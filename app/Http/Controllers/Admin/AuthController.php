<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository,
    ){
        $this->userRepository = $userRepository;
    }

    public function showLoginForm()
    {
        try{
            return view('admin.auth.login');
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function login(LoginRequest $request)
    {
        try{
            $user = $this->userRepository->where('username', $request->username)->whereIn('role_id', [1, 2])->first();

            if(!$user){
                return response()->json([
                    'success' => false,
                    'message' => __('messages.login_error')
                ]);
            }

            if($user->status){
                if ($user && $user->status == USER_STATUS_INACTIVE) {
                    return response()->json([
                        'success' => false,
                        'message' => __('messages.account_locked'),
                    ]);
                }
            }

            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();
                return response()->json([
                    'success' => true,
                    'message' => __('messages.login_success'),
                    'redirect' => route('admin.index')
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => __('messages.login_error')
            ]);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function logout(){
        try{
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('admin.login.get');
        }
        catch(\Exception $e){
            throw $e;
        }
    }
}
