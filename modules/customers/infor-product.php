<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
} else {
    die('KHONG TIM THAY ID SAN PHAM');
}

// Dùng selectOne chứ không phải selectAll
$product = selectOne("SELECT * FROM products WHERE ID = " . $product_id);

// 4. (Rất quan trọng) Kiểm tra xem sản phẩm có tồn tại không
if (empty($product)) {
    die('SAN PHAM KHONG TON TAI');
}

// 5. Lấy các ảnh liên quan (nếu có)
// (Giả sử bảng product_image có cột 'product_id' tham chiếu đến ID sản phẩm)

$image = selectOne("SELECT * FROM product_image WHERE product_id = " . $product["ID"]);
$imgs = $image;

// $dataIMG = selectAll("SELECT * FROM product_image");
// $img = $dataIMG;

$listIMG = [$product['thumb'], $imgs['img-back'], $imgs['img-left'], $imgs['img-zoom'], $imgs['img-right']];

// $firstIMG = $listIMG[0];


// echo "<pre>";
// print_r($product);
// echo "</pre>";

// echo "<pre>";
// print_r($image);
// echo "</pre>";

// echo "<pre>";
// print_r($listIMG);
// echo "</pre>";



layout('/home/header-home');
?>


<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/customer/infor-product.css">

<div class="body-container container mt-5 mb-5">

    <div class="row">

        <div class="img-product col-4 text-center">
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

        <div class="infor-product col-8 text-justify  " style="font-size: 20px;">
            <?php
            $brandName = selectOne("SELECT name FROM brand WHERE ID ='" . $product['brand_id'] . "'");
            ?>

            <div class="infor-product text-center mb-2 mt-2">
                <h4 class="product-name card-title"><?php echo htmlspecialchars($product['name']) ?></h4>
            </div>

            <div class="priceAsize-product mt-3">

                <div class="product-name card-text mb-2">
                    <?php
                    if (empty($brandName['name'])) {
                        $brandName['name'] = "Unknown";
                    } else {
                        $brandName['name'] = htmlspecialchars($brandName['name']);
                    }
                    ?>
                    <span class='brandName' style='font-weight: bold;'>
                        Thương hiệu / Brand:
                    </span class='brandName'>
                    <?php echo $brandName['name']; ?>
                </div>

                <div class="product-description card-text mb-2">
                    <span class='brandName' style='font-weight: bold;'>
                        Giới thiệu / Description:
                    </span class='brandName'>
                    <?php echo htmlspecialchars($product['descreption']) ?>
                </div>

                <div class="product-description card-text mb-2">
                    <span class='brandName' style='font-weight: bold;'>
                        Kích thước / Size:
                    </span class='brandName'>
                    <?php echo htmlspecialchars($product['size']) ?>
                </div>

                <div>
                    <span class='brandName' style='font-weight: bold;'>
                        Giá / Price:
                    </span class='brandName'>
                    <span class="product-price fw-bold text-danger">
                        <?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ
                    </span>
                </div>

            </div>

            <div class="button toCart text-center ">
                <button type="button" class="btn btn-outline-success">Thêm vào giỏ hàng</button>
            </div>



        </div>
    </div>

</div>


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

<?php
layout('footer');
?>