<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordReset;
use App\Mail\SendLink;

class AuthController extends Controller
{
    public function showLogin() 
    {
        return view('client.auth.login');
    }

    /**
     * Login account
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $result = Auth::attempt(['email' => $request->email, 'password' => $request->password], true);
            if ($result) {
                Alert::success('Success', 'Đăng nhập thành công');
                return redirect()->route('home');
            } else {
                Alert::error('Error', 'Email hoặc mật khẩu không đúng, vui lòng thử lại');
                return redirect()->back();
            }
        } catch (\Throwable $e) {
            \Log::info($e->getMessage());
        }
    }

    /**
     * Logout account
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        Alert::success('Success', 'Đăng xuất thành công');
        return redirect()->route('auth.show.login');
    }

    public function forgetPassword()
    {
        return view('client.auth.forget-password');
    }

    public function postSendmail(Request $request)
    {
        $isExist = User::whereEmail($request->input('email'))->exists();
        if ($isExist) {
            $token = Str::random(30);
            PasswordReset::create([
                'email'    => $request->input('email'),
                'token'    => $token
            ]);
            Alert::success('Gửi link thành công, vui lòng kiểm tra hộp thư của bạn', 'Success');
            Mail::to($request->input('email'))->send(new SendLink($token));
        } else {
            Alert::error('Email không có trong hệ thống', 'Error');
        }
        return redirect()->back();
    }

    public function showChangePassword($token)
    {
        $user = PasswordReset::where('token', '=', $token)->first();
        return view('client.auth.change-password',['email' => $user['email']]);
    }

    public function updatePassword(Request $request)
    {
        
        if($request->input('password') === $request->input('password_confirm')){
            User::whereEmail($request->input('email'))->update(['password' => bcrypt($request->input('password'))]);
            Alert::success('Cập nhật thành công', 'Success');
            return redirect()->route('auth.show.login');
        }else{
            Alert::error('Mật khẩu không trùng khớp', 'Error');
            return redirect()->back();
        }
    }
}