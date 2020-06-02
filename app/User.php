<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $userID,$email, $createAt , $profileIMG , $firstName , $lastName , $bio,$type;

    public function __construct($userID,$email, $createAt , $profileIMG , $firstName , $lastName,$bio,$type)
    {
        $this->userID = $userID;
        $this->email = $email;
        $this->createAt = $createAt;
        $this->profileIMG = $profileIMG;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bio=$bio;
        $this->type= $type;
    }


}
