<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function show($id){
        $group=\App\Group::findOrFail($id);
        if(!$group) return false;

        $photos=$group->g_photos;


        $users_accepted=$group->users_accepted;
        $users_a=array();//devo trovare anche le foto
        foreach($users_accepted as $user){
            array_push($users_a,["user"=>$user,"photo"=>$user->u_photos->first()]);
        }

        $users_request=$group->users_request;
        $users_r=array(); //stessa cosa qui devo trovare le foto
        foreach($users_request as $user){
            array_push($users_r,["user"=>$user,"photo"=>$user->u_photos->first()]);
        }

        $events=$group->events;


        $privilege=null;
        //$admin=false;
        if(\Auth::check()){
            /*foreach($users_accepted as $user_accepted){
                if($user_accepted->pivot->privilege == 1 && \Auth::user()->id == $user_accepted->id){//per vedere se sei admin
                    $admin=true;
                }


            }*/

            //trova il tuoi privilege all'interno di un gruppo(sempre se ci sei)
            $users=$group->users;
            foreach($users as $u){
                if($u->id == \Auth::user()->id){
                    $privilege=$u->pivot->privilege;
                }
            }
        }

        $genres=$group->genres;


        $info=["group"=>$group,"photos"=>$photos,"users_accepted"=>$users_a,"users_request"=>$users_r,"events"=>$events,"privilege"=>$privilege,"genres"=>$genres];
        return view('group.group',compact('info'));
    }


    public function addImage(Request $request){
        if($request->hasFile('image')){
            $img=$request->file('image');
            $id=$request->group;
            $name=$id."_".uniqid().".".$img->getClientOriginalExtension();
            //$img->storeAs('/photos/u_photos/', $name);
            $img_db=new \App\G_photo;
            $img_db->path=$name;
            $img_db->description=$request->description;
            \App\Group::find($request->group)->g_photos()->save($img_db);

            \Storage::disk('public')->put('/photos/g_photos/'.$name, file_get_contents($img));
        }
    }

    public function deleteImage(Request $request){
        $res=\App\G_photo::where("path",$request->path)->where("group_id",$request->group_id)->delete();
        \Storage::disk('public')->delete('/photos/g_photos/'.$request->path);
        return json_encode("true");
    }
}
