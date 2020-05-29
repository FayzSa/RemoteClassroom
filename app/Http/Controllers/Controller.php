<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Kreait\Firebase;
use Kreait\Firebase\Factory;

 use Kreait\Firebase\ServiceAccount;
 use Kreait\Firebase\Database;
use Google\Cloud\Firestore\FirestoreClient;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /// here i use the same idea that rachid gives me which is creating an instance of db in that controller and extends it in other controllers
   /// in my point of vue i see that we can use it also for handling sessions
     protected  $db;
    public function __construct() {
        $this->db = app('firebase.firestore')->database();
    }


}