<?php
include "../include/header_user.php";
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<div class="row cells4">
    <div class="cell colspan2">
        <h3>Data Warga</h3>
    </div>
    <?php
    if ($page == 'form') {
    ?>
        <div class="cell colspan2 align-right">
            <a href="data_warga.php" class="button info">Kembali</a>
        </div>
</div>
<p></p>
<?php
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $nik = $_POST['nik'];
            $penghasilan = $_POST['penghasilan'];

            $foto_names = [];
            for (
                $i = 1;
                $i <= 5;
                $i++
            ) {
                $foto_name = 'foto_' . $i;
                if ($_FILES[$foto_name]["error"] != UPLOAD_ERR_NO_FILE) {
                    $target_dir = "../uploads/";
                    $target_file = $target_dir . basename($_FILES[$foto_name]["name"]);
                    if (move_uploaded_file($_FILES[$foto_name]["tmp_name"], $target_file)) {
                        $foto_names[] = $target_file;
                    } else {
                        $foto_names[] = 'UPLOAD_FAILED'; // Or another placeholder value
                    }
                }
            }

            $id_admin = $_SESSION['id_admin']; // ID admin yang sedang aktif

            $stmt2 = $db->prepare("INSERT INTO data_warga (nama, alamat, nik, penghasilan, foto1, foto2, foto3, foto4, foto5, id_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt2->bindParam(1, $nama);
            $stmt2->bindParam(2, $alamat);
            $stmt2->bindParam(3, $nik);
            $stmt2->bindParam(4, $penghasilan);
            $stmt2->bindParam(5, $foto_names[0]);
            $stmt2->bindParam(6, $foto_names[1]);
            $stmt2->bindParam(7, $foto_names[2]);
            $stmt2->bindParam(8, $foto_names[3]);
            $stmt2->bindParam(9, $foto_names[4]);
            $stmt2->bindParam(10, $id_admin);

            if ($stmt2->execute()) {
?>
        <script type="text/javascript">
            location.href = 'data_warga.php'
        </script>
    <?php
            } else {
    ?>
        <script type="text/javascript">
            alert('Gagal menyimpan data')
        </script>
<?php
            }
        }
?>
<form method="post" enctype="multipart/form-data">
    <label>Nama</label><span style="color: red;">*</span>
    <div class="input-control text full-size">
        <input type="text" name="nama" placeholder="Nama Warga" required>
    </div>
    <label>Alamat</label><span style="color: red;">*</span>
    <div class="input-control text full-size">
        <input type="text" name="alamat" placeholder="Alamat" required>
    </div>
    <label>NIK</label><span style="color: red;">*</span>
    <div class="input-control text full-size">
        <input type="text" name="nik" placeholder="NIK" required>
    </div>
    <label>Penghasilan</label><span style="color: red;">*</span>
    <div class="input-control text full-size">
        <input type="text" name="penghasilan" placeholder="Penghasilan" required>
    </div>
    <label>Foto Dokumen</label>
    <div class="input-control file full-size" data-role="input">
        <input type="file" name="foto_1" accept="image/*" placeholder="KTP" required>
        <button class="button"><span class="mif-folder"></span></button>
    </div>
    <div class="input-control file full-size" data-role="input">
        <input type="file" name="foto_2" accept="image/*" placeholder="KK (Kartu Keluarga)" required>
        <button class="button"><span class="mif-folder"></span></button>
    </div>
    <div class="input-control file full-size" data-role="input">
        <input type="file" name="foto_3" accept="image/*" placeholder="Akta nikah/cerai" >
        <button class="button"><span class="mif-folder"></span></button>
    </div>
    <div class="input-control file full-size" data-role="input">
        <input type="file" name="foto_4" accept="image/*" placeholder="Pekerjaan" >
        <button class="button"><span class="mif-folder"></span></button>
    </div>
    <div class="input-control file full-size" data-role="input">
        <input type="file" name="foto_5" accept="image/*" placeholder="Foto lainnya" >
        <button class="button"><span class="mif-folder"></span></button>
    </div>
    <button type="submit" name="simpan" class="button primary">Simpan</button>
</form>
<?php
    } else if ($page == 'edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $db->prepare("SELECT * FROM data_warga WHERE id = ?");
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row) {
?>
        <div class="cell colspan2 align-right">
            <a href="data_warga.php" class="button info">Kembali</a>
        </div>
        </div>
        <p></p>
        <?php
                if (isset($_POST['update'])) {
                    $nama = $_POST['nama'];
                    $alamat = $_POST['alamat'];
                    $nik = $_POST['nik'];
                    $penghasilan = $_POST['penghasilan'];

                    // Simpan 5 foto dokumen ke server
                    $foto_names = [];
                    for (
                        $i = 1;
                        $i <= 5;
                        $i++
                    ) {
                        $foto_name = 'foto_' . $i;
                        if ($_FILES[$foto_name]["error"] == UPLOAD_ERR_NO_FILE) {
                            // Handle case where file is not uploaded
                            $foto_names[] = $row['foto' . $i]; // Keep the existing photo if no new file is uploaded
                        } else {
                            $target_dir = "../uploads/";
                            $target_file = $target_dir . basename($_FILES[$foto_name]["name"]);
                            if (move_uploaded_file($_FILES[$foto_name]["tmp_name"], $target_file)) {
                                $foto_names[] = $target_file;
                            } else {
                                // Handle case where upload fails
                                $foto_names[] = 'UPLOAD_FAILED'; // Or another placeholder value
                            }
                        }
                    }

                    $stmt2 = $db->prepare("UPDATE data_warga SET nama = ?, alamat = ?, nik = ?, penghasilan = ?, foto1 = ?, foto2 = ?, foto3 = ?, foto4 = ?, foto5 = ? WHERE id = ?");
                    $stmt2->bindParam(1, $nama);
                    $stmt2->bindParam(2, $alamat);
                    $stmt2->bindParam(3, $nik);
                    $stmt2->bindParam(4, $penghasilan);
                    $stmt2->bindParam(5, $foto_names[0]);
                    $stmt2->bindParam(6, $foto_names[1]);
                    $stmt2->bindParam(7, $foto_names[2]);
                    $stmt2->bindParam(8, $foto_names[3]);
                    $stmt2->bindParam(9, $foto_names[4]);
                    $stmt2->bindParam(10, $id);

                    if ($stmt2->execute()) {
                        echo "<script>alert('Data berhasil diubah')</script>";
                        header('Location: data_warga.php');
                    } else {
                        echo "<script>alert('Gagal mengubah data')</script>";
                    }
                }
        ?>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label>Nama</label>
            <div class="input-control text full-size">
                <input type="text" name="nama" placeholder="Nama Warga" value="<?php echo $row['nama']; ?>">
            </div>
            <label>Alamat</label>
            <div class="input-control text full-size">
                <input type="text" name="alamat" placeholder="Alamat" value="<?php echo $row['alamat']; ?>">
            </div>
            <label>NIK</label>
            <div class="input-control text full-size">
                <input type="text" name="nik" placeholder="NIK" value="<?php echo $row['nik']; ?>">
            </div>
            <label>Penghasilan</label>
            <div class="input-control text full-size">
                <input type="text" name="penghasilan" placeholder="Penghasilan" value="<?php echo $row['penghasilan']; ?>">
            </div>
            <label>Foto Dokumen</label>
            <div class="input-control file full-size" data-role="input">
                <input type="file" name="foto_1" accept="image/*" placeholder="KTP">
                <button class="button"><span class="mif-folder"></span></button>
            </div>
            <div>
                <label for="content">Tampilan gambar: </label>
                <br>
                <img src="<?php echo $row['foto1']; ?>" width="100" height="100">
            </div>
            <div class="input-control file full-size" data-role="input">
                <input type="file" name="foto_2" accept="image/*" placeholder="KK">
                <button class="button"><span class="mif-folder"></span></button>
            </div>
            <div>
                <label for="content">Tampilan gambar: </label>
                <br>
                <img src="<?php echo $row['foto2']; ?>" width="100" height="100">
            </div>
            <div class="input-control file full-size" data-role="input">
                <input type="file" name="foto_3" accept="image/*" placeholder="Akta nikah/cerai">
                <button class="button"><span class="mif-folder"></span></button>
            </div>
            <div>
                <label for="content">Tampilan gambar: </label>
                <br>
                <img src="<?php echo $row['foto3']; ?>" width="100" height="100">
            </div>
            <div class="input-control file full-size" data-role="input">
                <input type="file" name="foto_4" accept="image/*" placeholder="Pekerjaan">
                <button class="button"><span class="mif-folder"></span></button>
            </div>
            <div>
                <label for="content">Tampilan gambar: </label>
                <br>
                <img src="<?php echo $row['foto4']; ?>" width="100" height="100">
            </div>
            <div class="input-control file full-size" data-role="input">
                <input type="file" name="foto_5" accept="image/*" placeholder="Foto lainnya">
                <button class="button"><span class="mif-folder"></span></button>
            </div>
            <div>
                <label for="content">Tampilan gambar: </label>
                <br>
                <img src="<?php echo $row['foto5']; ?>" width="100" height="100">
            </div>
            <button type="submit" name="update" class="button warning">Update</button>
        </form>
    <?php
            }
        }
    } else if ($page == 'hapus') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $db->prepare("DELETE FROM data_warga WHERE id = ?");
            $stmt->bindParam(1, $id);
            if ($stmt->execute()) {
    ?>
        <script type="text/javascript">
            location.href = 'data_warga.php'
        </script>
<?php
            }
        }
    } else {
?>
<div class="cell colspan2 align-right">
    <a href="?page=form" class="button primary">Tambah</a>
</div>
</div>
<table class="table striped hovered cell-hovered border bordered dataTable" data-role="datatable" data-searching="true">
    <thead>
        <tr>
            <th width="50">ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>NIK</th>
            <th>Penghasilan</th>
            <th width="250">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $stmt = $db->prepare("SELECT * FROM data_warga WHERE id_admin = ?");
        $stmt->bindParam(1, $id_admin);
        $stmt->execute();
        $no = 1;
        while ($row = $stmt->fetch()) {
        ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['nama'] ?></td>
                <td><?php echo $row['alamat'] ?></td>
                <td><?php echo $row['nik'] ?></td>
                <td><?php echo $row['penghasilan'] ?></td>
                <td class="align-center">
                    <a href="detail.php?id=<?php echo $row['id'] ?>" class="button info"><span class="mif-eye icon"></span> Detail</a>
                    <a href="?page=edit&id=<?php echo $row['id'] ?>" class="button warning"><span class="mif-pencil icon"></span> Edit</a>
                    <a href="?page=hapus&id=<?php echo $row['id'] ?>" class="button danger"><span class="mif-cancel icon"></span> Hapus</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<p><br /></p>
<?php
    }
    include "../include/footer.php";
?>