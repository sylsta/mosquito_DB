<!-- Content Wrapper. Contains page content -->
<?php
	$login = $_SESSION['valida'];
	echo('
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Virus identification</h3><br />
					</div>
					<div class="box-body">
						<form action="index.php" id="nowy" method="POST">
							<input type="hidden" name="czynnosc" value="opisz_wirusy" />
							<div class="form-group">
								<label for="date">Mosquito</label>
								<input class="form-control" name="batch" id="batch" readonly="readonly" value="'.$_SESSION['valida'].'" type="text">
							</div>

							<div class="form-group">

								  <div class="box">
									<div class="box-body">
									  <table class="table table-bordered" id="lista">
										<tbody><tr>
										  <th>Virus ID</th>
										  <th style="width: 100px;">Virus type</th>
										  <th>Gene</th>
										  <th>Full length</th>
										  <th style="width: 200px;">Haplotype</th>
										  <th>Virus sequence ID</th>
										</tr>
										
										');
										
										$sesja = $_SESSION['session'];
										$zapytanie_rodzaje = mysql_query("SELECT *,ind_viruses.id AS vid FROM ind_viruses INNER JOIN ind_mosquitoes ON ind_mosquitoes.id=ind_viruses.id_mosquitoes INNER JOIN ind_viruses_type ON ind_viruses_type.id=ind_viruses.type WHERE ind_viruses.session='$sesja' ORDER BY ind_viruses.id");
										while ($row_rodzaje = mysql_fetch_array($zapytanie_rodzaje)) {
											echo('
												<tr>
												  <td>
													<input name="code_'.$row_rodzaje['vid'].'" class="form-control" readonly="readonly" value="'.$row_rodzaje['mosquitoes_code'].'_'.$row_rodzaje['vid'].'" type="text">
												  </td>
												  <td>
													<input name="type_'.$row_rodzaje['vid'].'" class="form-control" readonly="readonly" value="'.$row_rodzaje['virus'].'" type="text">
												  </td>
												  <td>
													<input name="gene_'.$row_rodzaje['vid'].'" class="form-control required" value="" type="text" required="required">
												  </td>
												  <td>
													<select name="len_'.$row_rodzaje['vid'].'" class="form-control required" required="required">
														<option value="">-- select --</option>
														<option value="1">yes</option>
														<option value="0">no</option>
													</select>
												  </td>
												  <td>
													<input name="hap1_'.$row_rodzaje['vid'].'" style="width: 50px; float: left;" readonly="readonly" value="'.substr($row_rodzaje['haplotype'],0,3).'" class="form-control" value="" type="text" required="required"><input name="hap2_'.$row_rodzaje['vid'].'" placeholder="LL" maxlength="2" class="form-control required lettersOnly" style="width: 50px; float: left;" value="" type="text" required="required"><input name="hap3_'.$row_rodzaje['vid'].'" placeholder="NNN" maxlength="3" class="form-control required numbersOnly" style="width: 80px; float: left;" value="" type="text" required="required">
												  </td>
												  <td>
													<input name="seq_'.$row_rodzaje['vid'].'" class="form-control required" value="" type="text" required="required">
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
	
	jQuery('.lettersOnly').keyup(function () { 
		this.value = this.value.replace(/[^A-Za-z]/g,'');
	});
	
	$(".del").click(function(){
		if (!confirm("Do you want to cancel")){
			return false;
		}
	});
});
</script>