<!-- Content Wrapper. Contains page content -->
<?php
	$login = $_SESSION['valida'];
	$zapytanie_mosq = mysql_query("SELECT id FROM ind_mosquitoes WHERE mosquitoes_code='$login'");
	$row_mosq = mysql_fetch_array($zapytanie_mosq);

	echo('
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Mosquito infection</h3><br />
					</div>
					<div class="box-body">
						<form action="index.php" id="nowy" method="POST">
							<input type="hidden" name="czynnosc" value="dodaj_wirusy" />
							<input name="mosqid" value="'.$row_mosq['id'].'" type="hidden">
							<input name="batch" value="'.$row_mosq['id_batch'].'" type="hidden">
							<div class="form-group">

								  <div class="box">
									<div class="box-body">
									  <table class="table table-bordered" id="lista">
										<tbody><tr>
										  <th>Mosquito ID</th>
										  ');
										  
											$zapytanie_wirusy = mysql_query("SELECT * FROM ind_viruses_type ORDER BY id");
											while ($row_wirusy = mysql_fetch_array($zapytanie_wirusy)) {
												echo('<th style="width: 100px;">'.$row_wirusy['name'].'</th>');
											};

										  echo('
										</tr>
										<tr>
										  <td>
											<input name="mosquitoes_code" class="form-control" readonly="readonly" value="'.$login.'" type="text">
										  </td>
										  ');
										  
											$zapytanie_wirusy = mysql_query("SELECT * FROM ind_viruses_type ORDER BY id");
											while ($row_wirusy = mysql_fetch_array($zapytanie_wirusy)) {
												echo('
													<td>
														<input type="checkbox" name="v'.$row_wirusy['id'].'" value="1" />
													</td>
												');
											};
											
										  echo('
										</tr>
									  </tbody></table>
									</div>
									<!-- /.box-body -->
								  </div>
								  <!-- /.box -->
							</div>

							<div class="form-group">
								<div class="box-footer pull-right">
									<input type="hidden" id="numinfected" name="numinfected" value="'.$numinfected.'" />
									<button type="submit" class="btn btn-info ifcheck">Next step</button>
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
	$(".del").click(function(){
		if (!confirm("Do you want to cancel")){
			return false;
		}
	});
});
</script>