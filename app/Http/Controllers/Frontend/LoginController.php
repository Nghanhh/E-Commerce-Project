<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Str;
//Dòng này import (nạp) class Str từ thư viện hỗ trợ của Laravel. Str cung cấp rất
//nhiều hàm xử lý chuỗi (string) như contains, startsWith, endsWith, v.v.

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    
    public function index(Request $request)
    {
        if (!$request->is('member/login')) {
            session(['url.intended' => url()->previous()]);
        }
        // var_dump(Auth::check());
        return view("Frontend.member.login");
        //dd (session('url.intended'));
        //return redirect()->back();
    }
    
    
    public function login(LoginRequest $request)
    {
       
            $login = [

                'email' => $request->email,
                'password' => $request->password,
                'level' => 0   
            ];

            $remember = false;

            if($request->remember_me){ //Nếu cái ô remeber_me được tick
                $remember = true;
            }

            //Tại sao không được?????????
            if(Auth::attempt($login, $remember)){
                $intendedUrl = session('url.intended', '/');
                return redirect($intendedUrl)->with('success', 'Đăng nhập thành công!');
            }else{
                return redirect()->back()->withErrors('Email of password is not correct.');
            }
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function logout()
    {
        //$currentUrl = url()->current();
        //echo $currentUrl;

        if(Str::contains(url()->current(),'member')){
            Auth::logout(); // Đăng xuất người dùng
            return redirect()->back(); 
            //echo "hello";
        }

        if(Str::contains(url()->current(),'account')){
            Auth::logout(); // Đăng xuất người dùng
            return redirect('/member/login'); 
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
    

}
