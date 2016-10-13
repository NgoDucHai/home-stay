;(function () {
	
	'use strict';

	$(function(){

		L.mapbox.accessToken = 'pk.eyJ1IjoiaGFpbmdvNjM5NCIsImEiOiJjaXJlZWU3aWIwMDNoZzVua2M5ZW1scjVkIn0.uHPNq72hOdL6D1OpeGlQow';
		var info = document.getElementById('info');
		var listAparment = $("div#listApartment").data('apartment');
		var listFeature = [];
		$.each(listAparment, function (i, val) {
			var obj = JSON.parse(val);
            var feature = {
				type: 'Feature',
				geometry: {
					type: 'Point',
					coordinates: [obj.location[0], obj.location[1]]
				},
				properties: {
					title: obj.name,
					description: obj.description,
                    image: obj.images,
                    owner: obj.owner.name,
                    price: obj.price,
                    id: i,
					'marker-color': '#548cba',
                    'marker-size': 'large',
                    'marker-symbol': 'warehouse'
				}
			};
			listFeature.push(feature);
		});
        var map = L.mapbox.map('map', 'mapbox.streets');
        var myLayer = L.mapbox.featureLayer().addTo(map);
        map.setView([listFeature[0].geometry.coordinates[1],listFeature[0].geometry.coordinates[0]], 6);
        map.addControl(L.mapbox.geocoderControl('mapbox.places', {
            autocomplete: true
        }));
		var geoJson = {
			type: 'FeatureCollection',
			features: listFeature
		};

		myLayer.setGeoJSON(geoJson);

// Listen for individual marker clicks.
		myLayer.on('click',function(e) {
			// Force the popup closed.
			e.layer.closePopup();
            map.panTo(e.layer.getLatLng());


			var feature = e.layer.feature;
            var slideshowContent = '';
            console.log(feature.properties);
            for(var i = 0; i < feature.properties.image.length; i++) {
                var img = feature.properties.image[i];

                slideshowContent += '<div class="image' + (i === 0 ? ' active' : '') + '">' +
                    '<img src="' + img + '" style="width: 200px"/>' +
                    '</div>';
            }
			var content = '<div class="thumbnail popup" id="' + feature.properties.id + '">'+
                '<div class="slideshow">' +
                    slideshowContent +
                '</div>' +
                '<div class="caption">'+
                '<h3>'+ feature.properties.title +'</h3>'+
                '<p style="color: #0b0b0b">'+feature.properties.description+'</p>'+
                '<p style="color: #0b0b0b">'+feature.properties.price+'</p>'+
                '<a href="#" class="btn btn-default" role="button">Detail</a></p>'+
                '</div>'+
                '<div class="cycle">' +
                '<a href="#" class="prev">&laquo; Previous</a>' +
                '<a href="#" class="next">Next &raquo;</a>' +
                '</div>'+
                '</div>';

			info.innerHTML = content;
		});

        $('#map').on('click', '.popup .cycle a', function() {
            var $slideshow = $('.slideshow'),
                $newSlide;

            if ($(this).hasClass('prev')) {
                $newSlide = $slideshow.find('.active').prev();
                if ($newSlide.index() < 0) {
                    $newSlide = $('.image').last();
                }
            } else {
                $newSlide = $slideshow.find('.active').next();
                if ($newSlide.index() < 0) {
                    $newSlide = $('.image').first();
                }
            }

            $slideshow.find('.active').removeClass('active').hide();
            $newSlide.addClass('active').show();
            return false;
        });

// Clear the tooltip when map is clicked.
		map.on('move', empty);

// Trigger empty contents when the script
// has loaded on the page.
		empty();

		function empty() {
			info.innerHTML = '<div><strong>Click a marker</strong></div>';
		}
	});


}());