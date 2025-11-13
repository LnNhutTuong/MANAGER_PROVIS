<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

$data = selectAll("SELECT * FROM products");
$products = $data;



$chunk = array_chunk($products, 3);
layout('/home/header-home');
?>


<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/home/index.css">

<div class="body-container">

    <div class="thumb-container border-top ">
        <div id="thumbCarousel"
            class="carousel slide hero-section text-center p-0"
            data-bs-ride="carousel"
            data-bs-interval="4000"
            data-bs-pause="false">

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/thumb/1.svg" class="img-thumbnail">
                    <div class="caption">
                        <h1> Not Classic, Iconic.</h1>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/thumb/2.svg" class="img-thumbnail">
                    <div class="caption">
                        <h1> Wear What Speaks Loud.</h1>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/thumb/3.svg" class="img-thumbnail ">
                    <div class="caption">
                        <h1>Made to Break the Rules.</h1>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/thumb/4.svg" class="img-thumbnail">
                    <div class="caption">
                        <h1>Past Threads, Future Energy.</h1>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <hr style="margin-top: 40px;">

    <div class="newProduct-container text-center mb-5 section">
        <div class="title mb-2">
            <h2>Sản phẩm mới</h2>
        </div>

        <hr class="w-50 mx-auto my-4">

        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $count = 0;
                foreach ($products as $product):
                    // Mở slide mới khi bắt đầu nhóm 3 sản phẩm
                    if ($count % 3 == 0):
                ?>
                        <div class="carousel-item <?php echo $count == 0 ? 'active' : ''; ?>">
                            <div class="row justify-content-center">
                            <?php endif; ?>

                            <div class="col-3 col-product card mb-4 ms-3">

                                <div class="product-card card-body d-flex flex-column">


                                    <?php
                                    // echo "<pre>";
                                    // print_r($product);
                                    // echo "</pre>";
                                    $brandName = selectOne("SELECT name FROM brand WHERE ID ='" . $product["brand_id"] . "'");
                                    ?>

                                    <div class="img-product">
                                        <a href="<?php echo _HOST_URL; ?>?module=customers&action=infor-product&id=<?php echo $product['ID']; ?>">
                                            <img src="<?php echo htmlspecialchars($product['thumb']) ?>" class="card-img-top mb-2" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                        </a>
                                    </div>

                                    <div class="infor-product flex-grow-1">
                                        <h6 class="product-name card-title"><?php echo htmlspecialchars($product['name']) ?></h6>
                                    </div>

                                    <div class="priceAsize-product mt-auto">
                                        <div class="product-name card-text">
                                            <?php
                                            if (empty($brandName['name'])) {
                                                $brandName['name'] = "Unknown";
                                            } else {
                                                $brandName['name'] = htmlspecialchars($brandName['name']);
                                            }
                                            ?>
                                            Brand: <?php
                                                    echo "<span class='brandName' style='font-weight: bold;'>"
                                                        . $brandName['name'] .
                                                        "</span class='brandName'>"
                                                    ?>
                                        </div>
                                        <div class="product-description card-text mb-1">
                                            <?php echo htmlspecialchars($product['size']) ?>
                                        </div>
                                        <div class="product-price fw-bold text-danger">
                                            <?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $count++;
                            if ($count % 3 == 0 || $count == count($products)):
                            ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" style="filter:invert(1);" aria-hidden="true"></span>
                <span class="visually-hidden">Trước</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" style="filter:invert(1);" aria-hidden="true"></span>
                <span class="visually-hidden">Sau</span>
            </button>
        </div>
    </div>
</div>


<script>

</script>

<?php
layout('footer');
?>