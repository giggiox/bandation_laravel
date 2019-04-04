@extends('layouts.master')

@section('content')

    @if(\Auth::check() && \Auth::user()->id == $info["user"]["id"]) <!-- chi sta navigando la pagina è anche admin della stessa(è la sua)-->
        @include('user._edit')
        @include('user._create_group')
    @endif





    <div class="container user-page">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar rounded">


                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic text-center">


                        @if(count($info["photos"])>0)

                            <a href="{{ asset('storage/photos/u_photos/'.$info["photos"][0]["path"])}}" data-fancybox="profile" data-caption="{{$info["photos"][0]["description"]}}" id="prf-1">
                                <img src="{{ asset('storage/photos/u_photos/'.$info["photos"][0]["path"])}}" class="img-fluid" alt="" >
                            </a>
                            @for ($i = 1; $i < count($info["photos"]); $i++)
                                <a href="{{ asset('storage/photos/u_photos/'.$info["photos"][$i]["path"])}}" data-fancybox="profile" data-caption="{{$info["photos"][$i]["description"]}}" id="prf-{{$i+1}}"></a>
                            @endfor
                        @else
                            <img src="{{URL::asset('photos/static/user-default.png')}}" class="img-fluid" alt="" style="background-color: #009afe" >
                        @endif
                    </div>
                    <!-- END SIDEBAR USERPIC -->

                    @if(\Auth::check() && \Auth::user()->id == $info["user"]["id"])
                        <div class="buttons-control">
                            <i class="fas fa-plus-circle btns-controls" id="btn-add-image-user"></i> &nbsp;&nbsp;
                            <a class="btn-edit" data-fancybox="edit-user" data-src="#edit-user">
								<i class="fas fa-edit btns-controls"></i>
						    </a>
                        </div>
                    @endif

                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{$info["user"]->nickname ? $info["user"]->nickname : $info["user"]->name}}
                        </div>
                    </div>


                </div>
                <br>
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-events-list" data-toggle="list" href="#list-events" role="tab" aria-controls="events">eventi</a>
                    <a class="list-group-item list-group-item-action" id="list-groups-list" data-toggle="list" href="#list-groups" role="tab" aria-controls="groups">gruppi</a>
                    <a class="list-group-item list-group-item-action" id="list-instruments-list" data-toggle="list" href="#list-instruments" role="tab" aria-controls="instruments">strumenti</a>
                </div>
            </div><!-- end col md-3-->

            <div class="col-md-9">

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active usr" id="list-events" role="tabpanel" aria-labelledby="list-events-list"><!--user events tab-->

                        <div class="user-events">
                            <div class="user-events-heading">
                                PROSSIMI EVENTI:
                                <hr>
                                <br>
                            </div>



                            <div class="row">
                                @foreach($info["events"] as $event)


                                    <div class="col-xs-12 col-sm-6">
                                        <div class="testimonial testimonial-gruppo" data-slick-index="0">
                                            <p class="description-date">
                                                <i class="fa fa-calendar" aria-hidden="true"></i> {{$event["event"]["event_date"]}}
                                            </p>
                                            <div class="testimonial-title">
                                                {{$event["event"]["title"]}}
                                            </div>

                                            <p class="description">
                                                <br>
                                            <table style="width:100%">
                                                <tr>
                                                    <td class="description-location">
                                                        <i class="fa fa-map-marker" aria-hidden="true"></i> {{$event["event"]["place"]}}
                                                    </td>
                                                    <td class="description-ora-inizio">
                                                        <i class="fas fa-clock"></i> inizio: {{$event["event"]["start_hour"]}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="description-bandname">
                                                        <i class="fas fa-users"></i> {{$event["group"]["name"]}}
                                                    </td>
                                                    <td class="description-ora-fine">
                                                        <i class="fas fa-clock"></i> fine: {{$event["event"]["end_hour"]}}
                                                    </td>
                                                </tr>
                                            </table>

                                            <div>
                                                {{$event["event"]["description"]}}
                                            </div>
                                            </p>
                                            <div class="testimonial-content">
                                                <div class="pic">
                                                    <img src="{{ asset('storage/photos/g_photos/'.$event["g_photo"]->path) }}" class="" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                        </div>

                    </div><!--end user events tab-->


                    <div class="tab-pane fade usr" id="list-groups" role="tabpanel" aria-labelledby="list-groups-list"><!-- user groups tab-->
                        <a class="btn-edit" data-fancybox="create-group" data-src="#create-group">
                                <i class="fas fa-edit btns-controls"></i>
                        </a>

                        <input type="text" class="form-control" id="search-group">

                        <div style="height: 400px" id="map2"></div>


                        <div class="user-groups">
                            <div class="user-events-heading">
                                GRUPPI DI CUI FAI PARTE:
                                <hr>
                                <br>
                            </div>
                            <section id="portfolio">
                                <div class="container">
                                    <div class="row">

                                        @foreach($info["groups"] as $group)
                                            <div class="col-xs-12 col-sm-6 portfolio-item ">  <!-- inizio portfolio item-->
                                                <a class="portfolio-link" href="{{url('group/'.$group["group"]->id)}}">
                                                    <div class="portfolio-hover">
                                                        <div class="portfolio-hover-content">
                                                            <i class="fas fa-plus fa-3x"></i>
                                                        </div>
                                                    </div>
                                                    <div class="portfolio-image" style="background-image: url('{{ asset('storage/photos/g_photos/'.$group["g_photo"]["path"])}}')">
                                                    </div>
                                                </a>
                                                <div class="portfolio-caption">
                                                    <h4>{{$group["group"]["name"]}}</h4>
                                                    <p >
                                                        @foreach($group["genres"] as $genre)
                                                            <span class="badge badge-primary">{{$genre->name}}</span>
                                                        @endforeach
                                                    </p>
                                                </div>
                                            </div><!-- fine portfolio item-->
                                        @endforeach

                                    </div>
                                </div>
                            </section>
                        </div>
                    </div><!-- end user groups tab-->



                    <div class="tab-pane fade usr" id="list-instruments" role="tabpanel" aria-labelledby="list-instruments-list"><!--user instrument tab-->
                        <div class="user-instruments">
                            <div class="user-events-heading">
                                INFO STRUMENTI:
                                <hr>
                                <br>
                            </div>

                            <!-- form modifica o inserisci strumentis -->
                            <form id="add-instrument" action="" method="post"
                                  style="display:none; width: 90%; max-width: 660px;margin-left:-5%;" class="fancybox-content">
                                <h2 class="mb-3">
                                </h2>
                                <p>

                                </p>
                                <p>

                                <div class="form-group">


                                    <select class="form-control" name="name[]" id="name">
                                        @foreach(\App\Instrument::all() as $instrument)
                                            <option>{{$instrument->name}}</option>
                                        @endforeach
                                    </select>

                                    <br>
                                    <label for="intrument-comment">commento:</label>
                                    <textarea class="form-control" rows="5" id="intrument-comment" name="intrument-comment"></textarea>

                                </div>

                                </p>
                                <p class="mb-0 text-right">
                                    <input data-fancybox-close="" type="button" class="btn btn-primary" value="Submit">
                                </p>
                                <button type="button" data-fancybox-close="" class="fancybox-button fancybox-close-small" title="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
                                        <path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path>
                                    </svg>
                                </button>
                            </form>

                            <form id="edit-instrument" action="" method="post"
                                  style="display:none; width: 90%; max-width: 660px;margin-left:-5%;" class="fancybox-content">
                                <h2 class="mb-3">
                                </h2>
                                <p>

                                </p>
                                <p>

                                <div class="form-group">

                                    <input type="hidden" id="instrument-id-edit" name="instrument-id">


                                    <select class="form-control" name="name[]" id="name">
                                        <option>ciaoo</option>
                                        <option>sadsadsa</option>
                                    </select>

                                    <br>
                                    <label for="intrument-comment">commento:</label>
                                    <textarea class="form-control" rows="5" id="intrument-comment" name="intrument-comment"></textarea>

                                </div>

                                </p>
                                <p class="mb-0 text-right">
                                    <input data-fancybox-close="" type="button" class="btn btn-primary" value="Submit">
                                </p>
                                <button type="button" data-fancybox-close="" class="fancybox-button fancybox-close-small" title="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
                                        <path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path>
                                    </svg>
                                </button>
                            </form>


                            <a  data-fancybox="add-instrument" data-src="#add-instrument">
                                <button type="button" class="btn btn-primary btn-circle float-right">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </a>


                            <br>
                            <br>

                            @foreach($info["instruments"] as $instrument)
                                <div class="card" id="cardIdchesara2o3o4o213">
                                    <div class="card-header">
                                        {{$instrument["instrument"]->name}}


                                        <a class="float-right btn-edit" data-fancybox="edit-instrument" data-src="#edit-instrument" style="color:gray">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <!--<button type="button" class="btn btn-outline-info float-right btn-edit">edit</button>-->
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>{{$instrument["instrument_info"]->note}}</p>
                                            <footer class="blockquote-footer">
                                                @foreach($instrument["instrument_genres"] as $gen)
                                                    <a href="#" class="badge badge-primary">{{$gen->name}}</a>
                                                @endforeach
                                            </footer>
                                        </blockquote>
                                    </div>
                                </div>
                            @endforeach





                    </div><!-- end user instrument tab-->

                </div>





            </div>


        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&libraries=places"></script>
@endsection

@section('styles')
    body{
        background-color: #F1F3FA;
    }
    .tab-pane{
        background-color: #F1F3FA;
    }
    .swal2-container {
        z-index: 999999999999  !important;
    }
    .pac-container {
        z-index: 999999 !important;
    }

    /*quello sotto è per l'infowindow che senno veniva con le scropl bar laterali e sopra*/
    .gm-style-iw {
      width: 200px; 
      min-height: 200px;
      height:300px;
      min-width:200px;
    }



@endsection


@section('scripts')
    //il js lo metto qui e non inu script apparte perche mi serve di sapere quando l'user è autenticato o no


    //click delete image
    @if(\Auth::check() && \Auth::user()->id == $info["user"]["id"]) //chi sta navigando la pagina è loggato con quell'account
        $(document).ready(function(){
            initAutocomplete();
            initAutocomplete2();
            mappa();
            displayGroups(groups);
            //centerView();//centra la view in modo che lo zoom della mappa prenda tutti i marker

        });



        //GLI SVG PRENDILI DA https://iconmonstr.com/
        $.fancybox.defaults.btnTpl.delete = '<button data-fancybox-delete class="fancybox-button fancybox-button--delete" title="rimuovi imamgine">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">' +
                '<path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-12v-2h12v2z"/>' +
                '</svg>' +
            '</button>';


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
                        path:pathImage
                    }
                    $.ajax({
                        url: "{{route('deleteImageUser')}}",
                        data: campi,
                        type: 'POST',
                        dataType: "json",
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
                    console.log(index);
                    //location.reload();
                }
            })
        });

        //click add image
        $('body').on('click', '#btn-add-image-user', async function() {
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

                            $.ajax({
                                url: "{{route('addImageUser')}}",
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
        $( '[data-fancybox="profile"]' ).fancybox({
			buttons : [
				'delete',
				'close'
			]
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

        function initAutocomplete2(){
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete-register-group')),
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




        


        var map;
        var markersArray=[];
        var group_search_result=[];
        var current_infowindow=null;

        var groups=@json($info["allgroups"]);
        //console.log(groups);


        function mappa(){  //crea la mappa su coordinate dell'Italia
            var myLatLng = {lat: 42.504154, lng: 12.646361};
            map = new google.maps.Map(document.getElementById('map2'), {
                zoom: 5,
                center: myLatLng
            });    
        }

        //groups è un oggetto formato da ["group"=>objgruppo,"photo"=>objfotogruppo]

        $('#search-group').keyup(function(){
            var query=$('#search-group').val();
            if(query == ""){
                clearGroupsMarkers();//prima si tolgono tutti
                displayGroups(groups);//poi si aggiungono tutti
                centerView();
                return;
            }
            group_search_result = [];
            for(var index = 0; index < groups.length; index++){
                if(groups[index]["group"]["name"].search(query) == 0){
                    group_search_result.push(groups[index]);
                }
            }

            clearGroupsMarkers();
            displayGroups(group_search_result);
            centerView();
        });


        function displayGroups(groups){
            groups.forEach(function(entry){

                var gruppo=entry["group"];

                var latlng={
                    lat: Number(gruppo["lat"]),
                    lng: Number(gruppo["lng"])
                };
                var marker=new google.maps.Marker({
                    position: latlng,
                    map: map,
                    icon: '../photos/static/red-nodot.png',
                });
                markersArray.push(marker);


                var url="../group/"+gruppo["id"];
                var photo_path = entry["photo"] == null? '../photos/static/user-default.png' : '../storage/photos/g_photos/'+entry["photo"]["path"];
                
                var contentString = "<div class='infow-evnts'>"+
                                    "   <div class='infow-evnts-title'>"+gruppo["name"]+"<hr>"+
                                    "   </div>"+
                                    "   <a href='"+url+"'>"+
                                    "       <div class='infow-groups-desc' >"+
                                    "           <img src='"+photo_path+"'></img>"+
                                    "       </div>"+
                                    "   </a>"+
                                    "   <div class='infow-events-footer'>"+
                                    "       <hr>"+
                                    "       <p class='infow-events-group'>"+
                                    "           <i class='fas fa-users'></i> nirvana"+
                                    "       </p>"+
                                    "   </div>"+
                                    
                                    "</div>";
                    
                var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });


                    var clicked=false;

                    google.maps.event.addListener(marker,'mouseover', function() {
                        infowindow.open(map, marker);
                    });
                    google.maps.event.addListener(marker, 'click', function () {
                        if(current_infowindow)
                            current_infowindow.close();
                        infowindow.open(map, marker);
                        current_infowindow=infowindow;
                        clicked=true;
                    });
                    //qua sotto ho aggiunto l'evento per qunado NB *infoindow* viene chiuso con la (x) (della GUI)  ==>l'ho fatto perche ogni tanto senno si buggava e il clicked rimaneva sempre a true poi
                    google.maps.event.addListener(infowindow,'closeclick',function(){
                        clicked=false;
                        //console.log(clicked);
                    });
                    google.maps.event.addListener(marker,'mouseout', function() {
                        //console.log(clicked);
                        if(!clicked)
                            infowindow.close();
                    });

                });
        }


        function clearGroupsMarkers() {
              for (var i = 0; i < markersArray.length; i++ ) {
                markersArray[i].setMap(null);
              }
              markersArray.length = 0;
        }


        function centerView(){
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < markersArray.length; i++) {
             bounds.extend(markersArray[i].getPosition());
            }

            map.fitBounds(bounds);
        }


    @else
        console.log("no un tu sei te");
    @endif
@endsection
