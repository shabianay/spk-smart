<?php
include "../include/header_user.php";
?>
<style>
    .info-kelurahan {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        text-align: center;
    }

    .info-kelurahan img {
        border-radius: 10%;
        margin-bottom: 10px;
    }

    .info-kelurahan p {
        margin-bottom: 5px;
    }
</style>

<h1>SPK Metode SMART</h1>
<p>Selamat datang di Sistem Pendukung Keputusan Metode SMART</p>
<p>Anda login sebagai <strong><?php echo $_SESSION['username']; ?></strong></p>

<div class="row">
    <div class="cell">
        <h3>Informasi Kelurahan</h3>
        <div class="info-kelurahan">
            <img src="../img/kelurahan.jpg" alt="logo" width="300">
            <p><strong>Nama Kelurahan:</strong> Kelurahan Kepanjin</p>
            <p><strong>Alamat:</strong> Jl Pujangga No. 27 A, Kelurahan Kepanjin, Kab. Sumenep, 69415</p>
            <p><strong>No Telepon:</strong> -</p>
            <p><strong>Kecamatan:</strong> Kota Sumenep</p>
            <p><strong>Kabupaten:</strong> Sumenep</p>
            <p><strong>Provinsi:</strong> Jawa Timur</p>
            <p><strong>Negara:</strong> Indonesia</p>
            <p><strong>Akun Instagram:</strong> <a href="https://www.instagram.com/kelurahan.kepanjin">kelurahan.kepanjin</a></p>
        </div>
    </div>
</div>

<script src="js/Chart.js"></script>
<?php
include "../include/footer.php";
?>