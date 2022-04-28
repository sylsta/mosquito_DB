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
						<h3 class="box-title">Summary</h3><br />
					</div>
					<div class="box-header">
						<form action="index.php" id="nowy" method="POST">
							<input type="hidden" name="czynnosc" value="anuluj" />
							
							<div class="form-group">
								<div class="box-footer pull-right">
									<button type="submit" class="btn btn-danger del">Log-out</button>
								</div>
							</div>
						</form>
					</div>
					<div class="box-body">
						<form action="index.php" id="nowy" method="POST">
							<div class="form-group">
								  <div class="box">
									<div class="box-body">
									  <table class="table table-bordered" id="lista">
										<tbody>
										<tr>
										  <th>Long</th>
										  <th>Lat</th>
										  <th>Year</th>
										  <th>Prov</th>
										  <th>Dis</th>
										  <th>Subdis</th>
										  <th>Point ID</th>
										  <th>Batch ID</th>
										  <th>Mosq ID</th>
										  <th>Genus</th>
										  <th>Species</th>
										  <th>Stage</th>
										  <th>Genotype</th>
										  <th>Mseq ID</th>
										  <th>Vir ID</th>
										  <th>Target</th>
										  <th>Hap</th>
										  <th>Vseq ID</th>
										  <th>Vcode</th>
										</tr>
										
										');
										
										$sesja = $_SESSION['session'];
										$zapytanie_rodzaje = mysql_query("SELECT ind_viruses.virus_code,ind_viruses.virus_sequence,ind_viruses.haplotype, ind_viruses_type.virus,ind_mosquitoes.mosquitoes_sequence,ind_mosquitoes.genotype,ind_mosquitoes.genus,ind_mosquitoes.species ,ind_mosquitoes.mosquitoes_code,ind_batches.batch_code,ind_batches.type_age,ind_observations.date_start, ind_points.verify_code,ind_points.x,ind_points.y,ind_points.level1,ind_points.level2,ind_points.level3,ind_points.level4 FROM ind_viruses INNER JOIN ind_viruses_type ON ind_viruses.type=ind_viruses_type.id INNER JOIN ind_mosquitoes ON ind_mosquitoes.id=ind_viruses.id_mosquitoes INNER JOIN ind_batches ON ind_mosquitoes.id_batch=ind_batches.id INNER JOIN ind_observations ON ind_batches.id_observation=ind_observations.id INNER JOIN ind_points ON ind_observations.id_points=ind_points.id ORDER BY ind_viruses.virus_code");
										while ($row_rodzaje = mysql_fetch_array($zapytanie_rodzaje)) {
											echo('
												<tr>
												  <td>'.$row_rodzaje['x'].'</td>
												  <td>'.$row_rodzaje['y'].'</td>
												  <td>'.substr($row_rodzaje['date_start'],0,4).'</td>
												  <td>'.$row_rodzaje['level4'].'</td>
												  <td>'.$row_rodzaje['level3'].'</td>
												  <td>'.$row_rodzaje['level2'].'</td>
												  <td>'.$row_rodzaje['verify_code'].'</td>
												  <td>'.$row_rodzaje['batch_code'].'</td>
												  <td>'.$row_rodzaje['mosquitoes_code'].'</td>
												  <td>'.$row_rodzaje['genus'].'</td>
												  <td>'.$row_rodzaje['species'].'</td>
												  <td>'.$row_rodzaje['type_age'].'</td>
												  <td>'.$row_rodzaje['genotype'].'</td>
												  <td>'.$row_rodzaje['mosquitoes_sequence'].'</td>
												  <td>'.$row_rodzaje['virus'].'</td>
												  <td>?</td>
												  <td>'.$row_rodzaje['haplotype'].'</td>
												  <td>'.$row_rodzaje['virus_sequence'].'</td>
												  <td>'.$row_rodzaje['virus_code'].'</td>
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
	$(".ifcheck").click(function(){
		var rows = $("#numinfected").val();
		var numberOfChecked = $('input:checkbox:checked').length;
		if (numberOfChecked < rows) {
			alert('Empty value in infected mosquitoes');
			return false;
		};
	});
	
	jQuery('.numbersOnly').keyup(function () { 
		this.value = this.value.replace(/[^0-9\-\.]/g,'');
	});
	
	$(".del").click(function(){
		if (!confirm("Do you want to log-out")){
			return false;
		}
	});
});
</script>