<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

$data = selectAll("SELECT * FROM products");
$products = $data;

$chunk = array_chunk($products, 3);
layout('header-home');
?>


<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/home/index.css">

<div class="body-container">
    <div id="thumbCarousel"
        class="carousel slide hero-section"
        data-bs-ride="carousel"
        data-bs-interval="4000"
        data-bs-pause="false">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/thumb/thumb1s.svg" class="img-thumbnail d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/thumb/thumb2.svg" class="img-thumbnail d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/thumb/thumb3.svg" class="img-thumbnail d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/thumb/thumb4.svg" class="img-thumbnail d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <hr>

    <div class="newProduct-container text-center mb-4 section">
        <div class="title mb-2">
            <h2>Sản phẩm mới</h2>
        </div>


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

                                    <div class="img-product">
                                        <a href="">
                                            <img src="<?php echo htmlspecialchars($product['thumb']) ?>" class="card-img-top mb-2" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                        </a>
                                    </div>

                                    <div class="infor-product flex-grow-1">
                                        <h3 class="product-name card-title"><?php echo htmlspecialchars($product['name']) ?></h3>
                                    </div>
                                    <div class="priceAsize-product mt-auto">
                                        <div class="product-name card-text">Color: <?php echo htmlspecialchars($product['color']) ?></div>
                                        <div class="product-description card-text mb-1">
                                            Size: <?php echo htmlspecialchars($product['size']) ?>
                                        </div>
                                        <div class="product-price fw-bold text-danger">
                                            <?php echo htmlspecialchars($product['price']) ?> VNĐ
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

    <hr>

    <div class="newProduct-container text-center mb-4 section">
        <div class="title mb-2">
            <h2>Sản phẩm mới</h2>
        </div>


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

                                    <div class="img-product">
                                        <a href="">
                                            <img src="<?php echo htmlspecialchars($product['thumb']) ?>" class="card-img-top mb-2" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                        </a>
                                    </div>

                                    <div class="infor-product flex-grow-1">
                                        <h3 class="product-name card-title"><?php echo htmlspecialchars($product['name']) ?></h3>
                                    </div>
                                    <div class="priceAsize-product mt-auto">
                                        <div class="product-name card-text">Color: <?php echo htmlspecialchars($product['color']) ?></div>
                                        <div class="product-description card-text mb-1">
                                            Size: <?php echo htmlspecialchars($product['size']) ?>
                                        </div>
                                        <div class="product-price fw-bold text-danger">
                                            <?php echo htmlspecialchars($product['price']) ?> VNĐ
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

    <hr>

    <div class="newProduct-container text-center mb-4 section">
        <div class="title mb-2">
            <h2>Sản phẩm mới</h2>
        </div>


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

                                    <div class="img-product">
                                        <a href="">
                                            <img src="<?php echo htmlspecialchars($product['thumb']) ?>" class="card-img-top mb-2" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                        </a>
                                    </div>

                                    <div class="infor-product flex-grow-1">
                                        <h3 class="product-name card-title"><?php echo htmlspecialchars($product['name']) ?></h3>
                                    </div>
                                    <div class="priceAsize-product mt-auto">
                                        <div class="product-name card-text">Color: <?php echo htmlspecialchars($product['color']) ?></div>
                                        <div class="product-description card-text mb-1">
                                            Size: <?php echo htmlspecialchars($product['size']) ?>
                                        </div>
                                        <div class="product-price fw-bold text-danger">
                                            <?php echo htmlspecialchars($product['price']) ?> VNĐ
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

    <hr>

    <div class="newProduct-container text-center mb-4 section">
        <div class="title mb-2">
            <h2>Sản phẩm mới</h2>
        </div>

        <hr class="w-50  my-4">

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

                                    <div class="img-product">
                                        <a href="">
                                            <img src="<?php echo htmlspecialchars($product['thumb']) ?>" class="card-img-top mb-2" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                        </a>
                                    </div>

                                    <div class="infor-product flex-grow-1">
                                        <h3 class="product-name card-title"><?php echo htmlspecialchars($product['name']) ?></h3>
                                    </div>
                                    <div class="priceAsize-product mt-auto">
                                        <div class="product-name card-text">Color: <?php echo htmlspecialchars($product['color']) ?></div>
                                        <div class="product-description card-text mb-1">
                                            Size: <?php echo htmlspecialchars($product['size']) ?>
                                        </div>
                                        <div class="product-price fw-bold text-danger">
                                            <?php echo htmlspecialchars($product['price']) ?> VNĐ
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