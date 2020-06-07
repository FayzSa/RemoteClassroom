<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth;
use PhpParser\Node\Stmt\TryCatch;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   




    public function myProfile($Admin)
    {
       $admin = [];
       $docRef =  $this->db->collection('Admin')->document($Admin);
       
       $snapshot = $docRef->snapshot();
       $Adminprofile = $snapshot;
       $Admin = new 
       Admin($Adminprofile->id(), $Adminprofile["FirstName"] ,
       $Adminprofile["LastName"] ,$Adminprofile["Email"] ,
       $Adminprofile["Bio"],$Adminprofile["ProfileIMG"]); 
      
      return $Admin;
    }


    public function index()
    {
        $Admin =$this->myProfile(session('uid'));
        return view('profile', compact('Admin'));
    }

    // about 
    public function about()
    {
        // $Admin =$this->myProfile(session('uid'));
        return view('about');
    }



    public function settings()
    {
         $admin = $this->auth->getUser(session('uid'));
        // $Admin =$this->myProfile("dqKf3DftOeT7VTZ6ju7w");
    
        // print_r($admin);
        return view('Admin.Settings.index',compact('admin'));
    }


    public function ListeUsers($type)
    {

        $docRef =  $this->db->collection('User');
        $snapshot = $docRef->where('Type','==',$type)->documents();
        $users = $snapshot;   
        
       return $users;

        // $Admin =AdminController::myProfile("dqKf3DftOeT7VTZ6ju7w");
        //return view('Admin.Students.index');
    }

    public function ListeAdmins()
    {

        $docRef =  $this->db->collection('Admin');
        $snapshot = $docRef->orderby('created_at','DESC')->documents();
        $admins = $snapshot;   
        
       return $admins;

        
    }
    public function Admins(){
        $admins = $this->ListeAdmins();
        return view('Admin.Admins.index', compact('admins'));
    }

    public function ListeClassrooms()
    {

        $docRef =  $this->db->collection('Classrooms');
        $snapshot = $docRef->documents();
        $classrooms = $snapshot;   
        
       return $classrooms;

        
    }
    public function ClassroomsByDate()
    {

        $week= date('Y-m-d H:i:s',strtotime('-7 days'));
        $date = new \DateTime($week);
       $datestr= $date->format('Y-m-d H:i:s');
        
        $docRef =  $this->db->collection('Classrooms');
        // ->whereDate('created_at', '>=', date('Y-m-d H:i:s',strtotime('-7 days')) )->count();
        $snapshot = $docRef->where('Created_at', '>=', $datestr);
        $classrooms = $snapshot->documents();   
        
       return $classrooms;

        
    }

    

    public function ListeTeachers(){
        $teachers = $this->ListeUsers("Teacher");
        return view('Admin.Teachers.index', compact('teachers'));
    }
    public function ListeStudents(){
        $students = $this->ListeUsers("Student");
        return view('Admin.Students.index', compact('students'));
    }

public function uploadfiles(Request $request){
    $fileArray =array();
    if($request->hasFile('attachment')) {

        $filesArray = $request->file('attachment');
        $folderName="prof";
        $docRef =  $this->db->collection('User')->newDocument();
        $filesArray = $this->uploadFileToStorage($folderName,$filesArray);
        $docRef->set([      
            'FirstName' => 'rachiiid',
            'LastName' => 'fayz',
            'Bio' => 'Test upload files',
            'Email' => 'email@email.com',
            'ProfileIMG' => $filesArray

        ]);
        echo "upload succes ";

    }

}




    public function uploadFileToStorage($type,$file){
        $storage = app('firebase.storage');
        $defaultBucket = $storage->getBucket();
        // $bucket = $storage->bucket('lpsfewebmobile.appspot.com');
         
           
            $name = $file->getClientOriginalName();
            $filename =  fopen($file->getRealPath(), 'r');
             
            // Upload file
            $object = $defaultBucket->upload($filename, [
                'name' => $type.'/'.$name 
            ]);
            
             $object->update(
                 ['acl' => []],
                  ['predefinedAcl' => 'PUBLICREAD']
             );
             $url ="https://storage.googleapis.com/elearningapp-30a10.appspot.com/".$type."/".$name;
             
  
       

          return $url;
    }



    public function uploadforum(){
        return view('testUpload');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $request->validate([
                'FirstName' => 'required|string|max:255',
                'LastName' => 'required|string|max:255',
                'Email' => 'required|email|max:255|',
                'password' => 'required|confirmed|max:405',
                'password_confirmation' => 'required|max:405'
            ]);


            
                $email = $request->Email;
                $password = $request->password;
                $authRef = $this->auth->createUser([
                     'email' => $email,
                    'password' => $password
               ]);
               $user = $this->auth->signInWithEmailAndPassword($email, $password);
           
            $date = new \DateTime();
            $createdAt= $date->format('Y-m-d H:i:s');
               
               $newuser = $this->db->collection('Admin')->document($user->firebaseUserId());
                $newuser->set([
                'FirstName' => $request->FirstName,
                'LastName'  => $request->LastName,
                'Email'       => $request->Email,
                'Bio' => '',
                'created_at' => $createdAt,
                'ProfileIMG' =>''
                ]); 
                session()->flash('status', 'admin added succesfully');
                // session()->put('status', "");
                    
                $this->Admins();
            //   $actionCodeSettings = [
            //            'continueUrl' => 'www.remoteclassroom.com/home'
            //   ];

            //    app('firebase.auth')->sendEmailVerificationLink($email, $actionCodeSettings);

            //    echo $authRef->uid; //This is unique id of inserted user.
            
    }
  
public function UserActiveDB($status,$UserID){

    $docRef =  $this->db->collection('User');
    $account = $docRef->document($UserID)->update(
        [
['path' => 'active','value' => $status],

  ]
    );
}

    public function teacherssettings($id){
        $docRef = $this->db->collection('User')->document($id)->snapshot();
        if($docRef['active']){
            
           
        $disible  = $this->auth->disableUser($id);
        $this->UserActiveDB(false,$id);
        // $Request->session()->flash('success', .');
        return redirect()->route('teachers');
        }else{
            $updatedUser = $this->auth->enableUser($id);
        $this->UserActiveDB(true,$id);
        return redirect()->route('teachers');
        }
    }



    public function studentssettings($id){
        $docRef = $this->db->collection('User')->document($id)->snapshot();
        if($docRef['active']){
            
           
        $disible  = $this->auth->disableUser($id);
        $this->UserActiveDB(false,$id);
        // $Request->session()->flash('success', .');
        return redirect()->route('students');
        }else{
            $updatedUser = $this->auth->enableUser($id);
        $this->UserActiveDB(true,$id);
        return redirect()->route('students');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
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
    public function update(Request $request, $id)
    {
        //
    }


    public function updateActiveDB($status,$adminID){

        $docRef =  $this->db->collection('Admin');
        $account = $docRef->document($adminID)->update(
            [
    ['path' => 'active','value' => $status],
    
      ]
        );
    
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $docRef = $this->db->collection('Admin')->document($id)->snapshot();
        if($docRef['active']){
           
        $disible  = $this->auth->disableUser($id);
        $this->updateActiveDB(false,$id);
        // $Request->session()->flash('success', .');
        return redirect()->route('Admins');
        }else{
            $updatedUser = $this->auth->enableUser($id);
        $this->updateActiveDB(true,$id);
        return redirect()->route('Admins');
        }
        // $docRef->delete();

        // return redirect('/departements');
    }
}
