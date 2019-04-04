<form id="edit-group" action="{{route('group/update')}}" method="post" style="display:none; width: 90%; max-width: 660px;margin-left:-5%;z-index:100" class="fancybox-content">
    @csrf

    <input type="hidden" name="edit_group_id" value="{{ encrypt($info["group"]->id) }}">
    <div class="form-group">
        <label for="inputnickname">nome gruppo:</label>
        <input type="text" class="form-control {{ ($errors->has('edit_group_name')) ? ' is-invalid':'' }}" name="edit_group_name" placeholder="" value="{{$errors->has("edit_group_name") ? old("edit_group_name") : $info["group"]->name}}">
        <div class="invalid-feedback">
            {{ $errors->has('edit_group_name') ? $errors->first('edit_group_name') : ''}}
        </div>
    </div>

    <div class="form-group">
        <label for="indirizzo">indirizzo di recapito:</label>
        <input id="autocomplete-edit-group" name="edit_group_place" class="form-control {{ ($errors->has('edit_group_place')) ? ' is-invalid':'' }}" value="{{$errors->has("edit_group_place") ? old("edit_group_place") : $info["group"]->place}}" onFocus="geolocate()" type="text"/>
        <div class="invalid-feedback">
            {{ $errors->has('edit_group_place') ? $errors->first('edit_group_place') : ''}}
        </div>

    </div>
    <div class="form-group">
        <label for="datanascita">generi:</label>
        <input type="text" name="edit_group_genres" value="{{$info["genres"]->pluck('name')->implode(',')}}" data-role="tagsinput" id="edit_group_genres">
    </div>
    <input type="submit" class="btn btn-primary" value="aggiorna">

    <input type="button"class="btn btn-secondary float-right" onclick="$.fancybox.close()" value="annulla"/>




    <button type="button" data-fancybox-close="" class="fancybox-button fancybox-close-small" title="Close">
        <svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
            <path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path>
        </svg>
    </button>
</form>