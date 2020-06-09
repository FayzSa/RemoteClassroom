<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth;
use Session;
use \Illuminate\Auth\SessionGuard;
class FirebaseController extends Controller
{
    //

    protected  $db;
    public function __construct() {
        $this->db = app('firebase.firestore')->database();
    }



    public function index()
    {
        echo "hello ";
        $docRef =  $this->db->collection('User');
        $query = $docRef;
        $search="Ayoub";
        $type="prof";
            $query = $docRef->where('FullName', '=', $search);

        $documents = $query->documents();
        foreach ($documents as $document) {
            if ($document->exists()) {
                printf('Document data for document %s:' . PHP_EOL, $document->id());
                print_r($document->data());
                printf(PHP_EOL);
            }
        }
    }


        public function register(){
            try {
                $email = 'arouche2@gmail.com';
                $password = '123456';
                $authRef = app('firebase.auth')->createUser([
                     'email' => $email,
                    'password' => $password
               ]);

              $actionCodeSettings = [
                       'continueUrl' => 'www.remoteclassroom.com/home'
              ];

               app('firebase.auth')->sendEmailVerificationLink($email, $actionCodeSettings);

               echo $authRef->uid; //This is unique id of inserted user.
        }
        catch (\Kreait\Firebase\Exception\Auth\EmailExists $ex) {
           echo 'email already exists';
        }
        }

        public function isAdmin($Admin){
            $docRef =  $this->db->collection('Admin')->document($Admin);

       $adminAccount = $docRef->snapshot();
       if($adminAccount->exists()){
        return true;
       }
       return false;
        }

        public function isStudent($id){
            $docRef =  $this->db->collection('User')->document($id);
            $TeacherAccount = $docRef->snapshot();
            if($TeacherAccount->exists() && $TeacherAccount['Type']=='Student'){
                return true;
            }
            return false;
                }





        public function isTeacher($id){
            $docRef =  $this->db->collection('User')->document($id);
            $TeacherAccount = $docRef->snapshot();
            if($TeacherAccount->exists() && $TeacherAccount['Type']=='Teacher'){
                return true;
            }
            return false;
                }






        public function LoginForm(){
            return view('auth.login');
        }
        public function Logincheck(Request $request){

            try {
                $logged_user = app('firebase.auth')->signInWithEmailAndPassword($request->email, $request->password);
                if ($logged_user) {

                    // session(['uid' => '$logged_user->uid']);
                    //  print_r($logged_user);
                    $me =  UsersController::user($logged_user->firebaseUserId(),$this->db);
                    session()->put('uid', $logged_user->firebaseUserId());
                    session()->put('me', $me);
                    return redirect()->route('home');
                }

                //Credentials are correct
          } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
                return back()->withErrors(['Credentials are incorrect']);
          }



        }



        // register
        public function RegisterForm(){
            return view('auth.register');
        }

        public function Registercheck(Request $request){
            $request->validate([
                'Type' => 'required',
                'FirstName' => 'required|string|max:255',
                'LastName' => 'required|string|max:255',
                'Email' => 'required|email|max:255|',
                'password' => 'required|confirmed|max:405',
                'password_confirmation' => 'required|max:405'
            ]);


            try {
                $email = $request->Email;
                $password = $request->password;
                $authRef = app('firebase.auth')->createUser([
                     'email' => $email,
                    'password' => $password
               ]);
               $user = app('firebase.auth')->signInWithEmailAndPassword($email, $password);

            $date = new \DateTime();
            $createdAt= $date->format('Y-m-d H:i:s');

               $newuser = $this->db->collection('User')->document($user->firebaseUserId());
                $newuser->set([
                'FirstName' => $request->FirstName,
                'LastName'  => $request->LastName,
                'Email'       => $request->Email,
                'Bio' => '',
                'Type'  => $request->Type,
                'CreatedDate' => $createdAt,
                'ProfileIMG' => "https://firebasestorage.googleapis.com/v0/b/elearningapp-30a10.appspot.com/o/undraw_male_avatar_323b%20(1).png"
                ]);
                session()->flash('status', 'account registred succesfully');
                // session()->put('status', "");

                return view('auth.login');
            //   $actionCodeSettings = [
            //            'continueUrl' => 'www.remoteclassroom.com/home'
            //   ];

            //    app('firebase.auth')->sendEmailVerificationLink($email, $actionCodeSettings);

            //    echo $authRef->uid; //This is unique id of inserted user.
        }
        catch (\Kreait\Firebase\Exception\Auth\EmailExists $ex) {
           echo 'email already exists';
        }


        }



        public function logout(){
            Session()->forget('uid');
            Session()->forget('me');
            return redirect(route('login'));
        }

        public function login(){


            try {
                $email ='arouche@gmail.com';
                $password = '123456';
                $user = app('firebase.auth')->signInWithEmailAndPassword($email,$password);
                if($user) {
                         echo 'login success';
                } else {
                        echo 'email verification pending';
                }
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
               echo 'Invalid password';
        }

        }

    public  function insertUser($uid){
        $docRef = $this->db->collection('User')->document($uid);
        $docRef->set([
            'FullName' => 'rachid',
            'LastNAme'  => 'fayz',
            'Type'       => 'ayoub'
        ]);
        return view('welcome');
    }

}
