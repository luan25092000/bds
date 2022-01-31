<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

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
}
