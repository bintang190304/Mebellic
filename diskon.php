<?php 
error_reporting(E_ALL ^ E_NOTICE);

session_start();
$sid = $_SESSION['id_users'];

require 'functions.php';
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
    <title>Mebellic | Shop - Product Discount</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.png">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
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
        <?php  require 'ui/header.php';?>
        <!-- Header Area End -->

        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">
                <div class="row"><!-- Single Product Area -->
                    <?php
                    $perpage = 20;
                    $page = isset($_GET['page']) ? $_GET['page'] : "";
                    
                    if(empty($page)){
                        $num = 0;
                        $page = 1;
                    }else{
                        $num = ($page - 1) * $perpage;
                    }

                    
                    $query = "SELECT * FROM produk INNER JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE produk.diskon >= 1 ORDER by id_produk DESC LIMIT $num, $perpage";
                    $result = mysqli_query($koneksi, $query);
                    while($row = mysqli_fetch_array($result)){
                        $totalDisc = $row['harga_produk']-($row['harga_produk'] * $row['diskon']/100);
                        $sale = $row['diskon'];
                        ?>

                        <!-- Single Product Area -->
                        <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <a href="shop.php?id=<?php echo $row['id_produk']; ?>">
                                        <img src="img/product-img/<?php echo $row['img']; ?>"alt="#"/>
                                    </a>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description d-flex align-items-center justify-content-between">
                                    <!-- Product Meta Data -->
<!--                                 <?php if($row['diskon']){
                                    echo ' <span class="sale-tag"> ';
                                    echo $row['diskon']; 
                                    echo '%'; '</span>';
                                    }
                                ?> -->
                                <div class="product-meta-data">
                                    <div class="line"></div>
                                    <p class="product-price">
                                       <?php 
                                       if($row['diskon'] == "0"){
                                        echo '
                                        <span>Rp'.number_format($row['harga_produk'],0,".",".").'</span>
                                        ';
                                    }else{
                                        echo '
                                        <span>Rp '.number_format($totalDisc,0,".",".").'</span>
                                        <i style="font-size: 16px;">
                                        <del style="u">Rp '.number_format($row['harga_produk'],0,".",".").'
                                        </del>
                                        </i>
                                        ';
                                    }
                                    ?>
                                </p>
                                <a href="shop.php?id=<?php echo $row['id_produk']; ?>">
                                    <h6><?php echo $row['nama_produk']; ?></h6>
                                </a>
                            </div>
                            <!-- Ratings & Cart -->
                            <div class="ratings-cart text-right">
                                <!-- <div class="ratings">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                                <div class="cart">
                                    <a href="cart.html" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="img/core-img/cart.png" alt=""></a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
<!-- ##### Main Content Wrapper End ##### -->



<!-- ##### Footer Area Start ##### -->
<?php $active_diskon = "active"; require 'ui/footer.php';?>
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