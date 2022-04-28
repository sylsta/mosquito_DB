<!-- Content Wrapper. Contains page content -->
<?php
	$sesja = $_SESSION['session'];
	$zapytanie = mysql_query("SELECT * FROM ind_observations WHERE session='$sesja'");
	$row = mysql_fetch_array($zapytanie);
	$data = date('Y-m-d H:i:s');
	$lista_con = '';
	$suma_con = 0;
	$zapytanie_con = mysql_query("SELECT ind_containers.container_infected,ind_containers_type.container_type,ind_containers.type_loc FROM ind_containers INNER JOIN ind_containers_type ON ind_containers.container_type_id=ind_containers_type.id WHERE ind_containers.session='$sesja' ORDER BY ind_containers.container_type_id");
	while ($row_con = mysql_fetch_array($zapytanie_con)) {
		if ($row_con['container_infected']> 0) {$lista_con = $lista_con.' '.$row_con['container_type'].' ('.$row_con['container_infected'].' '.$row_con['type_loc'].'), ';};
		$suma_con = $suma_con + $row_con['container_infected'];
	};
											
	$row_con = mysql_fetch_array($zapytanie_con);
	
	echo('
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Mosquitoes</h3><br />
					</div>
					<div class="box-body">
						<form action="index.php" id="nowy" method="POST">
							<input type="hidden" name="czynnosc" value="dodaj_komary" />
							<input type="hidden" name="id_observations" value="'.$row['id'].'" />
							<input type="hidden" id="klik" name="klik" value="0" />

							<div class="form-group">
								<label for="address">Address</label>
								<input class="form-control" name="address" id="address" readonly="readonly" value="'.$row['address'].'" type="text">
							</div>
							
							<div class="form-group">
								<label for="date">Infected containers</label>
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											Containers: <input class="form-control" name="suminf" id="suminf" readonly="readonly" value="'.$lista_con.'" type="text">
										</div>
									</div>
									<div class="col-sm-1">
										<div class="form-group">
											All: <input class="form-control" name="suminf_all" id="suminf_all" readonly="readonly" value="'.$suma_con.'" type="text">
										</div>
									</div>
									<div class="col-sm-1">
										<div class="form-group">
											Left: <input class="form-control" name="suminf_left" id="suminf_left" readonly="readonly" value="'.$suma_con.'" type="text">
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">

								  <div class="box">
									<div class="box-body">
									  <table class="table table-bordered" id="lista">
										<tbody><tr>
										  <th>Batch ID</th>
										  <th style="width: 15%">Count of mosquitoes in batch</th>
										  <th style="width: 15%">Age</th>
										  <th style="width: 15%">Location</th>
										  <th style="width: 15%">Type of container</th>
										  <th style="width: 10%">Action</th>
										</tr>
										
										<tr>
										  <td>
											<input name="name_batch" id="name_batch" class="form-control required" readonly="readonly" value="'.$_SESSION['valida'].'_O'.$row['id'].'_B1" type="text">
										  </td>
										  <td>
												<input name="count_batch" id="count_batch" class="form-control required numbersOnly" value="" type="text">
										  </td>
										  <td>
												<select name="age_batch" id="age_batch" class="form-control">
													<option value="">-- select --</option>
													<option value="adult">adult</option>
													<option value="larvae">larvae</option>
												</select>
										  </td>
										  <td>
												<select name="loc_batch" id="loc_batch" class="form-control">
													<option value="">-- select --</option>
													<option value="inside">inside</option>
													<option value="outside">outside</option>
												</select>
										  </td>
										  <td>
												<select name="cont_batch" id="cont_batch" class="form-control">
													<option value="">-- select --</option>');
												
													$zapytanie_rodzaje = mysql_query("SELECT * FROM ind_containers_type ORDER BY container_type");
													while ($row_rodzaje = mysql_fetch_array($zapytanie_rodzaje)) {
														echo('<option data-value="'.$row_rodzaje['id'].'" value="'.$row_rodzaje['container_type'].'">'.$row_rodzaje['container_type'].'</option>');	
													};
												
												echo('
												</select>
												
										  </td>
										  <td>
												<span class="input-group-btn" style="float: left;"><button type="button" class="dodaj_batch btn btn-success btn-flat">Add batch</button></span>
										  </td>
										</tr>
										
									  </tbody></table>
									</div>
									<!-- /.box-body -->
								  </div>
								  <!-- /.box -->
							</div>

							<div class="form-group">
								<div class="box-footer pull-right">
									<button type="submit" class="btn btn-info nextbtn">Next step</button>
								</div>
							</div>
						</form>
						<form action="index.php" id="nowy" method="POST">
							<input type="hidden" name="czynnosc" value="anuluj" />
							
							<div class="form-group">
								<div class="box-footer pull-right">
									<button type="submit" class="btn btn-danger del">Cancel</button>
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
	
	$(".nextbtn").click(function(){
		var numItems = $('.larvae').length;
		var limItems = $('#suminf_all').val();
		if (limItems - numItems != 0){
			alert('You added incorrect number of batches');
			return false;
		}
	});

	var klik = 1;
	$("#lista").on("click", ".dodaj_batch", function() {
		klik = klik + 1;
		var name_batch = $("#name_batch").val();
		var name_batch_array = name_batch.split('_');
		var age_batch = $("#age_batch").val();
		var count_batch = $("#count_batch").val();
		var loc_batch = $("#loc_batch").val();
		var cont_batch = $("#cont_batch").val();
		var cont_batch_data = $('option:selected', "#cont_batch").attr('data-value');
		if ((name_batch != '') && (age_batch != '') && (loc_batch != '') && (count_batch != '') && (age_batch == 'adult')) {
			$("#lista").append('<tr><td><input name="name_batch_'+klik+'" class="form-control" readonly="readonly" value="'+name_batch+'" type="text"></td><td><input name="count_batch_'+klik+'" class="form-control" readonly="readonly" value="'+count_batch+'" type="text"></td><td><input name="age_batch_'+klik+'" class="form-control '+age_batch+'" readonly="readonly" value="'+age_batch+'" type="text"></td><td><input name="loc_batch_'+klik+'" class="form-control" readonly="readonly" value="'+loc_batch+'" type="text"></td><td><input name="cont_batch_'+klik+'" class="form-control" readonly="readonly" value="'+cont_batch+'" type="text"><input type="hidden" name="cont_batch_data_'+klik+'" value="'+cont_batch_data+'" /></td><td><span class="input-group-btn" style="float: left;"><button type="button" class="usun_batch btn btn-danger del btn-flat">Delete batch</button></span></td></tr>');
		} else if ((name_batch != '') && (age_batch != '') && (loc_batch != '') && (count_batch != '') && (age_batch == 'larvae') && (cont_batch != '')) {
			$("#lista").append('<tr><td><input name="name_batch_'+klik+'" class="form-control" readonly="readonly" value="'+name_batch+'" type="text"></td><td><input name="count_batch_'+klik+'" class="form-control" readonly="readonly" value="'+count_batch+'" type="text"></td><td><input name="age_batch_'+klik+'" class="form-control '+age_batch+'" readonly="readonly" value="'+age_batch+'" type="text"></td><td><input name="loc_batch_'+klik+'" class="form-control" readonly="readonly" value="'+loc_batch+'" type="text"></td><td><input name="cont_batch_'+klik+'" class="form-control" readonly="readonly" value="'+cont_batch+'" type="text"><input type="hidden" name="cont_batch_data_'+klik+'" value="'+cont_batch_data+'" /></td><td><span class="input-group-btn" style="float: left;"><button type="button" class="usun_batch btn btn-danger del btn-flat">Delete batch</button></span></td></tr>');
		} else {
			alert('One of fields is empty');
		};
		$("#age_batch").val('');
		$("#count_batch").val('');
		$("#loc_batch").val('');
		$("#cont_batch").val('');
		$("#klik").val(klik);
		$("#name_batch").val(name_batch_array[0]+"_"+name_batch_array[1]+"_B"+klik);
		$("#cont_batch").css("display","inline");
		
		var numItems = $('.larvae').length;
		var limItems = $('#suminf_all').val();
		var pozostalo = limItems - numItems;
		$('#suminf_left').val(pozostalo);
	});
	
	$("#age_batch").change(function() {
		var age_batch = $("#age_batch").val();
		if (age_batch == 'adult') {$("#cont_batch").css("display","none");};
		if (age_batch == 'larvae') {$("#cont_batch").css("display","inline");};
	});
	
	$("#lista").on("click", ".usun_batch", function() {
	  $(this).parent().parent().parent().remove();
	  $("#klik").val(klik);
	  
	  var numItems = $('.larvae').length;
	  var limItems = $('#suminf_all').val();
	  var pozostalo = limItems - numItems;
	  $('#suminf_left').val(pozostalo);
	});
});
</script>