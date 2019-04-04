<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\GmapsAPI;

class UpdateController extends Controller
{
    use GmapsAPI;
    public function update(Request $request){
        $user=\Auth::user();


        $credentials=$request->only('edit_user_name','edit_user_surname','edit_user_nickname','edit_user_place','edit_user_born_date');
        //dd($credentials);

        $validation=\Validator::make($credentials,$this->rules(),$this->messages());

        $response=false;
        if($request->edit_user_place == $user->place){
            $response["place"]=$user->place;
            $response["lat"]=$user->lat;
            $response["lng"]=$user->lng;
        }else{
            $response=empty($request->edit_user_place) ? false : $this->validatePlace($request->edit_user_place);    
        }
        

        //dd($request->edit_user_place);
        //dd($response);

        if ($validation->fails()) {
            return redirect('user/'.$user->id."#edit-user")->withErrors($validation)->withInput($credentials);
        }else{
            
            $user->nickname=$request->edit_user_nickname;
            $user->name=$request->edit_user_name;
            $user->surname=$request->edit_user_surname;
            $user->place=$response["place"];
            $user->lat=$response["lat"];
            $user->lng=$response["lng"];
            $user->born_date=$request->edit_user_born_date;
            $user->save();
            return redirect('user');

        }

    }

    public function rules(){
        return [
            "edit_user_name"=>"required|max:190",
            "edit_user_surname"=>"required|max:190",
            "edit_user_nickname"=>"nullable",
            "edit_user_place"=>"required",
            "edit_user_born_date"=>"required|date",
        ];
    }
    public function messages(){
        return [
            'edit_user_name.required'=>'nome richiesto.',
        ];
    }
}
