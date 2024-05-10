<?php
include "../include/header.php";
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<div class="row cells4">
    <div class="cell colspan2">
        <h3>Data Warga</h3>
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
        $stmt->bindValue(1, 10);
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
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<p><br /></p>
<?php
include "../include/footer.php";
?>