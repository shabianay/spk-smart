<?php
include "config.php";
session_start();
if (!isset($_SESSION['id_admin'])) {
	exit();
}

$id_admin = $_SESSION['id_admin']; // ID pengguna yang sedang aktif
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
		<a class="app-bar-element" href="../user/index.php">SPK Metode SMART</a>
		<span class="app-bar-divider"></span>
		<ul class="app-bar-menu">
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
						<li><a href="data_warga.php"><span class="mif-stack icon"></span> Data Warga</a></li>
						<li><a href="laporan.php"><span class="mif-file-pdf icon"></span> Laporan</a></li>
						<li class="divider"></li>
						<li class="menu-title">Pengguna</li>
						<li><a href="ubahpassword.php"><span class="mif-key icon"></span> Ubah Password</a></li>
						<li><a href="logout.php"><span class="mif-cross icon"></span> Logout</a></li>
					</ul>
				</div>
				<div class="cell colspan4">
					<div style="padding:10px 15px;border:1px solid blue;background:white;">