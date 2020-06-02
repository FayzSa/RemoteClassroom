<?php

namespace App\Http\Controllers;
use DateTime;

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
       $sessions =  $this->allSessions($classroomID);
       return view('teacher.classrooms.sessions.index', compact('sessions','classroomID'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($classroomID)
    {

        return view("teacher.classrooms.sessions.create",compact("classroomID"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$classroomID)
    {
       
        $annonce = Sessions::setNewAnnonce($this->validateRe());
        $new = $this->annocceSession($annonce,$classroomID);
        $session = $this->session($new);
        return view("teacher.classrooms.sessions.show",compact("session","classroomID"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show($sessionID,$classroomID)
    {
        
        $session = $this->session($sessionID);
        return view("teacher.classrooms.sessions.show",compact("session","classroomID"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit($sessionID,$classroomID)
    {
        $session = $this->session($sessionID);
        return view("teacher.classrooms.sessions.edit",compact("session","classroomID"));
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
        $this->updateSession($this->validateRe(),$sessionID); 
        $session = $this->session($sessionID);
        return view("teacher.classrooms.sessions.show",compact("session","classroomID"));
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
       //print_r($session->hour);
        $docRef =  $this->db->collection('Session')->newDocument();
        $newTest =  $docRef->set([
           'ClassroomID' => $classroomID,
           'DateSession'  =>$session->date ,
           'Day' => $session->day,
           'Hour' => $session->hour,
           'Subject'=>$session->subject,
           'SessionID' => $docRef->id()
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

      private function allSessions($classroomID){
       
        $SessionRef =  $this->db->collection('Session');
        $snapshot = $SessionRef->where('ClassroomID','==',$classroomID)->documents();
        $Sessions = [];
        foreach($snapshot as $dataFormsnap)
        {
            $Session = new
            Sessions($dataFormsnap->id(), $dataFormsnap["DateSession"] ,
            $dataFormsnap["Day"] ,$dataFormsnap["Hour"] ,
            $dataFormsnap["Subject"] ,$classroomID
        );
        array_push($Sessions,$Session);
 
        }
      
      return $Sessions;
    }

    
    private function session($sessionID)
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
   
    $now = new DateTime();
    $year = $now->format("Y");
    $month = $now->format("M");
    $Date = "$year - ". $month ." - ".$Request["Day"]." - ".$Request["Hour"];
    $docRef =  $this->db->collection('Session');
    
    $session = $docRef->document($sessionID)->update(
        [
['path' => 'Subject','value' => $Request['Subject']],
['path' => 'Hour','value' => $Request['Hour']],
['path' => 'Day','value' => $Request["Day"]],
['path' => 'DateSession','value' => $Date],

]
    );
}
      
}
