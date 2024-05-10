<?php
include "../include/config.php";
session_start();
if (!isset($_SESSION['username'])) {
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
    <style>
        @media print {

            /* Sembunyikan link foto saat halaman dicetak */
            a[target="_blank"] {
                display: none;
            }
        }
    </style>

</head>

<body>
    <div class="container">
        <h2 style="text-align:center;">DATA WARGA KESELURUHAN</h2>
        <table class="table striped hovered cell-hovered border bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>NIK</th>
                    <th>Penghasilan</th>
                    <th>Foto Dokumen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $db->prepare("select * from data_warga");
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                ?>
                    <tr>
                        <td><?php echo $row['nama'] ?></td>
                        <td><?php echo $row['alamat'] ?></td>
                        <td><?php echo $row['nik'] ?></td>
                        <td><?php echo $row['penghasilan'] ?></td>
                        <td>
                            <?php if ($row['foto1']) : ?>
                                <img src="<?php echo $row['foto1'] ?>" width="100" height="100" alt="Foto 1">
                            <?php endif; ?>
                            <?php if ($row['foto2']) : ?>
                                <img src="<?php echo $row['foto2'] ?>" width="100" height="100" alt="Foto 2">
                            <?php endif; ?>
                            <?php if ($row['foto3']) : ?>
                                <img src="<?php echo $row['foto3'] ?>" width="100" height="100" alt="Foto 3">
                            <?php endif; ?>
                            <?php if ($row['foto4']) : ?>
                                <img src="<?php echo $row['foto4'] ?>" width="100" height="100" alt="Foto 4">
                            <?php endif; ?>
                            <?php if ($row['foto5']) : ?>
                                <img src="<?php echo $row['foto5'] ?>" width="100" height="100" alt="Foto 5">
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/metro.js"></script>
</body>

</html>