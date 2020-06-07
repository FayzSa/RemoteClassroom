<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        return view('profile');
    }

    // public function update(Request $Request)
    // {
    //     $Request->validate([
    //         'FirstName' => 'required|string|max:255',
    //         'LastName' => 'required|string|max:255',
    //         'Email' => 'required|string|email|max:255|',
    //         'Bio' => 'required|string|max:405',
    //         'profileImg' => 'max:10000|mimes:png,jpg,jpeg'
    //     ]);
    //     $adminID="dqKf3DftOeT7VTZ6ju7w";
    //     $admin= new Admin($adminID,$Request['FirstName'],$Request['LastName'],$Request['Email'],$Request['Bio']);

    //     $docRef =  $this->db->collection('Admin');
    //     if($Request->hasFile('ProfileIMG')){
    //         $account = $docRef->document($adminID)->update(
    //             [
    //     ['path' => 'FirstName','value' => $admin->FirstName],
    //     ['path' => 'LastName','value' => $admin->LastName],
    //     ['path' => 'Bio','value' => $admin->Bio],
    //     ['path' => 'ProfileIMG','value' => $Request['ProfileIMG']],
    
    //       ]
    //         );
    //     }else{

    //         $account = $docRef->document($adminID)->update(
    //             [
    //     ['path' => 'FirstName','value' => $admin->FirstName],
    //     ['path' => 'LastName','value' => $admin->LastName],
    //     ['path' => 'Bio','value' => $admin->Bio],
        
    
    //       ]
    //         );

    //     }
      

    //     // $admin->name = $request->input('name');
    //     // $user->last_name = $request->input('last_name');
    //     // $user->email = $request->input('email');

    //     // if (!is_null($request->input('current_password'))) {
    //     //     if (Hash::check($request->input('current_password'), $user->password)) {
    //     //         $user->password = $request->input('new_password');
    //     //     } else {
    //     //         return redirect()->back()->withInput();
    //     //     }
    //     // }

    //     // $user->save();

    //     return redirect()->route('profile');
    // }
}
