<?php

namespace App\Http\Controllers;

use App\Comment;
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

   public function exit_class_room($id_of_user,$id_of_class_room){
       $docRef =  $this->db->collection('Classrooms');
       $docRef->document($id_of_class_room)->update([
           [
               "path" => 'Students',
               'value' => FieldValue::arrayRemove([$id_of_user])
           ]
       ]);
   }
///you give it a class room collection and it returns an array of courses
///

    public function get_courses_of_classroom($classroom_collection){
        $courses = array();
        if($classroom_collection->exists()){
            $coursesDoc = $classroom_collection->data()['Courses'];
            foreach ($coursesDoc as $courseDoc){
                $courseData = $courseDoc->snapshot()->data();
                $course = new Course();
                $course->setClassRoomId($courseData['ClassroomId']);
                $course->setCourseId($courseData['CourseID']);
                $course_comments = $this->get_comments_of_course($courseDoc->Collection('Comments'));
                $course->setComments($course_comments);
                array_push($courses,$course);
                }
           }
        return $courses;
    }
    ///get all the student courses which the method try to find
    ///  every class the student is registred in and return array of model course
    ///fayz you can use the same mathode to get claassroums
    /// but with a littele bit changes
    /// tomorrow i will create a methode for getting the class roums but i need a class model
    ///
    ///
    ///
    public function get_all_courses($id_of_user){
    $courses = array();     //these is the list that will be returned

        $docRef =  $this->db->collection('Classrooms');
        $classrooms = $docRef->where('Students', 'array-contains', $id_of_user)->documents();
        if($classrooms ->size() > 0) {
            foreach($classrooms as $classroom){
                if($classroom->exists()){
                     $coursesDoc = $classroom->data()['Courses'];
                     foreach ($coursesDoc as $courseDoc){
                        $courseData = $courseDoc->snapshot()->data();
                        $course = new Course();
                        $course->setClassRoomId($courseData['ClassroomId']);
                        $course->setCourseId($courseData['CourseID']);
                        $course_comments = $this->get_comments_of_course($courseDoc->Collection('Comments'));
                        $course->setComments($course_comments);
                        array_push($courses,$course);
 ///you can see here how i use comment _to_a_course_methode
 ///
//                $comment = $this->test_comment_to_a_course();
//                $this->comment_to_a_course($courseDoc->collection('Comments'),$comment);
                    }
                }
            }
        }
        return $courses;
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
    public function add_to_a_class_room($classrom_id,$id_user){
        $this->db->collection('Classrooms')->document($classrom_id)->update([
            [
                "path" => 'Students',
                'value' => FieldValue::arrayUnion([
                    $id_user])
            ]
        ]);
    }
    ///a testing methode for get_all_courses methode
 public function test($id_of_user){
        $courses = $this->get_all_courses($id_of_user);
        return view('show_courses',compact('courses'));
 }

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
                                            $commentDoc['OwenerID'],
                                            $commentDoc['DateComm']
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
    public function comment_to_a_course($comments_collection,Comment $comment){
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
            $this->add_to_user_collection($authRef->uid,$name,$lastname,$email,$inviteCode);
            ///findign the class room
            $classroom = $this->find_classroom_using_invitecode($inviteCode);
            $this->add_to_a_class_room($classroom,$authRef->uid);
            return redirect('/')->with("account created successufly !!");
        }
        catch (\Kreait\Firebase\Exception\Auth\EmailExists $ex) {
            echo 'email already exists';
        }
    }
}
