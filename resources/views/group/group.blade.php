@extends('layouts.master')

@section('content')

@if($info["privilege"]==1)
    @include('group._edit')
@endif

@if($info["privilege"] == 1 || $info["privilege"] == 2)
    @include('group._create_event')    
@endif


@include('group._register_user_group')


<section id="tabs">
    <div class="container">


        <div class="group-userpic text-center">
            @if(count($info["photos"])>0)

                <a href="{{ asset('storage/photos/g_photos/'.$info["photos"][0]["path"])}}" data-fancybox="profile" data-caption="{{$info["photos"][0]["description"]}}" id="prf-1">
                    <img src="{{ asset('storage/photos/g_photos/'.$info["photos"][0]["path"])}}" class="img-fluid" alt="" >
                </a>
                @for ($i = 1; $i < count($info["photos"]); $i++)
                    <a href="{{ asset('storage/photos/g_photos/'.$info["photos"][$i]["path"])}}" data-fancybox="profile" data-caption="{{$info["photos"][$i]["description"]}}" id="prf-{{$i+1}}"></a>
                @endfor
            @else
                <img src="{{URL::asset('photos/static/user-default.png')}}" class="img-fluid" alt="" style="background-color: #009afe" >
            @endif

        </div>


        @if($info["privilege"] == 1)
            <div class="buttons-control">
                <i class="fas fa-plus-circle btns-controls" id="btn-add-image-group"></i>
                <a class="btn-edit" data-fancybox="edit-group" data-src="#edit-group">
                        <i class="fas fa-edit btns-controls"></i>
                </a>
            </div>
        @endif


        <h6 class="section-title h1">
           {{$info["group"]->name}}
        </h6>

    </div><!-- container-->



    <div class="container">
        <div class="row" style="display:grid">
            <div class="col-xs-12">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-eventi-tab" data-toggle="tab" href="#nav-eventi" role="tab" aria-controls="nav-eventi" aria-selected="true"  href="#eventi">Eventi</a>
                        <a class="nav-item nav-link" id="nav-membri-tab" data-toggle="tab" href="#nav-membri" role="tab" aria-controls="nav-membri" aria-selected="false">Membri</a>
                        @if($info["privilege"] == 1) <a class="nav-item nav-link" id="nav-richieste-tab" data-toggle="tab" href="#nav-richieste" role="tab" aria-controls="nav-richieste" aria-selected="false">Richieste <span class="badge badge-light">{{count($info["users_request"])}}</span></a> @endif
                        <a class="nav-item nav-link" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="false">Info</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>


    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-eventi" role="tabpanel" aria-labelledby="nav-eventi-tab">
                <div class="container">

                    <a class="btn-edit" data-fancybox="create-event" data-src="#create-event">
                                <i class="fas fa-edit btns-controls"></i>
                        </a>




                    <div class="row">
                            @foreach ($info["events"] as $event)
                                <div class="col-xs-12 col-sm-4">
                                        <div class="testimonial testimonial-gruppo" style="padding:10px;">
                                                <p class="description-date">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i> {{$event->event_date}}
                                                </p>
                                                <div class="testimonial-title">
                                                    {{$event->title}}
                                                </div>

                                                <p class="description">
                                                    <br>
                                                    <table style="width:100%">
                                                        <tr>
                                                            <td class="description-location">
                                                                <i class="fa fa-map-marker" aria-hidden="true"></i> {{$event->place}}
                                                            </td>
                                                            <td class="description-ora-inizio">
                                                                <i class="fas fa-clock"></i> {{$event->start_hour}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="description-bandname">
                                                                <i class="fas fa-users"></i> {{$info["group"]->name}}
                                                            </td>
                                                            <td class="description-ora-fine">
                                                                <i class="fas fa-clock"></i> {{$event->end_hour}}
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <div>
                                                        {{$event->description}}
                                                    </div>
                                                </p>
                                            </div>
                                </div>
                            @endforeach


                    </div><!--end row-->
                </div><!-- end container-->

            </div><!--end nav eventi-->


            <div class="tab-pane fade" id="nav-membri" role="tabpanel" aria-labelledby="nav-membri-tab">
                <div class="container">
                    <div class="group-members">
                            <div class="row">
                                @foreach($info["users_accepted"] as $user)
                                    <div class="col-xs-12 col-sm-6">
                                            <div class="group-member rounded" onclick="window.location='{{ url('user/'.$user["user"]->id) }}'">
                                                <div class="group-member-profile text-center">
                                                    @isset($user["photo"])
                                                        <img src="{{ asset('storage/photos/u_photos/'.$user["photo"]["path"])}}" class="rounded-circle">
                                                    @else
                                                        <img src="{{URL::asset('photos/static/user-default.png')}}" class="rounded-circle" alt="" style="background-color: #009afe" >
                                                    @endisset
                                                </div>
                                                <div class="group-member-name">
                                                        {{$user["user"]->nickname ? $user["user"]->nickname : $user["user"]->name}}
                                                </div>
                                                <ul class="text-center">
                                                    <li>
                                                        <span class="badge badge-primary">basso</span>
                                                    </li>
                                                    <li>
                                                        <span class="badge badge-primary">chitarra</span>
                                                    </li>
                                                </ul>

                                            </div>


                                    </div>
                                @endforeach
                            </div><!-- end row-->
                        </div><!-- end group member-->

                </div><!-- end container-->
            </div><!-- end membri tab-->


            <div class="tab-pane fade" id="nav-richieste" role="tabpanel" aria-labelledby="nav-richieste-tab">
                    <div class="container">
                        <div class="row">

                                @foreach($info["users_request"] as $user)
                                    <div class="col-xs-12 col-sm-6">
                                            <div class="group-member rounded" onclick="window.location='{{ url('user/'.$user["user"]->id) }}'" style="height:220px;">
                                                <div class="group-member-profile text-center">
                                                    @isset($user["photo"])
                                                        <img src="{{ asset('storage/photos/u_photos/'.$user["photo"]["path"])}}" class="rounded-circle">
                                                    @else
                                                        <img src="{{URL::asset('photos/static/user-default.png')}}" class="rounded-circle" alt="" style="background-color: #009afe" >
                                                    @endisset
                                                </div>
                                                <div class="group-member-name">
                                                        {{$user["user"]->nickname ? $user["user"]->nickname : $user["user"]->name}}
                                                </div>
                                                <ul class="text-center">
                                                    <li>
                                                        <a class="btn-accept-user" id="{{$user["user"]->id}}"> <i class="fas fa-check-circle"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="btn-deny-user" id="{{$user["user"]->id}}"><i class="fas fa-times-circle"></i></a>
                                                    </li>
                                                </ul>

                                            </div>


                                    </div>
                                @endforeach
                    </div><!--end row-->
                </div><!--end container-->
            </div> <!--end tab richieste-->


            <div class="tab-pane fade" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                    <div class="container">

						<!--<a class="btn btn-success float-right" data-fancybox="register-user-group" data-src="#register-user-group" style="color:white">
								<i class="fas fa-plus"></i> iscriviti
                        </a>-->
                        @switch($info["privilege"])

                            @case(5)

                                @break

                            @case(4)
                                <label class="btn btn-lg btn-success float-right" style="background-color:gray">
                                    <i class="fas fa-spinner"></i> richiesta inviata
                                </label>
                                @break

                            @case(3)
                                @break

                            @case(2)
                                @break

                            @case(1)
                                <label class="btn btn-lg btn-success active float-right">
                                    <i class="fa fa-check"></i> iscritto
                                </label>
                                @break
                            @default
                                <a class="btn btn-success float-right" id="btn-iscriviti" style="color:white">
                                    <i class="fas fa-plus"></i> iscriviti
                                </a>
                        @endswitch



						<div class="row">

                            <div class="col-xs-12 col-sm-4 group-info-created align-middle">
                                gruppo creato da:
                            </div><!--col xs 12-->


							<div class="col-xs-12 col-sm-6">


                                    <div class="group-member rounded">
                                        <div class="group-member-profile text-center">
                                            <img src="foto/nirvana.jpg" class="rounded-circle">
                                        </div>
                                        <div class="group-member-name">
                                            luigi cennini
                                        </div>
                                        <ul class="text-center">
                                            <li>
                                                <span class="badge badge-primary">basso</span>
                                            </li>
                                            <li>
                                                <span class="badge badge-primary">chitarra</span>
                                            </li>
                                        </ul>
                                    </div>
                            </div><!--col xs 12-->
                        </div><!--end row-->

						<div class="group-member-number">
							in data:
						</div>

						<div class="group-member-number">
								numero membri: 15
						</div>
						<div class="group-member-number">
								generi:
						</div>

					</div><!-- end container-->

            </div><!--end tab info-->

    </div>


</section>

<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&libraries=places"></script>

@endsection

@section('styles')

.swal2-container {
    z-index: 999999999999  !important;
}
.pac-container {
    z-index: 999999 !important;
}
section {
    padding: 120px 0;

}

section .section-title {
    text-align: center;
    color: #007b5e;
    margin-bottom: 50px;
    text-transform: uppercase;
}
#tabs{
	background: white;
    color: black;

}
#tabs h6.section-title{
    color: black;
}

#tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {

    color: #f3f3f3;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 4px solid !important;
    font-size: 20px;
    font-weight: bold;
}
#tabs .nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color:black;
    font-size: 20px;
}
.tab-content {
    background-color: #F8F9FA;
	color:black;
}

@endsection

@section('scripts')

@if($info["privilege"] == 1)

$.fancybox.defaults.btnTpl.delete = '<button data-fancybox-delete class="fancybox-button fancybox-button--delete" title="rimuovi imamgine">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">' +
                '<path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-12v-2h12v2z"/>' +
                '</svg>' +
            '</button>';

$( '[data-fancybox="profile"]' ).fancybox({
    buttons : [
        'delete',
        'close'
    ]
});

$('body').on('click', '[data-fancybox-delete]', function() {

            Swal.fire({
                title: 'Sei sicuro?',
                text: "cliccando elimina rimuoverai questa immagine!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,elimina!'
            }).then((result) => {
                if (result.value) {


                    //l'immagine
                    //var path=$.fancybox.getInstance().group[$.fancybox.getInstance().currIndex].src;
                    var index=$.fancybox.getInstance().group[$.fancybox.getInstance().currIndex].index;
                    var pathImage=@json($info["photos"]);
                    pathImage=pathImage[index]["path"];

                    var campi={
                        path:pathImage,
                        group_id:{{$info["group"]->id}}
                    };
                    console.log(campi);
                    $.ajax({
                        url: "{{route('deleteImageGroup')}}",
                        data: campi,
                        type: 'POST',
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            window.location.reload(true)
                            //console.log(data);
                        },
                        error: function(e){
                            console.log(e);
                        }
                    });
                    //console.log(path);
                    //console.log(index);
                    //location.reload();
                }
            })
        });


@endif


$(function(){
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('.nav-tabs a').click(function (e) {
      $(this).tab('show');
      var scrollmem = $('body').scrollTop() || $('html').scrollTop();
      window.location.hash = this.hash;
      $('html,body').scrollTop(scrollmem);
    });
  });       


          $('#edit_group_genres').tagsinput({

          });


          $('.btn-accept-user').click(function(){
            //le 3 righe sotto sono per stoppare la propagazione degli eveti in js
            //senza queste siccome l'outer div ha un onclick appena io clicco il bottone dentro il div , si attiva il click dell'outer div-> le 3 righ sono per far si che questo non accada
            if (!e) var e = window.event;
            e.cancelBubble = true;
            if (e.stopPropagation) e.stopPropagation();

            Swal.fire({
                title: 'Sei sicuro?',
                text: "Clicca accetta per accettare nella tua band!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'accetta!'
              }).then((result) => {
                if (result.value) {
                    dati={
                        "group": {{$info["group"]->id}},
                        "user": $(this).attr("id")
                    }
                    $.ajax({
                        url: "{{route('addUserGroup')}}",
                        data: dati,
                        type: 'POST',
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            //console.log(data);
                            window.location.reload(true)
                        },
                        error: function(e){
                            console.log(e);
                        }
                    })

                }
              })
          });

          $('.btn-deny-user').click(function(){
            if (!e) var e = window.event;
            e.cancelBubble = true;
            if (e.stopPropagation) e.stopPropagation();

            Swal.fire({
                title: 'Sei sicuro?',
                text: "Clicca rifiuta per rifiutare questo membro della band!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'rifiuta!'
              }).then((result) => {
                if (result.value) {
                    dati={
                        "group": {{$info["group"]->id}},
                        "user": $(this).attr("id")
                    }
                    $.ajax({
                        url: "{{route('denyUserGroup')}}",
                        data: dati,
                        type: 'POST',
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            //console.log(data);
                            window.location.reload(true)
                        },
                        error: function(e){
                            console.log(e);
                        }
                    })

                }
              })
          });



          $('#btn-iscriviti').click(function(){
            @guest
                //se non sei loggato prima di iscriverti devi loggare
                Swal.fire({
                    text: "Esegui il login per rendere disponibile questa funzione!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'login'
                }).then((result) => {
                if (result.value) {
                    window.location="../user/login";
                }
                })
            @else
                //se sei loggato allora puoi chiedere di iscriverti
                Swal.fire({
                    title: 'Sei sicuro?',
                    text: "Cliccando iscriviti invierai una richiesta al gruppo.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'iscriviti!'
                }).then((result) => {
                    if (result.value) {
                        //in ajax mando l'id del gruppo a cui l'utente loggato si deve iscrivere
                        group =  {
                            group_id :@php echo $info["group"]["id"] @endphp
                        }
                        $.ajax({
                            method:"POST",
                            url:"subscribe",
                            data: group,
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(a){
                                Swal.fire(
                                    'Fatto!',
                                    'la tua richiesta è stata inviata correttamente.',
                                    'success'
                                )
                            }
                        });

                    }
                })
            @endguest

          });


          //click add image
          $('body').on('click', '#btn-add-image-group', async function() {
              const {value: file} =await Swal.fire({
                  title: 'Select image',
                  input: 'file',
                  inputAttributes: {
                      'accept': 'image/*',
                      'aria-label': "aggiungi un'immagine!"
                  }
              })



              if (file) {
                  const reader = new FileReader
                  reader.onload = (e) => {
                      Swal.fire({
                          title: 'descrizione:',
                          imageUrl: e.target.result,
                          imageAlt: 'The uploaded picture',
                          input: 'text',
                          showCancelButton: true,
                          preConfirm: (testo) => {
                              var sendImage=new FormData();
                              sendImage.append("image",file);
                              sendImage.append("description",testo);
                              sendImage.append("group",{{$info["group"]->id}});


                              $.ajax({
                                  url: "{{route('addImageGroup')}}",
                                  data: sendImage,
                                  processData: false,
                                  contentType: false,
                                  type: 'POST',

                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  },
                                  success: function (data) {
                                      window.location.reload(true)
                                  },
                                  error: function(e){
                                      console.log(e);
                                  }
                              });

                              //console.log(testo);
                              //console.log(e.target.result);
                          }
                      })
                  }
                  reader.readAsDataURL(file)
              }

          });




          //per avere gli hint dell'indirizzo:

          $(document).ready(function(){
            initAutocomplete();
            initAutocomplete2();    
      })
          var placeSearch, autocomplete;
        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete-edit-group')),
                {types: ['geocode','establishment']});

            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function initAutocomplete2(){
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete-register-event')),
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
