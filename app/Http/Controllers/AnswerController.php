<?php

namespace App\Http\Controllers;

use App\Test;
use DateTime;
use Google\Cloud\Firestore\FieldValue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Answer;
class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($testid)
    {
        return view("student.classrooms.tests.answers.create",compact("testid"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$testid)
    {
        $fileArray =array();
        $filesArray = $request->file('attach');
        $folderName="Answers/$testid";
        $file = $this->uploadFileToStorage($folderName,$filesArray);

        $answer = Answer::setNewAnswer($this->validateReq());
        $answerid = $this->storeAnswer($answer,$testid,$file);
       return redirect(route('student.classroom.test.answer',['testid' =>$testid,'answerid' => $answerid]));
    }

    private function validateReq(){

        return
            request()->validate([
                'attach'=>'required',
                'Title'=>'required|min:4',
                'Description' => 'required|min:15',
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($testid,$answerid)
    {
        $answer = $this->answer($testid,$answerid);
        return view('student.classrooms.tests.answers.show',compact('answer','testid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $testid
     * @param string $answerid
     * @return \Illuminate\Http\Response
     */
    public function edit($testid,$answerid)
    {
        $answer = $this->answer($testid,$answerid);
        return view("student.classrooms.tests.answers.edit",compact("answer","testid"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $testid
     * @param  string $answerid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $testid ,$answerid)
    {
        $fileArray =array();
        $filesArray = $request->file('attach');
        $folderName="Answers/$testid";
        $file = $this->uploadFileToStorage($folderName,$filesArray);
        $this->updateAnswer($this->validateRe(),$testid,$answerid,$file);
        return $this->show($testid,$answerid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($testid,$answerid)
    {
        $this->db->collection('Tests')->document($testid)->Collection('Answers')->document($answerid)->delete();
    return redirect(route('student.classroom.alltests'));
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

    private function storeAnswer(Answer $answer,$testid,$file){
        $date = new DateTime('now ');
        $delay = $date->format("Y-m-d H:i:s");

        $docRef =  $this->db->collection('Tests')->document($testid)->Collection('Answers')->newDocument();
        $newAnswer =  $docRef->set([
            'AnswerDate' => $date,
            'Description'  =>$answer->description ,
            'FilesAnswer' => $file,
            'StudentID' => $answer->studentid,
            'StudentName'=>$answer->studentname,
            'AnswerID' => $docRef->id(),
            'Title' =>$answer->title
        ]);
        return $docRef->id();

    }
    public function answer($testid,$answerid){
        $answerRef =  $this->db->collection('Tests')->document($testid)->Collection('Answers')->document($answerid)->snapshot()->data();
        $answer  = new Answer($answerRef['AnswerDate'],$answerRef['Description'],$answerRef['FilesAnswer'],
            $answerRef['StudentID'],$answerRef['StudentName'],$answerRef['Title'],$answerRef['AnswerID']);
        return $answer;
    }



    private function updateAnswer($Request , $testid,$answerid , $file)
    {
        $date = new DateTime('now ');
        $delay = $date->format("Y-m-d H:i:s");

        $docRef =  $this->db->collection('Tests');
        if($file){
            $answer = $docRef->document($testid)->Collection('Answers')->document($answerid)->update(
                [
                    ['path' => 'Title','value' => $Request['Title']],
                    ['path' => 'Description','value' => $Request['Description']],
                    ['path' => 'FilesAnswer','value' => $file],

                ]
            );
        }
        else {
            $answer = $docRef->document($testid)->Collection('Answers')->document($answerid)->update(
                [
                    ['path' => 'Title','value' => $Request['Title']],
                    ['path' => 'Description','value' => $Request['Description']],
                ]
            );
        }
    }

    public  function hasAnswers($id_user,$testid){
        $docRef =  $this->db->collection('Tests')->document($testid)->collection('Answers');
        $answers = $docRef->where('StudentID', '=', $id_user)->documents();
        if($answers->size() > 0) {
            foreach($answers as $answer){
                if($answer->exists()){
                    return $answer->id();
                }
            }
        }
        return "";
    }
    private function validateRe(){
        return
            request()->validate([
                'attach'=>'sometimes',
                'Title'=>'required|min:4',
                'Description' => 'required|min:15',
            ]);

    }
}
