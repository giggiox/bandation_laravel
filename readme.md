<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

Laravel è un framework open source di tipo MVC scritto in PHP per lo sviluppo di applicazioni web, creato nel 2011 da Taylor Otwell come derivazione di Symfony.

È distribuito con licenza MIT e mantiene tutto il codice disponibile su GitHub.


per sviluppare il prgetto ho potuto usufruire di alcuni dei servizi che Laravel mette a disposizione agli sviluppatori:
tra questi  
## laravel routing
laravel offre un semplice ed efficace metodo di gestione degli URL(route disptacher).

gestione routes per utente:
```php
Route::prefix('user')->group(function(){
    Route::get('login',function(){
        return view('user.login');
    })->name('user/login');
    Route::post('login','User\LoginController@login');
});
```

## Laravel Controller
```php
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
```


## Laravel View
```php 
<form class="form-signin" method="POST" action="{{route('user/login')}}">
	@csrf //PROTEZIONE CSRF GIA' INTEGRATA NATIVAMENTE
        @if($errors->has('generic'))
        	<div class="alert alert-danger" role="alert">
                                    {{$errors->first('generic')}}
                                </div>
                            @endif

                            <div class="form-label-group">
                                <label for="inputEmail">Email</label>
                                <input type="text" id="inputEmail" class="form-control {{ ($errors->has('email')) ? ' is-invalid':'' }}" name="email" placeholder="Email address" value="{{old('email')}}" required autofocus>
                                <div class="invalid-feedback">
                                    {{ $errors->has('email') ? $errors->first('email') : ''}}
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
</form>
```


le view di laravel sono un mezzo molto potente perchè facilitano molto la codifica del progetto in quanto offrono nativamente molti servizi.



## Laravel model
i modelli in laravel sono molto semplici da gestire perchè contengono solo gli attributi di una classe sia che la sua relazione con le altre.
```php
class User extends Model{
	public function instruments(){
        return $this->belongsToMany(\App\Instrument::class);
    }



	protected $fillable = [
        'name', 'email', 'password','surname','place','lat','lng','born_date','verify_token','status'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
}
```
