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
    <title>Mebellic | Order Details</title>

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
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="shop1.php">Shop</a></li>
                    <li><a href="cart.php">Cart</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <a href="account.php" class="btn amado-btn mb-15">Account</a>
                <a href="diskon.php" class="btn amado-btn mb-15 active">%Discount%</a>
                <a href="order-detail.php" class="btn amado-btn mb-15">Order Details</a>
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="cart.php" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Cart <span>(0)</span></a>
                <a href="#" class="search-nav"><img src="img/core-img/search.png" alt=""> Search</a>
            </div>
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="https://instagram.com/mebellic_id?utm_medium=copy_link"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

        <!-- Product Details Area Start -->
        <?php   
            $act = @$_GET['KHSCJS'];
            
            switch($act){
              default:
                  
            ?>
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

        <?php 
            $sql_1 = "SELECT * FROM checkout WHERE id_session = '".$sid."' order by order_id DESC" ;
            $result_1 = mysqli_query($koneksi, $sql_1);
            while ($dataa = mysqli_fetch_array($result_1)) {
        ?>
        <article class="card">
        <header class="card-header"> My Order</header>
        <div class="card-body">
            <h6>Order ID: <?= $dataa['order_id'] ?></h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Order Time :</strong> <br><?= $dataa['creation_date']; ?></div>
                    <div class="col"> <strong>Payment Method :</strong> <br> <?= strtoupper($dataa['purchise_type']); ?></div>
                    <div class="col"> <strong>Status:</strong> <br> <?= strtoupper($dataa['payment_status']); ?> </div>
                    <div class="col"> <strong>Tracking #:</strong> <br> BD045903594059 </div>
                </div>
            </article>
            <div class="track">
                <?php if($dataa['payment_status'] == 'packed'){ ?>

                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Confirmation</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Packed</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Sent</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Finished</span> </div>
                    
                <?php } else if ($dataa['payment_status'] == 'sent') { ?>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Confirmation</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Packed</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Sent</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Finished</span> </div>

                <?php } else if ($dataa['payment_status'] == 'finished') { ?>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Confirmation</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Packed</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Sent</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Finished</span> </div>
                <?php } ?>
            </div>
            <hr> <a href="?KHSCJS=DPKACHJES&id=<?= $dataa['order_id'] ?>" class="btn btn-custom" data-abc="true"> <i class="fa fa-chevron-right"></i> More</a>
        </div>
    </article>
    <br><br><br>
    <?php } ?>
                
            </div>
        </div>
    </div>
        <?php
                break;
                case 'DPKACHJES':
            ?>
    <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

        <?php 
            $id = $_GET['id'];
            $sql_1 = "SELECT * FROM checkout WHERE order_id = '".$id."'";
            $result_1 = mysqli_query($koneksi, $sql_1);
            while ($dataa = mysqli_fetch_array($result_1)) {
        ?>
        <article class="card">
        <header class="card-header"> My Order</header>
        <div class="card-body">
            <h6>Order ID: <?= $dataa['order_id'] ?></h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Order Time :</strong> <br><?= $dataa['creation_date']; ?></div>
                    <div class="col"> <strong>Payment Method :</strong> <br> <?= strtoupper($dataa['purchise_type']); ?></div>
                    <div class="col"> <strong>Status :</strong> <br> <?= strtoupper($dataa['payment_status']); ?> </div>
                    <div class="col"> <strong>Tracking #:</strong> <br> BD045903594059 </div>
                </div>
            </article>
            <div class="track">
                <?php if($dataa['payment_status'] == 'packed'){ ?>

                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Confirmation</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Packed</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Sent</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Finished</span> </div>
                    
                <?php } else if ($dataa['payment_status'] == 'sent') { ?>
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Confirmation</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Packed</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Sent</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Finished</span> </div>

                <?php } else if ($dataa['payment_status'] == 'finished') { ?>
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Confirmation</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Packed</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Sent</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Finished</span> </div>
                <?php } ?>
            </div>
            <hr>
            <ul class="row">
                <?php 
                    $sql_4 = "SELECT * FROM checkout INNER JOIN order_detail ON checkout.order_id = order_detail.order_id WHERE order_detail.order_id = '".$id."'" ;
                    $result_4 = mysqli_query($koneksi, $sql_4);
                    while ($data = mysqli_fetch_array($result_4)) { 
                ?>
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="img/product-img/<?= $data['img'] ?>" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title"><?= $data['item_name']; ?></p> <span class="text-muted"><?php echo 'Rp '.number_format($data['price'],0,".",".").''?> </span>
                        </figcaption>
                    </figure>
                </li>  
                <?php } ?>
            </ul>
            <hr> <a href="order-detail.php" class="btn btn-custom" data-abc="true"> <i class="fa fa-chevron-left"></i> </a>
        </div>
    </article>
    <br><br><br>
    <?php } ?>
                
            </div>
        </div>
    </div>
    <?php } ?>
        <!-- Product Details Area End -->
    <!-- Team Area End -->
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
    <?php require 'ui/footer.php';?>
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