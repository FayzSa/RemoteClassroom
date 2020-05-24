<?php

namespace App;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
=======
>>>>>>> origin/master
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
<<<<<<< HEAD
    protected $course_id,$class_room_id,$comments;

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



//
=======
    //
>>>>>>> origin/master
}
