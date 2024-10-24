<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateRequest;
use App\Models\User;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
       
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        $country = Country::all()->toArray();
        //var_dump ($country);
        return view('Admin.pages.pages-profile', compact('user','country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {
        $userId = Auth::id(); 
        $user = User::findOrFail($userId); 

        //var_dump ($request->all());
        $data = $request->all();
        $file = $request->avatar;
        
        if(!empty($file)){ 
            $data['avatar'] = $file->getClientOriginalName(); 
        }
        
       if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }
       
        if ($user->update($data)) {
            if(!empty($file)){
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        } 

    }

}
