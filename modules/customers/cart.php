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

$products_per_page = 3;

//Vì cái trang đầu tiên là 0, nên phải trừ 
//1 để nó biến thành trang 0 xong rồi skip trang đó

$nonePage = ($page - 1) * $products_per_page;

// Lấy tất cả product
$count = selectOne("SELECT COUNT(ID) as total FROM products");
$total_products = $count['total'];

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


layout('/home/header-home');
?>


<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/home/cart.css">

<div class="body-container container mt-4 mb-4">
    <div class="row cart-product">

        <div class="cart-container col-lg-3">
            <div class="card">
                <div class="card-body mb-4 ">
                    <h5 class="text-center">Giỏ hàng</h5>

                    <div class="cart-content ">

                        <div class="productSelected ">
                            Sản phẩm đã chọn: name (price*quantity)
                        </div>

                        <div class="total-quantity">
                            Tổng số lượng :
                        </div>

                        <div class="totalprice">
                            Thành tiền:
                        </div>

                    </div>
                </div>
            </div>


        </div>

        <div class="product-container col-lg-9">
            <div class=" justify-content-center g-4">

                <div class="nameColumn row mb-2">
                    <h6 class="col ps-2 m-0" style="max-width: fit-content;">Chọn</h6>
                    <h6 class="col ps-5 me-4" style="max-width: fit-content;">Hình ảnh</h6>
                    <h6 class="col ps-5" style="max-width: fit-content; padding-left: 58px !important;">Tên sản phẩm</h6>
                    <h6 class="col ps-5 ms-4 me-4" style="max-width: fit-content;">Brand & Size</h6>
                    <h6 class="col ps-5 ms-5" style="max-width: fit-content;">Số lượng</h6>
                    <h6 class="col ps-5 ms-4" style="max-width: fit-content;">Giá / Sản phẩm</h6>
                    <h6 class="col p-0 m-0" style="max-width: fit-content;"></h6>
                </div>

                <?php foreach ($products as $product): ?>

                    <div class="100-w shadow-sm text-center row align-items-center">

                        <div class="form-check col pe-0 ms-3" style="max-width: fit-content;">

                            <input class="form-check-input" type="checkbox" name="select" id="select">
                        </div>

                        <?php

                        $brandName = selectOne("SELECT name FROM brand WHERE ID ='" . $product["brand_id"] . "'");
                        ?>

                        <div class="img-product col" style="max-width: fit-content;">
                            <a href="#">
                                <img src="<?php echo htmlspecialchars($product['thumb']); ?>"
                                    class="card-img-top mb-2"
                                    alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </a>
                        </div>

                        <h3 class="product-name col" style="max-width: fit-content;">
                            <?php echo htmlspecialchars($product['name']); ?>
                        </h3>



                        <div class="infor-product col " style="max-width: fit-content;">
                            <?php
                            if (empty($brandName['name'])) {
                                $brandName['name'] = "Unknown";
                            } else {
                                $brandName['name'] = htmlspecialchars($brandName['name']);
                            }
                            ?>
                            <div class="brand"> Brand: <?php
                                                        echo "<span class='brandName' style='font-weight: bold;'>"
                                                            . $brandName['name'] .
                                                            "</span class='brandName'>"
                                                        ?></div>
                            <div class="size" style="width: 183px;"><?php echo htmlspecialchars($product['size']); ?>
                            </div>
                        </div>

                        <div class="quantity col" style="max-width: fit-content;">

                            <button type="btn" aria-l abel="Decrease">
                            </button>

                            <input type="number">

                            <button type="btn" aria-label="Increase">

                            </button>

                        </div>

                        <div class=" fw-bold text-danger col" style="max-width: fit-content;">
                            <?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ
                        </div>

                        <button class=" btn delete col" style="max-width: fit-content; height: fit-content;"> Xóa</button>
                    </div>
                <?php endforeach; ?>

            </div>


            <!-- ========================================DONE============================================] -->
            <?php
            $prevPage = $page - 1;
            $nextPage = $page + 1;
            ?>
            <div class="pagination d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination">


                        <?php
                        $isDisabled = ($page <= 1);
                        ?>

                        <li class="page-item 
                            <?php if ($page <= 1) {
                                echo 'disabled';
                            }
                            ?>">
                            <a class="page-link" href="<?php echo _HOST_URL; ?>?module=customers&action=cart&page=<?php echo $prevPage ?>">
                                Previous
                            </a>
                        </li>

                        <?php for ($i = 0; $i < $total_pages; $i++):
                            $pageNumber = $i + 1;
                            $isActive = ($page == $pageNumber);
                        ?>
                            <li class="page-item <?php echo $isActive ? 'active' : ''; ?>">
                                <a class="page-link"
                                    href="<?php echo _HOST_URL; ?>?module=customers&action=cart&page=<?php echo $pageNumber ?>"
                                    <?php echo   "success"; ?>>
                                    <?php echo $pageNumber;
                                    ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item 
                            <?php
                            if ($page >= $total_pages) {
                                echo 'disabled';
                            }
                            ?>">
                            <a class="page-link" href="<?php echo _HOST_URL; ?>?module=customers&action=cart&page=<?php echo $nextPage ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>

    </div>
</div>




<script>

</script>

<?php
layout('footer');
?>