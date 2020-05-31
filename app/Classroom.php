<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{

<<<<<<< HEAD
    public $classroomID  , $students , $courses , $invitCode , $className , $owenrID;

    public function __construct($classroomID , $students , $courses , $invitCode , $className , $owenrID)
    {
        $this->classroomID = $classroomID;
=======
    public $classroomID  , $students , $courses , $invitCode , $className , $owenrID , $requests;
    
    public function __construct($classroomID , $students , $courses , $invitCode , $className , $owenrID,$requests)
    {
        $this->classroomID = $classroomID ;
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
        $this->students = $students;
        $this->courses = $courses;
        $this->invitCode = $invitCode;
        $this->className = $className;
        $this->owenrID = $owenrID;
<<<<<<< HEAD
    }
    public static function setNewClass($Request,$owenrID){

        $class = new Classroom("",[],[],$Request['invitCode'],$Request['ClassName'],$owenrID);
=======
        $this->requests = $requests;
    }
    public static function setNewClass($Request,$owenrID){

        $class = new Classroom("",[],[],$Request['invitCode'],$Request['ClassName'],$owenrID,[]);
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
        return $class;
    }
}
