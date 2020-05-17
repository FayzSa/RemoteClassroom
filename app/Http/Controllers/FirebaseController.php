<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Auth;

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
