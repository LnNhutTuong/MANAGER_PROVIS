<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

layout('header-home');
?>

<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/global.css" />

<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/home.css">

<div class="body-container container min-vh-100 mb-3 mt-3">
    <div class="thumb-container mt-4">
        <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/logo/PROVIS.png" class="img-thumbnail" alt="...">
    </div>

    <div class="product-container mt-4 text-center">
        <h2>Sản phẩm mới</h2>
        <div class="product">
            <?php foreach ($products as $products): ?>
                <div class="product-card">
                    <div class="product-img">
                        <img src="<?php echo htmlspecialchars($products['name']) ?>" alt="img-Product">
                    </div>
                </div>
                <div class="product-content">
                    <h3 class="product-name"><?php echo htmlspecialchars($products['name']) ?></h3>
                    <div class="product-price"><?php echo htmlspecialchars($products['[price]']) ?></div>
                    <div class="product-description"><?php echo htmlspecialchars($products['[descreption]']) ?></div>
                </div>
        </div> <?php endforeach; ?>
    </div>

</div>

<?php
layout('footer');
?>