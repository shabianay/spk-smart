<?php
include "../include/header.php";
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<div class="row cells4">
	<div class="cell colspan2">
		<h3>Sub Kriteria</h3>
	</div>
	<?php
	if ($page == 'form') {
	?>
		<div class="cell colspan2 align-right">
			<a href="subkriteria.php" class="button info">Kembali</a>
		</div>
</div>
<p></p>
<?php
		if (isset($_POST['simpan'])) {
			$nama = $_POST['nama'];
			$nilai = $_POST['nilai'];
			$kriteria = $_POST['kriteria'];
			$stmt2 = $db->prepare("insert into smart_sub_kriteria(nama_sub_kriteria, nilai_sub_kriteria, id_kriteria) values(?,?,?)");
			$stmt2->bindParam(1, $nama);
			$stmt2->bindParam(2, $nilai);
			$stmt2->bindParam(3, $kriteria);
			if ($stmt2->execute()) {
?>
		<script type="text/javascript">
			location.href = 'subkriteria.php'
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
		if (isset($_POST['update'])) {
			$id = $_POST['id'];
			$nama = $_POST['nama'];
			$nilai = $_POST['nilai'];
			$kriteria = $_POST['kriteria'];
			$stmt2 = $db->prepare("update smart_sub_kriteria set nama_sub_kriteria=?, nilai_sub_kriteria=?, id_kriteria=? where id_sub_kriteria=?");
			$stmt2->bindParam(1, $nama);
			$stmt2->bindParam(2, $nilai);
			$stmt2->bindParam(3, $kriteria);
			$stmt2->bindParam(4, $id);
			if ($stmt2->execute()) {
	?>
		<script type="text/javascript">
			location.href = 'subkriteria.php'
		</script>
	<?php
			} else {
	?>
		<script type="text/javascript">
			alert('Gagal mengubah data')
		</script>
<?php
			}
		}
?>
<form method="post">
	<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
	<label>Sub Kriteria</label>
	<div class="input-control text full-size">
		<input type="text" name="nama" placeholder="Nama Sub Kriteria" value="<?php echo isset($_GET['nama']) ? $_GET['nama'] : ''; ?>">
	</div>
	<label>Nilai</label>
	<div class="input-control text full-size">
		<input type="text" name="nilai" placeholder="Nilai Sub Kriteria" value="<?php echo isset($_GET['nilai']) ? $_GET['nilai'] : ''; ?>">
	</div>
	<label>Kriteria</label>
	<div class="input-control select full-size">
		<select name="kriteria">
			<option value="<?php echo isset($_GET['kriteria']) ? $_GET['kriteria'] : ''; ?>"><?php echo isset($_GET['kriteria']) ? $_GET['kriteria'] : ''; ?></option>
			<?php
			$stmt3 = $db->prepare("select * from smart_kriteria");
			$stmt3->execute();
			while ($row3 = $stmt3->fetch()) {
			?>
				<option value="<?php echo $row3['id_kriteria'] ?>"><?php echo $row3['nama_kriteria'] ?></option>
			<?php
			}
			?>
		</select>
	</div>
	<?php
		if (isset($_GET['id'])) {
	?>
		<button type="submit" name="update" class="button warning">Update</button>
	<?php
		} else {
	?>
		<button type="submit" name="simpan" class="button primary">Simpan</button>
	<?php
		}
	?>
</form>
<?php
	} else if ($page == 'hapus') {
?>
	<div class="cell colspan2 align-right">
	</div>
	</div>
	<?php
		if (isset($_GET['id'])) {
			$stmt = $db->prepare("delete from smart_sub_kriteria where id_sub_kriteria='" . $_GET['id'] . "'");
			if ($stmt->execute()) {
	?>
			<script type="text/javascript">
				location.href = 'subkriteria.php'
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
				<th width="50">No</th>
				<th>Kriteria</th>
				<th>Sub Kriteria</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$stmt = $db->prepare("select * from smart_kriteria");
			$stmt->execute();
			$no = 1;
			while ($row = $stmt->fetch()) {
			?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $row['nama_kriteria'] ?></td>
					<td>
						<?php
						//$stmt2 = $db->prepare("select * from smart_sub_kriteria a left join smart_kriteria b on a.id_kriteria=b.id_kriteria");
						$stmt2 = $db->prepare("select * from smart_sub_kriteria where id_kriteria='" . $row['id_kriteria'] . "'");
						$stmt2->execute();
						while ($row2 = $stmt2->fetch()) {
						?>
							<?php echo $row2['nilai_sub_kriteria'] ?>&nbsp;<?php echo $row2['nama_sub_kriteria'] ?>&nbsp;
							<a href="?page=form&id=<?php echo $row2['id_sub_kriteria'] ?>&nama=<?php echo $row2['nama_sub_kriteria'] ?>&nilai=<?php echo $row2['nilai_sub_kriteria'] ?>&kriteria=<?php echo $row2['id_kriteria'] ?>" style="color:orange;"><span class="mif-pencil icon"></span></a>
							<a href="?page=hapus&id=<?php echo $row2['id_sub_kriteria'] ?>" style="color:red;"><span class="mif-cancel icon"></span></a><br />
						<?php
						}
						?>
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