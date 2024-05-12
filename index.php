<?php
include "./include/config.php";
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>SPK Metode SMART</title>
	<link href="css/metro.css" rel="stylesheet">
	<link href="css/metro-icons.css" rel="stylesheet">
	<link href="css/metro-schemes.css" rel="stylesheet">
	<link href="css/metro-responsive.css" rel="stylesheet">
	<script src="js/jquery.js"></script>
	<script src="js/metro.js"></script>
</head>

<body onload="runPB1()">
	<div class="app-bar">
		<a class="app-bar-element" href="index.php">SPK Metode SMART</a>
	</div>

	<h2 style="text-align:center;margin:100px auto 0 auto;">Login Member</h2>
	<div style="margin:15px auto;width:320px;background:#eee;border:1px solid #ddd;padding:20px;">
		<?php
		if (isset($_POST['username']) && isset($_POST['password'])) {
			$user = $_POST['username'];
			$pass = md5($_POST['password']);
			$stmt = $db->prepare("SELECT * from smart_admin where username=:username and password=:password limit 0,1");
			$stmt->bindParam(':username', $user);
			$stmt->bindParam(':password', $pass);
			$stmt->execute();
			$row = $stmt->fetch();
			if ($row) {
				session_start();
				$_SESSION['id_admin'] = $row['id_admin'];
				$_SESSION['nama_admin'] = $row['nama_admin'];
				$_SESSION['username'] = $row['username'];

				// Redirect based on role
				if ($row['role'] == 'admin') {
					header("Location: ./admin/index.php");
					exit();
				} else {
					header("Location: ./user/index.php");
					exit();
				}
			} else {
		?>
				<script>
					$.Notify({
						caption: 'Maaf',
						content: 'Anda mungkin salah memasukkan username dan password, silahkan coba lagi!',
						type: 'alert'
					});
				</script>
		<?php
			}
		}
		?>
		<form method="post">
			<p></p>
			<!-- input[type=text] -->
			<div class="input-control text full-size">
				<label>Username</label>
				<span class="mif-user prepend-icon"></span>
				<input type="text" name="username" placeholder="admin untuk dasar username" required>
			</div>
			<p></p>
			<!-- input[type=password] -->
			<div class="input-control password full-size">
				<label>Password</label>
				<span class="mif-key prepend-icon"></span>
				<input type="password" name="password" placeholder="admin untuk dasar password" required>
			</div>
			<button type="submit" class="button primary" style="text-align:center;">Masuk</button>
		</form>
	</div>

</body>

</html>