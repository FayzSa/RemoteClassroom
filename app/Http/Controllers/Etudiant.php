<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Comment;
use App\Course;
use App\Test;
use Google\Cloud\Firestore\FieldValue;
use Illuminate\Http\Request;
///these is the student controller
///
class Etudiant extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*

    i still need to create methode which returns the array of class rooms of the student but i need the classromm model
    wich fayz will create
    methods that i create till now is : (each method has a description in it )
   | -------------------------------------------------------------------------------------------------------------------------------------|
   | DESCRIPTION                                                             |    PROTOTYPES                                              |
   | -------------------------------------------------------------------------------------------------------------------------------------|
   |  * exit class room                                                      : exit_class_room($id_of_user,$id_of_class_room)             |
   |  * get courses of classroom                                             : get_courses_of_classroom($classroom_collection)            |
   |  * get array of all course                                              : get_all_courses($id_of_user)                               |
   |  * get the id of classroom using invitecode                             : find_classroom_using_invitecode($invitecode)               |
   |  * add a student to a classroom                                         : add_to_a_class_room($classrom_id,$id_user)                 |
   |  * get array of comments                                                : get_comments_of_course($comments_collection)               |
   |  * comment to a course                                                  : comment_to_a_course($comments_collection,Comment $comment) |
   |  * add the student user to user collection                              : add_to_user_collection($user_id,$name,$lastname,$email)    |
   |  * register will do all the stuff invite code + autth+add to collection : register(Request $request)                                 |
   |--------------------------------------------------------------------------------------------------------------------------------------|
     */

/// these method allows to the student to  exit the class room
///you give it the id of student and the class he will exit
///
///

    public function index(){
            $id_user = 'B1Df9tQl7UiACljxusUi';
            $classrooms = $this->get_my_classrooms($id_user);
            return view('student.index',compact('classrooms'));
    }

   public function exit_class_room($classromID){
        $id_of_user = 'B1Df9tQl7UiACljxusUi';
       $docRef =  $this->db->collection('Classrooms');
       $docRef->document($classromID)->update([
           [
               "path" => 'Students',
               'value' => FieldValue::arrayRemove([$id_of_user])
           ]
       ]);
     return redirect('student/classrooms');
    }
///you give it a class room collection and it returns an array of courses
///

    public function get_courses_of_classroom($classroomID){
        $courses = array();
        $docRef =  $this->db->collection('Classrooms')->document($classroomID);
            $coursesDoc = $docRef->snapshot()->data()['Courses'];
            foreach ($coursesDoc as $courseDoc){
               $course = $this->get_course($courseDoc);
                array_push($courses,$course);
                }
       return view('student.classrooms.courses',compact('courses'));
    }

    public function get_course($course_id ){
        $docRef =  $this->db->collection('Courses')->document($course_id);
        $courseData = $docRef->snapshot()->data();
        $course = new Course($courseData['CourseID'],$courseData['ClassroomId'],$this->get_comments_of_course($docRef->Collection('Comments')),
            $courseData['attach'],$courseData['Name'],$courseData['Description']);
//        $course->setClassRoomId();
//        $course->setCourseId();
//        $course->setName();
//        $course->setDescription();
//        $course->setFiles();
//        $course_comments = ;
//        $course->setComments($course_comments);
       return $course ;
    }
    public function show_course($courseID){
        $course  = $this->get_course($courseID);
        return view('student.classrooms.course',compact('course'));
    }
    ///get all the student courses which the method try to find
    ///  every class the student is registred in and return array of model course
    ///fayz you can use the same mathode to get claassroums
    /// but with a littele bit changes
    /// tomorrow i will create a methode for getting the class roums but i need a class model
    ///
    ///
    ///
    public function get_my_classrooms($id_of_user){
    $courses = [];     //these is the list that will be returned
        $classRooms = [];
        $docRef =  $this->db->collection('Classrooms');
        $classrooms = $docRef->where('Students', 'array-contains', $id_of_user)->documents();
        if($classrooms ->size() > 0) {
            foreach($classrooms as $classroom){
                if($classroom->exists()){
                $classRoom = new Classroom($classroom->id(),$classroom->data()['Students'],
                                           $classroom->data()['Courses'],
                                           $classroom->data()['InviteCode'],
                                           $classroom->data()['ClassName'],
                                            $classroom->data()['OwnerID'],null);
                        $classRoom->setTests($classroom->data()['Tests']);
                        array_push($classRooms,$classRoom);

                }
            }
        }
        return $classRooms;
    }
    public function get_my_requests($id_of_user){

        $classRooms = [];
        $docRef =  $this->db->collection('Classrooms');
        $classrooms = $docRef->where('Requests', 'array-contains', $id_of_user)->documents();
        if($classrooms ->size() > 0) {
            foreach($classrooms as $classroom){
                if($classroom->exists()){
                    $classRoom = new Classroom($classroom->id(),$classroom->data()['Students'],
                        $classroom->data()['Courses'],
                        $classroom->data()['InviteCode'],
                        $classroom->data()['ClassName'],
                        $classroom->data()['OwnerID'],null);
                    array_push($classRooms,$classRoom);
//                     $coursesDoc = $classroom->data()['Courses'];
//                     foreach ($coursesDoc as $courseDoc){
//                        $courseData = $courseDoc->snapshot()->data();
//                        $course = new Course();
//                        $course->setClassRoomId($courseData['ClassroomId']);
//                        $course->setCourseId($courseData['CourseID']);
//                        $course_comments = $this->get_comments_of_course($courseDoc->Collection('Comments'));
//                        $course->setComments($course_comments);
//                        array_push($courses,$course);
// ///you can see here how i use comment _to_a_course_methode
// ///
////                $comment = $this->test_comment_to_a_course();
////                $this->comment_to_a_course($courseDoc->collection('Comments'),$comment);
//                    }
                }
            }
        }
        return $classRooms;
    }

    ///find a class room using invitecode
    ///  it will return the id of class room
    ///
    ///
    public function find_classroom_using_invitecode($invitecode){
        $docRef =  $this->db->collection('Classrooms');
        $classrooms = $docRef->where('InviteCode', '=', $invitecode)->documents();
        if($classrooms ->size() > 0) {
            foreach($classrooms as $classroom){
                if($classroom->exists()){
                   return $classroom->id();
                }
            }
        }
    }

    ///add to a class room
    /// you can use it fayz i use it onl for testing
    ///after finding the class room the problem is it returns to us a snapshot of
    /// document so we need to find the document t self for that i use the classroom id
    /// if you find any other solution you can test it thank you
    ///
    public function send_request_to_the_owner_of_classroom($classrom_id){
        $id_user = 'B1Df9tQl7UiACljxusUi';
        $this->db->collection('Classrooms')->document($classrom_id)->update([
            [
                "path" => 'Requests',
                'value' => FieldValue::arrayUnion([
                    $id_user])
            ]
        ]);
    }
    ///a testing methode for get_all_courses methode
// public function test(){
//        $this->add_to_a_class_room('c63ef51f1550478bb894','fayz');
//        return dd('added to request');
// }

/// we give the collection of the comments inside the course so we can work with it as fast as possible
/// and it returns an array of comments Model
/// you can see how i use it in the line 83 in these controller 'Etudiant'
    private function get_comments_of_course($comments_collection){
        $comments = array();
        $commentsDoc = $comments_collection->documents();
        if($commentsDoc->size() > 0){
            foreach ($commentsDoc as $commentDoc){
                    if($commentDoc->exists()){
                        $commentDoc = $commentDoc->data();
                        $comment = new Comment($commentDoc['Title'],
                                            $commentDoc['Body'],
                                             $commentDoc['DateComm'] ,
                                             $commentDoc['OwenerID']

                                            );
                        array_push($comments,$comment);
                    }
            }
        }
        return $comments;
    }
///here we pass the collection of comments of course and the comment model and it will be added to the collection
///it s the same as methode get_comments_of_course
///
    public function comment_to_a_course($course_id,Comment $comment){
        $comments_collection = $this->db->collection('Courses')->document($course_id)->Collection('Comments');
        $comments_collection->newDocument()->set([
            'Title' => $comment->getTitle(),
            'Body' => $comment->getBody(),
            'OwenerID' => $comment->getOwnerId(),
            'DateComm' => $comment->getDateComment()
        ]);
    }
///
///
/// only amethode for generating a comment i use i oly for tests
///
    public function generate_comment(){
        $comment = new Comment();
        $comment->setTitle('test 1');
        $comment->setBody('test body 1');
        $comment->setDateComment('test date comment 1');
        $comment->setOwnerId('owner id test 1');
        return $comment;
    }
    public function comment(Request $request){
        $title = $request->get('title');
        $body = $request->get('body');
        $datecomment = "".now();
        $courseid = $request->get('courseid');
        $ownerId = 'B1Df9tQl7UiACljxusUi';
        $comment = new Comment($title,$body,$datecomment,$ownerId);
        $this->comment_to_a_course($courseid,$comment);
        return redirect(route('student.classroom.course.show',['courseID'=>$courseid]));
    }
    /// methode to add a user to a user collection
    /// when we create the user modelthese methode will be modified in chaa alah
    public function add_to_user_collection($user_id,$name,$lastname,$email){
        $userRef = $this->db->collection('User')->document($user_id)->set([
            'Type' => 'Student',
            'Name' => $name,
            'LastName' => $lastname,
            'Email' =>  $email,
        ]);
    }
///methode for regestring in fire base auth
///
///
    public function register(Request $request){
        $email = $request->get('email',['default' =>'email']);
        $password = $request->get('password',['default' =>'password']);
        $name = $request->get('name',['default' =>'name']);
        $lastname = $request->get('lastname',['default' =>'lastname']);
        $inviteCode = $request->get('invitecode',['default' =>'invitecode']);
        try {
            $authRef = app('firebase.auth')->createUser([
                'email' => $email,
                'password' => $password
            ]);
            $this->add_to_user_collection($authRef->uid,$name,$lastname,$email);
            ///findign the class room
            $classroom = $this->find_classroom_using_invitecode($inviteCode);
            $this->add_to_a_class_room($classroom,$authRef->uid);
            return redirect('/')->with("account created successufly !!");
        }
        catch (\Kreait\Firebase\Exception\Auth\EmailExists $ex) {
            echo 'email already exists';
        }
        return redirect('/')->with("account is not created !!");
    }
    public function join_class_room_view(){
        return view('student.classrooms.joinclassroom');
    }
    public function join_class_room(Request $request){
        $invitecode = $request->get('invitCode');
        $classroom_id = $this->find_classroom_using_invitecode($invitecode);
        $this->send_request_to_the_owner_of_classroom($classroom_id);
        return redirect('student/classrooms');
    }
    public function myrequests(){
    $classrooms = $this->get_my_requests('B1Df9tQl7UiACljxusUi');
    return view('student.classrooms.requests',compact('classrooms'));
    }

    public function get_my_tests(){
        $classroomstests = [];
        $iduser = 'B1Df9tQl7UiACljxusUi';
          $classrooms = $this->get_my_classrooms($iduser);
        foreach ($classrooms as $classroom){
            if(count($classroom->getTests()) < 1)continue;
                $classroom->tests = $this->allTests($classroom->getClassroomID());
                    array_push($classroomstests,$classroom);
        }
        return view('student.classrooms.tests.index',compact('classroomstests'));
    }

    public function get_tests_of_classroom($classroomid){
        $tests = $this->allTests($classroomid);
        $classroom = $this->get_classroom($classroomid);
        $classroom->setTests($tests);
        $classroomstests = [];
        array_push($classroomstests,$classroom);

        return view('student.classrooms.tests.index',compact('classroomstests'));
    }
    private function allTests($classroomID){

        $ClassroomRef =  $this->db->collection('Classrooms');
        $class =  $ClassroomRef->document($classroomID)->snapshot();
        $Tests = [];
        $Tests = $class["Tests"] ?? [];
        $Testss = [];
        $TestRef =  $this->db->collection('Tests');
        foreach($Tests as $testID)
        {

            $T= $TestRef->document($testID)->snapshot();
            $Test = new
            Test($testID, $T->data()["Title"],$T->data()["LastDay"],
                $T->data()["Description"],$T->data()["Delay"] ,
                $T->data()["Files"] ,[]
            );
            array_push($Testss,$Test);

        }

        return $Testss;
    }

    public function get_classroom($classroomID)
    {
        $docRef =  $this->db->collection('Classrooms');
        $class = $docRef->document($classroomID)->snapshot();
        $classroom = new
        Classroom($class->id(), $class->data()["Students"] ,
            $class["Courses"] ,$class->data()["InviteCode"] ,
            $class->data()["ClassName"] ,"My ID" , $class->data()["Requests"]);
        return $classroom;
    }


    public function get_test($classroomid,$testid){
        $iduser = 'B1Df9tQl7UiACljxusUi';
        $test = $this->test($testid);
        $classroom = $this->get_classroom($classroomid);
      $answerconrtroller  = new AnswerController();
     $answertestresult = $answerconrtroller->hasAnswers($iduser,$testid);
        return view('student.classrooms.tests.show',compact('test',"classroom",'answertestresult'));
    }
    private function test($testID)
    {
        $answers = [];
        $testRef =  $this->db->collection('Tests')->document($testID);
        $answersRef = $testRef->collection('Answers')->documents();
        $test = $testRef->snapshot();
        $testt = new
        Test($testID, $test->data()["Title"],$test->data()["LastDay"],
            $test->data()["Description"],$test->data()["Delay"] ,
            $test->data()["Files"] ,$answers
        );

        return $testt;
    }
public function get_my_sessions($classroomid){
        $sessioncontroller = new SessionsController();
        $mysessions = $sessioncontroller->allSessions($classroomid);
return $mysessions ?? [];
}
public function getsessions($classroomid){
        $sessions = $this->get_my_sessions($classroomid);
        return view('student.sessions.index',compact('sessions','classroomid'));
}
public function get_all_my_sessions(){
        $sessions = [];
        $iduser = 'B1Df9tQl7UiACljxusUi';
        $classrooms = $this->get_my_classrooms($iduser);
        foreach ($classrooms as $classroom){
            $sessions_of_classroom = $this->get_my_sessions($classroom->classroomID);
//            print_r($sessions_of_classroom[0].'<br>');
            if(empty($sessions_of_classroom))continue;
//            array_push($sessions,$sessions_of_classroom);
            $sessions = array_merge($sessions,$sessions_of_classroom);
//            break;
        }
        return view('student.sessions.index',compact('sessions'));
}
public function get_session_view($classroomid,$sessionid){
        $sessioncontroller = new SessionsController();
        $session = $sessioncontroller->session($sessionid);
        $classroom = $this->get_classroom($classroomid);
        return view('student.sessions.show',compact('session','classroom'));
}
}
