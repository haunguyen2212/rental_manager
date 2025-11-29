<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserSearchRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $userRepository, $roleRepository;

    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository
    ){
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        try{
            $data['users'] = $this->userRepository->searchListUser($request);
            $data['option'] = [
                'role' => $this->roleRepository->getDropdown(),
                'user_status' => ['' => ''] + USER_STATUS,
            ];
            return view('admin.user.index', $data);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Validate the form for search
     * 
     * @param UserSearchRequest $request
     * @return Response
     */
    public function validateSearch(UserSearchRequest $request)
    {
        try{
            return response()->json([
                'data' => $request->validated(),
                'success' => true
            ]);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return view
     */
    public function create()
    {
        try{
            $data['option'] = [
                'role' => $this->roleRepository->getDropdown(),
            ];
            return view('admin.user.create', $data);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param UserStoreRequest $request
     * @return Response
     */
    public function store(UserStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            $user = $this->userRepository->create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
                'name' => $request->name,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);
            write_activity_log('create', "Đã tạo tài khoản mới: {$user->username} (id={$user->id})");
            DB::commit();
            return response()->json([
                'data' => $user,
                'url_redirect' => route('admin.user.index'),
                'message' => __('messages.insert_success'),
                'success' => true
            ]);
        }
        catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param string $id
     * @return view
     */
    public function show(string $id)
    {
        try{
            $data['user'] = $this->userRepository->getById($id);
            return view('admin.user.show', $data);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param string $id
     * @return view
     */
    public function edit(string $id)
    {
        try{
            $data['user'] = $this->userRepository->getById($id);
            $data['option'] = [
                'role' => $this->roleRepository->getDropdown(),
                'user_status' => ['' => ''] + USER_STATUS,
            ];
            return view('admin.user.edit', $data);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UserUpdateRequest $request
     * @param string $id
     * @return Response
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        try{
            $params = [
                'username' => $request->username,
                'role_id' => $request->role_id,
                'name' => $request->name,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'status' => $request->status,
                'updated_by' => auth()->id(),
            ];
            if(!empty($request->password)){
                $params['password'] = bcrypt($request->password);
            }
            $oldData = $this->userRepository->getById($id);
            $dataChange = $this->parseDataChangeUser($oldData->toArray(), $params);
            if($dataChange['is_changed']){
                DB::beginTransaction();
                $user = $this->userRepository->update($params, $id);
                write_activity_log('update', "Đã cập nhật thông tin tài khoản:  {$user->username} (id={$user->id}) <br> {$dataChange['message']}");
                DB::commit();
                return response()->json([
                    'data' => $user,
                    'message' => __('messages.update_success'),
                    'success' => true
                ]);
            }
            return response()->json([
                'data' => $oldData,
                'message' => __('messages.update_no_change'),
                'success' => true
            ]);
        }
        catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Parse the data change user
     * 
     * @param array $before
     * @param array $after
     * @return array
     */
    private function parseDataChangeUser($before = [], $after = []){
        try{
            $data = [];
            $message = '';
            $attributes = [
                'username' => 'Tên tài khoản',
                'name' => 'Họ và tên',
                'role_id' => 'Vai trò',
                'birthday' => 'Ngày sinh',
                'address' => 'Địa chỉ',
                'phone' => 'Số điện thoại',
                'email' => 'Email',
                'status' => 'Trạng thái',
            ];
            foreach($after as $key => $value){
                if(in_array($key, ['password', 'updated_by'])){
                    continue;
                }
                if($key == 'birthday'){
                    $value = !empty($value) ? Carbon::parse($value)->format(DATE_FORMAT_VIEW) : '';
                    $before[$key] = !empty($before[$key]) ? Carbon::parse($before[$key])->format(DATE_FORMAT_VIEW) : '';
                }
                if($value != $before[$key]){
                    $data[$key] = $value;
                    $message .= " - {$attributes[$key]}: {$before[$key]} → {$value} <br>";
                }
            }
            if(!empty($after['password'])){
                $data['password'] = '********';
                $message .= ' - Mật khẩu đã được thay đổi.';
            }
            return [
                'is_changed' => !empty($data),
                'data' => $data,
                'message' => $message,
            ];
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        try{
            if(!empty($request->id)){
                DB::beginTransaction();
                $ids = explode(',', $request->id);
                $users = $this->userRepository->whereIn('id', $ids)->pluck('username', 'id')->toArray();
                $userDelete = [];
                foreach ($users as $id => $username) {
                    $userDelete[] = "{$username} (id={$id})";
                }
                $userDeleteText = implode(', ', $userDelete);
                $totalUserDelete = count($users);
                $this->userRepository->whereIn('id', $ids)->delete();
                write_activity_log('delete', "Đã xóa {$totalUserDelete} tài khoản: {$userDeleteText}");
                DB::commit();
                return response()->json(['success' => true, 'message' => __('messages.delete_success')]);
            }
            return response()->json(['success' => true, 'message' => __('messages.delete_error')], 500);
        }
        catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the import screen.
     * 
     * @return view
     */
    public function excel(){
        try{
            return view('admin.user.excel');
        }
        catch(\Exception $e){
            throw $e;
        }
    }
}
