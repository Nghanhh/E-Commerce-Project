<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;

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
        
        /* echo "<pre>";
        var_dump($data);
        echo "<pre/>"; */
       

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }

        if(!empty($file)){ 
            $data['avatar'] = $file->getClientOriginalName(); 
        }
        
        echo $data['avatar'];
       if (User::create($data)) {
            
            if(!empty($file)){

                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }

            return redirect()->back()->with('success', __('Create profile success.'));

        } else {

            return redirect()->back()->withErrors('Create profile error.');
            
        }  
    }
}
