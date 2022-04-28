<!-- Content Wrapper. Contains page content -->
<?php
	$sesja = $_SESSION['session'];
	$zapytanie = mysql_query("SELECT * FROM ind_observations WHERE session='$sesja'");
	$row = mysql_fetch_array($zapytanie);
	$data = date('Y-m-d H:i:s');
	echo('
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Containers</h3><br />
					</div>
					<div class="box-body">
						<form action="index.php" id="nowy" method="POST">
							<input type="hidden" name="czynnosc" value="dodaj_pojemniki" />
							<input type="hidden" name="id_observations" value="'.$row['id'].'" />
							<input type="hidden" name="mosquitoes" value="'.$row['mosquitoes'].'" />

							<div class="form-group">
								<label for="date">Address</label>
								<input class="form-control" name="date_start" id="date" readonly="readonly" value="'.$row['address'].'" type="text">
							</div>
							
							<div class="form-group">
								<label for="date">Containers inside</label>

								  <div class="box">
									<div class="box-body">
									  <table class="table table-bordered">
										<tbody><tr>
										  <th>Type</th>
										  <th style="width: 20%">Count of containers in this type</th>
										  <th style="width: 20%">Count of infected containers in this type</th>
										</tr>');
										
										$zapytanie_rodzaje = mysql_query("SELECT * FROM ind_containers_type ORDER BY container_type");
										while ($row_rodzaje = mysql_fetch_array($zapytanie_rodzaje)) {
											echo('
												<tr>
												  <td>
													'.$row_rodzaje['container_type'].'
												  </td>
												  <td>
														<input name="icon_c_'.$row_rodzaje['id'].'" data-con="icon_i_'.$row_rodzaje['id'].'" id="icon_c_'.$row_rodzaje['id'].'" class="form-control required numbersOnly zero_click" value="" placeholder="Count" type="text" required="required">
												  </td>
												  <td>
														<input name="icon_i_'.$row_rodzaje['id'].'" data-con="icon_c_'.$row_rodzaje['id'].'" id="icon_i_'.$row_rodzaje['id'].'"  class="form-control required numbersOnly container_click" value="" placeholder="Count" type="text" required="required">
												  </td>
												</tr>
											');
										};
										
										echo('
									  </tbody></table>
									</div>
									<!-- /.box-body -->
								  </div>
								  <!-- /.box -->
							</div>
							
							<div class="form-group">
								<label for="date">Containers outside</label>

								  <div class="box">
									<div class="box-body">
									  <table class="table table-bordered">
										<tbody><tr>
										  <th>Type</th>
										  <th style="width: 20%">Count of containers in this type</th>
										  <th style="width: 20%">Count of infected containers in this type</th>
										</tr>');
										
										$zapytanie_rodzaje = mysql_query("SELECT * FROM ind_containers_type ORDER BY container_type");
										while ($row_rodzaje = mysql_fetch_array($zapytanie_rodzaje)) {
											echo('
												<tr>
												  <td>'.$row_rodzaje['container_type'].'</td>
												  <td>
														<input name="ocon_c_'.$row_rodzaje['id'].'" data-con="ocon_i_'.$row_rodzaje['id'].'" id="ocon_c_'.$row_rodzaje['id'].'" class="form-control required numbersOnly zero_click" value="" placeholder="Count" type="text" required="required">
												  </td>
												  <td>
														<input name="ocon_i_'.$row_rodzaje['id'].'" data-con="ocon_c_'.$row_rodzaje['id'].'" id="ocon_i_'.$row_rodzaje['id'].'" class="form-control required numbersOnly container_click" value="" placeholder="Count" type="text" required="required">
												  </td>
												</tr>
											');
										};
										
										echo('
									  </tbody></table>
									</div>
									<!-- /.box-body -->
								  </div>
								  <!-- /.box -->
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
	$(function(){
		$(".container_click").change(function() {
			var data_con = $(this).attr('data-con');
			var con_val = $('#'+data_con).val();
			var curr_val = $(this).val();
			if (curr_val > con_val) {$(this).val("");};
		});
		
		$(".zero_click").change(function() {
			var data_con = $(this).attr('data-con');
			var curr_val = $(this).val();
			if (curr_val == 0) {$('#'+data_con).val("0");};
		});
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