<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{

    public $classroomID  , $students , $courses , $invitCode , $className , $owenrID;

    public function __construct($classroomID , $students , $courses , $invitCode , $className , $owenrID)
    {
        $this->classroomID = $classroomID;
        $this->students = $students;
        $this->courses = $courses;
        $this->invitCode = $invitCode;
        $this->className = $className;
        $this->owenrID = $owenrID;
    }
    public static function setNewClass($Request,$owenrID){

        $class = new Classroom("",[],[],$Request['invitCode'],$Request['ClassName'],$owenrID);
        return $class;
    }
}
