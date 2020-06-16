<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{

    public $classroomID  , $students , $courses , $invitCode , $className , $owenrID , $requests,$tests,$liveRunning;

    /**
     * @return mixed
     */
    public function getClassroomID()
    {
        return $this->classroomID;
    }

    /**
     * @param mixed $classroomID
     */
    public function setClassroomID($classroomID): void
    {
        $this->classroomID = $classroomID;
    }

    /**
     * @return mixed
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param mixed $students
     */
    public function setStudents($students): void
    {
        $this->students = $students;
    }

    /**
     * @return mixed
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * @param mixed $courses
     */
    public function setCourses($courses): void
    {
        $this->courses = $courses;
    }

    /**
     * @return mixed
     */
    public function getInvitCode()
    {
        return $this->invitCode;
    }

    /**
     * @param mixed $invitCode
     */
    public function setInvitCode($invitCode): void
    {
        $this->invitCode = $invitCode;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param mixed $className
     */
    public function setClassName($className): void
    {
        $this->className = $className;
    }

    /**
     * @return mixed
     */
    public function getOwenrID()
    {
        return $this->owenrID;
    }

    /**
     * @param mixed $owenrID
     */
    public function setOwenrID($owenrID): void
    {
        $this->owenrID = $owenrID;
    }

    /**
     * @return mixed
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @param mixed $requests
     */
    public function setRequests($requests): void
    {
        $this->requests = $requests;
    }

    /**
     * @return mixed
     */
    public function getTests()
    {
        return $this->tests;
    }

    /**
     * @param mixed $tests
     */
    public function setTests($tests): void
    {
        $this->tests = $tests;
    }

    public function __construct($classroomID , $students , $courses , $invitCode , $className , $owenrID,$requests,$tests)
    {
        $this->classroomID = $classroomID ;
        $this->students = $students;
        $this->courses = $courses;
        $this->invitCode = $invitCode;
        $this->className = $className;
        $this->owenrID = $owenrID;
        $this->requests = $requests;
        $this->tests = $tests;
    }
    public static function setNewClass($Request,$owenrID){

        $class = new Classroom("",[],[],$Request['invitCode'],$Request['ClassName'],$owenrID,[],[]);
        return $class;
    }
}
