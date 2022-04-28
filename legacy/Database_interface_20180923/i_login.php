<body class="register-page" onload="geoloc()">
	<div class="register-box">
		<div class="register-box-body">
			<div class="box-body">
				<div class="box-group" id="accordion">
					
					<div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a class="collapsed" aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Log-in
                          </a>
                        </h4>
                      </div>
                      <div aria-expanded="true" id="collapseOne" class="panel-collapse collapse in">
                        <div class="box-body">
							<form action="index.php" method="post">
								<div class="form-group has-feedback">
									<input type="text" id="out" name="out" class="form-control" readonly="readonly" />
									<input type="text" name="code" class="form-control" placeholder="Insert OBJECT code" />
									<input type="hidden" name="czynnosc" value="zaloguj" />
									<input type="hidden" id="lat" name="lat" value="" />
									<input type="hidden" id="long" name="long" value="" />
								</div>
								<div class="form-group has-feedback">
									<input type="text" name="user" class="form-control" placeholder="Insert USER code" />
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
								<div class="form-group has-feedback">
									<select name="role" class="form-control" required="required">
										<option value="1">terrain</option>
										<option value="2">labratory - batch</option>
										<option value="3">labratory - virus</option>
										<option value="99">admin</option>
									</select>
								</div>
								
								<div class="col-xs-8">

								</div><!-- /.col -->
								<div class="col-xs-4">
									<button type="submit" class="btn btn-primary btn-block btn-flat">Go!</button>
								</div><!-- /.col -->
							</form>
							<br /><br />
							<!-- <div id='mapdiv'></div> -->
                        </div>
                      </div>
                    </div>

				</div>
			</div>
		</div>
	</div>

		<style>
#mapdiv {
	margin: 0;
	padding: 0;
	width: 100%;
	height: 200px;
}
</style>

    <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
<script>
	var watchId = null;
	function geoloc() {
	if (navigator.geolocation) {
		var optn = {
				enableHighAccuracy : true,
				timeout : Infinity,
				maximumAge : 0
		};
	watchId = navigator.geolocation.getCurrentPosition(showPosition, showError, optn);
	} else {
			alert('Geolocation is not supported in your browser');
	}
	}

function showPosition(position) {
		var output = document.getElementById("out");
		var pole_lat = document.getElementById("lat");
		var pole_long = document.getElementById("long");
	
		output.value = '' + position.coords.latitude + '; ' + position.coords.longitude + '';
		pole_lat.value = position.coords.latitude;
		pole_long.value = position.coords.longitude;
		
		var googlePos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		var mapOptions = {
			zoom : 16,
			center : googlePos,
			mapTypeId : google.maps.MapTypeId.ROADMAP
		};
		var mapObj = document.getElementById('mapdiv');
		var googleMap = new google.maps.Map(mapObj, mapOptions);
		var markerOpt = {
			map : googleMap,
			position : googlePos,
			title : 'Hi, I am here',
			animation : google.maps.Animation.DROP
		};
		var googleMarker = new google.maps.Marker(markerOpt);
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			'latLng' : googlePos
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
				if (results[1]) {
					var popOpts = {
						content : results[1].formatted_address,
						position : googlePos
					};
				var popup = new google.maps.InfoWindow(popOpts);
				google.maps.event.addListener(googleMarker, 'click', function() {
				popup.open(googleMap);
			});
				} else {
					alert('No results found');
				}
				} else {
					alert('Geocoder failed due to: ' + status);
				}
			});
			}
			
			function stopWatch() {
				if (watchId) {
					navigator.geolocation.clearWatch(watchId);
					watchId = null;

				}
			}

		function showError(error) {
		var err = document.getElementById('mapdiv');
		switch(error.code) {
		case error.PERMISSION_DENIED:
		err.innerHTML = "User denied the request for Geolocation."
		break;
		case error.POSITION_UNAVAILABLE:
		err.innerHTML = "Location information is unavailable."
		break;
		case error.TIMEOUT:
		err.innerHTML = "The request to get user location timed out."
		break;
		case error.UNKNOWN_ERROR:
		err.innerHTML = "An unknown error occurred."
		break;
		}
		}
		</script>
</body>