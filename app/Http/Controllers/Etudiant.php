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
///
/// in these methode we just use it for somme help coding u can  copy somme sentences from it and pass it in your methode
/// a
//    public function getAllEtudiants()
//    {
//        echo "hello ";
//        $docRef =  $this->db->collection('User');
//
//        $search="Ayoub";
//        $type="prof";
//        $query = $docRef->where('FullName', '=', $search);
//
//        $documents = $query->documents();
//        foreach ($documents as $document) {
//            if ($document->exists()) {
//                printf('Document data for document %s:' . PHP_EOL, $document->id());
//                print_r($document->data());
//                printf(PHP_EOL);
//            }
//        }
//    }
///



/// these methode allows to the student to  exit the class room
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

   ///get all the student courses which the method try to find
    ///  every class the student is registred in and return array of model course
    ///fayz you can use the same mathode to get claassroums
    /// but with a littele bit changes
    /// tomorrow i will create a methode for getting the class roums but i need a class model
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
}
