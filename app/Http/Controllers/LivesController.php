<?php

namespace App\Http\Controllers;
use App\Classroom;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use Illuminate\Http\Request;

class LivesController extends Controller
{
    

    public function create_meeting(Request $request ,$classroomID){
        $me = session('me');
     
       $class= $this->tClass($classroomID);
        
        $bbb = new BigBlueButton();
       
        $username = $me->firstName." ".$me->lastName ;
        $password = $me->userID;
        $attendedpassword = $class->invitCode;
        $meeting_id = $class->invitCode;
        $meetiongName = $request->get('meetingname');
        $welcomemessage = $request->get('welcomemesage');
        $createMeetingParams = new CreateMeetingParameters($meeting_id, $meetiongName);
        $createMeetingParams->setAttendeePassword($attendedpassword);
        $createMeetingParams->setModeratorPassword($password);
        $createMeetingParams->setWelcomeMessage($welcomemessage);
        $createMeetingParams->setLogoutUrl(route('live.changestate',['classroomID'=>$classroomID]));

        $docRef =  $this->db->collection('Classrooms');
        $class = $docRef->document($classroomID)->update(
            [
    
    ['path' => 'LiveRunning','value' => true],
    
      ]
        );

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

    
    public function createLive($classroomID)
    {
        $me = session('me');
        $classroom = $this->tClass($classroomID);
        return view('teacher.classrooms.createmeeting',compact('classroom','me','classroomID'));
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

    public function changeState($classroomID)
    {
        $docRef =  $this->db->collection('Classrooms');
        $class = $docRef->document($classroomID)->update(
            [
    
    ['path' => 'LiveRunning','value' => false],
    
      ]
        );

        $me = session('me');
        $classroom = $this->tClass($classroomID);
        return view("teacher.classrooms.show",compact('classroom','me'));
    }
    
}
