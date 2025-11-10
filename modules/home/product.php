<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

// Phân trang san pham (rất khó tốn rất nhiều ngày chứ ko phải giờ nữa :")

//xài GET vì nó hiện URL, dễ hơn cho ng dùng
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$products_per_page = 9;

//Vì cái trang đầu tiên là 0, nên phải trừ 
//1 để nó biến thành trang 0 xong rồi skip trang đó
$nonePage = ($page - 1) * $products_per_page;

// Lấy tất cả product
$total_products = getRows("SELECT COUNT(ID) FROM products");

// -> tính được số trang (ceil làm tròn ko phẩy)
$total_pages = ceil($total_products / $products_per_page);

//
$products = selectAll("SELECT * FROM products LIMIT $products_per_page OFFSET $nonePage");
$categories = selectAll("SELECT * FROM category");
$brands = selectAll("SELECT * FROM brand");
$styles = selectAll("SELECT * FROM style");

// echo '<pre>';
// print_r($styles);
// echo '</pre>';



//Này làm bằng mảng vì nhiều hãng vl
foreach ($brands as $brand) {
    $nameBrand = selectOne("SELECT name FROM brand WHERE  id= '" . $brand['ID'] . "'");
}


layout('header-home');
?>


<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/home/product.css">

<div class="body-container container mt-4 mb-4">
    <div class="row selling-product">

        <div class="category-container col-lg-3">
            <div class="card">
                <div class="card-body mb-4 ">

                    <div class="category">
                        <h6 class="fw-bold mb-2">Phân loại</h6>
                        <?php
                        foreach ($categories as $category):
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="category"
                                id="<?php echo htmlspecialchars($category['ID']); ?>">
                            <label class="form-check-label" for="<?php echo htmlspecialchars($category['ID']); ?>">
                                <?php echo htmlspecialchars($category['name']); ?>
                            </label>
                        </div>
                        <?php
                        endforeach;
                        ?>
                    </div>

                    <div class="brand">
                        <h6 class="fw-bold mb-2">Thương hiệu</h6>
                        <?php
                        foreach ($brands as $brand):
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="brand"
                                id="<?php echo htmlspecialchars($brand['ID']); ?>">
                            <label class="form-check-label" for="<?php echo htmlspecialchars($brand['ID']); ?>">
                                <?php echo htmlspecialchars($brand['name']); ?>
                            </label>
                        </div>
                        <?php
                        endforeach;
                        ?>
                    </div>

                    <div class="style">
                        <h6 class="fw-bold mb-2">Phong cách</h6>
                        <?php
                        foreach ($styles as $style):
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="style"
                                id="<?php echo htmlspecialchars($style['ID']); ?>">
                            <label class="form-check-label" for="<?php echo htmlspecialchars($style['ID']); ?>">
                                <?php echo htmlspecialchars($style['name']); ?>
                            </label>
                        </div>
                        <?php
                        endforeach;
                        ?>
                    </div>

                    <div class="price">
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

        <div class="product-container col-lg-9">
            <div class="row justify-content-center g-4">
                <?php foreach ($products as $product): ?>
                <div class="col-6 col-md-4 col-lg-4">
                    <div class="card h-100 shadow-sm text-center">

                        <div class="img-product">
                            <a href="#">
                                <img src="<?php echo htmlspecialchars($product['thumb']); ?>" class="card-img-top mb-2"
                                    alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </a>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h3 class="product-name card-title mb-2">
                                <?php echo htmlspecialchars($product['name']); ?>
                            </h3>

                            <div class="flex-grow-1">
                                <div class="card-text mb-1">Color: <?php echo htmlspecialchars($product['color']); ?>
                                </div>
                                <div class="card-text mb-1">Size: <?php echo htmlspecialchars($product['size']); ?>
                                </div>
                            </div>

                            <div class="mt-auto fw-bold text-danger">
                                <?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ
                            </div>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>


            <?php
            $prevPage = $page - 1;
            $nextPage = $page + 1;
            ?>

            <div class="pageination d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination">

                        <!--không phải vì hàm for dễ hơn mà phải là bắt buộc dùng hàm for -->

                        <li class="page-item" <?php
                            if ($page <= 1) {
                                echo 'disabled';
                            }
                            ?>>
                            <a class=" page-link"
                                href="<?php echo _HOST_URL; ?>?module=home&action=product&page=<?php echo $prevPage; ?>">Previous</a>
                        </li>

                        <?php for ($i = 0; $i < $total_pages; $i++):
                            $pageNumber = $i + 1;
                            if ($page == $pageNumber) {
                                continue;
                            }
                        ?>
                        <li class="page-item">
                            <a class="page-link"
                                href="<?php echo _HOST_URL; ?>?module=home&action=product&page=<?php echo $pageNumber; ?>">
                                <?php echo $pageNumber; ?>
                            </a>
                        </li>
                        <?php endfor; ?>

                        <li class="page-item 
                            <?php
                            if ($page >= $total_pages) {
                                echo 'disabled';
                            }
                            ?>">
                            <a class="page-link"
                                href="<?php echo _HOST_URL; ?>?module=home&action=product&page=<?php echo $nextPage; ?>">Next</a>
                        </li>

                    </ul>
                </nav>
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