<?php
	date_default_timezone_set('Asia/Jakarta');
	error_reporting('0');
	function sambung($db='rumah_sakit', $host='localhost', $user='root', $pass=''){
    @$koneksi= mysqli_connect($host,$user,$pass,$db) or die('<strong style="color: red;">Gagal Terhubung ke database '.mysqli_error($koneksi).'</strong>');;
	};
	function catat($con, $us,$text){
		$now=date('Y-m-d H:i:s');
		$peng=mysqli_real_escape_string($con, $us);
		$aksi=mysqli_real_escape_string($con, $text);
			$insert=mysqli_query($con, "INSERT INTO log SET username = '$peng', aksi = '$aksi', tanggal = '$now'");
			if($insert){
	
			}else{
				echo "<script type='text/javascript'>alert('Pencatatan Log gagal');</script>";
			}
	}
	class db{
		private $h,$u,$p,$d,$query,$baris;
		public $hasil;
	
		public function setDB($ho, $us, $pw, $db){
			$this->h=$ho;
			$this->u=$us;
			$this->p=$pw;
			$this->d=$db;
		}
		public function sambungDB(){
			@mysqli_connect($this->h,$this->u,$this->p,$this->d);
		}
		public function sql($query){
			//$this::sambungDB();
	
			$this->query=mysqli_query($query);
		}
		public function hasil(){
			$this->hasil=mysqli_fetch_array($this->query);
			return $this->hasil;
		}
		public function getJml(){
			//$this::sambungDB();
			return mysqli_num_rows($this->query);
		}
		public function baris($sql){
			//$this::sambungDB();
			$this->baris=mysqli_query($sql);
			return mysqli_num_rows($this->baris);
		}
		public function single($sql){
			$query=mysqli_query($sql);
			return @mysqli_result($query,0);
		}
	}
	
	function cek_user($user='admin', $redir='media.php?module=home'){
		$sesi=$_SESSION['leveluser'];
		if(!($sesi==$user || $sesi==$or)){
			header('location: '.$redir.'');
		}
	}
?>