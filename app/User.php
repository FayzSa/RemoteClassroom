<?php

namespace App;

<<<<<<< HEAD
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
=======
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

    
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
}
