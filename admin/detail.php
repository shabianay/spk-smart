<?php
include "../include/header.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM data_warga WHERE id = ?");
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row) {
?>
        <div class="row cells4">
            <div class="cell colspan2">
                <h3>Data Detail Warga</h3>
            </div>
            <div class="cell colspan2 align-right">
                <a href="data_warga.php" class="button info">Kembali</a>
            </div>
        </div>
        <p></p>
        <table class="table striped">
            <tr>
                <td width="150"><strong>Nama</strong></td>
                <td><?php echo $row['nama']; ?></td>
            </tr>
            <tr>
                <td><strong>Alamat</strong></td>
                <td><?php echo $row['alamat']; ?></td>
            </tr>
            <tr>
                <td><strong>NIK</strong></td>
                <td><?php echo $row['nik']; ?></td>
            </tr>
            <tr>
                <td><strong>Foto Dokumen</strong></td>
                <td>
                    <img src="<?php echo $row['foto1']; ?>" width="250" height="250" alt="Foto 1">
                    <img src="<?php echo $row['foto2']; ?>" width="250" height="250" alt="Foto 2">
                    <img src="<?php echo $row['foto3']; ?>" width="250" height="250" alt="Foto 3">
                    <img src="<?php echo $row['foto4']; ?>" width="250" height="250" alt="Foto 4">
                    <img src="<?php echo $row['foto5']; ?>" width="250" height="250" alt="Foto 5">
                </td>
            </tr>
        </table>
<?php
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID tidak ditemukan.";
}

include "../include/footer.php";
?>