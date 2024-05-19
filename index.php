<?php 
error_reporting(E_ALL ^ E_NOTICE);

session_start();
$sid = $_SESSION['id_users'];

require 'functions.php';
if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Mebellic | Home</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.png">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <?php $active_home = "active"; require 'ui/header.php';?>
        <!-- Header Area End -->

        <!-- Product CatagorSies Area Start -->
        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix">
                <?php
                $perpage = 25;
                $page = isset($_GET['page']) ? $_GET['page'] : "";
                
                if(empty($page)){
                    $num = 0;
                    $page = 1;
                }else{
                    $num = ($page - 1) * $perpage;
                }

                
                $query = "SELECT * FROM produk INNER JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE produk.tersedia = 'Ada' ORDER by id_produk DESC LIMIT $num, $perpage";
                $result = mysqli_query($koneksi, $query);
                while($row = mysqli_fetch_array($result)){
                    // $totalDisc = $row['price']-($row['price'] * $row['discount']/100);
                    // $sale = $row['discount'];
                    
                ?>


                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    <a href="shop.php?id=<?php echo $row['id_produk']; ?>">
                        <img src="img/product-img/<?php echo $row['img']; ?>"alt="#"/>
                        <!-- <?php if($row['discount']){
                                    echo ' <span class="sale-tag"> ';
                                    echo $row['discount']; 
                                    echo '%'; '</span>';
                            }
                         ?> -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>
                                <?php echo '<span>Rp. '.number_format($row['harga_produk'],0,".",".").'</span>';?>
                            </p>
                            <h4>
                                <?php echo $row['nama_produk']; ?>
                            </h4>
                        </div>
                    </a>
                </div>
            <?php  } ?>
            </div>
        </div>
        <!-- Product Catagories Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- Start Shop Services Area -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="fa fa-truck"></i>
                        <h4>Free Shipping</h4>
                        <p>Minimum Rp. 500,000</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="fa fa-undo"></i>
                        <h4>Free Returns</h4>
                        <p>Within 7 Days Return</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="fa fa-lock"></i>
                        <h4>Secure Payment</h4>
                        <p>100% Secure Payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="fa fa-tag"></i>
                        <h4>Best Quality</h4>
                        <p>Best Price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services Area -->

    <!-- ##### Footer Area Start ##### -->
    <?php $active_home = "active"; require 'ui/footer.php';?>
    <!-- ##### Footer Area End ##### -->

    <a href="https://api.whatsapp.com/send?phone=6285775723618&text=Hai%20Mebellic" class="wa d-flex align-items-center justify-content-center"><i class="fa fa-whatsapp"></i></a>

    

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>

</html>