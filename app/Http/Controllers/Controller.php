<?php

namespace App\Http\Controllers;
<<<<<<< HEAD

=======
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
<<<<<<< HEAD
// use Kreait\Firebase\ServiceAccount;
// use Kreait\Firebase\Database;
=======

 use Kreait\Firebase\ServiceAccount;
 use Kreait\Firebase\Database;
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
use Google\Cloud\Firestore\FirestoreClient;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
<<<<<<< HEAD
    protected $db;
    public function __construct()
    {
=======
    /// here i use the same idea that rachid gives me which is creating an instance of db in that controller and extends it in other controllers
   /// in my point of vue i see that we can use it also for handling sessions
     protected  $db;
    public function __construct() {
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
        $this->db = app('firebase.firestore')->database();
    }


<<<<<<< HEAD
}
=======
}
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
