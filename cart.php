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
    <title>Mebellic | Cart</title>

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
        <?php $active_cart = "active"; require 'ui/header.php';?>
        <!-- Header Area End -->

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2>Shopping Cart</h2>
                        </div>

                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody><?php 
                                    $query = "SELECT * FROM keranjang, produk WHERE id_session = '".$sid."' AND keranjang.id_produk=produk.id_produk";
                                        $result = mysqli_query($koneksi, $query);
                                        $jumlahProduk = mysqli_num_rows($result);
                                        $total = 0;
                                        while($row = mysqli_fetch_array($result)){
                                            $subtotal = $row['last_price'] * $row['jumlah'];
                                            $total    = $total + $subtotal;
                                            $totalHarga =+ $total;
                                            $sale = $row['diskon'];
                                    ?>
                                    <tr>
                                        <td class="cart_product_img">
                                            <a href="#"><img src="img/product-img/<?php echo $row['img']; ?>" alt="Product"></a>
                                        </td>
                                        <td class="cart_product_desc">
                                            <h5><?php echo $row['nama_produk']; ?></h5>
                                        </td>
                                        <td class="price">
                                            <?php 
                                            if($row['diskon'] == "0"){
                                                echo '
                                                    <span>Rp'.number_format($row['harga_produk'],0,".",".").'</span>
                                                ';
                                            }else{
                                                echo '
                                                    <span>Rp '.number_format($row['last_price'],0,".",".").'</span>
                                                    <p><i style="font-size: 16px;color: #747474;">
                                                        <del>Rp '.number_format($row['harga_produk'],0,".",".").'
                                                        </del>
                                                    </i></p>
                                                ';
                                            }
                                        ?>
                                        </td>
                                        <td class="qty">
                                            <div class="qty-btn d-flex">
                                                <div class="quantity">
                                                    <a href="aksi_keranjang2.php?act=minus&id_produk=<?php echo $row['id_produk']; ?>"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                                    <input type="number" class="qty-text" readonly id="qty" step="1" min="1" max="300" name="jumlah" value="<?php echo $row['jumlah']; ?>">
                                                    <a href="aksi_keranjang2.php?act=plus&id_produk=<?php echo $row['id_produk']; ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>Total Produk:</span> <span><?php echo $jumlahProduk; ?></span></li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span> <span><?php echo "Rp ".number_format($totalHarga,0,".","."); ?></span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                                <a href="checkout.php" class="btn amado-btn w-100">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    

    <!-- ##### Footer Area Start ##### -->
    <?php $active_cart = "active"; require 'ui/footer.php';?>
    <!-- ##### Footer Area End ##### -->

    <a href="https://api.whatsapp.com/send?phone=6285883017770&text=Hai%20Mebellic" class="wa d-flex align-items-center justify-content-center"><i class="fa fa-whatsapp"></i></a>

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