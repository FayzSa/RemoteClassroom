<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
<<<<<<< HEAD
    protected $title,$body,$dateComment,$ownerId;


    public function __construct($title,$body,$dateComment,$ownerId){
=======
    public $comID, $title,$body,$dateComment,$ownerId;


    public function __construct($comID,$title,$body,$dateComment,$ownerId){
        $this->comID = $comID;
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
        $this->title = $title;
        $this->body = $body;
        $this->dateComment = $dateComment;
        $this->ownerId = $ownerId;
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
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getDateComment()
    {
        return $this->dateComment;
    }

    /**
     * @param mixed $dateComment
     */
    public function setDateComment($dateComment): void
    {
        $this->dateComment = $dateComment;
    }

    /**
     * @return mixed
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * @param mixed $ownerId
     */
    public function setOwnerId($ownerId): void
    {
        $this->ownerId = $ownerId;
    }

<<<<<<< HEAD
=======

    //
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
}
