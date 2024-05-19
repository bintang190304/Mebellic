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
    <title>Mebellic | Profile Account</title>

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

        <!-- Product Details Area Start -->
        <?php
          $query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_users = '".$sid."'");
          $data = mysqli_fetch_array($query);
          
          $error = false;
          if(isset($_POST['save'])){
            $gambarLama = $_POST['gambarLama'];
                
            if($_SERVER['REQUEST_METHOD'] == "POST"){
              
              if(empty($_POST['username'])){
                $error = true;
                $username = $_POST['usernameLama'];
              }else{
                $username = $_POST['username'];
                
              }
                  
              if(empty($_POST['email'])){
                $error = true;
                $email = $_POST['emailLama'];
              }else{
                $email = $_POST['email'];
              }

              if(empty($_POST['alamat'])){
                $error = true;
                $alamat = $_POST['alamatLama'];
              }else{
                $alamat = $_POST['alamat'];
              }

              if(empty($_POST['notelp'])){
                $error = true;
                $no_telp = $_POST['noLama'];
              }else{
                $no_telp = $_POST['notelp'];
              }
            }
            
             
            $bgImg = $_FILES['img-profil']['name'];
            $bgImgNew = date("md").$bgImg;

            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $bgImgNew);
            $ekstensiGambar = strtolower(end($ekstensiGambar));

            $newImage = uniqid();
            $newImage .= '.';
            $newImage .= $ekstensiGambar;
            
            
            if(move_uploaded_file($_FILES['img-profil']['tmp_name'],"img/profil-img/".$newImage)){
              $sql = mysqli_query($koneksi, "SELECT gambar FROM users WHERE id_users='".$sid."'");
              $img = mysqli_fetch_array($sql);
                  
              if(is_file("img/profil-img".$img['gambar'])){
                unlink("img/profil-img".$img['gambar']);
              }
              if ($_FILES['gambar']['error'] === 4){
                                $foto = $gambarLama;
                            }else{
                                $foto = $newImage;
                            }
              mysqli_query($koneksi,"UPDATE users SET gambar='$foto' WHERE id_users='".$sid."'");
            }

              mysqli_query($koneksi,"UPDATE users SET username='$username',email='$email',alamat='$alamat',no_telp='$no_telp' WHERE id_users='".$sid."'");
              echo "<script>
                                            alert ('Profil berhasil diubah');
                                            document.location.href = 'account.php';
                                        </script> ";
            }
    ?>
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

        <div class="row">
        <div class="col-md-3 border-right">
                <form action="" method="POST" enctype="multipart/form-data">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <?php  
                    if ($data['gambar']) { ?>
                        <img class="img-fluid" name="img-profil" src="img/profil-img/<?php echo $data['gambar']; ?>" id="gambar_nodin">
                    <?php } else { ?>
                        <img src="images/bg.jpg" name="img-profil" class="img-fluid" id="gambar_nodin">
                    <?php } ?>
                <input type="hidden" name="gambarLama" value="<?php echo $data['gambar']; ?>">
                <input type="file" name="img-profil" id="img-profil" style="display: none;">
                <span class="font-weight-bold"><label><?php echo $data['username'];?></label></span><span class="text-black-50"><?php echo $data['email'];?></span><span>
                <!-- <label class="btn btn-primary profile-button" for="img-profil">Upload Gambar</label> -->
        </div></span></div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username" value="<?php echo $data['username']; ?>">
                        <input type="hidden" name="usernameLama" value="<?php echo $data['username'];?>" Autocomplete="off">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Email Address</label>
                        <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $data['email']; ?>">
                        <input type="hidden" name="emailLama" value="<?php echo $data['email'];?>" Autocomplete="off">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">No. Handphone</label>
                        <input type="text" name="notelp" class="form-control" placeholder="Enter No. Telepon" value="<?php echo $data['no_telp']; ?>">
                        <input type="hidden" name="noLama" value="<?php echo $data['no_telp'];?>" Autocomplete="off">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Full Address</label>
                        <textarea class="form-control" name="alamat" placeholder="<?php echo $data['alamat']; ?>" value="<?php echo $data['alamat']; ?>"></textarea>
                        <input type="hidden" name="alamatLama" value="<?php echo $data['alamat'];?>" Autocomplete="off">
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit" name="save">Save Profile</button>
                </div>
                </form>
            </div>
        </div>
        <?php

            $query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_users = '".$sid."'");
            $data = mysqli_fetch_array($query);

            if (isset($_POST["confirm_password"])) {

              $password1 = $_POST['password1'];
              $password2 = $_POST['password2'];

                  if ($password1 !== $password2) {
                        echo "<script>
                                    alert ('password tidak sama');
                                    document.location.href = 'account.php';
                                </script> ";
                        return false;
                    }

                // enkripsi password
                            
                if($_SERVER['REQUEST_METHOD'] == "POST"){

                      $username = $_POST["username"];
                      $password_lama = $_POST["password_lama"];
                      // login dengan email atau username
                      $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

                            $row = mysqli_fetch_assoc($result);
                            $_SESSION['user_id'] = $row['user_id'];
                            $_SESSION['nama'] = $row['nama'];

                            if (password_verify($password_lama, $row["password"])) {
                                // set session 
                                $_SESSION["login"] = true;
                                            $password1 = password_hash($password1, PASSWORD_DEFAULT);

                                mysqli_query($koneksi,"UPDATE users SET password='$password1' WHERE id_users='".$sid."'");
                                  echo "<script>
                                                                alert ('Password berhasil diubah');
                                                                document.location.href = 'account.php';
                                                            </script> ";
                            }else {
                              echo "<script>
                                    alert ('password salah');
                                  </script> ";
                            }
                    }
                $error = true;

            }

            ?>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $data['id_users'] ?>">
                    <input type="hidden" name="username" value="<?php echo $data['username'] ?>">
                    <h5>Ubah Password</h5>
                    <div class="col-md-12">
                        <label class="labels">Current Password</label>
                        <input type="password" name="password_lama" class="form-control" placeholder="Password Saat Ini">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">New Password</label>
                        <input type="Password" class="form-control" placeholder="Password Baru" name="password1">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Confirmation New Password</label>
                        <input type="Password" class="form-control" placeholder="Konfirmasi Password" name="password2">
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit" name="confirm_password">Confirmation</button>
                    </div>
                </form>
            </div>
        </div>
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

    <a href="https://api.whatsapp.com/send?phone=6285775723618&text=Hai%20Mebellic" class="wa d-flex align-items-center justify-content-center"><i class="fa fa-whatsapp"></i></a>

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script type="text/javascript">
    $("#img-profil").change(function(){
   bacaGambar(this);
});
  </script>
  <script type="text/javascript">
  function bacaGambar(input) {
   if (input.files && input.files[0]) {
      var reader = new FileReader();
 
      reader.onload = function (e) {
          $('#gambar_nodin').attr('src', e.target.result);
      }
 
      reader.readAsDataURL(input.files[0]);
    }
  }
  </script>
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