<?php
if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

// 1. GỌI HEADER (Giống như các trang khác)
layout('/home/header-home');
?>

<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/global.css">


<div class="body-container" style="min-height: 80vh;">
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <?php
                if (isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {

                    // 3. LẤY VÀ XỬ LÝ TỪ KHÓA
                    $keyword = trim($_GET['keyword']);

                    // Thêm dấu % để tìm kiếm LIKE (ví dụ: tìm "áo" sẽ ra "áo thun", "áo sơ mi")
                    $search_term = "%" . $keyword . "%";

                    // 4. TRUY VẤN DATABASE (DÙNG HÀM selectAll)
                    // Câu SQL dùng prepared statement (dấu ?) để chống SQL Injection
                    $sql = "SELECT * FROM products WHERE name LIKE ?";

                    // Gọi hàm selectAll từ file database.php của bạn
                    // Truyền câu SQL và mảng chứa tham số [$search_term]
                    $results = selectAll($sql, [$search_term]);

                    // 5. HIỂN THỊ KẾT QUẢ
                    echo "<h1>Kết quả tìm kiếm cho: '" . htmlspecialchars($keyword) . "'</h1>";
                    echo "<hr>";

                    // 5.1. NẾU CÓ KẾT QUẢ
                    if (!empty($results)) {
                        echo '<p>Tìm thấy ' . count($results) . ' sản phẩm.</p>';
                        echo '<div class="row">'; // Bắt đầu hàng chứa sản phẩm

                        // Lặp qua từng sản phẩm tìm được
                        foreach ($results as $product) {
                            // SAO CHÉP CẤU TRÚC HTML TỪ TRANG index.php/product.php CỦA BẠN
                            // (Bạn có thể cần chỉnh lại đường dẫn ảnh hoặc tên biến)
                ?>
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
<?php
// 7. GỌI FOOTER
layout('footer');
?>