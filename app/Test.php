<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public $testID,$title , $description , $delay ,$lastDay, $files , $answers;
    public function __construct($testID,$title , $lastDay,$description , $delay , $files , $answers)
    {
        $this->testID = $testID;
        $this->title = $title;
        $this->description=$description;
        $this->delay = $delay;
        $this->files = $files;
        $this->answers = $answers; 
        $this->lastDay=$lastDay;
    }

    public static function setNewTest($Request)
    {
        $Test = new Test('',$Request['Title'],"",$Request['Description'],$Request['Delay'],[],[]);
        return $Test;
    }

}
