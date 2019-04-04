<form id="create-event" action="{{ route('event/register')}}" method="post" style="display:none; width: 90%; max-width: 660px;margin-left:-5%;" class="fancybox-content" onsubmit="return CheckCreateEventForm()">
    @csrf
    <input type="hidden" name="group" value="{{ encrypt($info["group"]->id) }}">


	<div class="form-group">
        <label for="event_title">titolo evento:</label>
        <input type="text" class="form-control {{ ($errors->has('event_title')) ? ' is-invalid':'' }}" name="event_title" placeholder="titolo evento" value="{{ old('event_title') }}">
        <div class="invalid-feedback">
            {{ $errors->has('event_title') ? $errors->first('event_title') : ''}}
        </div>

        <label for="event_date">data:</label>
        <input type="date" class="form-control {{ ($errors->has('event_date')) ? ' is-invalid':'' }}" name="event_date" value="{{ old('event_date') }}">
        <div class="invalid-feedback">
            {{ $errors->has('event_date') ? $errors->first('event_date') : ''}}
        </div>

        <label for="event_place">luogo svolgimento:</label>
        <input type="text" id="autocomplete-register-event" class="form-control {{ ($errors->has('event_place')) ? ' is-invalid':'' }}" name="event_place" placeholder="luogo evento" onFocus="geolocate()" value="{{ old('event_place') }}">
        <div class="invalid-feedback">
            {{ $errors->has('event_place') ? $errors->first('event_place') : ''}}
        </div>


        <div class="form-row">
			<div class="col">
				<label for="event_start_hour">ora inizio:</label>
        		<input type="time" class="form-control {{ ($errors->has('event_start_hour')) ? ' is-invalid':'' }}" name="event_start_hour" value="{{ old('event_start_hour') }}">
                <div class="invalid-feedback">
                    {{ $errors->has('event_start_hour') ? $errors->first('event_start_hour') : ''}}
                </div>
			</div>
			<div class="col">
				<label for="event_end hour">ora fine:</label>
        		<input type="time" class="form-control {{ ($errors->has('event_end_hour')) ? ' is-invalid':'' }}" name="event_end_hour" value="{{ old('event_end_hour') }}">
                <div class="invalid-feedback">
                    {{ $errors->has('event_end_hour') ? $errors->first('event_end_hour') : ''}}
                </div>
			</div>
		</div>


        

        

        <label for="event_description">descrizione:</label>
        <textarea type="text" class="form-control {{ ($errors->has('event_description')) ? ' is-invalid':'' }}" rows="3" name="event_description" placeholder="descrizione evento" value="{{ old('event_description') }}"></textarea>
        <div class="invalid-feedback">
            {{ $errors->has('event_description') ? $errors->first('event_description') : ''}}
        </div>

		<p></p>			
        <input type="submit" value="crea" class="btn btn-success float-left">
    </div>


    <input type="button"class="btn btn-secondary float-right" onclick="$.fancybox.close()" value="annulla"/>
    <button type="button" data-fancybox-close="" class="fancybox-button fancybox-close-small" title="Close">
        <svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
            <path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path>
        </svg>
    </button>
</form>