@extends('layouts.layout')

@section('title')
    Homestay
@endsection

@section('content')
    <header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url({{asset('images/img_bg_11.jpg')}})" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="gtco-container" style="margin-top: 10em;">
            <form action="/apartment" data-parsley-validate method="POST" id="apartment-adding-form">

                <div class="col-md-6">
                    <div
                          class="dropzone image-edit"
                          id="image-dropzone">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="lobster-font" style="color: #FBB448;">Information</h2>
                    <input type="text" name="user_id" id="user_id" class="hidden" value="{{Auth::user()->id}}">
                    <div class="form-group">
                        <label for="name" class="white">Name:</label>
                        <input type="text" class="form-control white" name="name" id="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="description"  class="white">Description:</label>
                        <textarea class="form-control white" rows="3" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start-date"  class="white">Start Date</label>
                        <input type="text"  name="available_from" id="start-date" class="form-control white" required>
                    </div>
                    <div class="form-group">
                        <label for="end-date"  class="white" >End Date</label>
                        <input type="text" name="available_to" id="end-date" class="form-control white" required>
                    </div>
                    <div class="form-group">
                        <label for="availableForm"  class="white">Available Form:</label>
                        <select class="form-control white" name="capacity_from" required>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description"  class="white">Available To:</label>
                        <select class="form-control white" name="capacity_to" required>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="c2"  class="white">Price</label>
                        <div class="input-group">
                            <span class="input-group-addon white" style="background-color: #4C443E;border: 1px solid #463D31;">$</span>
                            <input name="price" type="number" value="1000" min="0" step="0.01" required data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency white" id="c2" />
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <h2 class="lobster-font" style="color: #FBB448;">Address</h2>
                <div class="col-md-6 address ">

                    <div class="form-group">
                        <label for="city"  class="white">Select State:</label>
                        <select name="city" class="form-control white" required>
                            <option value="">--- Select City ---</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title"  class="white">Select District:</label>
                        <select name="district" class="form-control white" required>
                            <option value="">--- Select District ---</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title"  class="white">Select Province:</label>
                        <select name="province" class="form-control white" required>
                            <option value="">--- Select Province ---</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name" class="white">House Number:</label>
                        <input type="text" class="form-control white" required name="house-number" id="house-number" placeholder="House number">
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
            var imagesList = [];
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
                        imagesList.push(response.images);
                    });
                }
            };

            L.mapbox.accessToken = 'pk.eyJ1IjoiaGFpbmdvNjM5NCIsImEiOiJjaXJlZWU3aWIwMDNoZzVua2M5ZW1scjVkIn0.uHPNq72hOdL6D1OpeGlQow';
            var geojson = {
                "type": "FeatureCollection",
                "features": {}
            };
            var map = L.mapbox.map('map', 'mapbox.streets');

            map.setView([38.909671288923, -77.034084142948], 13);


            var address = '';
            var provinceE = $('select[name="province"]');
            var districtE = $('select[name="district"]');
            var cityE = $('select[name="city"]');
            var numberE = $('input[name="house-number"]');
            var location = [];
            numberE.on('change', function () {
                var province = provinceE.find('option:selected').attr("province");
                var district = districtE.find('option:selected').attr("district");
                var city = cityE.find('option:selected').attr("city");
                var number = numberE.val();
                var addr = number + province + district+city;
                var url =  "http://maps.google.com/maps/api/geocode/json?address="+addr+"&sensor=false"
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
                if(imagesList.length > 0){

                    apartmentRaw.images = imagesList[0];
                }
//                apartmentRaw.user_id = 1;
                apartmentRaw.lat = location[0];
                apartmentRaw.lng = location[1];



                var $createApartment = $.post(formSubmit.attr('action'), apartmentRaw);
                $createApartment.then(function (response) {
                    alert (response.message);
                    window.location.replace('/apartment/'+response.id);
                });

            });
        })();
    </script>
@stop
