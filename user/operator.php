<?php
include "../include/header_user.php";
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<div class="row cells4">
	<div class="cell colspan2">
		<h3>Operator</h3>
	</div>
	<?php
	if ($page == 'form') {
	?>
		<div class="cell colspan2 align-right">
			<a href="operator.php" class="button info">Kembali</a>
		</div>
</div>
<p></p>
<?php
		if (isset($_POST['simpan'])) {
			$nama = $_POST['nama'];
			$user = $_POST['user'];
			$pass = ($_POST['pass']);
			$stmt2 = $db->prepare("INSERT INTO smart_admin (nama_admin, username, password) VALUES (?, ?, ?)");
			$stmt2->bindParam(1, $nama);
			$stmt2->bindParam(2, $user);
			$stmt2->bindParam(3, $pass);
			try {
				if ($stmt2->execute()) {
?>
			<script type="text/javascript">
				location.href = 'operator.php'
			</script>
		<?php
				} else {
		?>
			<script type="text/javascript">
				alert('Gagal menyimpan data')
			</script>
		<?php
				}
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}
		if (isset($_POST['update'])) {
			$id = $_POST['id'];
			$nama = $_POST['nama'];
			$user = $_POST['user'];
			$pass = md5($_POST['pass']);
			$stmt2 = $db->prepare("UPDATE smart_admin SET nama_admin=?, username=?, password=? WHERE id_admin=?");
			$stmt2->bindParam(1, $nama);
			$stmt2->bindParam(2, $user);
			$stmt2->bindParam(3, $pass);
			$stmt2->bindParam(4, $id);
			try {
				if ($stmt2->execute()) {
		?>
			<script type="text/javascript">
				location.href = 'operator.php'
			</script>
		<?php
				} else {
		?>
			<script type="text/javascript">
				alert('Gagal mengubah data')
			</script>
<?php
				}
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		}
?>
<form method="post">
	<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
	<label>Nama Lengkap</label>
	<div class="input-control text full-size">
		<input type="text" name="nama" placeholder="Nama Lengkap" value="<?php echo isset($_GET['nama']) ? $_GET['nama'] : ''; ?>">
	</div>
	<label>Username</label>
	<div class="input-control text full-size">
		<input type="text" name="user" placeholder="Nama Pengguna" value="<?php echo isset($_GET['username']) ? $_GET['username'] : ''; ?>">
	</div>
	<label>Password</label>
	<div class="input-control text full-size">
		<input type="password" name="pass" placeholder="Kata Sandi">
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
			$stmt = $db->prepare("delete from smart_admin where id_admin='" . $_GET['id'] . "'");
			if ($stmt->execute()) {
	?>
			<script type="text/javascript">
				location.href = 'operator.php'
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
				<th>Username</th>
				<th width="240">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$stmt = $db->prepare("select * from smart_admin");
			$stmt->execute();
			while ($row = $stmt->fetch()) {
			?>
				<tr>
					<td><?php echo $row['id_admin'] ?></td>
					<td><?php echo $row['nama_admin'] ?></td>
					<td><?php echo $row['username'] ?></td>
					<td class="align-center">
						<a href="?page=form&id=<?php echo $row['id_admin'] ?>&nama=<?php echo $row['nama_admin'] ?>&username=<?php echo $row['username'] ?>" class="button warning"><span class="mif-pencil icon"></span> Edit</a>
						<a href="?page=hapus&id=<?php echo $row['id_admin'] ?>" class="button danger"><span class="mif-cancel icon"></span> Hapus</a>
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