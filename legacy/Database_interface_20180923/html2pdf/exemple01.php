<?php
    // get the HTML
    ob_start();
	$person = $_GET['per'];
	$dl = strlen($person)-9;
	$person = substr($person,3,$dl);
	
	include('../i_dbase.php');
	$zapytanie_sem = mysql_query("SELECT * FROM kon_faktury WHERE id='$person' LIMIT 1");
	$row_sem = mysql_fetch_array($zapytanie_sem);

	echo('
	<page style="font-size: 10pt">
		<table style="width: 100%;">
			<tr>
				<td style="text-align: center; padding: 10px; width: 100%; font-size: 12pt;"><b>CONFIRMATION</b> of payment</td>
			</tr>
			<tr>
				<td style="text-align: left; padding: 30px; width: 50%; font-size: 12pt;">University of Warsaw<br />Ul. Krakowskie Przedmiescie 26/28<br />00-927 Warszawa</td>
			</tr>
			<tr>
				<td style="text-align: center; border: 1px solid lightgrey; padding: 10px; width: 100%;">'.$row_sem['tytul'].'</td>
			</tr>
			<tr>
				<td style="text-align: center; border: 1px solid lightgrey; padding: 10px; width: 100%;">'.$row_sem['instytucja'].' '); if ($row_sem['nip'] != '') {echo('(TAX no. '.$row_sem['nip'].')');}; echo('</td>
			</tr>
			<tr>
				<td style="text-align: center; border: 1px solid lightgrey; padding: 10px;">'.$row_sem['ulica'].' '.$row_sem['budynek'].' '.$row_sem['lokal'].', '.$row_sem['kod_pocztowy'].' '.$row_sem['miasto'].'</td>
			</tr>
		</table>
	</page>
	');

    $content = ob_get_clean();
    require_once('/html2pdf.class.php');
    try {
        $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
		$html2pdf->setDefaultFont('arialunicid0');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('confirmation.pdf');
    } catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    };
?>