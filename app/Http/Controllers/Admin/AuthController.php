<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Mail\Admin\ResetPasswordMail;
use App\Repositories\PasswordResetTokenRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Pest\Support\Str;

class AuthController extends Controller
{
    protected $userRepository, $passwordResetTokenRepository;

    public function __construct(
        UserRepository $userRepository,
        PasswordResetTokenRepository $passwordResetTokenRepository
    ){
        $this->userRepository = $userRepository;
        $this->passwordResetTokenRepository = $passwordResetTokenRepository;
    }

    /**
     * Show login form
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        try{
            return view('admin.auth.login');
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Login
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try{
            $user = $this->userRepository->where('username', $request->username)->whereIn('role_id', [SUPER_ADMIN, ADMIN])->first();

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

    /**
     * Logout
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Show forgot password form
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showForgotPasswordForm()
    {
        try{
            return view('admin.auth.forgot-password');
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Show forgot password success page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showForgotPasswordSuccess()
    {
        try{
            return view('admin.auth.forgot-password-success');
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Forgot password
     *
     * @param ForgotPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try{
            $user = $this->userRepository->checkMailForgetPassword($request->email, [SUPER_ADMIN, ADMIN]);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => __('passwords.user')
                ], 400);
            }
            $token = Str::random(64);
            $this->passwordResetTokenRepository->updateOrCreate(
                ['email' => $request->email],
                [
                    'token' => Hash::make($token),
                    'created_at' => Carbon::now(),
                    'expire_at' => Carbon::now()->addMinutes(30),
                ]
            );
            Mail::to($user->email)->send(new ResetPasswordMail($token, $user));
            return response()->json([
                'success' => true,
                'message' => __('passwords.sent'),
                'redirect' => route('admin.forgot-password.success')
            ]);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Show reset password form
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View
     */
    public function showResetPasswordForm(Request $request)
    {
        try{
            $token = $request->get('token');
            $email = $request->get('email');

            // Check if token and email exist
            if(!$token || !$email) {
                return redirect()->route('admin.reset-password.error')
                    ->with('error', __('messages.reset_password_invalid_link'));
            }

            // Validate email format
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return redirect()->route('admin.reset-password.error')
                    ->with('error', __('messages.reset_password_invalid_email'));
            }

            // Find password reset token in database
            $passwordReset = $this->passwordResetTokenRepository->where('email', $email)->first();
            
            if(!$passwordReset) {
                return redirect()->route('admin.reset-password.error')
                    ->with('error', __('messages.reset_password_token_not_found'));
            }

            // Check if the token matches
            if(!Hash::check($token, $passwordReset->token)) {
                return redirect()->route('admin.reset-password.error')
                    ->with('error', __('messages.reset_password_token_mismatch'));
            }

            // Check if the token has expired
            if($passwordReset->isExpired()) {
                return redirect()->route('admin.reset-password.error')
                    ->with('error', __('messages.reset_password_token_expired'));
            }

            // Check if user exists and has admin rights
            $user = $this->userRepository->checkMailForgetPassword($email, [SUPER_ADMIN, ADMIN]);

            if(!$user) {
                return redirect()->route('admin.reset-password.error')
                    ->with('error', __('passwords.user'));
            }

            return view('admin.auth.reset-password', [
                'token' => $token,
                'email' => $email
            ]);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Show reset password error page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function showResetPasswordError(Request $request)
    {
        try{
            return view('admin.auth.reset-password-error');
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Show reset password success page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showResetPasswordSuccess()
    {
        try{
            return view('admin.auth.reset-password-success');
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Reset password
     *
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        try{
            $token = $request->get('token');
            $email = $request->get('email');

            // Find password reset token in database
            $passwordReset = $this->passwordResetTokenRepository->where('email', $email)->first();
            
            if(!$passwordReset) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.reset_password_token_not_found')
                ], 400);
            }

            // Check if the token matches
            if(!Hash::check($token, $passwordReset->token)) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.reset_password_token_mismatch')
                ], 400);
            }

            // Check if the token has expired
            if($passwordReset->isExpired()) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.reset_password_token_expired')
                ], 400);
            }

            // Check if user exists and has admin rights
            $user = $this->userRepository->checkMailForgetPassword($email, [SUPER_ADMIN, ADMIN]);
            if(!$user) {
                return response()->json([
                    'success' => false,
                    'message' => __('passwords.user')
                ], 400);
            }

            DB::beginTransaction();
            $this->userRepository->update([
                'password' => Hash::make($request->password),
                'remember_token' => null
            ], $user->id);
            DB::table('sessions')->where('user_id', $user->id)->delete();
            $passwordReset->delete();
            write_activity_log('reset_password', "Tài khoản {$user->username} đã thay đổi mật khẩu");
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('passwords.reset'),
                'redirect' => route('admin.reset-password.success')
            ]);
        }
        catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
