<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\GmapsAPI;//il trait l'ho fatto perche avevo bisogno di utilizzare la stessa funzionalita(validate place) in piu classi.

class RegisterController extends Controller
{
    use GmapsAPI;//per la validazione del place

    public function register(Request $request){

        $credentials=$request->only('new_group_name','new_group_place');
        $validation=\Validator::make($credentials,$this->rules(),$this->messages());
        if($validation->fails())
            return redirect('user/'.\Auth::user()->id."#create-group")->withErrors($validation)->withInput($credentials);

    	$name=$request->new_group_name;
    	$response=empty($request->new_group_place) ? false : $this->validatePlace($request->new_group_place);
        if(!$response){
            $errors = new Illuminate\Support\MessageBag();
            $errors->add('new_group_place', 'posizione non valida.');
            return redirect('user/'.\Auth::user()->id."#create-group")->withErrors($errors);
        }

    	$group=new \App\Group;
    	$group->name=$name;
    	$group->lat=$response["lat"];
    	$group->lng=$response["lng"];
    	$group->place=$response["place"];
    	$group->save();

    	$group->users()->attach(\Auth::user()->id,['privilege'=>1]);
    	return redirect('group/'.$group->id);
    }

    public function rules(){
        return [
            "new_group_name"=>"required",
            "new_group_place"=>"required",
        ];
    }
    public function messages(){
        return [
            "new_group_name.required"=>"nome gruppo richiesto.",
            "new_group_place.required"=>"sede gruppo richiesta."
        ];
    }
}
