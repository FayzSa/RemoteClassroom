<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;


class ClassroomsController extends Controller
{
    private function myClasses($OwenrID)
    {
       $classrooms = [];
       $docRef =  $this->db->collection('Classrooms');
       $snapshot = $docRef->where('OwnerID','==',$OwenrID)->documents();
       foreach($snapshot as $dataFormsnap)
       {
           $class = new 
           Classroom($dataFormsnap->id(), $dataFormsnap["Students"] ,
           $dataFormsnap["Courses"] ,$dataFormsnap["InviteCode"] ,
           $dataFormsnap["ClassName"] ,$OwenrID
       );
       array_push($classrooms,$class);

       }   
       //print_r($classrooms);
      return $classrooms;
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
       
        $classrooms =ClassroomsController::myClasses("9152801b0c7e44838a0d");
        return view('teacher.classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $classroom = Classroom::setNewClass($this->validateReq(),"9152801b0c7e44838a0d");
        ClassroomsController::storeClass($classroom);
        return view('teacher.classrooms.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show($classroomID)
    {
        print_r($classroomID);
        $classroom = ClassroomsController::tClass($classroomID);
       
        return view("teacher.classrooms.show",compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit($classroomID)
    {
        $classroom = ClassroomsController::tClass($classroomID);
       
        return view("teacher.classrooms.edit",compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update($classroomID)
    {
        
        $classroom = ClassroomsController::updateClass($this->validateReq(),$classroomID);
        return redirect("teacher/classrooms/show/$classroomID");
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy($classroomID)
    {
        $docRef =  $this->db->collection('Classrooms')
        ->document($classroomID)
        ->delete();
     return redirect('teacher/classrooms/');
    }


    private function validateReq(){

        return 
          request()->validate([
            'ClassName'=>'required|min:4',    
            'invitCode'=>'required',
          ]);
    
      }

      private function storeClass(Classroom $class)
      {
        $docRef =  $this->db->collection('Classrooms')->newDocument();
       // print_r($docRef->id());
       $newClass =  $docRef->set([
          'ClassName' => $class->className,
          'Courses'  => [],
          'InviteCode' =>  $class->invitCode,
          'OwnerID' => "9152801b0c7e44838a0d",
          'Students' => []
        ]);
        

      }
  private function tClass($classroomID)
{
    $docRef =  $this->db->collection('Classrooms');
    $class = $docRef->document($classroomID)->snapshot();

    $classroom = new 
    Classroom($class->id(), $class->data()["Students"] ?? [],
    $class["Courses"] ?? [] ,$class->data()["InviteCode"] ?? "" ,
    $class->data()["ClassName"] ?? "","My ID");
    return $classroom;
}


private function updateClass($Request , $classroomID)
{
    
    $docRef =  $this->db->collection('Classrooms');
    $class = $docRef->document($classroomID)->update(
        [
['path' => 'InviteCode','value' => $Request['invitCode']],
['path' => 'ClassName','value' => $Request['ClassName']],

  ]
    );
    
}

}


/* ]
new Map
$docRef->set([
   'location' => new \Google\Cloud\Core\GeoPoint(<latitude>,<longitude>)
]);
//GeoPoint(20.593683,78.962883)

*/