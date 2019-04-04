<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($id){
        $user=null;
        try{
            $user=\App\User::findOrFail($id);
        }catch(ModelNotFoundException $e){
            abort(404,'ciao');
        }
        $photos=$user->u_photos;

        $groupsphoto=array();
        $groups=$user->groups_accepted;
        foreach ($groups as $group){
            array_push($groupsphoto,["group"=>$group,"g_photo"=>$group->g_photos->first(),"genres"=>$group->genres]);
        }

        $eventsgroup=array();
        foreach ($groups as $group){
            $events=$group->events;
            $groupPhoto=$group->g_photos->first();
            foreach ($events as $event) {
                array_push($eventsgroup,["group"=>$group,"event"=>$event,"g_photo"=>$groupPhoto]);
            }

        }

        $instruments=array();
        $instrument_user=$user->instrument_users;
        foreach ($instrument_user as $instrument_u){
            $genres=$instrument_u->genres;
            array_push($instruments,["instrument"=>$instrument_u->instrument,"instrument_info"=>$instrument_u,"instrument_genres"=>$genres]);
        }
        //dd($instruments);

        $info=["user"=>$user,"photos"=>$photos,"groups"=>$groupsphoto,"events"=>$eventsgroup,"instruments"=>$instruments];

        if(\Auth::check()){
            $groups=\App\Group::all();
            $final=[];
            foreach($groups as $group){
                array_push($final,["group"=>$group,"photo"=>$group->g_photos->first()]);
            }
            $info["allgroups"]=$final;
        }

        return view('user/user',compact('info'));

    }


    public function addImage(Request $request){ //TODO validare la richiesta dell'immagine  e della description
        if($request->hasFile('image')){
            $img=$request->file('image');
            $id=\Auth::user()->id;
            $name=$id."_".uniqid().".".$img->getClientOriginalExtension();
            //$img->storeAs('/photos/u_photos/', $name);
            $img_db=new \App\U_photo;
            $img_db->path=$name;
            $img_db->description=$request->description;
            \Auth::user()->u_photos()->save($img_db);

            \Storage::disk('public')->put('/photos/u_photos/'.$name, file_get_contents($img));
        }
    }

    public function deleteImage(Request $request){
        $res=\App\U_photo::where("path",$request->path)->where("user_id",\Auth::user()->id)->delete();
        \Storage::disk('public')->delete('/photos/u_photos/'.$request->path);
        return "true";

    }
}
