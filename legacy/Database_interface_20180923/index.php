<?php
	ob_start();
	session_start();
	include('i_dbase.php');
	
	function logowanie($login,$user,$lat,$long,$role) { // logowanie do systemu i pobranie zmiennych sesji
		$login = preg_replace('/[^a-zA-Z0-9_]/', '', $login);
		$login = strtoupper($login);
		$user = preg_replace('/[^a-zA-Z0-9_]/', '', $user);
		$status = 0;
		$data = date('Y-m-d H:i:s');
		$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
		session_regenerate_id();
		$promien = 0.001; // ustawa margines bufora
	
		if (($user != '')) { // sprawdza czy wpisane pola nie są puste
			$zapytanie_user = mysql_query("SELECT id FROM ind_users WHERE verify_user='$user' AND disabled='0' AND role LIKE '%,$role,%'");
			$num_rows_user = mysql_num_rows($zapytanie_user);
			$row_user = mysql_fetch_array($zapytanie_user);

			if ($num_rows_user == 1) { // sprawdza czy jest taki user
					if (($role == 1) AND ($login!='')) { // sprawdza rolę
						$zapytanie = mysql_query("SELECT * FROM ind_points WHERE (verify_code='$login' AND disabled='0')");
						$num_rows = mysql_num_rows($zapytanie);
						$row = mysql_fetch_array($zapytanie);

						//if ((($row['x'] - $promien) < $long) AND (($row['x'] + $promien) > $long) AND (($row['y'] - $promien) < $lat) AND (($row['y'] + $promien) > $lat) AND ($num_rows == 1)) { // sprawdza lokalizację
							$_SESSION['start'] = 1;
							$_SESSION['valida'] = $row['verify_code']; // ustawia status na zalogowany
							$_SESSION['osoba'] = $row_user['id']; // ustawia numer osoby
							$_SESSION['session'] = session_id(); // ustawia numer sesji
							$komunikat = 'POINT code '.$row['verify_code'].' is correct';		
						/* } else {
							$_SESSION['valida'] = 0;
							$_SESSION['osoba'] = 0;
							$_SESSION['start'] = 0;
							$_SESSION['session'] = session_id();
							$komunikat = 'Point are not valid';
						}; */
					} else if (($role == 2) AND ($login!='')) {
						$zapytanie = mysql_query("SELECT batch_code FROM ind_batches WHERE (batch_code='$login')");
						$num_rows = mysql_num_rows($zapytanie);
						$row = mysql_fetch_array($zapytanie);
						if ($num_rows == 1) {
							$_SESSION['valida'] = $login; // ustawia sesje na zalogowany
							$_SESSION['osoba'] = $row_user['id'];
							$_SESSION['session'] = session_id();
							$komunikat = 'BATCH code '.$row['batch_code'].' is correct';
							$_SESSION['start'] = 21;
						} else {
							$_SESSION['valida'] = 0;
							$_SESSION['osoba'] = 0;
							$_SESSION['start'] = 0;
							$_SESSION['session'] = session_id();
							$komunikat = 'Batch are not valid';
						}
					} else if ($role == 3) {
						$zapytanie = mysql_query("SELECT * FROM ind_mosquitoes WHERE (mosquitoes_code='$login' AND infected='infected')");
						$num_rows = mysql_num_rows($zapytanie);
						$row = mysql_fetch_array($zapytanie);
						if ($num_rows == 1) {
							$_SESSION['valida'] = $login; // ustawia sesje na zalogowany
							$_SESSION['osoba'] = $row_user['id'];
							$_SESSION['session'] = session_id();
							$komunikat = 'MOSQUITO code '.$login.' is correct';
							$_SESSION['start'] = 31;
						} else {
							$_SESSION['valida'] = 0;
							$_SESSION['osoba'] = 0;
							$_SESSION['start'] = 0;
							$_SESSION['session'] = session_id();
							$komunikat = 'Mosquito are not valid';
						}
					} else if ($role == 99) {
						$_SESSION['start'] = 99;
						$_SESSION['valida'] = $row_user['id']; // ustawia status na zalogowany
						$_SESSION['osoba'] = $row_user['id']; // ustawia numer osoby
						$_SESSION['session'] = session_id(); // ustawia numer sesji
						$komunikat = 'Admin is correct';	
					} else {
						$_SESSION['valida'] = 0;
						$_SESSION['osoba'] = 0;
						$_SESSION['start'] = 0;
						$_SESSION['session'] = session_id();
						$komunikat = 'Role or point are not valid';
					};
			} else {
				$_SESSION['valida'] = 0;
				$_SESSION['osoba'] = 0;
				$_SESSION['start'] = 0;
				$_SESSION['session'] = session_id();
				$komunikat = 'User data are not valid';
			};
		} else {
			$_SESSION['valida'] = 0;
			$_SESSION['osoba'] = 0;
			$_SESSION['start'] = 0;
			$_SESSION['session'] = session_id();
			$komunikat = 'No data';
		};
		
		$sesja = $_SESSION['session'];
		$ins = mysql_query("INSERT INTO ind_logi (date,ip,pole,wartosc,status) VALUES ('$data','$ip','$sesja','$komunikat','logowanie')");
		return $komunikat;
	};
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Research project</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	
	<!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <script src="dist/js/demo.js" type="text/javascript"></script>
	
	<!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
	<script src="plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- daterange picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	
	<script type="text/javascript">
      $(function () {
        //Date range picker
        $('.dateinfo').datepicker({
			format: "yyyy-mm-dd",
			language: "en",
			calendarWeeks: true,
		});
      });
    </script>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini" style="background-color: #222D32;">
    <div class="wrapper">
	  <?php 
		if (isset($_POST['czynnosc']) == TRUE) {$czynnosc = $_POST['czynnosc'];} else {$czynnosc = '';}; 
		if (isset($_GET['p']) == TRUE) {$page = $_GET['p'];} else {$page = '';};
	  ?>	
	  
	  <?php 
		$blad = 0;
		
		switch ($czynnosc) {
			case 'zaloguj': 
				$loginfo = logowanie($_POST['code'],$_POST['user'],$_POST['lat'],$_POST['long'],$_POST['role']); 
				echo('<div style="border: 1px solid #628291; background-color: #628291; margin: 5px; text-align: center: width: 100%; color: white; font-size: 14px;"><center>'.$loginfo.'</center></div>'); 
				break;
			case 'dodaj_punkt': 
				$address = $_POST['address'];
				$temperature = $_POST['temperature'];
				$humidity = $_POST['humidity'];
				$id_points = $_POST['id_points'];
				$date_start = $_POST['date_start'];
				$sesja = $_SESSION['session'];
				$user = $_SESSION['osoba'];
				
				$people = $_POST['people'];
				$animals_inside = $_POST['animals_inside'];
				$animals_outside = $_POST['animals_outside'];
				$backyard = $_POST['backyard'];
				$backyard_garden = $_POST['backyard_garden'];
				$backyard_trees = $_POST['backyard_trees'];
				$backyard_plants = $_POST['backyard_plants'];
				$backyard_animals = $_POST['backyard_animals'];
				$containers = $_POST['containers'];
				$mosquitoes = $_POST['mosquitoes'];
				if ($containers == 1) {$page=2;} else if ($mosquitoes == 1) {$page=3;} else {$page=4;};
				$rap = mysql_query("INSERT INTO ind_observations (id_points,date_start,session,researcher,humidity,temperature,address,backyard,backyard_garden,backyard_trees,backyard_plants,backyard_animals,people,animals_inside,animals_outside,containers,mosquitoes) VALUES ('$id_points','$date_start','$sesja','$user','$humidity','$temperature','$address','$backyard','$backyard_garden','$backyard_trees','$backyard_plants','$backyard_animals','$people','$animals_inside','$animals_outside','$containers','$mosquitoes')");
				
				$data = date('Y-m-d H:i:s');
				$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
				
				$ins = mysql_query("INSERT INTO ind_logi (date,ip,pole,wartosc,status) VALUES ('$data','$ip','$sesja','$id_points','dodanie_punktu')");
				break;
			case 'dodaj_pojemniki': 
				$id_observations = $_POST['id_observations'];
				$sesja = $_SESSION['session'];
				$mosquitoes = $_POST['mosquitoes'];
				
				$zapytanie_rodzaje = mysql_query("SELECT * FROM ind_containers_type ORDER BY container_type");
				while ($row_rodzaje = mysql_fetch_array($zapytanie_rodzaje)) {
					$container_count = $_POST['ocon_c_'.$row_rodzaje['id'].''];
					$container_infected = $_POST['ocon_i_'.$row_rodzaje['id'].''];
					$type = $row_rodzaje['id'];
					$location = 'outside';
					
					$ins = mysql_query("INSERT INTO ind_containers (container_type_id,id_observations,container_count,container_infected,type_loc,session) VALUES ('$type','$id_observations','$container_count','$container_infected','$location','$sesja')");
					
					$container_count = 0;
					$container_infected = 0;
				};
				
				$zapytanie_rodzaje = mysql_query("SELECT * FROM ind_containers_type ORDER BY container_type");
				while ($row_rodzaje = mysql_fetch_array($zapytanie_rodzaje)) {
					$container_count = $_POST['icon_c_'.$row_rodzaje['id'].''];
					$container_infected = $_POST['icon_i_'.$row_rodzaje['id'].''];
					$type = $row_rodzaje['id'];
					$location = 'inside';
					
					$ins = mysql_query("INSERT INTO ind_containers (container_type_id,id_observations,container_count,container_infected,type_loc,session) VALUES ('$type','$id_observations','$container_count','$container_infected','$location','$sesja')");
					
					$container_count = 0;
					$container_infected = 0;
				};

				$data = date('Y-m-d H:i:s');
				$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
				$sesja = $_SESSION['session'];
				$ins = mysql_query("INSERT INTO ind_logi (date,ip,pole,wartosc,status) VALUES ('$data','$ip','$sesja','','dodano_kontenery')");
				
				if ($mosquitoes == 1) {$page=3;} else {$page=4;};
				break;
			case 'dodaj_komary':
				$klik = $_POST['klik'];
				$id_observations = $_POST['id_observations'];
				$sesja = $_SESSION['session'];

				for ($i = 1; $i <= $klik; $i++) {
					$name_batch = trim($_POST['name_batch_'.$i]);
					$age_batch = trim($_POST['age_batch_'.$i]);
					$count_batch = trim($_POST['count_batch_'.$i]);
					$loc_batch = trim($_POST['loc_batch_'.$i]);
					$cont_batch_data = trim($_POST['cont_batch_data_'.$i]);
					if ($name_batch != '') {
						$rap = mysql_query("INSERT INTO ind_batches (batch_code,id_observation,type_age,type_loc,type_con,session,mosquitoes_count_start) VALUES ('$name_batch','$id_observations','$age_batch','$loc_batch','$cont_batch_data','$sesja','$count_batch')");
					}
				};
				
				$data = date('Y-m-d H:i:s');
				$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
				$sesja = $_SESSION['session'];
				$ins = mysql_query("INSERT INTO ind_logi (date,ip,pole,wartosc,status) VALUES ('$data','$ip','$sesja','','dodano_komary')");
				$page=4;
				break;
				
			case 'dodaj_mosquitoes':
				$klik = $_POST['klik'];
				$mos_count = $_POST['mos_count'];
				$id_batch = $_POST['id_batch'];
				$sesja = $_SESSION['session'];
				$user = $_SESSION['osoba'];
				$data = date('Y-m-d H:i:s');

				for ($i = 1; $i <= $klik; $i++) {
					$mos_id = trim($_POST['mos_id_'.$i]);
					$mos_genus = trim($_POST['mos_genus_'.$i]);
					$mos_species = trim($_POST['mos_species_'.$i]);
					$mos_genotype = trim($_POST['mos_genotype_'.$i]);
					$mos_seqid = trim($_POST['mos_seqid_'.$i]);
					$mos_error = trim($_POST['error_id_'.$i]);
					$mos_infected = trim($_POST['mos_infected_'.$i]);
					$mos_sex = trim($_POST['mos_sex_'.$i]);
					
					if ($mos_id != '') {
						$zapytanie_wartosci = mysql_query("SELECT * FROM ind_mosquitoes WHERE mosquitoes_code='$mos_id'");
						$czy_jest_mosq = mysql_num_rows($zapytanie_wartosci);
						if ($czy_jest_mosq > 0) {
							$ins = mysql_query("UPDATE ind_mosquitoes SET date='$data',genus='$mos_genus',species='$mos_species',genotype='$mos_genotype',mosquitoes_sequence='$mos_seqid',sex='$mos_sex',infected='$mos_infected',researcher='$user',error='$mos_error',close='1' WHERE mosquitoes_code='$mos_id'"); 
						} else {
							$rap = mysql_query("INSERT INTO ind_mosquitoes (date,mosquitoes_code,id_batch,genus,species,genotype,mosquitoes_sequence,sex,infected,session,researcher,error,close) VALUES ('$data','$mos_id','$id_batch','$mos_genus','$mos_species','$mos_genotype','$mos_seqid','$mos_sex','$mos_infected','$sesja','$user','$mos_error','1')");
						};					
					};
				};

				$ins = mysql_query("UPDATE ind_batches SET mosquitoes_count_end='$mos_count',close='1' WHERE id='$id_batch'"); 

				$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
				$sesja = $_SESSION['session'];
				$ins = mysql_query("INSERT INTO ind_logi (date,ip,pole,wartosc,status) VALUES ('$data','$ip','$sesja','','batch_dodano_komary')");
				
				$page=0;
				break;
			case 'wstrzymaj_mosquitoes':
				$klik = $_POST['klik'];
				$mos_count = $_POST['mos_count'];
				$id_batch = $_POST['id_batch'];
				$sesja = $_SESSION['session'];
				$user = $_SESSION['osoba'];
				$data = date('Y-m-d H:i:s');

				for ($i = 1; $i <= $klik; $i++) {
					$mos_id = trim($_POST['mos_id_'.$i]);
					$mos_genus = trim($_POST['mos_genus_'.$i]);
					$mos_species = trim($_POST['mos_species_'.$i]);
					$mos_genotype = trim($_POST['mos_genotype_'.$i]);
					$mos_seqid = trim($_POST['mos_seqid_'.$i]);
					$mos_error = trim($_POST['report_'.$i]);
					$mos_infected = trim($_POST['mos_infected_'.$i]);
					$mos_sex = trim($_POST['mos_sex_'.$i]);
					
					if ($mos_id != '') {
						$zapytanie_wartosci = mysql_query("SELECT * FROM ind_mosquitoes WHERE mosquitoes_code='$mos_id'");
						$czy_jest_mosq = mysql_num_rows($zapytanie_wartosci);
						if ($czy_jest_mosq > 0) {
							$ins = mysql_query("UPDATE ind_mosquitoes SET date='$data',genus='$mos_genus',species='$mos_species',genotype='$mos_genotype',mosquitoes_sequence='$mos_seqid',sex='$mos_sex',infected='$mos_infected',researcher='$user',error='$mos_error' WHERE mosquitoes_code='$mos_id'"); 
						} else {
							$rap = mysql_query("INSERT INTO ind_mosquitoes (date,mosquitoes_code,id_batch,genus,species,genotype,mosquitoes_sequence,sex,infected,session,researcher,error) VALUES ('$data','$mos_id','$id_batch','$mos_genus','$mos_species','$mos_genotype','$mos_seqid','$mos_sex','$mos_infected','$sesja','$user','$mos_error')");
						};					
					};
				};

				$ins = mysql_query("UPDATE ind_batches SET mosquitoes_count_end='$mos_count' WHERE id='$id_batch'"); 

				$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
				$sesja = $_SESSION['session'];
				$ins = mysql_query("INSERT INTO ind_logi (date,ip,pole,wartosc,status) VALUES ('$data','$ip','$sesja','','batch_dodano_komary')");
				
				$page=0;
				break;
			case 'dodaj_wirusy':
				$sesja = $_SESSION['session'];	
				$user = $_SESSION['osoba'];	
				$mosqid = $_POST['mosqid'];
				$batchid = $_POST['batch'];
				
				$zapytanie_wirusy = mysql_query("SELECT * FROM ind_viruses_type ORDER BY id");
				while ($row_wirusy = mysql_fetch_array($zapytanie_wirusy)) {
					${'v'.$row_wirusy['id']} = $_POST['v'.$row_wirusy['id']];
					if (${'v'.$row_wirusy['id']} == 1) {
						$type = $row_wirusy['id'];
						$rap = mysql_query("INSERT INTO ind_viruses (session,researcher,id_mosquitoes,type,id_batch) VALUES ('$sesja','$user','$mosqid','$type','$batchid')");
					};
				};
			
				$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
				$sesja = $_SESSION['session'];
				$ins = mysql_query("INSERT INTO ind_logi (date,ip,pole,wartosc,status) VALUES ('$data','$ip','$sesja','','batch_dodano_wirusy')");
				$page=32;
				break;
			case 'opisz_wirusy':
				$sesja = $_SESSION['session'];	
				$id_batch = $_SESSION['valida'];
				$user = $_SESSION['osoba'];	
				
				$sesja = $_SESSION['session'];
				$zapytanie_rodzaje = mysql_query("SELECT *,ind_viruses.id AS vid FROM ind_viruses INNER JOIN ind_mosquitoes ON ind_mosquitoes.id=ind_viruses.id_mosquitoes INNER JOIN ind_viruses_type ON ind_viruses_type.id=ind_viruses.type WHERE ind_viruses.session='$sesja' ORDER BY ind_viruses.id");
				while ($row_rodzaje = mysql_fetch_array($zapytanie_rodzaje)) {
					$code = $_POST['code_'.$row_rodzaje['vid']];
					$gene = $_POST['gene_'.$row_rodzaje['vid']];
					$len = $_POST['len_'.$row_rodzaje['vid']];
					$hap = $_POST['hap_'.$row_rodzaje['vid']];
					$seq = $_POST['seq_'.$row_rodzaje['vid']];
					$id = $row_rodzaje['vid'];

					$ins = mysql_query("UPDATE ind_viruses SET virus_code='$code',gene='$gene',full_lenght='$len',haplotype='$hap',virus_sequence='$seq' WHERE id='$id'");
				};	

				$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
				$sesja = $_SESSION['session'];
				$ins = mysql_query("INSERT INTO ind_logi (date,ip,pole,wartosc,status) VALUES ('$data','$ip','$sesja','','batch_opisano_wirusy')");
				$page=33;
				break;
				
			case 'zakoncz': 
				$id_observation = $_POST['id_observation'];
				$date_end = $_POST['date_end'];
				
				$ins = mysql_query("UPDATE ind_observations SET date_end='$date_end' WHERE id='$id_observation'"); 
				$page=0;
				
				$data = date('Y-m-d H:i:s');
				$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
				$sesja = $_SESSION['session'];
				$ins = mysql_query("INSERT INTO ind_logi (date,ip,pole,wartosc,status) VALUES ('$data','$ip','$sesja','','zakonczenie')");
				break;
			case 'anuluj': 
				$page=0;
				
				$data = date('Y-m-d H:i:s');
				$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
				$sesja = $_SESSION['session'];
				$ins = mysql_query("INSERT INTO ind_logi (date,ip,pole,wartosc,status) VALUES ('$data','$ip','$sesja','','anulowanie')");
				break;
		};
	  ?>

	  <?php 
	  if ($_SESSION['start'] > 0) {$page = $_SESSION['start']; $_SESSION['start'] = 0;};
	  if (($_SESSION['valida'] != '') AND ($page > 0)) {
			switch ($page) {
				case 0: include('i_login.php'); break;
				case 1: include('p_uczen_point.php'); break;
				case 2: include('p_uczen_containers.php'); break;
				case 3: include('p_uczen_mosquitoes.php'); break;
				case 4: include('p_uczen_end.php'); break;
				
				case 21: include('p_nauczyciel_mosquitoes.php'); break;
				case 31: include('p_nauczyciel_viruses.php'); break;
				case 32: include('p_nauczyciel_desc_viruses.php'); break;
				case 33: include('p_nauczyciel_end.php'); break;
				
				case 99: include('p_admin_tabela.php'); break;
				
				default: $_SESSION['valida'] = 0; $_SESSION['osoba'] = 0; $_SESSION['start'] = 0; include('i_login.php');
			};
 
	  } else {
		include('i_login.php');
	  }; 
	  ?>

      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
  </body>
</html>

<?php
	ob_end_flush();
?>