<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class HomeController extends Controller
{
    public function homePageLoad(){
        $eventi=Event::all();

        $info=[];

        $tmp=[];
        foreach ($eventi as $event){
            $group=$event->group_user->group;
            $photo=$group->g_photos->first();
            array_push($tmp,["event"=>$event,"group"=>$group,"photo"=>$photo]);
        }
        $info["events"]=$tmp;

        //qui solo chi ha il login puo vedere i gruppi nella view, quindi bisogna fare un auth ceck
        if (\Auth::check()){
            $groups=\App\Group::all();
            $final=[];
            foreach($groups as $group){
                array_push($final,["group"=>$group,"photo"=>$group->g_photos->first()]);
            }
            $info["groups"]=$final;
        }

        //dd($info);
        return view('welcome',compact('info'));
    }
}
