<?php
session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
?>
<!DOCTYPE html> <html lang="en"> 
<!-- Mirrored from demo.neontheme.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 May 2019 10:04:47 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head> <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta charset="utf-8"> <meta name="viewport" content="width=device-width, initial-scale=1" />
 <meta name="description" content="" /> 
 <meta name="" content="" /> 
<head>
<title>Halaman Administrator</title>




	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="assets/css/custom.css"  id="style-resource-6">
	<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="assets/js/select2/select2.css"  id="style-resource-2">
	
	
	
	
	<script src="assets/js/jquery-1.10.2.min.js"></script>

 <script src="../tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
  <script src="../tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js" type="text/javascript"></script>

  <?php include "../config/koneksi.php";

$mysql = mysql_fetch_array(mysql_query("select alamat_web from identitas"));?>
  
 
  <script type="text/javascript" src="../bootstrap/js/jquery.js" ></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js" ></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap-tooltip.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap-modal.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap-timepicker.min.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap-dropdown.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="../bootstrap/js/prettify.js"></script>
  
  <style type="text/css">
.form-signin {   
        padding: 10px 10px 10px;
        margin: auto;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
<script type="text/javascript">
  $(function() {
window.prettyPrint && prettyPrint();
			$('#mulai').datepicker({
				format: 'yyyy-mm-dd',
                todayBtn: 'linked'
			});
			$('#akhir').datepicker({
				format: 'yyyy-mm-dd',
                todayBtn: 'linked'
			});
			$('#waktumulai').timepicker({
			    minuteStep: 1,
                showMeridian: false
			});
			$('#waktuakhir').timepicker({
			    minuteStep: 1,
                showMeridian: false
			});
			$('#jadwal').timepicker({
			    minuteStep: 1,
                showMeridian: false
			});
  });
  
  function ubah(by)
  {
		if(by.value=='0')
			document.booking.harga.disabled=true;
		else
			document.booking.harga.disabled=false;
  }
  
  function filetypechanged(rdo)
{
	if(rdo.value=='0')
		document.booking.harga.disabled=true;
	else
		document.booking.harga.disabled=true;
}
  </script>
  <script>/*
	function auto(t){
		setTimeout("location.reload(true);",t);
	} */
  </script>
  </head>
<body class="page-body loaded"  style="background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 140%; background-image: url('images/bg_0009.jpg')">
<div class="page-container">
<div class="sidebar-menu">
<header class="logo-env">
		
		<!-- logo -->
		<div class="logo">
			<a href="media.php?module=home">
				 <strong><span style="font-size:24px;">
				     <img src="images/2020_logo.png" style="width: 56px"/>
				 </i><span style="font-size:20px;">i</span>PASIEN</span></strong>
			</a>
		</div>
		
				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
			<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
				<i class="entypo-menu"></i>
			</a>
		</div>
						
		
		<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
		<div class="sidebar-mobile-menu visible-xs">
			<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
				<i class="entypo-menu"></i>
			</a>
		</div>
		
	</header>
<ul id="main-menu" class="">

<?php include "menu.php"; ?>
</ul>
</div>
<div class="main-content" style="background: rgba(0,0,0,0)">		
<div class="row">
	<!-- Profile Info and Notifications -->
	<div class="col-md-6 col-sm-8 clearfix">
		<ul class="user-info pull-left pull-none-xsm">
			<!-- Profile Info -->
				<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->			
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<?php
						$count = mysql_fetch_array(mysql_query("select img from users where username='$_SESSION[namauser]'")); 
						if($count['img']!=''){
								echo "<img src='../img_foto/small_$count[img]' width='42px' height='42px' alt='' style='background:#ebebeb;border:2px solid #303641;' class='img-circle'> <strong>$_SESSION[namalengkap]</strong>";
						}else{
								 echo "<img src='assets/images/login.png' width='42px' height='42px' alt='' style='background:#ebebeb;border:2px solid #303641;' class='img-circle'> <strong>$_SESSION[namalengkap]</strong>";
						}
					?>
					
				</a>
				<ul class="dropdown-menu">
					<!-- Reverse Caret -->
					<li class="caret"></li>
					<!-- Profile sub-links -->
					<li>
							<a href="media.php?module=user&act=edituser&id=<?php $q_session = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$_SESSION[namauser]'")); echo $q_session[id_session];?>">Edit profile</a>
						
					</li>
					
				</ul>
			</li>
		</ul>
	</div>
	
	
	<!-- Raw Links -->
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		<ul class="list-inline links-list pull-right">
	
			<li class="sep"></li>
			<li>
				<a href="https://rspkugombong.com/" target="blank">Live Site</a>
			</li>
			<li class="sep"></li>
			<li>
				<a href="logout.php">
					Log Out <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
	</div>
	
</div>
<hr>
		<?php include "content.php"; 
		?>

</div>
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#mytable").dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
	
</script>
</div>
    <link rel="stylesheet" href="assets/js/jvectormap/jquery-jvectormap-1.2.2.css"  id="style-resource-1">
	<link rel="stylesheet" href="assets/js/rickshaw/rickshaw.min.css"  id="style-resource-2">
	<link rel="stylesheet" href="assets/js/dropzone/dropzone.css"  id="style-resource-1">
	<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="assets/js/select2/select2.css"  id="style-resource-2">
	<link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css"  id="style-resource-3">
	<link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css"  id="style-resource-4">

	<script src="assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="assets/js/joinable.js" id="script-resource-4"></script>
	<script src="assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js" id="script-resource-7"></script>
	<script src="assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js" id="script-resource-8"></script>
	<script src="assets/js/bootstrap-switch.min.js" id="script-resource-7"></script>
	<script src="assets/js/jquery.validate.min.js" id="script-resource-7"></script>
	<script src="assets/js/jquery.sparkline.min.js" id="script-resource-9"></script>
	<script src="assets/js/rickshaw/vendor/d3.v3.js" id="script-resource-10"></script>
	<script src="assets/js/rickshaw/rickshaw.min.js" id="script-resource-11"></script>
	<script src="assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="assets/js/bootstrap-tagsinput.min.js" id="script-resource-8"></script>
	<script src="assets/js/typeahead.min.js" id="script-resource-9"></script>
	<script src="assets/js/selectboxit/jquery.selectBoxIt.min.js" id="script-resource-10"></script>
	<script src="assets/js/jquery.mousewheel-3.0.4.pack.js" id="script-resource-10"></script>
	<script src="assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
	<script src="assets/js/bootstrap-timepicker.min.js" id="script-resource-12"></script>
	
	<script src="assets/js/raphael-min.js" id="script-resource-12"></script>
	<script src="assets/js/bootstrap-colorpicker.min.js" id="script-resource-13"></script>
	<script src="assets/js/daterangepicker/moment.min.js" id="script-resource-14"></script>
	<script src="assets/js/daterangepicker/daterangepicker.js" id="script-resource-15"></script>
	<script src="assets/js/fileinput.js" id="script-resource-7"></script>
	<script src="assets/js/jquery.multi-select.js" id="script-resource-16"></script>
	<script src="assets/js/morris.min.js" id="script-resource-13"></script>
	<script src="assets/js/toastr.js" id="script-resource-14"></script>
	<script src="assets/js/neon-chat.js" id="script-resource-15"></script>
	<script src="assets/js/neon-custom.js" id="script-resource-16"></script>
	<script src="assets/js/neon-demo.js" id="script-resource-17"></script>
	<script type="text/javascript">
		/*
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-28991003-3']);
		_gaq.push(['_setDomainName', 'laborator.co']);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);
		
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		*/
		var self = 0; var top = 1;
		
	</script>
</body>
</html>
<?php
}
}
?>
