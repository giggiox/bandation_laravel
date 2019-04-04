<form id="create-group" action="{{route('group/register')}}" method="post"
                              style="display:none; width: 90%; max-width: 660px;margin-left:-5%;" class="fancybox-content">
            <!--<div id="create-group-pic" style="background-image:url('foto/band.png')">
            </div>-->
            @csrf
            <div class="form-group">            
            
                <label for="new_group_name">nome gruppo:</label>
                <input type="text"class="form-control {{ ($errors->has('new_group_name')) ? ' is-invalid':'' }}" name="new_group_name" value="{{ old('new_group_name') }}">
                <div class="invalid-feedback">
                    {{ $errors->has('new_group_name') ? $errors->first('new_group_name') : ''}}
                </div>
                
                <label for="new_group_place">indirizzo sede gruppo:</label>
                <input type="text" value="{{ old('new_group_place') }}" class="form-control {{ ($errors->has('new_group_place')) ? ' is-invalid':'' }}" name="new_group_place" id="autocomplete-register-group" onFocus="geolocate()">
                <div class="invalid-feedback">
                    {{ $errors->has('new_group_place') ? $errors->first('new_group_place') : ''}}
                </div>

            </div>
            
            <input type="submit" value="crea" class="btn btn-success">  

            <button type="button" data-fancybox-close="" class="fancybox-button fancybox-close-small" title="Close">
            <svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
                <path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path>
            </svg>
        </button>
    </form>