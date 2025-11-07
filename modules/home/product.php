<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

$data = selectAll("SELECT * FROM products");
$products = $data;

// $chunk = array_chunk($products, 3);

layout('header-home');
?>


<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/home/product.css">

<div class="body-container container mt-4 mb-4">
    <div class="row">

        <div class="category-container col-lg-2">
            <div class="card">
                <div class="card-body mb-4 ">
                    <div>
                        <h6 class="fw-bold mb-2">Danh mục</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="aoThun">
                            <label class="category-name" for="aoThun">Achive</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="aoThun">
                            <label class="category-name" for="aoThun">Denim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="quanJean">
                            <label class="category-name" for="quanJean">Y2K</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="aoKhoac">
                            <label class="category-name" for="aoKhoac">Military</label>
                        </div>
                    </div>

                    <div>
                        <h6 class="fw-bold mb-2">Giá</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="price" id="duoi200">
                            <label class="form-check-label" for="duoi200">Dưới 200k</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="price" id="200to500">
                            <label class="form-check-label" for="200to500">200k - 500k</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="price" id="tren500">
                            <label class="form-check-label" for="tren500">Trên 500k</label>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-2">Giá</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="price" id="duoi200">
                            <label class="form-check-label" for="duoi200">Dưới 200k</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="price" id="200to500">
                            <label class="form-check-label" for="200to500">200k - 500k</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="price" id="tren500">
                            <label class="form-check-label" for="tren500">Trên 500k</label>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="product-container col-lg-10">
            <div class="row justify-content-center g-4">
                <?php foreach ($products as $product): ?>
                    <div class="col-6 col-md-4 col-lg-4">
                        <div class="card h-100 shadow-sm text-center">
                            <div class="img-product">
                                <a href="#">
                                    <img src="<?php echo htmlspecialchars($product['thumb']); ?>"
                                        class="card-img-top mb-2"
                                        alt="<?php echo htmlspecialchars($product['name']); ?>">
                                </a>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h3 class="product-name card-title mb-2">
                                    <?php echo htmlspecialchars($product['name']); ?>
                                </h3>

                                <div class="flex-grow-1">
                                    <div class="card-text mb-1">Color: <?php echo htmlspecialchars($product['color']); ?></div>
                                    <div class="card-text mb-1">Size: <?php echo htmlspecialchars($product['size']); ?></div>
                                </div>

                                <div class="mt-auto fw-bold text-danger">
                                    <?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>

    </div>
</div>

</div>


<script>

</script>
<?php
layout('footer');
?>