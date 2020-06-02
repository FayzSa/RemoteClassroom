<?php

namespace App\Http\Controllers;

use App\Test;
use DateTime;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Google\Cloud\Firestore\FieldValue;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($classroomID)
    {
        $tests = $this->allTests($classroomID);
        return view("teacher.classrooms.tests.index",compact("tests","classroomID"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($classroomID)
    {
        return view("teacher.classrooms.tests.create",compact("classroomID"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$classroomID)
    {
        $fileArray =array();
        $filesArray = $request->file('attach');
        $folderName="Tests/$classroomID";
        $file = $this->uploadFileToStorage($folderName,$filesArray);
    
    $test = Test::setNewTest($this->validateReq());
    $testID = $this->storeTest($test,$classroomID,$file);
    $test = $this->test($testID);
    return view("teacher.classrooms.tests.show",compact("test","classroomID"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show($testID,$classroomID)
    {
        $test = $this->test($testID);
        return view("teacher.classrooms.tests.show",compact("test","classroomID"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit($testID,$classroomID)
    {
        
        $test = $this->test($testID);
        return view("teacher.classrooms.tests.edit",compact("test","classroomID"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $testID,$classroomID)
    {
        
        $fileArray =array();
        $filesArray = $request->file('attach');
        $folderName="Tests/$classroomID";
        $file = $this->uploadFileToStorage($folderName,$filesArray);
        $this->updateTest($this->validateRe(),$testID,$file); 
        $test = $this->test($testID);
        return view("teacher.classrooms.tests.show",compact("test","classroomID"));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy($testID,$classroomID)
    {
        $docRef =  $this->db->collection('Tests')
        ->document($testID);
           
        $answersRef = $docRef->collection('Answer')->documents();
        foreach($answersRef as $answer){
            $docRef->collection('Answer')->document($answer->id())->delete();
        }
        $docRef->delete();
        $this->db->collection('Classrooms')->document($classroomID)->update([
            [
                "path" => 'Tests',
                'value' => FieldValue::arrayRemove([$testID])
            ]
        ]);
     return redirect('teacher/classrooms/tests/'.$classroomID);
    }


    private function allTests($classroomID){
       
        $ClassroomRef =  $this->db->collection('Classrooms');
        $class =  $ClassroomRef->document($classroomID)->snapshot();
        $Tests = [];
        $Tests = $class["Tests"] ?? [];
        $Testss = [];
       $TestRef =  $this->db->collection('Tests');
       foreach($Tests as $testID)
       {
           
        $T= $TestRef->document($testID)->snapshot();
           $Test = new
           Test($testID, $T->data()["Title"],$T->data()["LastDay"],
           $T->data()["Description"],$T->data()["Delay"] ,
           $T->data()["Files"] ,[]
       );
       array_push($Testss,$Test);

       }
      
      return $Testss;
    }


    private function test($testID)
    {
        
        $answers = [];
        $testRef =  $this->db->collection('Tests')->document($testID);
        $answersRef = $testRef->collection('Answers')->documents();
        // answers will be here
       /* foreach($answersRef as $ans){
            $a = new Answer($ans->id(),
            $ans['Title'],
            $ans['Body'],
            $ans['DateComm'],
            $ans['OwenerID']);
            array_push($answers,$a);
        }*/
        $test = $testRef->snapshot();
        $testt = new
        Test($testID, $test->data()["Title"],$test->data()["LastDay"],
           $test->data()["Description"],$test->data()["Delay"] ,
           $test->data()["Files"] ,$answers
       );
        
        return $testt;
    }

    private function validateRe(){
        return
          request()->validate([
            'attach'=>'sometimes',
            'Title'=>'required|min:4',
            'Description' => 'required|min:15',
            'Delay'=>'required|numeric'
          ]);

      }
    
    private function validateReq(){

        return
          request()->validate([
            'attach'=>'required',
            'Title'=>'required|min:4',
            'Description' => 'required|min:15',
            'Delay'=>'required|numeric'
          ]);

      }
    
    
    private function storeTest(Test $test,$classroomID,$file){
        $date = new DateTime('now +'.$test->delay.' day');
        $delay = $date->format("Y-m-d H:i:s");
       
        $docRef =  $this->db->collection('Tests')->newDocument();
        $newTest =  $docRef->set([
           'Files' => $file,
           'Title'  =>$test->title ,
           'Description' => $test->description,
           'Delay' => $test->delay,
           'LastDay'=>$delay,
           'testID' => $docRef->id()
         ]);
         $this->db->collection('Classrooms')->document($classroomID)->update([
           [
               "path" => 'Tests',
               'value' => FieldValue::arrayUnion([
                   $docRef->id()])
           ]
       ]);
                   return $docRef->id();

    }

    public function uploadFileToStorage($type,$files){
        $storage = app('firebase.storage');
        $defaultBucket = $storage->getBucket();
        // $bucket = $storage->bucket('lpsfewebmobile.appspot.com');
         $fileArray =[];
         $countfiles = count($files ?? []);
         for($i=0;$i<$countfiles;$i++){
           $rand = Str::random();
            $name = $files[$i]->getClientOriginalName();
            $filename =  fopen($files[$i]->getRealPath(), 'r');
             
            // Upload file
            $object = $defaultBucket->upload($filename, [
                'name' => $type.'/'.$rand.$name 
            ]);
            
             $object->update(
                 ['acl' => []],
                  ['predefinedAcl' => 'PUBLICREAD']
             );
             $url ="https://storage.googleapis.com/elearningapp-30a10.appspot.com/".$type."/".$rand.$name;
             array_push($fileArray,$url);
            

             
          }
        //  print_r($fileArray);
          return $fileArray;
    }



           
private function updateTest($Request , $testID , $file)
{
    
    $date = new DateTime('now +'.$Request['Delay'].' day');
    $delay = $date->format("Y-m-d H:i:s");
   
    $docRef =  $this->db->collection('Tests');
    if($file){
    $test = $docRef->document($testID)->update(
        [
['path' => 'Title','value' => $Request['Title']],
['path' => 'Description','value' => $Request['Description']],
['path' => 'Delay','value' => $Request["Delay"]],
['path' => 'Files','value' => $file],
['path' => 'LastDay','value' => $delay],
]
    );
}
else {
    $test = $docRef->document($testID)->update(
        [
            ['path' => 'Title','value' => $Request['Title']],
            ['path' => 'Description','value' => $Request['Description']],
            ['path' => 'Delay','value' => $Request['Delay']],
            ['path' => 'LastDay','value' => $delay],
]
    );
}
}

}
