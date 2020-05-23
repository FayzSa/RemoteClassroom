<?php

namespace App\Http\Controllers;

use App\BigBlueButton;
use App\BigBlueButton\Parameters\CreateMeetingParameters;
use Illuminate\Http\Request;
use App\Classroom;
use Illuminate\Support\Facades\Http;
use App\BigBlueButton\Parameters\JoinMeetingParameters;

class ClassroomsController extends Controller
{
   protected $bbb;

    /**
     * ClassroomsController constructor.
     */
    public function __construct()
    {
        $this->bbb = new BigBlueButton();
    }

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
           $dataFormsnap["ClassName"] ,$OwenrID
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

        $classrooms =ClassroomsController::myClasses("9152801b0c7e44838a0d");
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
        ClassroomsController::storeClass($classroom);
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
        print_r($classroomID);
        $classroom = ClassroomsController::tClass($classroomID);

        return view("teacher.classrooms.show",compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $docRef =  $this->db->collection('Classrooms')
        ->document($classroom->classroomID)
        ->delete();
        redirect('teacher.classrooms.index');
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
        $docRef =  $this->db->collection('Classrooms')->newDocument();
       // print_r($docRef->id());
       $newClass =  $docRef->set([
          'ClassName' => $class->className,
          'Courses'  => [],
          'InviteCode' =>  $class->invitCode,
          'OwnerID' => "9152801b0c7e44838a0d",
          'Students' => []
        ]);


      }
  private function tClass($classroomID)
{
    $docRef =  $this->db->collection('Classrooms');
    $class = $docRef->document($classroomID)->snapshot();

    $classroom = new
    Classroom($class->id(), $class->data()["Students"] ,
    $class["Courses"] ,$class->data()["InviteCode"] ,
    $class->data()["ClassName"] ,"My ID");
    return $classroom;
}
//
//public function createMeting(){
//        $big = new BigBlueButton();
////
////        $serversecretkey = 'igf2bniBLKYzKylkowueFYsIptyHM7r3W66btBQY';
////        $url ='name=English&welcome=helloworld&moderatorPW=google&isBreakoutRoom=false&attendeePW=maroc&meetingID=hello';
////        $appendcreate = 'create'.$url.$serversecretkey;
////        $checksum = sha1($appendcreate);
////       $response = Http::get('http://class.remoteclassroom.cloudns.cl/bigbluebutton/api/create?name=English&welcome=helloworld&moderatorPW=google&isBreakoutRoom=false&attendeePW=maroc&meetingID=hello&checksum='.$checksum);
////    return $response;
//
//    $world = new CreateMeetingParameters("hello world","english");
//    $world->setWelcomeMessage("hello world")->setModeratorOnlyMessage("ahmed sefrioui");
//    $join =
//
//    $world->setModeratorPassword("google")->setBreakout(false)->setAttendeePassword("home");
//    $life = $big->createMeeting($world);
//   dd($life->getMeetingId());
//    }
    public function create_meeting(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');
        $attendedpassword = $request->get('attendedpassword');
        $meeting_id = $request->get('meeting');
        $meetiongName = $request->get('meetingname');
       $welcomemessage = $request->get('welcomemesage');
        $parameter = new CreateMeetingParameters($meeting_id,$meetiongName);
        $parameter->setModeratorPassword($password)->setWelcomeMessage($meetiongName);
        $parameter->setAttendeePassword($attendedpassword);
        $parameter->setWelcomeMessage($welcomemessage);
       $meetingurl =  $this->bbb->getCreateMeetingUrl($parameter);
       $joinurl = 'to create the meeting use that url';
        return view('teacher.classrooms.joinlivescript',compact('joinurl','meetingurl'));

    }

    public function joinMeeting(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');
        $meetingid = $request->get('meetingId');
        $joinmeetingparameter = new JoinMeetingParameters($meetingid,$username,$password);
        $joinurl = $this->bbb->getJoinMeetingURL($joinmeetingparameter);
        $meetingurl = 'to  join use that url';
        return view('teacher.classrooms.joinlivescript',compact('joinurl','meetingurl'));

    }
//
//    public function joinmeeting(){
//
//       $join = new JoinMeetingParameters("hello world","arouche","home");
//        $big = new BigBlueButton();
//        dd($big->getJoinMeetingURL($join));
//    }
//    public function  joinmodirator(){
//        $join = new JoinMeetingParameters("hello world","hamo","google");
//        $join = $join->setUserId("life");
//        $big = new BigBlueButton();
//        $modiratorurl = $big->getJoinMeetingURL($join);
//        dd($modiratorurl);
//    }
//    public function google($username){
//        $join = new JoinMeetingParameters("hello world",$username,"home");
//        $big = new BigBlueButton();
//        dd($big->getJoinMeetingURL($join));
//    }
    public function withpdffunction(){

//        <modules>
//   <module name="presentation">
//      <document url="http://www.sample-pdf.com/sample.pdf" filename="report.pdf"/>
//      <document name="sample-presentation.pdf">JVBERi0xLjQKJ....
//        [clipped here]
//        ....0CiUlRU9GCg==
//      </document>
//   </module>
//</modules>

    }
}


/* ]
new Map
$docRef->set([
   'location' => new \Google\Cloud\Core\GeoPoint(<latitude>,<longitude>)
]);
//GeoPoint(20.593683,78.962883)

*/
