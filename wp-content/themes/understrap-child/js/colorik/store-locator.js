//-------------------------------------
//-- Common - Fonts
//-------------------------------------

function initMap() {

	var style = [
		{
			"stylers": [
				{"saturation": -100},
				{"lightness": 20},
				{"gamma": 0.83}
			]
		},
		{
			"featureType": "poi",
			"stylers": [
				{
					"visibility": "off"
				}
			]
		}
	];

	var map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: -33.8688, lng: 151.2195},
		zoom: 13,
		styles: style,
		mapTypeControl: false,
		scrollwheel: false,
		streetViewControl: false
	});

	var input = document.getElementById('pac-input');

	var bounds = new google.maps.LatLngBounds();

	var types = document.getElementById('type-selector');
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.bindTo('bounds', map);

	// Multiple Markers
	var markers = [];
	var infoWindowContent = [];

	jQuery('#locations-map .locations div.location').each(function(){
		if (jQuery(this).data('lat') && jQuery(this).data('lng')) {
			markers[jQuery(this).index()] = [jQuery(this).data('name'), jQuery(this).data('lat'),jQuery(this).data('lng'),17];
			infoWindowContent[jQuery(this).index()] = [
				'<div class="info_content">' +
					jQuery(this).html() +
				'</div>'
			];
		}
	});

    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
	var infowindowInitial = new google.maps.InfoWindow();

	var marker = new google.maps.Marker({
		map: map,
		anchorPoint: new google.maps.Point(0, -29)
	});

	var locations = new Object();

	placeLocations();
	geolocatize();
	autocomplete.addListener('place_changed', autocompleteChanged);

	// Try HTML5 geolocation.
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var pos = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};

			infoWindow.setPosition(pos);
			infoWindow.setContent('Location found.');
			map.setCenter(pos);
		}, function() {
			handleLocationError(true, infoWindow, map.getCenter());
		});
	} else {
		// Browser doesn't support Geolocation
		handleLocationError(false, infoWindow, map.getCenter());
	}

	function autocompleteChanged() {

		infowindowInitial.close();
		marker.setVisible(false);
		var place = autocomplete.getPlace();

		if (!place.geometry) {
			window.alert("You most select a valid address from the suggestion box");
			return;
		}

		var location = findClosestLocations(
			place.geometry.location.lat(),
			place.geometry.location.lng()
		);

		var locationPosition = new google.maps.LatLng(
			location.data('lat'),
			location.data('lng')
		);

		marker.setPosition(place.geometry.location);
		marker.setVisible(true);

		showCurrentPosition(marker);
		fitBounds(place.geometry.location, locationPosition);
		showLocationInSidebar(location.data('id'));

		var latAddress = place.geometry.location.lat();
		var lngAddress = place.geometry.location.lng();

		jQuery('.location').each(function() {
			var latDist = parseFloat(jQuery(this).data('lat'));
			var lngDist = parseFloat(jQuery(this).data('lng'));
			var p1 = new google.maps.LatLng(latDist, lngDist);
			var p2 = new google.maps.LatLng(latAddress, lngAddress);
			var $this = this;

			var service = new google.maps.DistanceMatrixService();
			service.getDistanceMatrix(
			{
				origins: [p1],
				destinations: [p2],
				travelMode: google.maps.TravelMode.DRIVING,
				unitSystem: google.maps.UnitSystem.IMPERIAL,
				avoidHighways: false,
				avoidTolls: false,
			}, callback);

			function callback(response, status) {
				if (status != google.maps.DistanceMatrixStatus.OK) {
					jQuery($this).find('span:first').html(err);
				} else {
					if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
						jQuery($this).find('span:first').html("There are no roads between you and destination");
					} else {
						var distance = response.rows[0].elements[0].distance;
						var distance_value = distance.value;
						var distance_text = distance.text;
						var miles = distance_text.substring(0, distance_text.length - 3);
						var kilometers = (distance_value / 1610.316455696203).toFixed(1);
						jQuery($this).find('span:first').html('<i class="fa fa-car"></i> ' + kilometers + 'km');
					}
				}
			}
		});

	}

	function geolocatize() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var location = findClosestLocations(
					position.coords.latitude,
					position.coords.longitude
				);

				var positionGoogle = new google.maps.LatLng(
					position.coords.latitude,
					position.coords.longitude
				);

				var locationPosition = new google.maps.LatLng(
					location.data('lat'),
					location.data('lng')
				);

				marker.setPosition(positionGoogle);
				marker.setVisible(true);

				showCurrentPosition(marker);
				fitBounds(positionGoogle, locationPosition);
				showLocationInSidebar(location.data('id'));

				var latAddress = position.coords.latitude;
				var lngAddress = position.coords.longitude;

				var R = 6371000; // metres

				var lat = location.data('lat');
				var lng = location.data('lng');

				lat = parseFloat(lat);
				lng = parseFloat(lng);

				var location;
				var minDistance = 0;

				jQuery('.location').each(function() {
					var latDist = parseFloat(jQuery(this).data('lat'));
					var lngDist = parseFloat(jQuery(this).data('lng'));
					var p1 = new google.maps.LatLng(latDist, lngDist);
					var p2 = new google.maps.LatLng(latAddress, lngAddress);
					var $this = this;

					var service = new google.maps.DistanceMatrixService();
					service.getDistanceMatrix(
					{
						origins: [p1],
						destinations: [p2],
						travelMode: google.maps.TravelMode.DRIVING,
						unitSystem: google.maps.UnitSystem.IMPERIAL,
						avoidHighways: false,
						avoidTolls: false,
					}, callback);

					function callback(response, status) {
						if (status != google.maps.DistanceMatrixStatus.OK) {
							jQuery($this).find('span:first').html(err);
						} else {
							if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
								jQuery($this).find('span:first').html("There are no roads between you and destination");
							} else {
								var distance = response.rows[0].elements[0].distance;
								var distance_value = distance.value;
								var distance_text = distance.text;
								var miles = distance_text.substring(0, distance_text.length - 3);
								var kilometers = (distance_value / 1610.316455696203).toFixed(1);
								jQuery($this).find('span:first').html('<i class="fa fa-car"></i> ' + kilometers + 'km');
							}
						}
					}
				});

			}, function() {

			});
		}
	}

	function showCurrentPosition(marker) {
		infowindowInitial.setContent('<strong>You are here</strong>');
		infowindowInitial.open(map, marker);
	}

	function fitBounds(point1, point2) {
		bounds = new google.maps.LatLngBounds();

		bounds.extend(point1);
		bounds.extend(point2);

		map.fitBounds(bounds);
	}

	function findClosestLocations(lat, lng) {
		var R = 6371000; // metres

		lat = parseFloat(lat);
		lng = parseFloat(lng);

		var location;
		var minDistance = 0;

		jQuery('.location').each(function() {
			var latDist = parseFloat(jQuery(this).data('lat'));
			var lngDist = parseFloat(jQuery(this).data('lng'));

			var φ1 = lat * Math.PI / 180;
			var φ2 = latDist * Math.PI / 180;
			var Δφ = (latDist-lat) * Math.PI / 180;
			var Δλ = (lngDist-lng) * Math.PI / 180;

			var a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
		        Math.cos(φ1) * Math.cos(φ2) *
		        Math.sin(Δλ/2) * Math.sin(Δλ/2);
			var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

			var d = R * c;

			if (minDistance === 0) {
				minDistance = d;
				location = jQuery(this);
			} else if (minDistance > d) {
				minDistance = d;
				location = jQuery(this);
				jQuery('.location').removeClass('selected-location');
				jQuery(this).addClass('selected-location');
			}
		});

		return location;
	}

	function placeLocations() {

		// Loop through our array of markers & place each one on the map
		for( i = 0; i < markers.length; i++ ) {
			var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
			bounds.extend(position);
			marker = new google.maps.Marker({
				position: position,
				map: map,
				title: markers[i][0],
				icon: window.location.protocol + "//" + window.location.host + "/" + 'blank-theme/wp-content/themes/understrap-child/src/img/map-marker.png'
			});

			google.maps.event.addListener(infoWindow, 'domready', function() {
				var iwOuter = jQuery('.gm-style-iw');
				var iwCloseBtn = iwOuter.next();
				iwOuter.parent().find('div').css({
					'background': 'transparent'
				});
				jQuery('.gm-style div div div div div div div div div').css({
					'background': 'black'
				});
				iwOuter.parent().css({
					'background': 'black',
					'border-radius': '0'
				});
				iwCloseBtn.css({
					'overflow': 'visible',
					'right': '10px'
				});
				iwCloseBtn.find('img').css({
					'width': '13px',
					'height': '13px',
					'top': '0',
					'left': '0'
				});
				iwCloseBtn.find('img').attr('src', 'https://www.orangetraffic.com/wp-content/themes/orangetraffic/assets/images/close-button.png');
			});

			google.maps.event.addListener(infowindowInitial, 'domready', function() {
				var iwOuter = jQuery('.gm-style-iw');
				var iwCloseBtn = iwOuter.next();
				iwOuter.css({
					'padding': '35px 20px 10px 25px',
					'min-width': 'auto'
				});
				iwOuter.parent().find('div').css({
					'background': 'transparent'
				});
				jQuery('.gm-style div div div div div div div div div').css({
					'background': 'black'
				});
				iwOuter.parent().css({
					'background': 'black',
					'border-radius': '0'
				});
				iwCloseBtn.css({
					'overflow': 'visible',
					'right': '10px'
				});
				iwCloseBtn.find('img').css({
					'width': '13px',
					'height': '13px',
					'top': '0',
					'left': '0'
				});
				iwCloseBtn.find('img').attr('src', 'https://www.orangetraffic.com/wp-content/themes/orangetraffic/assets/images/close-button.png');
			});

			// Allow each marker to have an info window
			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					infoWindow.setContent(infoWindowContent[i][0]);
					infoWindow.open(map, marker);
				}
			})(marker, i));

			// Automatically center the map fitting all markers on the screen
			map.fitBounds(bounds);

			jQuery( window ).resize(function() {
				map.fitBounds(bounds);
			});
		}

	}

	function showLocationInSidebar(id) {
		jQuery.each(locations, function(k, v) {
			if (k == id) {
				var location = jQuery('.location[data-id=' + k + ']');
				var position = location.position();

				v.setIcon({
					url: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|00FF00|000000'
				})

				location.addClass('highlight');
				jQuery('.locations').scrollTop(position.top);
			}
		});
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
			'Error: The Geolocation service failed.' :
			'Error: Your browser doesn\'t support geolocation.');
	}

}
