<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Comment;
use App\Course;

use Google\Cloud\Firestore\FieldValue;

use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($classroomID)
    {
       $courses =  $this->myCourses($classroomID);
       $me = session('me');
       return view('teacher.classrooms.courses.index', compact('courses','classroomID','me'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($classroomID)
    {
        $me = session('me');
        return view('teacher.classrooms.courses.create', compact('classroomID','me'));
   
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
            $folderName="Course";
            $file = $this->uploadFileToStorage($folderName,$filesArray);
        
        $course = Course::setNewCourse($this->validateReq());
        $CourseID = $this->storeCourse($course,$classroomID,$file);
        $course =  $this->myCourse($CourseID,$classroomID);
        $me = session('me');
        return view('teacher.classrooms.courses.show',compact('course','classroomID','me'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($courseID,$classroomID)
    {
        $me = session('me');
        $course =  $this->myCourse($courseID,$classroomID);
        return view('teacher.classrooms.courses.show', compact('course','classroomID','me'));
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($courseID,$classroomID)
    {
        $me = session('me');
        $course = $this->myCourse($courseID,$classroomID);
        return view('teacher.classrooms.courses.edit', compact('course','classroomID','me'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $courseID,$classroomID)
    {
        $fileArray =array();
        $filesArray = $request->file('attach');
        $folderName="Course";
        $file = $this->uploadFileToStorage($folderName,$filesArray);
        $this->updateCourse($this->validateRe(),$courseID,$file);
        $course =  $this->myCourse($courseID,$classroomID);
        $me = session('me');
        return view('teacher.classrooms.courses.show', compact('course','classroomID','me'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($courseID,$classroomID)
    {
        $docRef =  $this->db->collection('Courses')
        ->document($courseID);
        
        
        $commentsRef = $docRef->collection('Comments')->documents();
        foreach($commentsRef as $comment){
            $docRef->collection('Comments')->document($comment->id())->delete();
        }
        $docRef->delete();
        $arrayOfDelete = [];
        array_push($arrayOfDelete,$courseID);
        $this->db->collection('Classrooms')->document($classroomID)->update([
            [
                "path" => 'Courses',
                'value' => FieldValue::arrayRemove([$courseID])
            ]
        ]);
     return redirect('teacher/classrooms/courses/'.$classroomID);
     
    }




    private function myCourses($classroomID)
    {
        
        $docRef =  $this->db->collection('Classrooms');
        $class = $docRef->document($classroomID)->snapshot();
        $courses = [];
        $courses = $class["Courses"] ?? [];
        $coursess = [];
       $docRefs =  $this->db->collection('Courses');
       foreach($courses as $courseID)
       {
           
        $co = $docRefs->document($courseID)->snapshot();
    
           $course = new
           Course($courseID, $classroomID,
           [] ,$co->data()["attach"] ,
           $co->data()["Name"] , $co->data()["Description"]
       );
       array_push($coursess,$course);
    
       }
      
      return $coursess;
    }

    private function myCourse($courseID,$classroomID)
    {
        
        $comments = [];
        $courseRef =  $this->db->collection('Courses')->document($courseID);
        $commentsRef = $courseRef->collection('Comments')->documents();
        foreach($commentsRef as $comment){
            if($comment->exists()){
            $com = new Comment($comment->id(),
            $comment['Title'],
            $comment['Body'],
            $comment['DateComm'],
            $comment['OwenerID']);
            array_push($comments,$com);
        }}
        $co = $courseRef->snapshot();
        $course =
        new
           Course($courseID, $classroomID,
           $comments,$co->data()["attach"] ,
           $co->data()["Name"] , $co->data()["Description"]
       );
        
        return $course;
    }



    private function storeCourse(Course $course , $classroomID , $file)
    {

        
      $docRef =  $this->db->collection('Courses')->newDocument();
     $newClass =  $docRef->set([
        'attach' => $file,
        'Name'  =>$course->name ,
        'Description' => $course->description,
        'ClassroomId' => $classroomID,
        'CourseID' => $docRef->id()
      ]);
      $this->db->collection('Classrooms')->document($classroomID)->update([
        [
            "path" => 'Courses',
            'value' => FieldValue::arrayUnion([
                $docRef->id()])
        ]
    ]);
                return $docRef->id();
    }

    private function validateReq(){

        return
          request()->validate([
            'attach'=>'required',
            'Name'=>'required|min:4',
            'Description' => 'required|min:15'
          ]);

      }

      private function validateRe(){

        return
          request()->validate([
            'attach'=>'sometimes',
            'Name'=>'required|min:4',
            'Description' => 'required|min:15'
          ]);

      }
      // Store file 

     
    
    
    
    
    
    
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
       
private function updateCourse($Request , $courseID , $file)
{

    $docRef =  $this->db->collection('Courses');
    if($file){
    $class = $docRef->document($courseID)->update(
        [
['path' => 'Name','value' => $Request['Name']],
['path' => 'Description','value' => $Request['Description']],
['path' => 'attach','value' => $file],
]
    );
}
else {
    $class = $docRef->document($courseID)->update(
        [
['path' => 'Name','value' => $Request['Name']],
['path' => 'Description','value' => $Request['Description']],
]
    );
}
}
}
