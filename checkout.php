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
    <title>Mebellic | Checkout</title>

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
        <?php require 'ui/header.php';?>
        <!-- Header Area End -->
            <?php 
                $sql1 = "SELECT id_produk FROM keranjang WHERE id_session = '".$sid."'";
                    $rslt1 = mysqli_query($koneksi, $sql1);
                    $dt_id = mysqli_fetch_array($rslt1);
                    $id_produk = $dt_id['id_produk'];
            ?>

        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

        <div class="container">
    <div class="py-5 text-center">
        
        <h2>Checkout</h2>
        
    </div>
    <?php 
        $sql = "SELECT * FROM keranjang, produk WHERE id_session = '".$sid."' AND keranjang.id_produk=produk.id_produk";
        $result = mysqli_query($koneksi, $sql);
        $jumlahItem = mysqli_num_rows($result);
    ?>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your Cart</span>
                <span class="badge badge-secondary badge-pill"><?= $jumlahItem; ?></span>
            </h4>
            <ul class="list-group mb-3 sticky-top">
                <?php
                        $total = 0;
                        while($data = mysqli_fetch_array($result)){
                        $subtotal = $data['last_price'] * $data['jumlah'];
                        $total = $total + $subtotal;
                        $totalHarga =+ $total;
                        $paid = (100-$data['diskon'])/100 * $totalHarga;
                                   
                    ?>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0"><?= $data['nama_produk']; ?> x <?= $data['jumlah']; ?></h6>
                    </div>
                    <?php 
                        if($data['diskon'] == "0"){
                            echo '
                                 <span class="text-muted">Rp '.number_format($subtotal,0,".",".").'</span>
                            ';
                        }else{
                            echo '
                                 <span class="text-muted">Rp '.number_format($subtotal,0,".",".").'</span>
                            ';
                        }
                        ?>
                </li>
                <?php } ?>
                <li class="list-group-item d-flex justify-content-between bg-light">
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total </span>
                    <strong><?= "Rp ".number_format($totalHarga,0,".","."); ?></strong>
                </li>
            </ul>
            <!-- <form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
            </form> -->
        </div>
        <?php       

                    if(isset($_POST['pesan'])){
                            
                        if($_SERVER['REQUEST_METHOD'] == "POST"){


                            
                            date_default_timezone_set('Asia/Jakarta');
                            $regdate = date('Y-m-d');
                            $regtime = date('G:i:s');
                            $alamat = $_POST['alamat'];
                            $nama = $_POST['nama'];
                            $notelp = $_POST['notelp'];
                            $email = $_POST['email'];
                            $pay = $_POST['pay'];
                            $metode = $_POST['metode'];
                                if($metode == "bank"){
                                  $in = "checked";
                                }elseif($metode == "cod"){
                                  $out = "checked";
                                }

                            $produk_id = $_POST['id_produk'];
                            $img = $_POST['img-produk'];
                            $nama_item = $_POST['nama-item'];
                            $jumlah = $_POST['jumlah'];
                            $price = $_POST['price'];
                            $discount = $_POST['discount'];
                            $cartid = $_POST["cartid"];
                            
                            // $idid = $_POST['order_id'];
                            // $order_id = $idid+1;

                            $query = "SELECT MAX(order_id) AS last_order_id FROM order_detail";
                            $last_order_id = $row['last_order_id'];
                            $new_order_id = $last_order_id + 1;

                        }
                            mysqli_query($koneksi,"INSERT INTO checkout VALUES('','".$sid."','$nama','$notelp','$email','$alamat','$metode','packed','$pay','$regdate','$regtime','PENDING')");
                            $jumlah_dipilih = count($cartid);

                            for($x=0;$x<$jumlah_dipilih;$x++){
                            mysqli_query($koneksi,"INSERT INTO order_detail VALUES('','$order_id','$img[$x]','$produk_id[$x]','$nama_item[$x]','$jumlah[$x]','$discount[$x]','$price[$x]')");
                            }
                                echo "<script>
                                        alert ('Order Successful');
                                        document.location.href = 'konfirmasi-pesanan.php';
                                      </script> ";
                    } 
        ?>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Order Address</h4>
            <form class="needs-validation" action="" method="post">
                <input type="hidden" name="pay" value="<?= $totalHarga; ?>">
                <div class="row">
                </div>
                <div class="mb-3">
                    <label for="username">Order Name</label>
                    <div class="input-group">
                        <input type="text" name="nama" class="form-control" id="username" placeholder="Enter the Order Name" required="">
                        <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="notelp">No. Handphone</label>
                    <input type="text" name="notelp" class="form-control" id="address" placeholder="Enter No. Handphone" required="">
                    <div class="invalid-feedback"> Please enter your no. telepon. </div>
                </div>

                <div class="mb-3">
                    <label for="email">Order E-mail <span class="text-muted">(Optional)</span></label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter the Order E-mail">
                    <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                </div>
                <div class="mb-3">
                    <label for="address">Address <span class="text-muted">(Street Name, House No., District, Village and Postal Code)</span></label>
                    <textarea type="text" name="alamat" class="form-control" id="address" placeholder="Enter the Full Address" required=""></textarea>
                    <div class="invalid-feedback"> Please enter your shipping address. </div>
                </div>
                
                    </div>
                </div>
                <hr class="mb-4">
                <h4 class="mb-3">Payment Method</h4>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="bank" name="metode" type="radio" class="custom-control-input" required="" value="bank">
                        <label class="custom-control-label" for="bank">Transfer Bank</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="cod" name="metode" type="radio" class="custom-control-input" required="" value="cod">
                        <label class="custom-control-label" for="cod">COD (Cash on Delivery)</label>
                    </div>
                </div>
                <?php 
                    $sql_3 = "SELECT order_id FROM order_detail ORDER BY order_id DESC LIMIT 1";
                    $result_2 = mysqli_query($koneksi, $sql_3);
                    $data_2 = mysqli_fetch_array($result_2);
                    $order_id = $data_2['order_id'];
                ?>
                <input type="hidden" name="order_id" value="<?= $id_order;?>">
                <?php 
                    $sql2 = "SELECT * FROM keranjang, produk WHERE id_session = '".$sid."' AND produk.id_produk=keranjang.id_produk";
                    $rslt = mysqli_query($koneksi, $sql2);
                    $jumlahItem = mysqli_num_rows($rslt);
                    while ($dt = mysqli_fetch_array($rslt)) { 
                    $img_produk = $dt['img'];
                    $nama_produk = $dt['nama_produk'];
                    $jumlah = $dt['jumlah'];
                    $diskon = $dt['diskon'];
                    $idcart = $dt['id_cart'];
                    $harga = $dt['last_price'];
                    $harga_akhir = $harga * $jumlah;
                ?>
                <hr class="mb-4">
                <input type="hidden" name="id_produk[]" value="<?= $id_produk; ?>">
                <input type="hidden" name="img-produk[]" value="<?= $img_produk; ?>">
                <input type="hidden" name="nama-item[]" value="<?= $nama_produk; ?>">
                <input type="hidden" name="jumlah[]" value="<?= $jumlah; ?>">
                <input type="hidden" name="discount[]" value="<?= $diskon ?>">
                <input type="hidden" name="price[]" value="<?= $harga_akhir; ?>">
                <input type="hidden" name="cartid[]" value="<?= $idcart; ?>">
                <?php } ?>
                <button class="btn btn-primary btn-lg btn-block profile-button" type="submit" name="pesan">Checkout</button>
            </form>
        </div>
    </div>
                
            </div>
        </div>
        <!-- Product Details Area End -->
    </div>

    
        


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
    <?php  require 'ui/footer.php';?>
    <!-- ##### Footer Area End ##### -->

    <a href="https://api.whatsapp.com/send?phone=62857757236180&text=Hai%20Mebellic" class="wa d-flex align-items-center justify-content-center"><i class="fa fa-whatsapp"></i></a>

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