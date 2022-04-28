<!-- Content Wrapper. Contains page content -->
<?php
	$login = $_SESSION['valida'];
	$session = $_SESSION['session'];
	$zapytanie = mysql_query("SELECT * FROM ind_observations WHERE session='$session'");
	$row = mysql_fetch_array($zapytanie);
	$data = date('Y-m-d H:i:s');
	echo('
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Save results</h3><br />');

						$zapytanie_batches = mysql_query("SELECT * FROM ind_batches WHERE session='$session'");
						$ile_batches = mysql_num_rows($zapytanie_batches);

						echo('
						<p style="margin: 20px; 20%;">
							<b>Check! You have '.$ile_batches.' batches:</b><br />');
							
							while ($row_batches = mysql_fetch_array($zapytanie_batches)) {
								echo('<br />'.$row_batches['batch_code'].'');
							};

							echo('	
						</p>
					</div>
					<div class="box-body">
						<form action="index.php" id="nowy" method="POST">
							<input type="hidden" name="czynnosc" value="zakoncz" />
							<input type="hidden" name="id_observation" value="'.$row['id'].'" />
							<input type="hidden" name="date_end" value="'.$data.'" />
							
							<div class="form-group">
								<div class="box-footer pull-right">
									<button type="submit" class="btn btn-info">Finish</button>
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
	
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- Page script -->
<script>
  $(function () {
    $("[data-mask]").inputmask();
  });
 $(function(){
	$(".backyard_click").click(function() {
	  $(".backyard").toggle( "fast", function() {
		// Animation complete
	  });
	});
});
</script>