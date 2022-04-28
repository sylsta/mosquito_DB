<!-- Content Wrapper. Contains page content -->
<?php
	$login = $_SESSION['valida'];
	$zapytanie = mysql_query("SELECT * FROM ind_points WHERE verify_code='$login'");
	$row = mysql_fetch_array($zapytanie);
	$data = date('Y-m-d H:i:s');
	echo('
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Point Characteristic</h3><br />
					</div>
					<div class="box-body">
						<form action="index.php" id="nowy" method="POST">
							<input type="hidden" name="czynnosc" value="dodaj_punkt" />
							<input type="hidden" name="id_points" value="'.$row['id'].'" />
							<div class="form-group">
								<label for="date">Date</label>
								<input class="form-control" name="date_start" id="date" readonly="readonly" value="'.$data.'" type="text">
							</div>
							<div class="form-group">
								<label for="place">Place</label>
								<input class="form-control" name="latlong" id="place" readonly="readonly" value="Longitude: '.$row['x'].'; Latitude: '.$row['y'].'" type="text">
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input class="form-control" name="area" id="place" readonly="readonly" value="Area: '.$row['area_code'].'" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input class="form-control" name="city" id="place" readonly="readonly" value="City: '.$row['city'].'" type="text">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="date">Point</label>
								<input name="address" class="form-control required" value="" placeholder="Administrative Address" type="text" required="required">
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<div class="input-group" style="width:100%;">
											<div class="input-group-addon" style="width:50px;">
												°C
											</div>
											<input name="temperature" class="form-control required numbersOnly" maxlength="3" value="" placeholder="Temperature (Degree Celsius)" type="text" required="required">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-group" style="width:100%;">
											<div class="input-group-addon" style="width:50px;">
												%
											</div>
											<input name="humidity" class="form-control required numbersOnly" maxlength="3" value="" placeholder="Humidity (in percents)" type="text" required="required">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="place">Count</label>
								<input name="people" class="form-control required numbersOnly" maxlength="3" value="" placeholder="Number of people in house" type="text" required="required">
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<div class="input-group" style="width:100%;">
											<div class="input-group-addon" style="width:50px;">
												<i class="fa fa-sign-in"></i>
											</div>
											<input name="animals_inside" maxlength="3" class="form-control required numbersOnly" value="" placeholder="Number of animal inside" type="text" required="required">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-group" style="width:100%;">
											<div class="input-group-addon" style="width:50px;">
												<i class="fa fa-share-square-o"></i>
											</div>
											<input name="animals_outside" maxlength="3" class="form-control required numbersOnly" value="" placeholder="Number of animal outside" type="text" required="required">
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-sm-2">
										<div class="form-group">
											<label style="height: 30px;">backyard</label>
											<select name="backyard" class="form-control" id="backyard_click" required="required">
												<option value="">-- select --</option>
												<option value="0">no</option>
												<option value="1">yes</option>
											</select>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label style="height: 30px;">Garden in backyard</label>
											<select name="backyard_garden" class="form-control backyard" required="required">
												<option value="">-- select --</option>
												<option value="0">no</option>
												<option value="1">yes</option>
											</select>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label style="height: 30px;">Plant in backyard</label>
											<select name="backyard_plants" class="form-control backyard" required="required">
												<option value="">-- select --</option>
												<option value="0">no</option>
												<option value="1">yes</option>
											</select>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label style="height: 30px;">Plants minimum 3 m high in backyard</label>
											<select name="backyard_trees" class="form-control backyard" required="required">
												<option value="">-- select --</option>
												<option value="0">no</option>
												<option value="1">yes</option>
											</select>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label style="height: 30px;">Backyard with animals</label>
											<select name="backyard_animals" class="form-control backyard" required="required">
												<option value="">-- select --</option>
												<option value="0">no</option>
												<option value="1">yes</option>
											</select>
										</div>
									</div>
									<div class="col-sm-2">
										&nbsp;
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-2">
										<div class="form-group">
											<label style="height: 30px;">containers</label>
											<select name="containers" class="form-control" required="required">
												<option value="">-- select --</option>
												<option value="0">no</option>
												<option value="1">yes</option>
											</select>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group">
											<label style="height: 30px;">mosquitos</label>
											<select name="mosquitoes" class="form-control" required="required">
												<option value="">-- select --</option>
												<option value="0">no</option>
												<option value="1">yes</option>
											</select>
										</div>
									</div>
									<div class="col-sm-2">
										&nbsp;
									</div>
									<div class="col-sm-2">
										&nbsp;
									</div>
									<div class="col-sm-2">
										&nbsp;
									</div>
									<div class="col-sm-2">
										&nbsp;
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="box-footer pull-right">
									<button type="submit" class="btn btn-info">Next step</button>
								</div>
							</div>
						</form>
						<form action="index.php" id="nowy" method="POST">
							<input type="hidden" name="czynnosc" value="anuluj" />
							
							<div class="form-group">
								<div class="box-footer pull-right">
									<button type="submit" class="btn btn-danger del" >Cancel</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				');
				?>
			</div>
		</div><!-- /.row -->
	</section><!-- /.content -->
	
<!-- Page script -->
<script>
 $(function(){
	$("#backyard_click").change(function() {
		var backyard_click = $("#backyard_click").val();
		if (backyard_click == '0') {$(".backyard").val("0");};
		if ((backyard_click == '1') || (backyard_click == '')) {$(".backyard").val("");};
	});
	
	jQuery('.numbersOnly').keyup(function () { 
		this.value = this.value.replace(/[^0-9\-\.]/g,'');
	});
	
	$(".del").click(function(){
		if (!confirm("Do you want to cancel")){
			return false;
		}
	});
});
</script>