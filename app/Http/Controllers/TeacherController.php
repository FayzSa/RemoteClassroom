<?php

namespace App\Http\Controllers;
use App\Classroom;
use App\User;
use DateTime;
use Google\Cloud\Firestore\FieldValue;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
    
         $me = session('me');
         
         $docRef =  $this->db->collection('Classrooms');
         $snapshot = $docRef->where('OwnerID','==',session('uid'))->documents();
    

         $classrooms = [];
         foreach($snapshot as $dataFormsnap)
         {
          if($dataFormsnap->exists()){
             $class = new
             Classroom($dataFormsnap->id(), $dataFormsnap["Students"] ,
             $dataFormsnap["Courses"] ,$dataFormsnap["InviteCode"] ,
             $dataFormsnap["ClassName"] ,session('uid') ,$dataFormsnap["Requests"],
             $dataFormsnap["Tests"]
         );
         array_push($classrooms,$class);
      }
         }
         $courses = 0;
         $testes = 0;
         $students = 0;
         $classes = sizeof($classrooms);
         foreach($classrooms as $class){
            $courses += sizeof($class->courses);
            $students += sizeof($class->students);
            $testes += sizeof($class->tests);
         }

        return view('teacher.index', compact('me','classes','students','testes','courses'));
    }

}
