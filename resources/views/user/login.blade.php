@extends('layouts.master')

@section('content')
    <div class="container" id="container-login">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In</h5>


                        <form class="form-signin" method="POST" action="{{route('user/login')}}">
                            @csrf
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

                            <div class="form-label-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" id="inputPassword" class="form-control {{ ($errors->has('password')) ? ' is-invalid':'' }}" name="password" placeholder="Password">
                                <div class="invalid-feedback">
                                    {{ $errors->has('password') ? $errors->first('password') : ''}}
                                </div>
                            </div>

                            <br>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="rememberme">
                                <label class="custom-control-label" for="customCheck1">ricorda password</label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                            <hr class="my-4">
                            <div class="forgot-pw">
                                <a href="#">hai dimenticato la tua password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    body{
        background-color: #009afe;
    }
    #container-login{
    margin-top: 90px;
    }
    .forgot-pw{
    text-align:center;
    }
@endsection
