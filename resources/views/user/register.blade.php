@extends('layouts.master')

@section('content')
<div class="container" id="container-login">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>


          <form class="form-signin" action="{{url('user/register')}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">email:</label>
                <input type="text" value="{{old('email')}}" class="form-control {{ ($errors->has('email')) ? ' is-invalid':'' }}" name="email">
                <div class="invalid-feedback">
                    {{ $errors->has('email') ? $errors->first('email') : ''}}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputnome">nome:</label>
                <input type="text" value="{{old('name')}}" class="form-control {{ ($errors->has('name')) ? ' is-invalid':'' }}" name="name">
                <div class="invalid-feedback">
                    {{ $errors->has('name') ? $errors->first('name') : ''}}
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputcognome">cognome:</label>
                <input type="text" value="{{old('surname')}}" class="form-control {{ ($errors->has('surname')) ? ' is-invalid':'' }}" name="surname">
                <div class="invalid-feedback">
                    {{ $errors->has('surname') ? $errors->first('surname') : ''}}
                </div>
            </div>
            </div>
            <div class="form-group">
                <label for="inputnickname">nickname:</label>
                <input type="text" value="{{old('nickname')}}" class="form-control {{ ($errors->has('nickanme')) ? ' is-invalid':'' }}" name="nickname">
                <div class="invalid-feedback">
                    {{ $errors->has('nickname') ? $errors->first('nickname') : ''}}
                </div>
            </div>
            <div class="form-group">
                <label for="indirizzo">indirizzo di recapito:</label>
                <input id="autocomplete-user-edit-place" value="{{old('place')}}" name="place" class="form-control {{ ($errors->has('place')) ? ' is-invalid':'' }}" onFocus="geolocate()" type="text"/>
                <div class="invalid-feedback">
                    {{ $errors->has('place') ? $errors->first('place') : ''}}
                </div>
            </div>
            <div class="form-group">
                <label for="datanascita">data di nascita:</label>
                <input type="date" value="{{old('born_date')}}" class="form-control {{ ($errors->has('born_date')) ? ' is-invalid':'' }}" name="born_date">
                <div class="invalid-feedback">
                    {{ $errors->has('born_date') ? $errors->first('born_date') : ''}}
                </div>
            </div>

              <div class="form-label-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control {{ ($errors->has('password')) ? ' is-invalid':'' }}" placeholder="Password" required name="password">
                <div class="invalid-feedback">
                    {{ $errors->has('password') ? $errors->first('password') : ''}}
                </div>
              </div>

              <div class="form-label-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control {{ ($errors->has('password')) ? ' is-invalid':'' }}" placeholder="Password" required name="password_confirmation">
                <div class="invalid-feedback">
                    {{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : ''}}
                </div>
              </div>

              <br>


              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>

            </form>
          </div>
        </div>
      </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&libraries=places"></script>
@endsection
@section('styles')
    body{
        background-color: #009afe;
    }
    #container-login{
    margin-top: 90px;
    }
@endsection
@section('scripts')
        $(document).ready(function(){
            initAutocomplete();

        });
        var placeSearch, autocomplete;
        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete-user-edit-place')),
                {types: ['geocode','establishment']});

            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();
        }

        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }


@endsection
