<?php 

include "../config/koneksi.php";

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php $i= mysqli_fetch_array(mysqli_query($con,"SELECT *FROM identitas")); ?>
    <!-- Title -->
    <title><?php echo $i['nama_organisasi']; ?></title>

    <!-- Favicon -->
    <link rel="icon" href="../file_user/foto_identitas/<?php echo $i['logo']; ?>">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../redaktur/assets/css/style.css">
    <link rel="stylesheet" href="../redaktur/assets/login/css/style.css">
    <link rel="stylesheet" href="../redaktur/assets/login/css/bootstrap.min.css">

    <link rel="stylesheet" href="../redaktur/assets/login/css/default-assets/classy-nav.css">

</head>
<!--
<a href="https://api.whatsapp.com/send?phone=6281931745058&amp;text=Anda perlu bantuan, silahkan klik tombol KIRIM" target="_blank">
<img src="../redaktur/wa.png" class="wabutton" width="180" height="70" alt="WhatsApp-Button" title="Klik Disini Untuk Chat Bantuan Teknis">
</a>
<style>
.wabutton{
position:fixed;
bottom:20px;
right:20px;
z-index:100;
}
</style>
-->
<body >
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- /Preloader -->

    <!-- Header Area Start -->
    <header class="header-area">
        <!-- Top Header Area Start -->
        <div class="top-header-area" style="background-color: #2E8B57;">
            <!-- <div class="container">
                <div class="row  align-items-center">
                    <div class="col-5">
                        <div class="top-header-content">
                            <small style="color: white;">Sistem Informasi Surat</small>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="top-header-content text-right">
                            <small style="color: white;">@2019 Version 1.0</small>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- Top Header Area End -->

        <!-- Main Header Start -->
        <div class="main-header-area" >
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar left-content-between" id="akameNav">

                        <!-- Logo -->
                        <img src="../file_user/foto_identitas/<?php echo $i['logo']; ?>" width="60px;" height="61px;">
                            &emsp;<?php echo $i['nama_organisasi']; ?>
<br>
                            &emsp;<?php echo $i['alamat']; ?>


                        <div class="classy-menu">
                            <!-- Menu Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul id="nav">
                                    
                                </ul>

                                <!-- Cart Icon -->
                                <div class="cart-icon ml-5 mt-4 mt-lg-0">
                                   <!--  <a href="#"><i class="icon_cart"></i></a> -->
                                </div>
                                <div class="cart-icon ml-5 mt-4 mt-lg-0">
                                   <!--  <a href="#"><i class="icon_cart"></i></a> -->
                                </div>
                                <div class="cart-icon ml-5 mt-4 mt-lg-0">
                                   <!--  <a href="#"><i class="icon_cart"></i></a> -->
                                </div>
                                <div class="cart-icon ml-5 mt-4 mt-lg-0">
                                   <!--  <a href="#"><i class="icon_cart"></i></a> -->
                                </div>
                                <div class="cart-icon ml-5 mt-4 mt-lg-0">
                                   <!--  <a href="#"><i class="icon_cart"></i></a> -->
                                </div>
                                <div class="cart-icon ml-5 mt-4 mt-lg-0">
                                   <!--  <a href="#"><i class="icon_cart"></i></a> -->
                                </div>
                                <div class="cart-icon ml-5 mt-4 mt-lg-0">
                                   <!--  <a href="#"><i class="icon_cart"></i></a> -->
                                </div>
                                <div class="cart-icon ml-5 mt-4 mt-lg-0">
                                   <!--  <a href="#"><i class="icon_cart"></i></a> -->
                                </div>

                                <!-- Book Icon -->
                                <div class="book-now-btn ml-5 mt-4 mt-lg-0 ml-md-4">
                                    <!-- <img src="./img/core-img/bg5.png"> -->
                                </div>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <!-- Welcome Area Start -->
    
    <!-- Welcome Area End -->

    <!-- About Area Start -->
   
    <!-- About Area End -->

    <!-- Border -->
    

    <!-- Our Service Area Start -->
    <section class="akame-service-area" style="padding-top: 20px; background-color: #00cccc; background-position: center;
    background-repeat: no-repeat;
    background-size: cover;width:100%">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="text-center">
                        <h2><b>Silahkan Login</b></h2>
                        <p><b>Masukkan Username dan Password dengan benar</b></p>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Single Service Area -->
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="single-service-area mb-80 wow fadeInUp" data-wow-delay="200ms">
                        <form action="cek_login.php" method="post" class="akame-contact-form border-0 p-0">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-3">
                               
                            </div>
                            <div class="col-12 col-lg-6">
                               <input type="text" name="username" class="form-control mb-30" placeholder="Username">
                            </div>
                        </div>
                         <div class="row align-items-center">
                            <div class="col-12 col-lg-3">
                               
                            </div>
                            <div class="col-12 col-lg-6">
                                <input type="password" name="password" class="form-control mb-30" placeholder="Password">
                            </div>
                        </div>
                      
                            <div class="col-12 text-center">
                                <button type="submit" name="submit" class="btn btn-primary col-md-6">Login</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>

                <!-- Single Service Area -->

            </div>
        </div>
        
    <!-- Our Service Area End -->

    <!-- Why Choose Us Area Start -->
    
    <!-- Why Choose Us Area End -->

    <!-- Portfolio Area Start -->
    
    <!-- Portfolio Area End -->

    <!-- Our Expert Area Start -->
    
    <!-- Our Expert Area End -->

    <!-- Border -->
    <!-- <div class="container">
        <div class="border-top mt-3"></div>
    </div> -->

    <!-- Blog Area Start -->

    <!-- Blog Area End -->

    <!-- Call To Action Area Start -->
    
    <!-- Call To Action Area End -->

    <!-- Footer Area Start -->
    <footer class="footer" style="background-color: #2F4F4F; color: white; padding-top: 10px;">
        <div class="container">
            <div class="row justify-content-between">

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single-footer-widget">
                        <!-- Footer Logo -->
                        <p class="mb-30" style="background-color: #2F4F4F; color: white;"><?php echo $i['alamat']; ?>
</p>

                        <!-- Copywrite Text -->
                        
                    </div>
                </div>

                <!-- Single Footer Widget -->

                <!-- Single Footer Widget -->
                <div class="col-12 col-md-4 col-xl-3">
                    <div class="single-footer-widget">
                        <!-- Contact Address -->
                        <div class="contact-address">
                            <p><b style=" color: white;"><?php echo $i['nama_organisasi']; ?></b></p>
                            <small>..............</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    
        </main><!-- Page Content -->

    
    <!-- /.social-auth-links -->

<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../redaktur/assets/login/js/jquery.min.js"></script>
    <!-- Popper -->
    <script src="../redaktur/assets/login/js/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="../redaktur/assets/login/js/bootstrap.min.js"></script>
    <!-- All Plugins -->
    <script src="../redaktur/assets/login/js/akame.bundle.js"></script>
    <!-- Active -->
    <script src="../redaktur/assets/login/js/default-assets/active.js"></script>

</body>

</html>

<!--
   -->