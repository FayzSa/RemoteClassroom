<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    public $sessionID, $date ,$day, $hour , $subject ,$classroomID ; 

    public function __construct($sessionID,$date,$day , $hour , $subject ,$classroomID)
    {

        $this->sessionID=$sessionID;
        $this->day=$day;
        $this->hour = $hour;
        $this->subject=$subject;
        $this->classroomID=$classroomID;
        $this->date = $date;

    }
    public static function setNewAnnonce($request)
    {
        $now = new DateTime();
        $year = $now->format("Y");
        $month = $now->format("m");
        $Date = "$year - ". $month ." - ".$request["Day"]." - ".$request["Hour"];
        $annonce =new  Sessions('',$Date,$request['Day'],$request["Hour"],$request['Subject'],'');
        return $annonce;
    }
}
