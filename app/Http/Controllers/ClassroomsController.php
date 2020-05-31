<?php

namespace App\Http\Controllers;

use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use Illuminate\Http\Request;
use App\Classroom;
<<<<<<< HEAD
=======
use App\User;
use DateTime;
use Google\Cloud\Firestore\FieldValue;

>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
use Illuminate\Support\Facades\Http;


class ClassroomsController extends Controller
{
   protected $bbb;

    /**
     * ClassroomsController constructor.
     */

    private function myClasses($OwenrID)
    {
       $classrooms = [];
       $docRef =  $this->db->collection('Classrooms');
       $snapshot = $docRef->where('OwnerID','==',$OwenrID)->documents();
       foreach($snapshot as $dataFormsnap)
       {
           $class = new
           Classroom($dataFormsnap->id(), $dataFormsnap["Students"] ,
           $dataFormsnap["Courses"] ,$dataFormsnap["InviteCode"] ,
<<<<<<< HEAD
           $dataFormsnap["ClassName"] ,$OwenrID
=======
           $dataFormsnap["ClassName"] ,$OwenrID ,$dataFormsnap["Requests"]
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
       );
       array_push($classrooms,$class);

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
<<<<<<< HEAD

        $classrooms =ClassroomsController::myClasses("9152801b0c7e44838a0d");
=======
        $classrooms =$this->myClasses("9152801b0c7e44838a0d");
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
        return view('teacher.classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $classroom = Classroom::setNewClass($this->validateReq(),"9152801b0c7e44838a0d");
<<<<<<< HEAD
        ClassroomsController::storeClass($classroom);
=======
        $this->storeClass($classroom);
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
        return view('teacher.classrooms.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show($classroomID)
    {
<<<<<<< HEAD
        print_r($classroomID);
        $classroom = ClassroomsController::tClass($classroomID);

=======
       // print_r($classroomID);
        $classroom = $this->tClass($classroomID);
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
        return view("teacher.classrooms.show",compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit($classroomID)
    {
<<<<<<< HEAD
        $classroom = ClassroomsController::tClass($classroomID);
=======
        $classroom = $this->tClass($classroomID);
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097

        return view("teacher.classrooms.edit",compact('classroom'));
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

<<<<<<< HEAD
        $classroom = ClassroomsController::updateClass($this->validateReq(),$classroomID);
=======
        $classroom = $this->updateClass($this->validateReq(),$classroomID);
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
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
<<<<<<< HEAD
=======
     // delete all courses
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
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
<<<<<<< HEAD
=======
          $date = new DateTime();
          $dateNow = $date->format("Y-m-d H:i:s");
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
        $docRef =  $this->db->collection('Classrooms')->newDocument();
       // print_r($docRef->id());
       $newClass =  $docRef->set([
          'ClassName' => $class->className,
          'Courses'  => [],
          'InviteCode' =>  $class->invitCode,
          'OwnerID' => "9152801b0c7e44838a0d",
<<<<<<< HEAD
          'Students' => []
=======
          'Students' => [],
          'Created_at'=>$dateNow
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
        ]);


      }
  private function tClass($classroomID)
{

    $docRef =  $this->db->collection('Classrooms');
    $class = $docRef->document($classroomID)->snapshot();

    $classroom = new
    Classroom($class->id(), $class->data()["Students"] ,
    $class["Courses"] ,$class->data()["InviteCode"] ,
<<<<<<< HEAD
    $class->data()["ClassName"] ,"My ID");
=======
    $class->data()["ClassName"] ,"My ID" , $class->data()["Requests"]);
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
    return $classroom;
}

public function create_meeting(Request $request){


    $bbb = new BigBlueButton();

    $username = $request->get('username');
    $password = $request->get('password');
    $attendedpassword = $request->get('attendedpassword');
    $meeting_id = $request->get('meeting');
    $meetiongName = $request->get('meetingname');
    $welcomemessage = $request->get('welcomemesage');
    $createMeetingParams = new CreateMeetingParameters($meeting_id, $meetiongName);
    $createMeetingParams->setAttendeePassword($attendedpassword);
    $createMeetingParams->setModeratorPassword($password);
    $createMeetingParams->setWelcomeMessage($welcomemessage);
    $createMeetingParams->setLogoutUrl('127.0.0.1:8000');
<<<<<<< HEAD

=======
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
//    if ($isRecordingTrue) {
//        $createMeetingParams->setRecord(true);
//        $createMeetingParams->setAllowStartStopRecording(true);
//        $createMeetingParams->setAutoStartRecording(true);
//    }

    $response = $bbb->createMeeting($createMeetingParams);
    if ($response->getReturnCode() == 'FAILED') {
        return dd('Can\'t create room! please contact our administrator.');
    } else {

        $joinMeetingParams = new JoinMeetingParameters($meeting_id, $username, $password); // $moderator_password for moderator
        $joinMeetingParams->setRedirect(true);
        $url = $bbb->getJoinMeetingURL($joinMeetingParams);
       header('Location:' . $url);
       return dd('room created');
    }


}

public function join_meeting(Request $request){
            $username = $request->get('username');
        $password = $request->get('password');
        $meetingid = $request->get('meetingId');
    $bbb = new BigBlueButton();

    $joinMeetingParams = new JoinMeetingParameters($meetingid, $username, $password); // $moderator_password for moderator
    $joinMeetingParams->setRedirect(true);
    $url = $bbb->getJoinMeetingURL($joinMeetingParams);
 header('Location:' . $url);
 dd('room joined');
}

<<<<<<< HEAD

private function updateClass($Request , $classroomID)
=======
public function requests($classroomID){
    $classroom = $this->tClass($classroomID);
    $students = [];
    foreach($classroom->requests as $request){
        $student = $this->user($request);
        array_push($students,$student); 
    }
    return view('teacher.classrooms.request',compact('students','classroomID'));
}
public function addStudentToClass($classroomID,$studentID){
    print_r($classroomID);
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

private function updateCourse($Request , $classroomID)
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
{

    $docRef =  $this->db->collection('Classrooms');
    $class = $docRef->document($classroomID)->update(
        [
['path' => 'InviteCode','value' => $Request['invitCode']],
['path' => 'ClassName','value' => $Request['ClassName']],

  ]
    );

}

<<<<<<< HEAD
=======
private function user($user_id)
{
    $userRef = $this->db->collection('User')->document($user_id)->snapshot();
    
    $user = new User($userRef->id(),$userRef->data()["Email"],
    $userRef->data()["CreatedDate"],$userRef->data()["ProfileIMG"],
    $userRef->data()["FirstName"],$userRef->data()["LastName"],$userRef->data()["Bio"],$userRef->data()["Type"]);
   // print_r($userRef->id());
   return $user;
}

>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
}
