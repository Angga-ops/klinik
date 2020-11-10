<?php
  session_start();
  unlink("error_log");
  include ('../config/koneksi.php');
  include ('../config/kode_otomatis.php');
  include ('../config/fungsi_rupiah.php');
  include ('../config/library.php');
  include ('../config/fungsi_indotgl.php');
  include ('../config/fungsi_combobox.php');
  include ('../config/class_paging.php');
  $id_kk = $_SESSION['klinik'];
  //echo $user['id_ju'];  
  if(empty($_SESSION['jenis_u'])){ 
 $jen= mysql_fetch_assoc(mysql_query("SELECT * FROM jenis_user WHERE id_ju ='".$_SESSION["jenis_ju"]."'"));
  }else{
	$jen= mysql_fetch_assoc(mysql_query("SELECT * FROM jenis_user WHERE id_ju ='".$_SESSION["jenis_u"]."'"));  
  }
//fungsi cek akses user
function user_akses($mod,$id){
  $link = "?module=".$mod;
  $cek = mysql_num_rows(mysql_query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'"));
  return $cek;
}
//fungsi cek akses menu
function umenu_akses($link,$id){
  $cek = mysql_num_rows(mysql_query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'"));
  return $cek;
}
//fungsi redirect
function akses_salah(){
  $pesan = "<script>alert('Akses ilegal'); location.href = '".$url."media.php?module=home';</script>";
  return $pesan;
}

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
?>
<script>
alert("Anda belum login"); location.href = "<?php echo $url;?>/redaktur/index.php";
</script>
<?php
  } else {
    
    $iden = mysql_fetch_assoc(mysql_query("SELECT * FROM identitas"));
	if (($_SESSION['jenis_u']=='JU-01') OR ($_SESSION['jenis_u']=='JU-02')){ 
    $user = mysql_fetch_assoc(mysql_query("SELECT * FROM user WHERE id_user ='".$_SESSION["id_user"]."'"));
	
	} else {
		$user = mysql_fetch_assoc(mysql_query("SELECT * FROM karyawan WHERE id_karyawan ='".$_SESSION["id_user"]."'"));
	}
 
?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $iden['nama_organisasi']; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/Ionicons/css/ionicons.min.css">
      <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $url2; ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $url2; ?>dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo $url2; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/jquery-ui-1.12.1/jquery-ui.min.css">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<!-- jQuery 3 -->
<script  src="<?php echo $url2; ?>bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo $url2; ?>bower_components/chartjs/Chart.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $url2; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Google Font --><!--
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
</head><!--
<a href="https://api.whatsapp.com/send?phone=6281931745058" target="_blank">
<img src="wa.png" class="wabutton" width="180" height="70" alt="WhatsApp-Button" title="Klik Disini Untuk Chat Bantuan Teknis">
</a>-->
<style>
.wabutton{
position:fixed;
bottom:20px;
right:20px;
z-index:100;
}
</style>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php include 'header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
	 <div class="user-panel">
        <div class="pull-left image">
		<?php 
		if ($_SESSION['jenis_u']=='JU-01' OR $_SESSION['jenis_u']=='JU-02'){?>		
          <img src="<?php echo $url;?>/file_user/foto_user/<?php echo $user['foto']; ?>" class="img-circle" alt="User Image">
		<?php }  else { ?>
		<img src="<?php echo $url;?>/foto_karyawan/<?php echo $user['foto']; ?>" class="img-circle" alt="User Image">
		
		<?php } ?>	
			
			
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION["namalengkap"]; ?></p>
         
		     <a href="#"><i class="fa fa-circle text-success"></i> Status : <?php  echo $jen['nama_ju']; ?></a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
        <li>
           <a href="?module=home">
            <i class="fa fa-home"></i> <span>Beranda </span>
          </a>
        </li>
      <?php 
       
    $id   = $_SESSION['id_user'];
	
	
	if (($_SESSION['jenis_u'] == 'JU-01') OR ($_SESSION['jenis_u'] == 'JU-02')){ 
    $data = mysql_fetch_array(mysql_query("SELECT * From user Where id_user='$id'"));
	}else {
		 $data = mysql_fetch_array(mysql_query("SELECT * From karyawan Where id_karyawan='$id'"));
		
	}
    $ju   = $data['id_ju'];
    
    $menu       = mysql_query("SELECT * From sub_menu Where id_ju='$ju' And sts_sm='Aktif' Order by urutan Asc");
      while($data_menu  = mysql_fetch_array($menu)){
      $id_sb        = $data_menu['id_sm'];
                if($data_menu['page_sm']=='' || $data_menu['page_sm']=='#'){ ?>

                  <li class='treeview'>
                    <a href='#'>
                      <i class='fa fa-<?php echo $data_menu['icon_fa']; ?>'></i> <span><?php echo $data_menu['nama_sm']; ?></span>
                      <span class='pull-right-container'>
                        <i class='fa fa-angle-left pull-right'></i>
                      </span>
                    </a>
                    <ul class='treeview-menu'>
              <?php
              $sub_menu   = mysql_query("Select * From menu Where id_sm='$id_sb' And sts_menu='Aktif' Order by nama_menu Asc");
              while($data_sm  = mysql_fetch_array($sub_menu)){
              $id_sm      = $data_sm['id_menu'];  ?>
                        
                         <li><a href="?module=<?php echo $data_sm['page_menu']; ?>"><i class="fa fa-circle-o"></i> <?php echo $data_sm['nama_menu']; ?></a></li>
                        <?php } ?>
                        </ul></li>

                <?php } else { ?>

                    <li><a href="?module=<?php echo $data_menu['page_sm']; ?>"><i class="fa fa-<?php echo $data_menu['icon_fa']; ?>"></i><span><?php echo $data_menu['nama_sm']; ?></span>
                    
                    <?php 
                    
                    if($id_sb == "SM-998990"){
                        
                        //pasien utama
                        $utama = mysql_fetch_assoc(mysql_query("SELECT COUNT(id_pasien) AS b FROM perawatan_pasien WHERE id_dr = '$_SESSION[id_user]' AND status IS NULL"));
                        //pasien visit
                        $visit = mysql_fetch_assoc(mysql_query("SELECT COUNT(a.id_pasien) AS b FROM dr_visit a JOIN perawatan_pasien b ON a.no_faktur = b.no_faktur WHERE a.id_dr = '$_SESSION[id_user]' AND b.status IS NULL"));
                        
                        $jmlpas = (int) $utama[b] + (int) $visit[b];
                    
                    ?>
                    
                    <span class="pull-right-container">
              <span class="label label-success pull-right" title="<?php echo $jmlpas; ?> pasien masih dirawat"><?php echo $jmlpas; ?></span>
            </span>
                    
                    <?php } else if($id_sb == "SM-669969"){ 
                      
                      
                      $rujuk = mysql_num_rows(mysql_query("SELECT * FROM rujuk_inap"));
                      
                      
                      ?>
                    
                      <span class="pull-right-container">
              <span class="label label-danger pull-right" title="<?php echo $rujuk; ?> pasien dirujuk inap"><?php echo $rujuk; ?> </span>
                    
                    <?php } ?>
                    </a></li>

                <?php }
                ?>  
          
          <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <?php 
      include('koneksi/konten.php'); 
    ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->  
  <!-- <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer> -->

  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="<?php echo $url2; ?>bower_components/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Morris.js charts -->
<script src="<?php echo $url2; ?>bower_components/raphael/raphael.min.js"></script>

<script src="<?php echo $url2; ?>bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo $url2; ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo $url2; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

<script src="<?php echo $url2; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo $url2; ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo $url2; ?>bower_components/moment/min/moment.min.js"></script>

<script src="<?php echo $url2; ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<!-- <script src="<?php echo $url2; ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo $url2; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo $url2; ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $url2; ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $url2; ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo $url2; ?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $url2; ?>dist/js/demo.js"></script>
<!-- Chart.js -->

<!-- Datatable -->
<script src="<?php echo $url2; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $url2; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- <script src="kasir.js"></script> -->
<script>
$(document).ready(function(){
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  <?php include 'fungsi.js'; ?>

});


var top = -1;
var self = false;
function netbro_cache_analytics(fn,callback){
    return false;
}


<?php


?>

</script>
</body>
</html>

 
  <?php
  }
  ?>