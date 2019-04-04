<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials=$request->only('email','password');
        $validation=\Validator::make($credentials,$this->rules(),$this->messages());
        if ($validation->fails()) {
            return redirect()->route('user/login')->withErrors($validation)->withInput($request->only('email'));
        }else{
            $rememberme=false;
            isset($request->rememberme) ? $rememberme=true : $rememberme=false;
            if (\Auth::attempt(["email"=>$request->email,"password"=>$request->password,"status"=>1],$rememberme)){
                return redirect()->route('/');
            }else{
                return redirect()->route('user/login')->withErrors(["generic"=>"nome utente o password non corretti"]);
            }

        }
    }


    public function rules(){
        return [
            "email"=>"required|email",
            "password"=>"required"
        ];
    }
    public function messages(){
        return [
            "email.required"=>"email mancante",
            "email.email"=>"formato non valido",
            "password.required"=>"password mancante"
        ];
    }


    public function logout(){
        \Auth::logout();
        return redirect()->route('/');
    }
}
