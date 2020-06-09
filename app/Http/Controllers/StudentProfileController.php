<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $me = session('me');
        return view('student.profile',compact('me'));
    }

    public function settings()
    {
        $me = session('me');
        return view('student.settings',compact('me'));
    }

    public function UserActiveDB($status){
        $UserID= session('uid');
        $docRef =  $this->db->collection('User');
        $account = $docRef->document($UserID)->update(
            [
                ['path' => 'active','value' => $status],

            ]
        );
    }


    public function update(Request $Request)
    {
        $Request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|',
            'Bio' => 'required|string|max:405',
            'ProfileImg' => 'max:10000|mimes:png,jpg,jpeg'
        ]);
        $UserID=session('uid');
        $ad= new AdminController();
        $docRef =  $this->db->collection('User');
        if($Request->hasFile('ProfileIMG')){
            $profile = $ad->uploadFileToStorage("UserProfile",$Request['ProfileIMG']);
            $user = new User($UserID,$Request['Email'],"",$profile,$Request['FirstName'],$Request['LastName'],$Request['Bio'],'');
            $account = $docRef->document($UserID)->update(
                [
                    ['path' => 'FirstName','value' => $user->firstName],
                    ['path' => 'LastName','value' => $user->lastName],
                    ['path' => 'Bio','value' => $user->bio],
                    ['path' => 'ProfileIMG','value' => $profile],

                ]
            );
        }else{

            $account = $docRef->document($UserID)->update(
                [
                    ['path' => 'FirstName','value' => $Request['FirstName']],
                    ['path' => 'LastName','value' => $Request['LastName']],
                    ['path' => 'Bio','value' => $Request['Bio']],


                ]
            );

        }

        $me =  UsersController::user($UserID,$this->db);

        session()->put('me', $me);
        return redirect()->route('student.profile');
    }

    public function updateEmailDB($email){
        $UserID=session('uid');
        $docRef =  $this->db->collection('User');
        $account = $docRef->document($UserID)->update(
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
        return redirect()->route('student.settings');

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
