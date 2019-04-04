<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\GmapsAPI;

use Illuminate\Contracts\Encryption\DecryptException;

class UpdateController extends Controller
{
	use GmapsAPI;
    public function update(Request $request){
    	//dd($request->edit_group_place);
    	$groupId=null;
        try {
            $groupId=decrypt($request->edit_group_id);
        } catch (DecryptException $e) {
            return back();
        }
        $group=\App\Group::find($groupId);

        $groups=\Auth::user()->groups_admin; //tutti i gruppi di cui sono admin
        $exist = $this->checkExistance($groupId,$groups);//vede se sono admin del gruppo di cui si fa l'evento(per evitare che qualcuno cambi il campo hidden permettendo cosi di fare eventi per qualsiasi gruppo)
        if(!$exist) return back();


        $credentials=$request->only('edit_group_name','edit_group_place','edit_group_genres');

 		$validation=\Validator::make($credentials,$this->rules(),$this->messages());
        if($validation->fails())
            return redirect('group/'.$groupId."#edit-group")->withErrors($validation)->withInput($credentials);

        $response=false;

        if($request->edit_group_place == $group->place){
        	$response["place"]=$group->place;
            $response["lat"]=$group->lat;
            $response["lng"]=$group->lng;
        }else{
        	$response=empty($request->edit_group_place) ? false : $this->validatePlace($request->edit_group_place);
        }
		
        /*if(!$response){
            $errors = new Illuminate\Support\MessageBag();
            $errors->add('edit_group_place', 'posizione non valida.');
            return redirect('group/'.$groupId."#edit-group")->withErrors($errors);
        }*/


        
        $group->name=$request->edit_group_name;
        $group->place=$response["place"];
        $group->lat=$response["lat"];
        $group->lng=$response["lng"];
        $group->save();

        return redirect('group/'.$groupId);


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

    public function rules(){
        return [
            "edit_group_name"=>"required",
            "edit_group_place"=>"required",
            "edit_group_genres"=>"nullable"
        ];
    }
    public function messages(){
        return [
        ];
    }
}
