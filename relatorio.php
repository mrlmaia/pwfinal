<?php
	ob_start();
	require_once "mpdf/mpdf.php";
	$mpdf = new mPDF();
	$mpdf->SetDisplayMode("fullpage");
	$css = file_get_contents('relatorio.css');
	$mpdf->WriteHTML($css, 1);
?>