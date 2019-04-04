<form id="edit-user" action="{{route('user/update')}}" method="post" style="display:none; width: 90%; max-width: 660px;margin-left:-5%;z-index:100" class="fancybox-content">
            @csrf
            <div class="form-group">
                <label for="inputnickname">email:</label>
                <input type="text" readonly class="form-control-plaintext" name="email" placeholder="{{\Auth::user()->email}}">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputnome">nome:</label>
                <input type="text" class="form-control {{ ($errors->has('edit_user_name')) ? ' is-invalid':'' }}" name="edit_user_name" value="{{$errors->has("edit_user_name") ? old("edit_user_name") : \Auth::user()->name }}">

                <div class="invalid-feedback">
                    {{ $errors->has('edit_user_name') ? $errors->first('edit_user_name') : ''}}
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputcognome">cognome:</label>
                <input type="text" class="form-control {{ ($errors->has('edit_user_surname')) ? ' is-invalid':'' }}" name="edit_user_surname" value="{{$errors->has("edit_user_surname") ? old("edit_user_surname") : \Auth::user()->surname }}">

                <div class="invalid-feedback">
                    {{ $errors->has('edit_user_surname') ? $errors->first('edit_user_surname') : ''}}
                </div>
            </div>
            </div>
            <div class="form-group">
                <label for="inputnickname">nickname:</label>
                <input type="text" class="form-control {{ ($errors->has('edit_user_nickname')) ? ' is-invalid':'' }}" name="edit_user_nickname" value="{{$errors->has("edit_user_nickname") ? old("edit_user_nickname") : \Auth::user()->nickname }}">


                 <div class="invalid-feedback">
                    {{ $errors->has('edit_user_nickname') ? $errors->first('edit_user_nickname') : ''}}
                </div>
            </div>
            <div class="form-group">
                <label for="indirizzo">indirizzo di recapito:</label>
                <input id="autocomplete-user-edit-place" name="edit_user_place" class="form-control {{ ($errors->has('edit_user_place')) ? ' is-invalid':'' }}" value="{{$errors->has("edit_user_place") ? old("edit_user_place") : \Auth::user()->place }}" onFocus="geolocate()" type="text"/>

                <div class="invalid-feedback">
                    {{ $errors->has('edit_user_place') ? $errors->first('edit_user_place') : ''}}
                </div>
            </div>
            <div class="form-group">
                <label for="datanascita">data di nascita:</label>
                <input type="date" class="form-control {{ ($errors->has('edit_user_born_date')) ? ' is-invalid':'' }}" name="edit_user_born_date" value="{{$errors->has("edit_user_born_date") ? old("edit_user_born_date") : \Auth::user()->born_date }}">

                <div class="invalid-feedback">
                    {{ $errors->has('edit_user_born_date') ? $errors->first('edit_user_born_date') : ''}}
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="aggiorna">

            <input type="button"class="btn btn-secondary float-right" onclick="$.fancybox.close()" value="annulla"/>




            <button type="button" data-fancybox-close="" class="fancybox-button fancybox-close-small" title="Close">
                <svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
                    <path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path>
                </svg>
            </button>
        </form>