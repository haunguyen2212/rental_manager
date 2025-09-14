<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
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
     */
    public function index()
    {
        $data['users'] = $this->userRepository->searchListUser();
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['option'] = [
            'role' => $this->roleRepository->getDropdown(),
        ];
        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        try{
            $user = $this->userRepository->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request['password']),
                'role_id' => $request->role_id,
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
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
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
}
