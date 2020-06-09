<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use App\User;
use DateTime;
use Google\Cloud\Firestore\FieldValue;

use Illuminate\Support\Facades\Http;


class ClassroomsController extends Controller
{
  

    private function myClasses($OwenrID)
    {
       $classrooms = [];
       $docRef =  $this->db->collection('Classrooms');
       $snapshot = $docRef->where('OwnerID','==',$OwenrID)->documents();
       foreach($snapshot as $dataFormsnap)
       {
        if($dataFormsnap->exists()){
           $class = new
           Classroom($dataFormsnap->id(), $dataFormsnap["Students"]  ?? [],
           $dataFormsnap["Courses"] ?? [],$dataFormsnap["InviteCode"] ,
           $dataFormsnap["ClassName"] ,$OwenrID ,$dataFormsnap["Requests"]  ?? [],$dataFormsnap["Tests"] ?? []
       );
       array_push($classrooms,$class);
    }
       }
       //print_r($classrooms);
      return $classrooms;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
    //   print_r(session('uid'));
         $me = session('me');
        $classrooms = $this->myClasses(session('uid'));
        return view('teacher.classrooms.index', compact('classrooms','me'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $me = session('me');
        return view('teacher.classrooms.create',compact('me'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $me = session('me');
        $classroom = Classroom::setNewClass($this->validateReq(),session('uid'));
        $this->storeClass($classroom);
        $classrooms = $this->myClasses(session('uid'));
        return view('teacher.classrooms.index', compact('classrooms','me'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show($classroomID)
    {
       // print_r($classroomID);
       $me = session('me');
        $classroom = $this->tClass($classroomID);
        return view("teacher.classrooms.show",compact('classroom','me'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit($classroomID)
    {
        $classroom = $this->tClass($classroomID);
        $me = session('me');
        return view("teacher.classrooms.edit",compact('classroom','me'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update($classroomID)
    {

        $classroom = $this->updateClass($this->validateReq(),$classroomID);
        return redirect("teacher/classrooms/show/$classroomID");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy($classroomID)
    {
        $docRef =  $this->db->collection('Classrooms')
        ->document($classroomID)
        ->delete();
     return redirect('teacher/classrooms/');
     // delete all courses
    }


    private function validateReq(){

        return
          request()->validate([
            'ClassName'=>'required|min:4',
            'invitCode'=>'required',
          ]);

      }

      private function storeClass(Classroom $class)
      {
          $date = new DateTime();
          $dateNow = $date->format("Y-m-d H:i:s");
        $docRef =  $this->db->collection('Classrooms')->newDocument();
       // print_r($docRef->id());
       $newClass =  $docRef->set([
          'ClassName' => $class->className,
          'Courses'  => [],
          'InviteCode' =>  $class->invitCode,
          'OwnerID' => session('uid'),
          'Students' => [],
          'Created_at'=>$dateNow,
          'LiveRunning'=>false,
          'Requests' => []
        ]);


      }
  private function tClass($classroomID)
{

    $docRef =  $this->db->collection('Classrooms');
    $class = $docRef->document($classroomID)->snapshot();

    $students = [];
    $ClassStd =$class->data()["Students"]; 
   
    foreach($ClassStd as $student)
    {
        
        $std = $this->user($student);
        if($std!=null){
        array_push($students,$std);
    } 
}
    $classroom = new
    Classroom($class->id(), $students ,
    $class["Courses"]  ?? [],$class->data()["InviteCode"] ,
    $class->data()["ClassName"] ,session('uid') , $class->data()["Requests"]  ?? [],$class->data()['Tests']  ?? []);
    return $classroom;
}


public function requests($classroomID){
    $me = session('me');
    $classroom = $this->tClass($classroomID);
    $students = [];
    foreach($classroom->requests as $request){

        $student = $this->user($request);
        if($student!=null){
            array_push($students,$student);
        }
       
    }
    return view('teacher.classrooms.request',compact('students','classroomID','me'));
}
public function addStudentToClass($classroomID,$studentID){
    
    $this->db->collection('Classrooms')->document($classroomID)->update([
        [
            "path" => 'Students',
            'value' => FieldValue::arrayUnion([
                $studentID])
        ]
    ]);
    $this->db->collection('Classrooms')->document($classroomID)->update([
        [
            "path" => 'Requests',
            'value' => FieldValue::arrayRemove([$studentID])
        ]
    ]);

    return redirect("teacher/classrooms/requestes/$classroomID");
}

public function removeStudentFromClass($classroomID,$studentID){
    $this->db->collection('Classrooms')->document($classroomID)->update([
        [
            "path" => 'Requests',
            'value' => FieldValue::arrayRemove([$studentID])
        ]
    ]);
    return redirect("teacher/classrooms/requestes/$classroomID");
}

private function updateClass($Request , $classroomID)
{

    $docRef =  $this->db->collection('Classrooms');
    $class = $docRef->document($classroomID)->update(
        [
['path' => 'InviteCode','value' => $Request['invitCode']],
['path' => 'ClassName','value' => $Request['ClassName']],

  ]
    );

}

public function user($user_id)
{
    $user = null;
    $userRef = $this->db->collection('User')->document($user_id)->snapshot();
    if($userRef->exists()){
    $user = new User($userRef->id(),$userRef->data()["Email"],
    $userRef->data()["CreatedDate"],$userRef->data()["ProfileIMG"] ?? '',
    $userRef->data()["FirstName"],$userRef->data()["LastName"],$userRef->data()["Bio"] ?? '',$userRef->data()["Type"]);
    }
    return $user;
}

}
