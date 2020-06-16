<?php

namespace App\Http\Controllers;
use App\Classroom;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use Illuminate\Http\Request;

class LivesController extends Controller
{



    public function join_meeting($meetingid){
        $username = session('me')->firstName.' '.session('me')->lastName;
        $bbb = new BigBlueButton();
        $joinMeetingParams = new JoinMeetingParameters($meetingid, $username,$meetingid); // $moderator_password for moderator
        $joinMeetingParams->setRedirect(true);
//        $url = $bbb->getJoinMeetingURL();
        $url = $bbb->getJoinMeetingURL($joinMeetingParams);
        header('Location:' . $url);
//     header('Location:' . $url);
     dd('room joined');
    }









    private function tClass($classroomID)
    {
        $docRef =  $this->db->collection('Classrooms');
        $class = $docRef->document($classroomID)->snapshot();
        $students = [];
        $classroom = new
        Classroom($class->id(), $students ,
        $class["Courses"] ,$class->data()["InviteCode"] ,
        $class->data()["ClassName"] ,session('uid') , $class->data()["Requests"],$class->data()['Tests']);
        return $classroom;
    }

    public function isliveRunning($classroom_id){
  $dataRef =   $this->db->collection('Classrooms')->document($classroom_id)->snapshot();
  if($dataRef->exists()){
      return $dataRef->data()['LiveRunning'];
  }
  return false;
}
public function createLive($classroomID){

    $me = session('me');

    $class= $this->tClass($classroomID);

    $bbb = new BigBlueButton();

    $username = $me->firstName." ".$me->lastName ;
    $password = $me->userID;
    $attendedpassword = $class->invitCode;
    $meeting_id = $class->invitCode;
    $meetiongName = $class->className;
    $welcomemessage = 'welcome dans ce live il faut savoir que tous votre donnes sont securise';
    $createMeetingParams = new CreateMeetingParameters($meeting_id, $meetiongName);
    $createMeetingParams->setAttendeePassword($attendedpassword);
    $createMeetingParams->setModeratorPassword($password);
    $createMeetingParams->setWelcomeMessage($welcomemessage);
    $createMeetingParams->setLogoutUrl(route('teacher.endMeeting',['classroomID' => $classroomID]));

    $docRef =  $this->db->collection('Classrooms');
    $class = $docRef->document($classroomID)->update(
        [

            ['path' => 'LiveRunning','value' => true],

        ]
    );


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
public function end_meeting($classroomID){
    $docRef =  $this->db->collection('Classrooms');
    $class = $docRef->document($classroomID)->update(
        [

            ['path' => 'LiveRunning','value' => false],

        ]
    );
    return redirect('127.0.0.1:8000/teacher/classrooms/show/'.$classroomID);
}
}
