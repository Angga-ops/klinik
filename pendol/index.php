<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set('Asia/Jakarta');
?>
<head>
<title>Halaman Pendaftaran Pasien</title>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css" id="style-resource-1"> 
 <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css" id="style-resource-2"> 
 <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic" id="style-resource-3">
 <link rel="stylesheet" href="assets/css/bootstrap.css" id="style-resource-4"> 
 <link rel="stylesheet" href="assets/css/neon-core.css" id="style-resource-5">
 <link rel="stylesheet" href="assets/css/neon-theme.css" id="style-resource-6">
 <link rel="stylesheet" href="assets/css/neon-forms.css" id="style-resource-7">
 <link rel="stylesheet" href="assets/css/custom.css" id="style-resource-8"> 
 <script src="assets/js/jquery-1.11.3.min.js"></script> 
</head>
<body class="page-body login-page login-form-fall" style="background-repeat: no-repeat; background-size: 100% 140%; background-image: url('images/bg_0009.jpg')">
    <style>
        .login-caret:after {
            border-color: rgba(255,182,0,0.25) transparent transparent transparent !important;
        }
    </style>
	<div class="login-container">
		<div class="login-header login-caret"  style="background: linear-gradient(180deg, rgba(12,121,9,0.25) 0%, rgba(255,182,0,0.25) 100%)">
			<div class="login-content">
			<a href="" class="logo"><img class="img-circle" width='100px' height='100px' src="images/2020_logo.png"></a>
			<h3 style="color:#fff;"><strong><span style="font-size:24px;"><i class="entypo-upload-cloud"></i><span style="font-size:20px;">i</span>PASIEN</span></strong></h3>
			<!-- progress bar indicator -->
				<div class="login-progressbar-indicator">
					<h3>43%</h3>
					<span>logging in...</span>
				</div>
			</div>	
		</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	<div class="login-form"><div class="login-content">
	<form method="post"  action="cek_login.php" method="POST">
	
	<div class="form-group">
							<?php
			if (!empty($_GET['msg'])){
				if($_GET['msg']==1){
					echo '<div class="alert alert-danger" ><strong>No Member</strong> dan <strong>Tanggal Lahir</strong> tidak boleh kosong.</div>';
				}elseif ($_GET['msg']==2){
					echo '<div for="username" class="alert alert-danger" >Pastikan <strong>No Member</strong> / <strong>Tanggal Lahir</strong> benar !</div>';
				}
			}
		?>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="username" id="username" placeholder="No Member" autocomplete="off" />
					</div>
					
				</div>
               <div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						<input type="password" class="form-control" name="password"  placeholder="Tanggal Lahir (contoh: 02122019)" autocomplete="off" /> 
						
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-success btn-block btn-lg">
						<i class="entypo-login"></i>
						Masuk
					</button>
				</div>
			
 <span class="pull-left" style="color: rgba(0,0,0,0.75);"><strong style="color: white">&copy; <?php $waktu= date("Y"); echo"$waktu "?> Klinik Surya Medika Satui</strong></span>
                    
</form>
	                
</div>   
</div>
</div>
	<script src="assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="assets/js/joinable.js" id="script-resource-4"></script>
	<script src="assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="assets/js/jquery.validate.min.js" id="script-resource-7"></script>
	<script src="assets/js/neon-login.js" id="script-resource-8"></script>
	<script src="assets/js/neon-custom.js" id="script-resource-9"></script>
	<script src="assets/js/neon-demo.js" id="script-resource-10"></script>
	
	
	

</body>
</html>
