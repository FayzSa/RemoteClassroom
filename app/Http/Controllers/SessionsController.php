<?php

namespace App\Http\Controllers;
use DateTime;
use DateInterval;
use App\Sessions;
use Illuminate\Http\Request;

use function GuzzleHttp\Psr7\str;

class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($classroomID)
    {
        $me = session('me');
        $sessions =  $this->allSessions($classroomID);
       return view('teacher.classrooms.sessions.index', compact('sessions','classroomID','me'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($classroomID)
    {
        $me = session('me');
        return view("teacher.classrooms.sessions.create",compact("classroomID",'me'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$classroomID)
    {
        $me = session('me');
        $annonce = Sessions::setNewAnnonce($this->validateRe());
        $new = $this->annocceSession($annonce,$classroomID);
        $session = $this->session($new);
        return redirect('teacher/classrooms/sessions/'.$classroomID);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show($sessionID,$classroomID)
    {
        $me = session('me');
        $session = $this->session($sessionID);
        return view("teacher.classrooms.sessions",compact("session","classroomID",'me'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit($sessionID,$classroomID)
    {
        $me = session('me');
        $session = $this->session($sessionID);
        return view("teacher.classrooms.sessions.edit",compact("session","classroomID",'me'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sessionID,$classroomID)
    {
        $me = session('me');
        $this->updateSession($this->validateRe(),$sessionID);
        $session = $this->session($sessionID);
        return view("teacher.classrooms.sessions.show",compact("session","classroomID",'me'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy($sessionID,$classroomID)
    {
        $docRef =  $this->db->collection('Session')
        ->document($sessionID);
        $docRef->delete();

     return redirect('teacher/classrooms/sessions/'.$classroomID);
    }

    private function annocceSession(Sessions $session,$classroomID)
    {
        $date = new DateTime();
        $dateNow = $date->format("Y-m-d H:i:s");
       //print_r($session->hour);
        $docRef =  $this->db->collection('Session')->newDocument();
        $newTest =  $docRef->set([
           'ClassroomID' => $classroomID,
           'DateSession'  =>$session->date ,
           'Day' => $session->day,
           'Hour' => $session->hour,
           'Subject'=>$session->subject,
           'SessionID' => $docRef->id(),
           'PostDate'=> $dateNow
         ]);

         return $docRef->id();
    }
    private function validateRe(){
        $now = new DateTime();
        $day = $now->format("d");

        return
          request()->validate([
            'Hour'=>'required|min:5|max:5',
            'Day'=>'required|numeric|between:'.$day.',31',
            'Subject' => 'required|min:15'
          ]);



      }

      public function allSessions($classroomID){

        $SessionRef =  $this->db->collection('Session');
        $snapshot = $SessionRef->where('ClassroomID','==',$classroomID)->orderBy('DateSession','DESC')->documents();
        $Sessions = [];
        foreach($snapshot as $dataFormsnap)
        {
            if(!$dataFormsnap->exists())continue;
                $datetime1 = new DateTime($dataFormsnap["PostDate"]);
                $datetime1->add(new DateInterval('P'.$dataFormsnap["Day"].'D'));
                $now = new DateTime('now');
               if($now < $datetime1){
            $Session = new
            Sessions($dataFormsnap->id(), $dataFormsnap["DateSession"] ,
            $dataFormsnap["Day"] ,$dataFormsnap["Hour"] ,
            $dataFormsnap["Subject"] ,$classroomID
        );
        array_push($Sessions,$Session);}

        }

      return $Sessions;
    }


    public function session($sessionID)
    {


        $sessionRef =  $this->db->collection('Session')->document($sessionID);

        $sessionSnap = $sessionRef->snapshot();
        $session = new
        Sessions($sessionID, $sessionSnap->data()["DateSession"],$sessionSnap->data()["Day"],
           $sessionSnap->data()["Hour"],$sessionSnap->data()["Subject"] ,
           $sessionSnap->data()["ClassroomID"]
       );

        return $session;
    }



    private function updateSession($Request , $sessionID )
{

    $date = new DateTime();
    $dateNow = $date->format("Y-m-d H:i:s");


    $now = new DateTime();
    $year = $now->format("Y");
    $month = $now->format("M");
     $now->modify($now, '+'.$Request["Day"].' day');

    $Date = "$year - ". $month ." - ".$Request["Day"]." - ".$Request["Hour"];
    $docRef =  $this->db->collection('Session');

    $session = $docRef->document($sessionID)->update(
        [
['path' => 'Subject','value' => $Request['Subject']],
['path' => 'Hour','value' => $Request['Hour']],
['path' => 'Day','value' => $Request["Day"]],
['path' => 'DateSession','value' => $Date],
['path' => 'PostDate','value' => $dateNow],

]
    );
}

}
