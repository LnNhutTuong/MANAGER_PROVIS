<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

$data = selectAll("SELECT * FROM products");
$products = $data;

layout('header-home');
?>

<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/global.css" />

<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/home.css">

<div class="body-container container min-vh-100 mb-3 mt-3">
    <div class="thumb-container mt-4">
        <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/logo/PROVIS.png" class="img-thumbnail" alt="...">
    </div>
    <div class="product-container mt-5 mb-5 text-center">
        <div class="title mb-5 mt-5">
            <h2>Sản phẩm mới</h2>
        </div>

        <div class="row row-product mt-3 g-4 justify-content-center">
            <?php foreach ($products as $products): ?>

                <div class="col-3 col-product card mb-4 ms-5">
                    <div class="product-card card-body ">
                        <div class="product-img">
                            <img src="<?php echo htmlspecialchars($products['thumb']) ?>" class="card-img-top">
                        </div>
                        <div class="product-content d-flex flex-column mt-2">
                            <h3 class="product-name card-title mt-auto"><?php echo htmlspecialchars($products['name']) ?></h3>
                            <div class="product-description  card-text">Size: <?php echo htmlspecialchars($products['size']) ?></div>
                            <div class="product-price "><?php echo htmlspecialchars($products['price']) ?> VNĐ</div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
layout('footer');
?>