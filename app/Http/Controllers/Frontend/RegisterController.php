<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $country = Country::all()->toArray();
        return view("Frontend.member.register",compact('country'));
    }   

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->all();
        $file = $request->avatar;

        //dd($data);
        
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }

        if(!empty($file)){ 
            $data['avatar'] = $file->getClientOriginalName(); 
        }
        
        // Tạo người dùng mới
        $user = User::create($data);
        //dd($data);=> có hết data người dùng mới rồi, lấy email và pass để login luôn

        //Nếu lưu thông tin thành công thì
       if ($user) {
            
            //Lưu file ava vào thư mục
            if(!empty($file)){

                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }

            //Sau đó lấy thông tin đó để đăng nhập luôn nha
            Auth::login($user); // Đăng nhập ngay lập tức sau khi tạo tài khoản

            return redirect()->back()->with('success', __('Create profile success.'));

        } else {

            return redirect()->back()->withErrors('Create profile error.');
            
        }  
    }

}
