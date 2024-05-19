<?php 
session_start();
require 'functions.php';
$sid = $_SESSION['id_users'];

    $jumlah = $_POST['jumlah'];
    $id = $_POST['id_produk'];

    
//di cek dulu apakah barang yang di beli sudah ada di tabel keranjang
    $query = mysqli_query($koneksi,"SELECT id_produk FROM keranjang WHERE id_produk = '".$id."' AND id_session ='".$sid."'");
    $row = mysqli_num_rows($query);
    if ($row==0){
        // kalau barang belum ada, maka di jalankan perintah insert
        mysqli_query($koneksi, "INSERT INTO keranjang (id_produk, jumlah, id_session) VALUES ('".$id."', '".$jumlah."', '".$sid."')");
    } else {
        //  kalau barang ada, maka di jalankan perintah update
        mysqli_query($koneksi, "UPDATE keranjang SET  jumlah = jumlah +'".$jumlah."' WHERE id_session='".$sid."' AND id_produk = '".$id."'");       
    }   
    header('location: cart.php');

 
?>