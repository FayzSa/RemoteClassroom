<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;
use JavaScript;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use Laracasts\Utilities\JavaScript\JavascriptServiceProvider;
// use Laracasts\Utilities\JavaScript\JavaScriptFacade;

// use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
public function allClassrooms(){
    $docRef =  $this->db->collection('Classrooms');
    $snapshot = $docRef->documents();
    $users = $snapshot;   
    
   return $users;

}




public function testwidget(){
    $week= date('Y-m-d',strtotime('-7 days'));
    $date = new \DateTime($week);
   $datestr= $date->format('Y-m-d');
    $students = new AdminController();
    $stud=$students->ClassroomsByDate();
   
    
    $array1 = array();
    for($days=1;$days<=7;$days++) {
        $countdays=0;
   foreach ($stud as $data ) {
       
    $dt=substr($data['Created_at'],0,10);
       if ($dt == $datestr) {
           $countdays++;
           
       }
       
        // echo $data['ClassName'].' date :  '.$data['Created_at'];
        // echo"<br>";
       }
     

      
       $week= date('Y-m-d',strtotime('-7 days'));
       $week2=date('Y-m-d',strtotime("+".$days." day", strtotime($week)));
       $date = new \DateTime($week2);
       $dayname=$date->format('D');
      $datestr= $date->format('Y-m-d');

   
  
    
    
 $array2=array($dayname => $countdays);
 array_push($array1,  array($dayname => $countdays));

    }
     
     return $array1;

}
   




///pass data to layout




    public function index()
    {
        $classromschart=$this->testwidget();
        
        $arraySingle = call_user_func_array('array_merge', $classromschart);
        $keys=array_keys($arraySingle);
        
        $value = array_values($arraySingle);
     
    
        JavaScriptFacade::put([
            'day1' => $keys[0],
            'day1data' => $value[0],
            'day2' => $keys[1],
            'day2data' => $value[1],
            'day3' => $keys[2],
            'day3data' => $value[2],
            'day4' => $keys[3],
            'day4data' => $value[3],
            'day5' => $keys[4],
            'day5data' => $value[4],
            'day6' => $keys[5],
            'day6data' => $value[5],
            'day7' => $keys[6],
            'day7data' => $value[6],
            
        ]);
        $users = new AdminController();
        // $users = User::count();
        $stud=$users->ListeUsers("Student");
        $teachers=$users->ListeUsers("Teacher");
        $admins=$users->ListeAdmins();
        $classrooms=$users->ListeClassrooms();;
        $widget = [
            'admins' => $admins->size(),
            'students'=>$stud->size(),
            'teachers'=>$teachers->size(),
            'classrooms'=>$classrooms->size(),
            //...
        ];
      
         return view('home', compact('widget'));
    }
}
