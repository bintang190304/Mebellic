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
            <li class="<?= $active_home ?>"><a href="index.php">Home</a></li>
            <li class="<?= $active_about ?>"><a href="about.php">About</a></li>
            <li class="<?= $active_shop ?>"><a href="shop1.php">Shop</a></li>
            <li class="<?= $active_cart ?>"><a href="cart.php">Cart</a></li>
        </ul>
    </nav>
    <!-- Button Group -->
    <div class="amado-btn-group mt-30 mb-100">
        <a href="account.php" class="btn amado-btn mb-15">Account</a>
        <a href="diskon.php" class="btn amado-btn mb-15 active">%Discount%</a>
        <a href="order-detail.php" class="btn amado-btn mb-15">Order Details</a>
    </div>
</header>