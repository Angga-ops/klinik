<?php
	session_start();
	include "../../../config/koneksi.php";

	if (isset($_POST['submit'])) {
		$chkarr = $_POST['checkbox'];
		$klaster = $_POST['klaster'];
		foreach ($chkarr as $id) {
			mysqli_query($con, "Update pasien Set klaster='$klaster' Where id='$id'");
		}
		header('location:../../media.php?module=terapkan_pelanggan');
	}
	?>