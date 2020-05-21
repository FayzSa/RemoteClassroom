<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
// use Kreait\Firebase\ServiceAccount;
// use Kreait\Firebase\Database;
use Google\Cloud\Firestore\FirestoreClient;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected static $db;




    protected static function firestoreDatabaseInstance(){
        // $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/FirebaseKey.json');
          $firebase = (new Factory)
          ->withServiceAccount(__DIR__.'/FirebaseKey.json');

          $db = new FirestoreClient([
              'projectId' => 'elearningapp-30a10',
          ]);

        return $db;
      }



}
