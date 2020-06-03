<?php

namespace App;


use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    public $course_id,$class_room_id,$comments,$name,$description,$files;

    
    public function __construct($course_id,$class_room_id,$comments , $files , $name , $description)
    {
        $this->course_id = $course_id;
        $this->class_room_id = $class_room_id;
        $this->comments = $comments;
        $this->files = $files;
        $this->name = $name;
        $this->description = $description;
    }

    public static function setNewCourse($Request)
    {

        $course = new Course(
         "","",[],[],$Request['Name'],$Request['Description']
        );
        return $course;
    }
    
    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param mixed $files
     */
    public function setFiles($files): void
    {
        $this->files = $files;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getClassRoomId()
    {
        return $this->class_room_id;
    }

    /**
     * @param mixed $class_room_id
     */
    public function setClassRoomId($class_room_id): void
    {
        $this->class_room_id = $class_room_id;
    }


//
//    public function __construct($course_id)
//    {
//        $this->course_id  = $course_id;
//
//    }
    /**
     * @return mixed
     */
    public function getCourseId()
    {
        return $this->course_id;
    }

    /**
     * @param mixed $course_id
     */
    public function setCourseId($course_id): void
    {
        $this->course_id = $course_id;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $coments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

}
