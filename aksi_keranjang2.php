<?php 
session_start();
require 'functions.php';
$sid = $_SESSION['id_users'];



    $act = @$_GET['act'];
    
    switch($act){
    default:

    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga_baru'];
    $id = $_POST['id_produk'];

    
//di cek dulu apakah barang yang di beli sudah ada di tabel keranjang
    $query = mysqli_query($koneksi,"SELECT id_produk FROM keranjang WHERE id_produk = '".$id."' AND id_session ='".$sid."'");
    $row = mysqli_num_rows($query);
    if ($row==0){
        // kalau barang belum ada, maka di jalankan perintah insert
        mysqli_query($koneksi, "INSERT INTO keranjang (id_produk, jumlah, id_session, last_price) VALUES ('".$id."', '".$jumlah."', '".$sid."', '".$harga."')");
    } else {
        //  kalau barang ada, maka di jalankan perintah update
        mysqli_query($koneksi, "UPDATE keranjang SET  jumlah = jumlah +'".$jumlah."' WHERE id_session='".$sid."' AND id_produk = '".$id."'");       
    }   
    header('location: cart.php');

    break;
    case 'plus':
    $id = $_GET['id_produk'];
    $query = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE id_produk = '".$id."' AND id_session ='".$sid."'");
    $row = mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);
    $jumlah = $row['jumlah'];
    $min = 0;
    if ($jumlah > $min){

        mysqli_query($koneksi, "UPDATE keranjang SET  jumlah = jumlah + 1 WHERE id_session='".$sid."' AND id_produk = '".$id."'");       
    }   
    header('location: '.$_SERVER['HTTP_REFERER']);

    break;
    case 'minus':
    $id = $_GET['id_produk'];
    $query = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE id_produk = '".$id."' AND id_session ='".$sid."'");
    $row = mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);
    $jumlah = $row['jumlah'];
    $min = 1;
    if ($jumlah > $min){

        mysqli_query($koneksi, "UPDATE keranjang SET  jumlah = jumlah - 1 WHERE id_session='".$sid."' AND id_produk = '".$id."'");       
    }   
    header('location: '.$_SERVER['HTTP_REFERER']);

}
 
?>