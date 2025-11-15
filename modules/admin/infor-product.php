<?php

if (!defined('_ximen')) {
    die('--- TRUY CẬP KHÔNG HỢP LỆ---');
}

require_once './template/playouts/header.php';
require_once './template/playouts/sidebar.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
} else {
    die('KHONG TIM THAY ID SAN PHAM');
}

if (isset($_POST['action']) && $_POST['action'] === 'delete') {

    $product_id_to_delete = intval($_POST['product_id']);

    if ($product_id_to_delete > 0) {

        //xoa bang phu truoc
        delete('product_image', ['product_id' => $product_id_to_delete]);
        delete('product_style', ['product_id' => $product_id_to_delete]);


        //xoa bang chinh
        delete('products', ['ID' => $product_id_to_delete]);

        //quay ve
        header('Location: ' . _HOST_URL . "?module=admin&action=list-product");
        echo "<script>alert('Đã xóa sản phẩm thành công!');</script>";
        exit; // Dừng script ngay lập
    }
}


$product = selectOne("SELECT * FROM products WHERE ID = ?", [$product_id]);

$productStyle = selectAll("SELECT * FROM product_style WHERE product_id = ?", [$product_id]);

if (empty($product)) {
    die('SAN PHAM KHONG TON TAI');
}

$image = selectOne("SELECT * FROM product_image WHERE product_id = " . $product["ID"]);
$imgs = $image;

$listIMG = [$product['thumb'], $imgs['img_back'], $imgs['img_left'], $imgs['img_zoom'], $imgs['img_right']];



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>

    <link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/admin/infor-product.css">

</head>

<body>
    <main class="app-main">
        <div class="app-content">
            <div class="container-fluid">

                <div class="row mt-2">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Thông tin sản phẩm</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?php _HOST_URL; ?>?module=admin&action=index">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="img-product col text-center">
                        <div class="firstIMG">
                            <img src="<?php echo $listIMG[0]; ?>" id="main-img">
                        </div>


                        <div class="row justify-content-center">
                            <?php
                            foreach ($listIMG as $index => $img):
                                $activeIMG = ($index == 0) ? 'active' : '';

                            ?>
                                <div class="moreimg col-2 justify-content-center">
                                    <img src="<?php echo htmlspecialchars($img) ?>"
                                        onclick="changeIMG(this)"
                                        class="<?php echo $activeIMG ?>">
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>

                    <div class="infor-product col text-justify  " style="font-size: 20px;">

                        <?php
                        $brandName = selectOne("SELECT name FROM brand WHERE ID = ?", [$product['brand_id']]);

                        $styleNames = [];
                        foreach ($productStyle as $ps) {

                            $style = selectOne("SELECT name FROM style WHERE ID = ?", [$ps['style_id']]);
                            if ($style) {
                                $styleNames[] = $style['name'];
                            }
                        }
                        ?>

                        <div class="infor-product text-center mb-2">
                            <h5 class="product-name">
                                <span class='productName' style='font-weight: bold;'>
                                    <?php echo htmlspecialchars($product['name']) ?>
                                </span class='productName'>

                            </h5>
                        </div>


                        <div class="product-brand card-text mb-2">
                            <span class='brandName' style='font-weight: bold;'>
                                Thương hiệu / Brand:
                            </span class='brandName'>
                            <?php echo $brandName['name']; ?>
                        </div>

                        <div class="product-style card-text mb-2">
                            <span class='style' style='font-weight: bold;'>
                                Phong cách / Style:
                            </span class='style'>
                            <?php
                            echo htmlspecialchars(implode(', ', $styleNames));
                            ?>
                        </div>

                        <div class="product-description card-text mb-2">
                            <span class='description' style='font-weight: bold;'>
                                Giới thiệu / Description:
                            </span class='description'>
                            <?php echo htmlspecialchars($product['description']) ?>
                        </div>

                        <div class="product-color card-text mb-2">
                            <span class='color' style='font-weight: bold;'>
                                Màu sắc/ Color:
                            </span class='color'>
                            <?php echo htmlspecialchars($product['color']) ?>
                        </div>


                        <div class="product-description card-text mb-2">
                            <span class='size' style='font-weight: bold;'>
                                Kích thước / Size:
                            </span class='size'>
                            <?php echo htmlspecialchars($product['size']) ?>
                        </div>

                        <div>
                            <span class='price' style='font-weight: bold;'>
                                Giá / Price:
                            </span class='price'>
                            <span class="product-price fw-bold text-danger">
                                <?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ
                            </span>
                        </div>

                        <div class="button toCart text-center">

                            <a class="btn btn-outline-info" href="<?php echo _HOST_URL; ?>?module=admin&action=edit-product&id=<?php echo $product['ID']; ?>">
                                Chỉnh sửa
                            </a>

                            <form method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn sản phẩm này?');">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-outline-danger">
                                    Xóa
                                </button>
                            </form>

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
        const mainIMG = document.getElementById('main-img');

        //PHAI CO THANG NAY DE NHAN BIET ANH NAO DANG DUOC CLICK
        const moreIMG = document.querySelectorAll('.moreimg img');


        const changeIMG = (clicked) => {
            const clickedIMG = clicked.src;
            mainIMG.src = clicked.src;

            //NHAN BIET
            //b1: xoa con me no active
            moreIMG.forEach(main => {
                main.classList.remove('active');
            })

            //b1: them con me no active vo thang vua duoc click dit me t hay vai l fuck you
            clicked.classList.add('active');
        }
    </script>


</body>

</html>


<?php
require_once './template/playouts/footer.php';
?>