<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $title,$body,$dateComment,$ownerId , $owenrName , $owenrPic;

    /**
     * @return mixed
     */
    public function getOwenrName()
    {
        return $this->owenrName;
    }

    /**
     * @param mixed $owenrName
     */
    public function setOwenrName($owenrName): void
    {
        $this->owenrName = $owenrName;
    }

    /**
     * @return mixed
     */
    public function getOwenrPic()
    {
        return $this->owenrPic;
    }

    /**
     * @param mixed $owenrPic
     */
    public function setOwenrPic($owenrPic): void
    {
        $this->owenrPic = $owenrPic;
    }


    public function __construct($title,$body,$dateComment,$ownerId , $owenrName,$owenrPic){
        $this->title = $title;
        $this->body = $body;
        $this->dateComment = $dateComment;
        $this->ownerId = $ownerId;
        $this->owenrName =$owenrName;
        $this->owenrPic = $owenrPic;
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

}
