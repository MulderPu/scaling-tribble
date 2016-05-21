@extends('app')

@section('content')

	<title>Trafficity</title>

	<div class="container">
		<div class="content">
			<div class="page-header">
				<h1>Welcome to Trafficity</h1>
			</div>
		</div>

		<!-- show map here -->
		<div id="map-canvas"></div>
	</div>

	<div class="container text-center">
		  <h1>Latest Statistic</h1>

		  <div class="col-sm-12">
			  <!-- show latest event reported  -->
			  @include('welcomeTable.table_latestevent')
		  </div>
		  <!-- end of col-sm-12 -->

		  <div class="col-sm-12">
			  <!-- show latest congestion detect -->
			  @include('welcomeTable.table_latestcongestion')
		  </div>
		  <!-- end of col-sm-12 -->

		  <!-- Another row -->
		  <div class="row">
		    <div class="col-sm-6">
				<!-- start of panel -->
				<div class = "page-header">
				    <h2>Today Road Events</h2>
				</div>

				<div class="panel panel-info">
				    <!-- Default panel contents -->
				    <div class="panel-heading">Total of Road Events Happened Today</div>
				    <div class="panel-body">
				        <p id="today_event" class="oblique"> {{$todayEvent}} </p>
				    </div>
				</div>
				<!-- end of panel -->
		    </div>

		    <div class="col-sm-6">
				<!-- start of the panel -->
				<div class = "page-header">
				    <h2>Today Road Congestions</h2>
				</div>

				<div class="panel panel-info">
				    <!-- Default panel contents -->
				    <div class="panel-heading"> Total of Road Congestion Happened Today</div>
				    <div class="panel-body">
				        <p id="today_congestion" class="oblique"> {{$todayCongestion}} </p>
				    </div>
				</div>
				<!-- end of panel -->
		    </div>
		  </div>
		  <!-- end row -->
	</div>
	<!-- end container -->

	<!-- js for map below-->
	<script type="text/javascript">
	function initMap(){
		//initialize Kuching location to set the position of the map
		var Kuching = {lat: 1.607681, lng: 110.378544};

		//store [type, lat, lng, time and date] from db into this array
		var locations = [
			@foreach($address as $add)
				[
					"{{ $add->type }}", //type of event
					"{{ $add->lat }}",	//latitude
					"{{ $add->lng }}",	//longitude
					"{{ $add->time_detected }}", //time detected
					"{{ $add->date_detected }}" //date detected
				],
			@endforeach
		];

		//store starting {lat, lng}  & ending {lat, lng} from db into this array
		var paths = [
			@foreach($paths as $path)
				[
					"{{ $path->start_lat }}", //starting point latitude
					"{{ $path->start_lng }}", //starting point longitude
					"{{ $path->end_lat }}",	  //ending point latitude
					"{{ $path->end_lng }}",	  //ending point longitude
					"{{ $path->path_id }}"
				],
			@endforeach
		];

		//store auto congestion detected time and date into this array from db
		var congestionDetected = [
			@foreach($congestionDates as $congestDate)
				[
					"{{ $congestDate->time_detected }}", //congestion time detected
					"{{ $congestDate->date_detected }}",	//congestion date detected
					"{{ $congestDate->path_id }}"
				],
			@endforeach
		];


		//init map
		var map = new google.maps.Map(document.getElementById('map-canvas'), {
		  zoom: 12,
		  center: Kuching,
		  scrollwheel: false,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		});

		//initialize variables
		var marker, i, j, k;

		//add markers to map through loop
		for (i = 0; i < locations.length; i++) {

			var markerDate = locations[i][4]; //store marker date detected into this var
			var markerTime = locations[i][3]; //store marker time detected into this var
			var currentDate = <?php echo json_encode($dateNow) ?>; //convert date for js
			var currentTime = <?php echo json_encode($timeNow) ?>; //convert time for js
			var convertedCurrentTime = timeString2ms(currentTime); //convert current time to millisec
			var convertedMarkerTime  = timeString2ms(markerTime); //convert marker time to millisec

			//make sure the marker only show on today's event and only alive for 20mins after occurred
			if (currentDate == markerDate){
				var resultMarkerTime = convertedCurrentTime - convertedMarkerTime;
				if(resultMarkerTime <= 1200000){
					//add marker
					marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map,
					draggable: false,
					title: locations[i][0],
					animation: google.maps.Animation.DROP
					});

					//initialize infowindow to show marker detail
					var infowindow = new google.maps.InfoWindow();

					//add information to marker infowindow so user can click and see
					google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
							var contentString = '<div id = "content">' +
												'<p>Type : ' + locations[i][0] + '</p>' +
												'<p>Time : ' + locations[i][3] + '</p>' +
												'<p>Date : ' + locations[i][4] + '</p>' +
												'</div>';
							infowindow.setContent(contentString); //show content of marker
							infowindow.open(map, marker);
						}
					})(marker, i));
				}
			}
		}

		//add congestion line through a loop
		for (j=0; j < congestionDetected.length; j++){
			//set variables
			var congestionDate = congestionDetected[j][1]; //store congestion date detected into var
			var congestionTime = congestionDetected[j][0]; //store congestion time detected into var
			var currentDate = <?php echo json_encode($dateNow) ?>; //convert date for js
			var currentTime = <?php echo json_encode($timeNow) ?>; //convert time for js
			var convertedCurrentTime = timeString2ms(currentTime); //convert current time to millisec
			var convertedCongestTime  = timeString2ms(congestionTime); //convert congestion time to millisec
			var congestionPathId = congestionDetected[j][2];

			if (currentDate == congestionDate){
				if(convertedCurrentTime - convertedCongestTime <= 1200000){
					for (k =0; k<paths.length; k++){
						var locationPathId = paths[k][4];

						if(congestionPathId == locationPathId){
							var startPoint 	= new google.maps.LatLng(paths[k][0], paths[k][1]); //store starting point
							var endPoint 	= new google.maps.LatLng(paths[k][2], paths[k][3]); //store ending point
							var myLine		= [startPoint, endPoint]; //store starting point and ending point to use in path of the line

							//add line
							var roadPath = new google.maps.Polyline({
							   path: myLine,
							   geodesic: true,
							   strokeColor: '#FF0000',
							   strokeOpacity: 1.0,
							   strokeWeight: 2
							});

							//set line on map
							roadPath.setMap(map);
						}
					}
				}
			}
		}

		//convert string time to millisec
		function timeString2ms(a,b){// time(HH:MM:SS.millisec)
			return a=a.split('.'), //split {HH:MM:SS} and {milliseconds}
			b=a[1]*1||0, // If input contains milliseconds, multiply one to avoid the slow parseInt, set b to the millisec else 0
			a=a[0].split(':'), //array store hours, minutes and seconds
			b+(a[2]?a[0]*3600+a[1]*60+a[2]*1:a[1]?a[0]*60+a[1]*1:a[0]*1)*1e3 // convert all to milliseconds
		}
	}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARKJBQkioS2IAjHo3rLZXotgPYqXrKS3o&callback=initMap"
	async defer></script>
	<script src="{{ asset('js/reload.js') }}"></script>

@endsection
