<?php

namespace App\Http\Controllers\Frontend;

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
    public function edit(/* string $id */)
        {

            if (Auth::check()){
    
                $user = Auth::user();
                $country = Country::all()->toArray();

                /* echo "<pre>";
                var_dump ($user);
                echo "</pre>"; */
                
                return view('Frontend.member.account', compact('user','country'));
    
            }else{
                
                return redirect('/member/login');
            }
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
