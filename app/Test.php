<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public $testID,$title , $description , $delay ,$lastDay, $files , $answers;

    /**
     * @return mixed
     */
    public function getTestID()
    {
        return $this->testID;
    }

    /**
     * @param mixed $testID
     */
    public function setTestID($testID): void
    {
        $this->testID = $testID;
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
    public function getDelay()
    {
        return $this->delay;
    }

    /**
     * @param mixed $delay
     */
    public function setDelay($delay): void
    {
        $this->delay = $delay;
    }

    /**
     * @return mixed
     */
    public function getLastDay()
    {
        return $this->lastDay;
    }

    /**
     * @param mixed $lastDay
     */
    public function setLastDay($lastDay): void
    {
        $this->lastDay = $lastDay;
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
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param mixed $answers
     */
    public function setAnswers($answers): void
    {
        $this->answers = $answers;
    }
    public function __construct($testID,$title , $lastDay,$description , $delay , $files , $answers)
    {
        $this->testID = $testID;
        $this->title = $title;
        $this->description=$description;
        $this->delay = $delay;

        $this->files=$files;
        $this->answers = $answers;
        $this->lastDay=$lastDay;
    }

    public static function setNewTest($Request)
    {
        $Test = new Test('',$Request['Title'],"",$Request['Description'],$Request['Delay'],[],[]);
        return $Test;
    }

}
