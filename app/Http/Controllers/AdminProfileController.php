<?php

namespace App\Http\Controllers;
use App\Admin;
use App\User;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
    }




    public function update(Request $Request)
    {
        $Request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|',
            'Bio' => 'required|string|max:405',
            'profileImg' => 'max:10000|mimes:png,jpg,jpeg'
        ]);
        $adminID=session('uid');
        // $admin= new Admin($adminID,$Request['FirstName'],$Request['LastName'],$Request['Email'],$Request['Bio']);
            $ad= new AdminController();
        $docRef =  $this->db->collection('Admin');
        if($Request->hasFile('ProfileIMG')){
        $profile = $ad->uploadFileToStorage("Adminprofile",$Request['ProfileIMG']);
        $admin= new Admin($adminID,$Request['FirstName'],$Request['LastName'],$Request['Email'],$Request['Bio'],$profile);
            $account = $docRef->document($adminID)->update(
                [
        ['path' => 'FirstName','value' => $admin->FirstName],
        ['path' => 'LastName','value' => $admin->LastName],
        ['path' => 'Bio','value' => $admin->Bio],
        ['path' => 'ProfileIMG','value' => $profile],
    
          ]
            );
        }else{

            $account = $docRef->document($adminID)->update(
                [
        ['path' => 'FirstName','value' => $Request['FirstName']],
        ['path' => 'LastName','value' => $Request['LastName']],
        ['path' => 'Bio','value' => $Request['Bio']],
        
    
          ]
            );

        }

        return redirect()->route('profile');
    }

    public function updateEmailDB($email,$adminID){

        $docRef =  $this->db->collection('Admin');
        $account = $docRef->document($adminID)->update(
            [
    ['path' => 'Email','value' => $email],

      ]
        );

    }


    public function disableaccount(){

        $uid = session('uid');
        $disible  = $this->auth->disableUser($uid);
        Session()->forget('uid');

    }

   public function settingsUpdate(Request $Request){
    
    $Request->validate([
        'Email' => 'required|string|email|max:255',
    
    ]);
    if (empty($Request['new_password']&& empty($Request['password_confirmation']))) {
        
        $uid = session('uid');
        $updatedUser = $this->auth->changeUserEmail($uid, $Request['Email']);
        $this->updateEmailDB($Request['Email'],$uid);
        $Request->session()->flash('success', 'Your Email has been changed.');
    } if (!empty($Request['new_password'] && !empty($Request['password_confirmation']) && $Request['new_password']==$Request['password_confirmation'])) {
        $uid = session('uid');
        $updatePassword =$this->auth->changeUserPassword($uid, $Request['new_password']);
        $updatedUser = $this->auth->changeUserEmail($uid, $Request['Email']);
        $this->updateEmailDB($Request['Email'],$uid);
        
    }
    return redirect()->route('Admin.Settings');

   }






  

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
