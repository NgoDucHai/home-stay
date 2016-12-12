@extends('layouts.layout')

@section('title')
    Homestay
@endsection

@section('content')
    <header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url({{asset('images/img_bg_11.jpg')}})" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="gtco-container" style="margin-top: 10em;">
            <form action="/apartment/{{$apartmentDetail->id}}/edit" data-parsley-validate method="POST" id="apartment-adding-form"
                  data-apartment-lat="{{json_encode($apartmentDetail->location[0])}}"
                  data-apartment-lng="{{json_encode($apartmentDetail->location[1])}}"
                  data-apartment-images="{{json_encode($apartmentDetail->images)}}"
            >
                <div class="col-md-6">
                    <div class="ms-showcase2-template">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @foreach ($apartmentDetail->images as $k => $image)
                                        <div class="item @if($k == 0) active @endif">
                                            <img class="image-slide img-responsive image-edit " src="/upload/{{$image}}" alt="">
                                        </div>
                                @endforeach

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                        </a>
                            </div> <!-- Carousel -->

                        </div>
                    </div>
                    <br>
                    <div
                            class="dropzone image-edit"
                            id="image-dropzone">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="lobster-font" style="color: #FBB448;">Information</h2>
                    <input type="text" name="id" id="id" class="hidden" value="{{ $apartmentDetail->id }}">
                    <input type="text" name="user_id" id="user_id" class="hidden" value="{{Auth::user()->id}}">
                    <div class="form-group">
                        <label for="name" class="white">Name:</label>
                        <input type="text" class="form-control white" name="name" id="name" placeholder="Name" required value="{{ $apartmentDetail->name }}">
                    </div>
                    <div class="form-group">
                        <label for="description"  class="white">Description:</label>
                        <textarea class="form-control white" rows="5" name="description" required>{{ $apartmentDetail->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="start-date"  class="white">Start Date</label>
                        <input type="text"  name="available_from" id="start-date" class="form-control white" value="{{date('d/m/Y', strtotime($apartmentDetail->availabilities->from->date)) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="end-date"  class="white" >End Date</label>
                        <input type="text" name="available_to" id="end-date" class="form-control white" value="{{date('d/m/Y', strtotime($apartmentDetail->availabilities->to->date)) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="availableForm"  class="white">Available Form:</label>
                        <input type="number" class="form-control white" name="capacity_from" id="capacity_from" required value="{{ $apartmentDetail->capacities->from }}" min="0">
                    </div>
                    <div class="form-group">
                        <label for="description"  class="white">Available To:</label>
                        <input type="number" class="form-control white" name="capacity_to" id="capacity_to" required value="{{ $apartmentDetail->capacities->to }}" min="0">
                    </div>
                    <div class="form-group">
                        <label for="c2"  class="white">Price</label>
                        <div class="input-group">
                            <span class="input-group-addon white" style="background-color: #4C443E;border: 1px solid #463D31;">$</span>
                            <input name="price" type="number" value="10" min="0" step="0.01" required data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency white" id="c2" />
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <h2 class="lobster-font" style="color: #FBB448;padding-left: 15px;">Address</h2>
                <div class="col-md-6 address ">
                    <div class="form-group">
                        <label for="title"  class="white">Select City:</label>
                        <select name="city" class="form-control white" data-city="{{$apartmentDetail->city}}">
                            <option value="">--- Select City ---</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title"  class="white">Select District:</label>
                        <select name="district" class="form-control white" data-district="{{$apartmentDetail->district}}">
                            <option value="">--- Select District ---</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title"  class="white">Select Province:</label>
                        <select name="province" class="form-control white" data-province="{{$apartmentDetail->province}}">
                            <option value="">--- Select Province ---</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name" class="white">House Number:</label>
                        <input type="text" class="form-control white" name="house-number" id="house-number" placeholder="House number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div id='map' style="height: 300px;"></div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" id="submit-all" class="btn btn-primary btn-block">Submit</button>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </header>

@endsection
@section('scripts')
    <script>
        (function() {
            var address = '';
            var provinceE = $('select[name="province"]');
            var districtE = $('select[name="district"]');
            var cityE = $('select[name="city"]');
            var numberE = $('input[name="house-number"]');
            var location = [];
            var imagesList = JSON.parse($('#apartment-adding-form').attr('data-apartment-images'));
            var lat = $('#apartment-adding-form').attr('data-apartment-lat');
            var lng = $('#apartment-adding-form').attr('data-apartment-lng');
            Dropzone.options.imageDropzone = {
                url : '/dropzone/store',
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,
                acceptedFiles: ".jpg, .png",
                init: function () {
                    var wrapperThis = this;
                    this.on("addedfile", function (file) {
                        // Create the remove button
                        var removeButton = Dropzone.createElement("<button class='btn btn-xs btn-link'>Remove</button>");

                        // Listen to the click event
                        removeButton.addEventListener("click", function (e) {
                            // Make sure the button click doesn't submit the form:
                            e.preventDefault();
                            e.stopPropagation();

                            // Remove the file preview.
                            wrapperThis.removeFile(file);
                            // If you want to the delete the file on the server as well,
                            // you can do the AJAX request here.
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                    });

                    this.on('successmultiple', function(file, response) {
                        if(response.images.length > 0){
                            $.each(response.images, function ($k, $value) {
                                imagesList.push($value);
                            });
                        }
                        console.log(imagesList);
                    });
                }
            };

            L.mapbox.accessToken = 'pk.eyJ1IjoiaGFpbmdvNjM5NCIsImEiOiJjaXJlZWU3aWIwMDNoZzVua2M5ZW1scjVkIn0.uHPNq72hOdL6D1OpeGlQow';
            var features = [];
            var geojson = {
                "type": "FeatureCollection",
                "features": features
            };
            var map = L.mapbox.map('map', 'mapbox.streets');

            var addressS = {
                "type": "Feature",
                "geometry": {
                    "type": "Point",
                    "coordinates": [
                        lng,
                        lat
                    ]
                },
                "properties": {
                    "Full address": "",
                    "phone": "2022347336",
                    "address": "1471 P St NW",
                    "city": "Washington DC",
                    "country": "United States",
                    "crossStreet": "at 15th St NW",
                    "postalCode": "20005",
                    "state": "D.C."
                }
            };
            features.push(addressS);
            location = [lat,lng];
            var featureLayer = L.mapbox.featureLayer(geojson).addTo(map);
            map.setView([lat,lng], 13);




            numberE.on('change', function () {
                var province = provinceE.find('option:selected').attr("province");
                var district = districtE.find('option:selected').attr("district");
                var city = cityE.find('option:selected').attr("city");
                var number = numberE.val();
                var addr = number + province + district+city;
                var url =  "http://maps.google.com/maps/api/geocode/json?address="+addr+"&sensor=false";
                $.getJSON(url, function (data) {
                    var features = [];
                    for(var i=0;i<data.results.length;i++) {
                        var address = {
                            "type": "Feature",
                            "geometry": {
                                "type": "Point",
                                "coordinates": [
                                    data.results[i].geometry.location.lng,
                                    data.results[i].geometry.location.lat
                                ]
                            },
                            "properties": {
                                "Full address": data.results[i].formatted_address,
                                "phone": "2022347336",
                                "address": "1471 P St NW",
                                "city": "Washington DC",
                                "country": "United States",
                                "crossStreet": "at 15th St NW",
                                "postalCode": "20005",
                                "state": "D.C."
                            }
                        };
                        features.push(address);
                    }
                    var geojson = {
                                "type": "FeatureCollection",
                                "features": features
                            };
                    location = [data.results[0].geometry.location.lat,data.results[0].geometry.location.lng];
                    var featureLayer = L.mapbox.featureLayer(geojson).addTo(map);
                    map.setView([data.results[0].geometry.location.lat,data.results[0].geometry.location.lng], 13);

                });
            });
            var formSubmit = $('#apartment-adding-form');
            formSubmit.on('submit', function(event){
                event.preventDefault();
                var apartmentRaw = {};
                var a = formSubmit.serializeArray();
                $.each(a, function() {
                    if (apartmentRaw[this.name]) {
                        if (!apartmentRaw[this.name].push) {
                            apartmentRaw[this.name] = [apartmentRaw[this.name]];
                        }
                        apartmentRaw[this.name].push(this.value || '');
                    } else {
                        apartmentRaw[this.name] = this.value || '';
                    }
                });
                if(!apartmentRaw['city']){
                    apartmentRaw['city'] = cityE.attr('data-city');
                }
                if(!apartmentRaw['district']){
                    apartmentRaw['district'] = districtE.attr('data-district');
                }
                if(!apartmentRaw['province']){
                    apartmentRaw['province'] = provinceE.attr('data-province');
                }
                if(imagesList.length > 0){

                    apartmentRaw.images = imagesList;
                }
                apartmentRaw.lat = location[0];
                apartmentRaw.lng = location[1];



                var $createApartment = $.post(formSubmit.attr('action'), apartmentRaw);
                $createApartment.then(function (response) {
                    alert (response.message);
//                    window.location.replace('/apartment/'+response.id);
                });

            });
        })();
    </script>

@stop
