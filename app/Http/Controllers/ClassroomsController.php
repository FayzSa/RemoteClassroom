<?php

namespace App\Http\Controllers;

use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use Illuminate\Http\Request;
use App\Classroom;
use App\User;
use DateTime;
use Google\Cloud\Firestore\FieldValue;

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
        if($dataFormsnap->exists()){
           $class = new
           Classroom($dataFormsnap->id(), $dataFormsnap["Students"] ,
           $dataFormsnap["Courses"] ,$dataFormsnap["InviteCode"] ,
           $dataFormsnap["ClassName"] ,$OwenrID ,$dataFormsnap["Requests"]
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
        $classrooms = $this->myClasses("9152801b0c7e44838a0d");
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
        $this->storeClass($classroom);
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
       // print_r($classroomID);
        $classroom = $this->tClass($classroomID);
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
        $classroom = $this->tClass($classroomID);

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
          'OwnerID' => "9152801b0c7e44838a0d",
          'Students' => [],
          'Created_at'=>$dateNow
        ]);


      }
  private function tClass($classroomID)
{

    $docRef =  $this->db->collection('Classrooms');
    $class = $docRef->document($classroomID)->snapshot();

    $students = [];
    foreach($class->data()["Students"] as $student)
    {
        
        $std = $this->user($student);
        if($std!=null){
        array_push($students,$std);
    } }
    $classroom = new
    Classroom($class->id(), $students ,
    $class["Courses"] ,$class->data()["InviteCode"] ,
    $class->data()["ClassName"] ,"My ID" , $class->data()["Requests"]);
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

public function requests($classroomID){
    $classroom = $this->tClass($classroomID);
    $students = [];
    foreach($classroom->requests as $request){

        $student = $this->user($request);
        if($student!=null){
            array_push($students,$student);
        }
       
    }
    return view('teacher.classrooms.request',compact('students','classroomID'));
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

private function user($user_id)
{
    $user = null;
    $userRef = $this->db->collection('User')->document($user_id)->snapshot();
    if($userRef->exists()){
    $user = new User($userRef->id(),$userRef->data()["Email"],
    $userRef->data()["CreatedDate"],$userRef->data()["ProfileIMG"],
    $userRef->data()["FirstName"],$userRef->data()["LastName"],$userRef->data()["Bio"],$userRef->data()["Type"]);
    }
    return $user;
}

}
