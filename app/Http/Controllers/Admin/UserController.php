<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserSearchRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;

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
            return response()->json([
                'data' => $user,
                'url_redirect' => route('admin.user.index'),
                'message' => __('messages.insert_success'),
                'success' => true
            ]);
        }
        catch(\Exception $e){
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
            $user = $this->userRepository->update($params, $id);
            return response()->json([
                'data' => $user,
                'message' => __('messages.update_success'),
                'success' => true
            ]);
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
                $ids = explode(',', $request->id);
                $this->userRepository->whereIn('id', $ids)->delete();
                return response()->json(['success' => true, 'message' => __('messages.delete_success')]);
            }
            return response()->json(['success' => true, 'message' => __('messages.delete_error')], 500);
        }
        catch(\Exception $e){
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
