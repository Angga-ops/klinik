<?php
	date_default_timezone_set('Asia/Jakarta');
	error_reporting('0');
	function sambung($db='rumah_sakit', $host='localhost', $user='root', $pass=''){
    @mysql_connect($host,$user,$pass) or die('<strong style="color: red;">Gagal Terhubung ke database '.mysql_error().'</strong>');
    @mysql_select_db($db) or die('<strong style="color: red;">Gagal Memilih database</strong>');;
	};
	function catat($us,$text){
		$now=date('Y-m-d H:i:s');
		$peng=mysql_real_escape_string($us);
		$aksi=mysql_real_escape_string($text);
			$insert=mysql_query("INSERT INTO log SET username = '$peng', aksi = '$aksi', tanggal = '$now'");
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
			@mysql_connect($this->h,$this->u,$this->p);
			@mysql_selectdb($this->d);
		}
		public function sql($query){
			//$this::sambungDB();
	
			$this->query=mysql_query($query);
		}
		public function hasil(){
			$this->hasil=mysql_fetch_array($this->query);
			return $this->hasil;
		}
		public function getJml(){
			//$this::sambungDB();
			return mysql_num_rows($this->query);
		}
		public function baris($sql){
			//$this::sambungDB();
			$this->baris=mysql_query($sql);
			return mysql_num_rows($this->baris);
		}
		public function single($sql){
			$query=mysql_query($sql);
			return @mysql_result($query,0);
		}
	}
	
	function cek_user($user='admin', $redir='media.php?module=home'){
		$sesi=$_SESSION['leveluser'];
		if(!($sesi==$user || $sesi==$or)){
			header('location: '.$redir.'');
		}
	}
?>