<!-- Content Wrapper. Contains page content -->
<?php
	$login = $_SESSION['valida'];
	$zapytanie = mysql_query("SELECT * FROM ind_batches WHERE batch_code='$login'");
	$row = mysql_fetch_array($zapytanie);
	$data = date('Y-m-d H:i:s');
	echo('
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Mosquito characteristics</h3><br />
					</div>
					<div class="box-body">
						<form action="index.php" id="nowy" method="POST">
							<input type="hidden" name="id_batch" value="'.$row['id'].'" />
							<input type="hidden" id="klik" name="klik" value="'.$row['mosquitoes_count_start'].'" />
							<div class="form-group">
								<label for="date">Batch</label>
								<input class="form-control" name="batch" id="batch" readonly="readonly" value="'.$_SESSION['valida'].'" type="text">
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-sm-2">
										<div class="form-group">
											<label style="height: 30px;">Number of mosquitoes in batch</label>
											<input name="mos_count" id="countmosq" class="form-control required numbersOnly countmosq" '); if ($row['mosquitoes_count_end'] != '') {echo('readonly="readonly" ');}; echo(' value="'.$row['mosquitoes_count_end'].'" placeholder="Count" type="text" required="required">
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
									<div class="col-sm-2">
										&nbsp;
									</div>
								</div>
							</div>
							
							<div class="form-group">

								  <div class="box">
									<div class="box-body">
									  <table class="table table-bordered" id="lista">
										<tbody><tr>
										  <th style="width: 20%">Mosquito ID</th>
										  <th>Genus</th>
										  <th>Species</th>
										  <th>Genotype</th>
										  <th>Mosquito sequence ID</th>
										  <th style="width: 10%">Infected</th>
										  <th style="width: 10%">Sex</th>
										  <th style="width: 10%">Action</th>
										</tr>
										
										');
										
										for ($i = 1; $i <= $row['mosquitoes_count_start']; $i++) {
											$mosquitoes_code = $_SESSION['valida'].'_M'.substr($row['type_age'],0,2).$i;
											$zapytanie_wartosci = mysql_query("SELECT * FROM ind_mosquitoes WHERE mosquitoes_code='$mosquitoes_code'");
											$row_wartości = mysql_fetch_array($zapytanie_wartosci);
											
											if ($row_wartości['error'] != '') {
												echo('
												<tr id="report_'.$i.'">
												  <td>
													<input name="mos_id_'.$i.'" id="mos_id_'.$i.'" class="form-control" readonly="readonly" value="'.$mosquitoes_code.'" type="text">
												  </td>
												  <td colspan="7"><input name="report_'.$i.'" class="form-control czypusty" value="'.$row_wartości['error'].'" placeholder="Describe error" type="text"></td>
												</tr>
												');
											} else {
											
													echo('
												<tr id="report_'.$i.'">
												  <td>
													<input name="mos_id_'.$i.'" id="mos_id_'.$i.'" class="form-control" readonly="readonly" value="'.$mosquitoes_code.'" type="text">
												  </td>
												  <td class="report_'.$i.'">
													<select name="mos_genus_'.$i.'" id="mos_genus_'.$i.'" class="form-control czypusty">
														<option value="">-- select --</option>
														');
												  
														  $zapytanie_rodzaje = mysql_query("SELECT * FROM ind_genus ORDER BY genus_name");
															while ($row_rodzaje = mysql_fetch_array($zapytanie_rodzaje)) {
																echo('
																	<option '); if ($row_wartości['genus']==$row_rodzaje['genus_name']) {echo(' selected="selected" ');}; echo(' value="'.$row_rodzaje['genus_name'].'">'.$row_rodzaje['genus_name'].'</option>
																');
															};
												  
													echo('
													</select>
												  </td>
												  <td class="report_'.$i.'">
													<select name="mos_species_'.$i.'" id="mos_species_'.$i.'" class="form-control czypusty">
														<option value="">-- select --</option>
														');
												  
														  $zapytanie_rodzaje = mysql_query("SELECT * FROM ind_species ORDER BY species_name");
															while ($row_rodzaje = mysql_fetch_array($zapytanie_rodzaje)) {
																echo('
																	<option '); if ($row_wartości['species']==$row_rodzaje['species_name']) {echo(' selected="selected" ');}; echo(' value="'.$row_rodzaje['species_name'].'">'.$row_rodzaje['species_name'].'</option>
																');
															};
												  
													echo('
													</select>
												  </td>
												  <td class="report_'.$i.'">
													<input name="mos_genotype_'.$i.'" id="mos_genotype_'.$i.'" class="form-control czypusty" value="'.$row_wartości['genotype'].'" type="text">
												  </td>
												  <td class="report_'.$i.'">
													<input name="mos_seqid_'.$i.'" id="mos_seqid_'.$i.'" class="form-control czypusty" value="'.$row_wartości['mosquitoes_sequence'].'" type="text">
												  </td>
												  <td class="report_'.$i.'">
														<select name="mos_infected_'.$i.'" id="mos_infected_'.$i.'" class="form-control czypusty">
															<option value="">-- select --</option>
															<option '); if ($row_wartości['infected']=='infected') {echo(' selected="selected" ');}; echo(' value="infected">infected</option>
															<option '); if ($row_wartości['infected']=='no infected') {echo(' selected="selected" ');}; echo(' value="no infected">no infected</option>
														</select>
												  </td>
												  <td class="report_'.$i.'">
												  ');
												  
												  if ($row['type_age'] == 'adult') {
													echo('
														<select name="mos_sex_'.$i.'" id="mos_sex_'.$i.'" class="form-control czypusty">
															<option value="">-- select --</option>
															<option '); if ($row_wartości['sex']=='male') {echo(' selected="selected" ');}; echo(' value="male">male</option>
															<option '); if ($row_wartości['sex']=='female') {echo(' selected="selected" ');}; echo(' value="female">female</option>
														</select>
													');

												  };
												  
												  echo('
												  </td>
												  <td class="report_'.$i.'">
														<span class="input-group-btn" style="float: left;"><button type="button" data-report="report_'.$i.'" class="raportuj btn btn-danger btn-flat">Report error</button></span>
												  </td>
												</tr>
												');
												
											};
											
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
									<button type="submit" name="czynnosc" value="dodaj_mosquitoes" class="btn btn-success finish">Complete</button>
								</div>
							</div>
							<div class="form-group">
								<div class="box-footer pull-right">
									<button type="submit" name="czynnosc" value="wstrzymaj_mosquitoes" class="btn btn-info notfinish">Standby (save incomplete and update later)</button>
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
	
	
	jQuery('.numbersOnly').keyup(function () { 
		this.value = this.value.replace(/[^0-9\-\.]/g,'');
	});
	
	$(".del").click(function(){
		if (!confirm("Do you want to cancel")){
			return false;
		}
	});
	
	$(".countmosq").change(function(){
		var klik = $("#klik").val();
		var valthis = $(this).val();
		if (valthis != klik) {
			if (!confirm("Are you sure?")){
				$(".countmosq").val("");
				return false;
			} else {
				$(".countmosq").attr("readonly", "readonly");
			};
		} else {
			$(".countmosq").attr("readonly", "readonly");
		};
	});
	
	$("#lista").on("click", ".raportuj", function() {
		var wiersz = $(this).attr('data-report');
		$("."+wiersz).remove();
		$( "<p>Test</p>" ).insertAfter( ".inner" );
		$("#"+wiersz).append('<td colspan="7"><input name="'+wiersz+'" class="form-control" value="" placeholder="Describe error" type="text"></td>');
		
	});
	
	$(".finish").click(function(){
		var czy_mozna_isc = 1;
		$(".czypusty").each(function(i) {
			if ($(this).val() == '') {czy_mozna_isc = 0;};
		});
		if (czy_mozna_isc == 0) {
			alert('One of fields is empty');
			return false;
		};
	});
	
	$(".notfinish").click(function(){
		var czy_mozna_isc = 1;
		$(".czypusty").each(function(i) {
			if ($(this).val() == '') {czy_mozna_isc = 0;};
		});
		if (czy_mozna_isc == 1) {
			alert('All of fields are completed');
			return false;
		};
	});
});
</script>