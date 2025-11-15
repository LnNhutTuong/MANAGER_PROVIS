<?php
if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

require_once './template/playouts/header.php';
require_once './template/playouts/sidebar.php';
?>

<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/global.css">

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


                </div>

                <div class="body-container" style="min-height: 80vh;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 mt-4">
                                <?php
                                if (isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {

                                    $keyword = trim($_GET['keyword']);
                                    $search_term = "%" . $keyword . "%";

                                    $sql = "SELECT * FROM products WHERE name LIKE ?";
                                    $params = [$search_term];

                                    $dataCate = selectALL("SELECT * FROM category WHERE name LIKE ?", $search_term);
                                    $cate_id = array_column($dataCate, 'id');

                                    if (!empty($cate_id)) {
                                        $in_placeholders = implode(',', array_fill(0, count($cate_id), '?'));

                                        $sql .= " OR category_id IN (" . $in_placeholders . ")";

                                        $params = array_merge($params, $cate_id);
                                    }

                                    $data = selectAll($sql, ...$params);
                                    echo "<h1>Kết quả tìm kiếm cho: '" . htmlspecialchars($keyword) . "'</h1>";
                                    echo "<hr>";

                                    if (!empty($data)) {
                                        echo '<p>Tìm thấy ' . count($data) . ' sản phẩm.</p>';
                                        echo '<div class="row">';

                                        echo ' <div class="row row-cols-2 row-cols-lg-6 g-2 g-lg-3 mt-2">';
                                        foreach ($data as $product) {
                                ?>
                                            <div class="col ">
                                                <div class="card h-100 shadow-sm text-center ">
                                                    <?php

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

                            </div>

                <?php
                                        }
                                        echo '</div>';
                                    } else {
                                        echo "<h3>Không tìm thấy sản phẩm nào phù hợp với từ khóa của bạn.</h3>";
                                        echo "<p>Vui lòng thử tìm kiếm với từ khóa khác.</p>";
                                    }
                                } else {
                                    echo "<h1>Vui lòng nhập từ khóa để tìm kiếm.</h1>";
                                }
                ?>
                        </div>
                    </div>
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


<?php
layout('footer');
?>