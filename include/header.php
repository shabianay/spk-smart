<?php
include "config.php";
session_start();
if (!isset($_SESSION['id_admin'])) {
?>
	<script>
		window.location.assign("index.php")
	</script>
<?php
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>SPK Metode SMART</title>
	<link href="../css/metro.css" rel="stylesheet">
	<link href="../css/metro-icons.css" rel="stylesheet">
	<link href="../css/metro-schemes.css" rel="stylesheet">
	<link href="../css/metro-responsive.css" rel="stylesheet">
</head>

<body>
	<div class="app-bar">
		<a class="app-bar-element" href="../admin/index.php">SPK Metode SMART</a>
		<span class="app-bar-divider"></span>
		<ul class="app-bar-menu">
			<li><a href="kriteria.php">Kriteria</a></li>
			<li><a href="subkriteria.php">Sub Kriteria</a></li>
			<li><a href="alternatif.php">Alternatif</a></li>
			<li><a href="perangkingan.php">Perangkingan</a></li>
			<li><a target="_blank" href="laporan.php">Laporan</a></li>
			<!--<li>
				<a href="" class="dropdown-toggle">Laporan</a>
				<ul class="d-menu" data-role="dropdown">
					<li><a href="">Direct</a></li>
					<li><a href="">FPDF</a></li>
					<li><a href="">phpToPDF</a></li>
					<li><a href="">TCPDF</a></li>
					<li><a href="">Dompdf</a></li>
					<li><a href="">Zend_Pdf</a></li>
					<li><a href="">PDFlib</a></li>
					<li><a href="">mPDF</a></li>
				</ul>
			</li>-->
		</ul>
		<a href="logout.php" class="app-bar-element place-right">Logout</a>
	</div>

	<div style="padding:5px 20px;">
		<div class="grid">
			<div class="row cells5">
				<div class="cell">

					<ul class="v-menu" style="border:1px solid blue">
						<li class="menu-title">Dashboard</li>
						<li><a href="index.php"><span class="mif-home icon"></span> Beranda</a></li>
						<li class="divider"></li>
						<li class="menu-title">Menu</li>
						<li><a href="#" class="dropdown-toggle"><span class="mif-users icon"></span> Data Warga</a>
							<ul class="d-menu" data-role="dropdown">
								<li><a href="rt1.php">RT 1</a></li>
								<li><a href="rt2.php">RT 2</a></li>
								<li><a href="rt3.php">RT 3</a></li>
								<li><a href="rt4.php">RT 4</a></li>
								<li><a href="rt5.php">RT 5</a></li>
								<li><a href="rt6.php">RT 6</a></li>
								<li><a href="rt7.php">RT 7</a></li>
								<li><a href="rt8.php">RT 8</a></li>
								<li><a href="rt9.php">RT 9</a></li>
								<li><a href="rt10.php">RT 10</a></li>
								<li><a href="rt11.php">RT 11</a></li>
								<li><a href="rt12.php">RT 12</a></li>
								<li><a href="rt13.php">RT 13</a></li>
								<li><a href="data_warga.php">Data Warga Keseluruhan</a></li>
							</ul>
						</li>
						<li><a href="kriteria.php"><span class="mif-florist icon"></span> Kriteria</a></li>
						<li><a href="subkriteria.php"><span class="mif-layers icon"></span> Sub Kriteria</a></li>
						<li><a href="alternatif.php"><span class="mif-stack icon"></span> Alternatif</a></li>
						<li><a href="perangkingan.php"><span class="mif-books icon"></span> Perangkingan</a></li>
						<li><a target="_blank" href="laporan.php"><span class="mif-file-pdf icon"></span> Laporan</a></li>
						<li class="divider"></li>
						<li class="menu-title">Pengguna</li>
						<li><a href="operator.php"><span class="mif-user icon"></span> Operator</a></li>
						<li><a href="logout.php"><span class="mif-cross icon"></span> Logout</a></li>
					</ul>

				</div>
				<div class="cell colspan4">

					<div style="padding:10px 15px;border:1px solid blue;background:white;">