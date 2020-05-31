<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Classroom;
use App\Comment;
=======
use App\Comment;
use App\Classroom;
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
use App\Course;
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
<<<<<<< HEAD
///

    public function index(){
            $id_user = 'moha';
            $classrooms = $this->get_my_classrooms($id_user);
            return view('student.index',compact('classrooms'));
    }

   public function exit_class_room($classromID){
        $id_of_user = 'moha';
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
        $course = new Course();
        $course->setClassRoomId($courseData['ClassroomId']);
        $course->setCourseId($courseData['CourseID']);
        $course->setName($courseData['Name']);
        $course->setDescription($courseData['Description']);
        $course->setFiles($courseData['attach']);
        $course_comments = $this->get_comments_of_course($docRef->Collection('Comments'));
        $course->setComments($course_comments);
       return $course ;
    }
    public function show_course($courseID){
        $course  = $this->get_course($courseID);
        return view('student.classrooms.course',compact('course'));
=======

public function index(){
    $id_user = 'moha';
    $classrooms = $this->get_my_classrooms($id_user);
    return view('student.index',compact('classrooms'));
}
   public function exit_class_room($classromID){
    $id_of_user = 'moha';
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

    public function get_courses_of_classroom($classroom_collection){
        $courses = array();
        if($classroom_collection->exists()){
            $coursesDoc = $classroom_collection->data()['Courses'];
            foreach ($coursesDoc as $courseDoc){
                $courseData = $courseDoc->snapshot()->data();
                $course = new Course('','','','','','');
                $course->setClassRoomId($courseData['ClassroomId']);
                $course->setCourseId($courseData['CourseID']);
                $course_comments = $this->get_comments_of_course($courseDoc->Collection('Comments'));
                $course->setComments($course_comments);
                array_push($courses,$course);
                }
           }
        return $courses;
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
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
<<<<<<< HEAD
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
                                            $classroom->data()['OwnerID']);
                      array_push($classRooms,$classRoom);
=======
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
                         $classroom->data()['OwnerID'] , []);
   array_push($classRooms,$classRoom);
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
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
<<<<<<< HEAD
                }
            }
        }
        return $classRooms;
    }
=======
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


>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
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
<<<<<<< HEAD
                        $classroom->data()['OwnerID']);
=======
                        $classroom->data()['OwnerID'],[]);
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
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
<<<<<<< HEAD
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

=======
        
        return $classRooms;
    }

>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
    ///add to a class room
    /// you can use it fayz i use it onl for testing
    ///after finding the class room the problem is it returns to us a snapshot of
    /// document so we need to find the document t self for that i use the classroom id
    /// if you find any other solution you can test it thank you
    ///
    public function send_request_to_the_owner_of_classroom($classrom_id){
        $id_user = 'moha';
        $this->db->collection('Classrooms')->document($classrom_id)->update([
            [
<<<<<<< HEAD
=======
               
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
                "path" => 'Requests',
                'value' => FieldValue::arrayUnion([
                    $id_user])
            ]
        ]);
    }
<<<<<<< HEAD
    ///a testing methode for get_all_courses methode
// public function test(){
//        $this->add_to_a_class_room('c63ef51f1550478bb894','fayz');
//        return dd('added to request');
// }
=======
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097

/// we give the collection of the comments inside the course so we can work with it as fast as possible
/// and it returns an array of comments Model
/// you can see how i use it in the line 83 in these controller 'Etudiant'
<<<<<<< HEAD
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
=======
private function get_comments_of_course($comments_collection){
    $comments = array();
    $commentsDoc = $comments_collection->documents();
    if($commentsDoc->size() > 0){
        foreach ($commentsDoc as $commentDoc){
                if($commentDoc->exists()){
                    $commentDoc = $commentDoc->data();
                    $comment = new Comment(
                        $commentDoc->id(),
                        $commentDoc['Title'],
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
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
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
<<<<<<< HEAD
    public function generate_comment(){
        $comment = new Comment();
=======

public function comment(Request $request){
    $title = $request->get('title');
    $body = $request->get('body');
    $datecomment = "".now();
    $courseid = $request->get('courseid');
    $ownerId = 'moha';
    $comment = new Comment("",$title,$body,$datecomment,$ownerId);
    $this->comment_to_a_course($courseid,$comment);
    return redirect(route('student.classroom.course.show',['courseID'=>$courseid]));
}

    public function generate_comment(){
        $comment = new Comment("",'','','','');
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
        $comment->setTitle('test 1');
        $comment->setBody('test body 1');
        $comment->setDateComment('test date comment 1');
        $comment->setOwnerId('owner id test 1');
        return $comment;
    }
<<<<<<< HEAD
    public function comment(Request $request){
        $title = $request->get('title');
        $body = $request->get('body');
        $datecomment = "".now();
        $courseid = $request->get('courseid');
        $ownerId = 'moha';
        $comment = new Comment($title,$body,$datecomment,$ownerId);
        $this->comment_to_a_course($courseid,$comment);
        return redirect(route('student.classroom.course.show',['courseID'=>$courseid]));
    }
=======

>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
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
<<<<<<< HEAD
            ///findign the class room
=======
              ///findign the class room
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
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
    $classrooms = $this->get_my_requests('moha');
    return view('student.classrooms.requests',compact('classrooms'));
    }
}
