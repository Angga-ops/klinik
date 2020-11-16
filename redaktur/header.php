 <header class="main-header">
    <!-- Logo -->
    <a href="?module=home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CGS</b></span>
      <!-- logo for regular state and mobile devices -->
      <?php $iden = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM identitas")); ?>
      <span class="logo-lg"><b><?php echo $iden['nama_organisasi']; ?><b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         <!-- Notifications Menu -->
         <?php if($_SESSION['jenis_u']=="JU-01"){ ?>
          <?php 
          $date = date('Y-m-d');

          $qq = mysqli_query($con, "SELECT *FROM beli_k WHERE '$date' <= tgl_tempo AND bukti_bayar=''"); 

          $tot = mysqli_num_rows($qq);

          $qp = mysqli_query($con, "SELECT *FROM pengiriman WHERE status='Lapor'");

          $cek = mysqli_num_rows($qp);
          $notif = 0;
          if ($tot>0) {
            $notif++;
          }

          if ($cek>0) {
            $notif++;
          }
          ?>
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $notif;  ?></span>
            </a>
            <ul class="dropdown-menu">
              <?php if ($notif>0) { ?>
              <li class="header">Anda Memiliki <?php echo $notif;  ?> Notifikasi</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <?php 
                  if ($tot>0) { ?>
                   <li><!-- start notification -->
                    <a href="media.php?module=pembayaran_kredit">
                      <i class="fa fa-dollar text-aqua"></i><?php echo $tot; ?> Pembayaran Belum Dilakukan
                    </a>
                  </li>
                  <?php 
                  }

                  if ($cek>0) { ?>
                  <li><!-- start notification -->
                    <a href="media.php?module=pengiriman&act=lapor">
                      <i class="fa fa-truck text-aqua"></i><?php echo $cek; ?> Pengiriman Tidak Sesuai
                    </a>
                  </li>
                  <?php
                  }
                  ?>
                  
                  <!-- end notification -->
                </ul>
              </li>
                <?php
              }else { ?>
                <li class="header">Anda Tidak Memiliki Notifikasi</li>
                <?php
              } ?>
              
            </ul>
          </li>
        <?php } ?>
        <?php if($_SESSION['jenis_u']=="JU-06"){ ?>
          <?php $qq = mysqli_query($con, "SELECT *FROM pengiriman WHERE cabang='$id_kk' AND keterangan='Sedang Proses Pengiriman'"); 
          $tot = mysqli_num_rows($qq);
          ?>
          
          
<li class="dropdown notifications-menu" id="checkout" style="display: none">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"  onclick="chk()">
<i class="fa fa-print" style="color: skyblue"></i>
              <span class="label label-danger">1</span>
              </a>
</li>
          
          
          
          
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php if($tot>0){echo 1;}else{ echo 0;}  ?></span>
            </a>
            <ul class="dropdown-menu">
              <?php if ($tot>0) { ?>
              <li class="header">Anda Memiliki 1 Notifikasi</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="media.php?module=penerimaan">
                      <i class="fa fa-truck text-aqua"></i><?php echo $tot; ?> Pengiriman Barang Akan Sampai
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
                <?php
              }else { ?>
                <li class="header">Anda Tidak Memiliki Notifikasi</li>
                <?php
              } ?>
              
            </ul>
          </li>
        <?php } ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            
              
              <a href="logout.php" ><button type="button" class="btn btn-block btn-danger btn-xs">Logout</button></a>
			 
       
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>