<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail; //per inviare la mail in fase di registrazione
use App\Http\Controllers\Traits\GmapsAPI;//il trait l'ho fatto perche avevo bisogno di utilizzare la stessa funzionalita(validate place) in piu classi.

class RegisterController extends Controller
{
    use GmapsAPI;//per la validazione del place

    public function register(Request $request){
        $credentials=$request->only('email','name','surname','nickname','born_date','place','password','password_confirmation');
        $validation=\Validator::make($credentials,$this->rules(),$this->messages());
        $response=empty($request->place) ? false : $this->validatePlace($request->place);
        if($validation->fails() || $response == false){
            return redirect()->route('user/register')->withErrors($validation)->withInput($request->except('password','password_confirmation'));
        }else{
            $verify_token=str_random(60);
            $user=\App\User::create([
                'nickname'=>$request->nickname,
                'name' => $request->name,
                'surname'=>$request->surname,
                'born_date'=>$request->born_date,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'place'=>$response["place"],
                'lat'=>$response["lat"],
                'lng'=>$response["lng"],
                'status'=>0,
                'verify_token'=>$verify_token
            ]);

            //send mail
            Mail::to($request->email)->send(new \App\Mail\Register($request->email,$verify_token));
        }
    }


    public function rules(){
        return [
            "email"=>"unique:users|required|email",
            "name"=>"required|max:190",
            "surname"=>"required|max:190",
            "nickname"=>"nullable",
            "born_date"=>"required|date",
            "place"=>"required",
            "password"=>"required|confirmed|max:255|min:6"
        ];
    }
    public function messages(){
        return [
            "email.required"=>"email mancante",
            "email.email"=>"formato non valido",
            "password.required"=>"password mancante"
        ];
    }



    public function verifyRegistration($email,$token){
        \DB::table('users')->where('email','=',$email)
                            ->where('verify_token','=',$token)
                            ->where('status','=',0)
                            ->update(['status'=>1,'verify_token'=>null]);
        return redirect('/');
    }



}
