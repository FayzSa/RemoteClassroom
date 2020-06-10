<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $answerdate,$description,$filesanswer,$studentid,$studentname,$title,$answerID;

    /**
     * Answer constructor.
     * @param $answerdate
     * @param $description
     * @param $filesanswer
     * @param $studentid
     * @param $studentname
     * @param $title
     */
    public function __construct($answerdate, $description, $filesanswer, $studentid, $studentname, $title,$answerID)
    {
        $this->answerdate = $answerdate;
        $this->description = $description;
        $this->filesanswer = $filesanswer;
        $this->studentid = $studentid;
        $this->studentname = $studentname;
        $this->title = $title;
        $this->answerID = $answerID;
    }

    /**
     * @return mixed
     */
    public function getAnswerID()
    {
        return $this->answerID;
    }

    /**
     * @param mixed $answerID
     */
    public function setAnswerID($answerID): void
    {
        $this->answerID = $answerID;
    }

    /**
     * @return mixed
     */
    public function getAnswerdate()
    {
        return $this->answerdate;
    }

    /**
     * @param mixed $answerdate
     */
    public function setAnswerdate($answerdate): void
    {
        $this->answerdate = $answerdate;
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
    public function getFilesanswer()
    {
        return $this->filesanswer;
    }

    /**
     * @param mixed $filesanswer
     */
    public function setFilesanswer($filesanswer): void
    {
        $this->filesanswer = $filesanswer;
    }

    /**
     * @return mixed
     */
    public function getStudentid()
    {
        return $this->studentid;
    }

    /**
     * @param mixed $studentid
     */
    public function setStudentid($studentid): void
    {
        $this->studentid = $studentid;
    }

    /**
     * @return mixed
     */
    public function getStudentname()
    {
        return $this->studentname;
    }

    /**
     * @param mixed $studentname
     */
    public function setStudentname($studentname): void
    {
        $this->studentname = $studentname;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public static function setNewAnswer($request)
    {
        $studentid = session('uid');
        $firstname = session('me')->firstName;
        $lastname = session('me')->lastName;
        $studentname = $firstname.' '.$lastname;
       $answer = new Answer("",$request['Description'],"",$studentid,$studentname,$request['Title'],"");
   return $answer;
    }
}
