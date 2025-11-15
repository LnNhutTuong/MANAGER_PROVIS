<?php

if (!defined('_ximen')) {
    die('--- TRUY CẬP KHÔNG HỢP LỆ---');
}

require_once './template/playouts/header.php';
require_once './template/playouts/sidebar.php';




$products = selectAll('SELECT * FROM products');
$categories = selectAll("SELECT * FROM category");
$brands = selectAll("SELECT * FROM brand");
$styles = selectAll("SELECT * FROM style");

// echo "<pre>";
// print_r($categories);
// echo "</pre>";
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>

    <link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/admin/list-product.css">
    <link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/global.css">

</head>

<body>
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">

                <div class="row mt-2">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Danh sách sản phẩm</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?php _HOST_URL; ?>?module=admin&action=index">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
                        </ol>
                    </div>

                    <div class="list-product">
                        <div class="searchBar col-lg-3" style="width: 333px;">
                            <form class="d-flex" role="search" method="GET" action="index.php">

                                <input type="hidden" name="module" value="admin">
                                <input type="hidden" name="action" value="search">

                                <div class="input-group">
                                    <input
                                        class="form-control"
                                        type="search"
                                        placeholder="Tìm kiếm sản phẩm..."
                                        aria-label="Search"
                                        name="keyword" />

                                    <button class="btn btn-primary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>



                    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 mt-2">
                        <?php foreach ($products as $product): ?>
                            <div class="col ">
                                <div class="card h-100 shadow-sm text-center ">

                                    <?php
                                    // echo "<pre>";
                                    // print_r($product);
                                    // echo "</pre>";
                                    $brandName = selectOne("SELECT name FROM brand WHERE ID ='" . $product["brand_id"] . "'");
                                    ?>

                                    <div class="img-product">
                                        <a href="<?php echo _HOST_URL; ?>?module=admin&action=infor-product&id=<?php echo $product['ID']; ?>">
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
                                            <?php
                                            if (empty($brandName['name'])) {
                                                $brandName['name'] = "Unknown";
                                            } else {
                                                $brandName['name'] = htmlspecialchars($brandName['name']);
                                            }
                                            ?>
                                        </div>
                                        <div class="product-name card-text mt-auto">
                                            Brand: <?php
                                                    echo "<span class='brandName' style='font-weight: bold;'>"
                                                        . $brandName['name'] .
                                                        "</span class='brandName'>"
                                                    ?>
                                        </div>
                                        <div class="card-text mb-1 mt-auto">Size: <?php echo htmlspecialchars($product['size']); ?></div>


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
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->



    <script>

    </script>

</body>

</html>


<?php
require_once './template/playouts/footer.php';
?>