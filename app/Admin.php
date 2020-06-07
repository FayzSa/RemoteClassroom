<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
   
    public $AdminID  , $FirstName , $LastName , $Email , $Bio ,$ProfileIMG;
   
    public function __construct($AdminID  , $FirstName , $LastName , $Email , $Bio,$ProfileIMG)
    {
        $this->AdminID = $AdminID ;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Email = $Email;
        $this->Bio = $Bio;
        $this->ProfileIMG = $ProfileIMG;
    }

  
    
}
