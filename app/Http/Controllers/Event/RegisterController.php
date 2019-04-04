<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\GmapsAPI;

use Illuminate\Contracts\Encryption\DecryptException;

class RegisterController extends Controller
{
	use GmapsAPI;
    public function register(Request $request){
        $groupId=null;
        try {
            $groupId=decrypt($request->group);
        } catch (DecryptException $e) {
            return back();
        }
        
        $groups=\Auth::user()->groups_admin; //tutti i gruppi di cui sono admin
        $exist = $this->checkExistance($groupId,$groups);//vede se sono admin del gruppo di cui si fa l'evento(per evitare che qualcuno cambi il campo hidden permettendo cosi di fare eventi per qualsiasi gruppo)
        if(!$exist) return back();

        //validazione campi lato server
    	$credentials=$request->only('event_title','event_description','event_start_hour','event_end_hour','event_place','event_date');
        $validation=\Validator::make($credentials,$this->rules(),$this->messages());
        if($validation->fails())
            return redirect('group/'.$groupId."#create-event")->withErrors($validation)->withInput($credentials);

        //validazione place
    	$response=empty($request->event_place) ? false : $this->validatePlace($request->event_place);
        if(!$response){
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add('event_place', 'posizione non valida.');
            return redirect('group/'.$groupId."#create-event")->withErrors($errors)->withInput($credentials);
        }


    	$event= new \App\Event;


    	$event->title=$request->event_title;
    	$event->description=$request->event_description;
    	$event->event_date=$request->event_date;
    	$event->start_hour=$request->event_start_hour;
    	$event->end_hour=$request->event_end_hour;
    	$event->place=$response["place"]; 
    	$event->lat=$response["lat"];
    	$event->lng=$response["lng"];



    	$group_user=\Auth::user()->group_user_per_group($groupId);
        $group_user->events()->save($event);
        //dd($group_user);


        return redirect('group/'.$groupId);


    	
    }

    public function rules(){
        return [
            "event_title"=>"required",
            "event_description"=>"required",
            "event_start_hour"=>"required",
            "event_end_hour"=>"required",
            "event_place"=>"required",
            "event_date"=>"required"
        ];
    }
    public function messages(){
        return [
        ];
    }



    public function checkExistance($groupId,$groups){
        //dd($groups);
        foreach($groups as $g){
            if($g->id == $groupId){
                return true;
            }
        }
        return false;
    }
}
