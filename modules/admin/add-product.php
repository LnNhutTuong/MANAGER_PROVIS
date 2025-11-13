<?php

if (!defined('_ximen')) {
    die('--- TRUY CẬP KHÔNG HỢP LỆ---');
}

require_once './template/playouts/header.php';
require_once './template/playouts/sidebar.php';


if (isset($_POST['submit_add_product'])) {

    // lay data tu form
    $name = $_POST['name'] ?? '';
    $category_id = $_POST['category'] ?? null;
    $brand_id = $_POST['brand'] ?? null;
    $styles = $_POST['style'] ?? null;
    $size = $_POST['size'] ?? '';
    $color = $_POST['color'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $timeCreated = date('Y-m-d H:i:s');

    $thumb = handle_upload('thumb');
    $img_back = handle_upload('img_back');
    $img_left = handle_upload('img_left');
    $img_right = handle_upload('img_right');
    $img_zoom = handle_upload('img_zoom');

    //Kiem tra
    $errors = [];
    if (empty($name)) {
        $errors[] = "Tên sản phẩm không được để trống.";
    }
    if (is_null($category_id)) {
        $errors[] = "Bạn phải chọn một Danh mục.";
    }
    if (is_null($brand_id)) {
        $errors[] = "Bạn phải chọn một Thương hiệu.";
    }
    if (is_null($styles)) {
        $errors[] = "Bạn phải chọn một Phong cách.";
    }


    // insert data vao database

    if (empty($errors)) {
        $productData = [
            'name' => $name,
            'brand_id' => $brand_id,
            'category_id' => $category_id,
            'size' => $size,
            'color' => $color,
            'description' => $description,
            'price' => $price,
            ' thumb' => $thumb,
            'created_at' => $timeCreated
        ];
        $newProduct = insert('products', $productData);


        if ($newProduct) {
            if (!empty($styles)) {
                foreach ($styles as $style_id) {
                    $productStyleData = [
                        'product_id' => $newProduct,
                        'style_id' => $style_id
                    ];

                    insert('product_style', $productStyleData);
                }
            }

            $imgData = [
                'product_id' => $newProduct,
                'img-back' => $img_back,
                'img-left' => $img_left,
                'img-right' => $img_right,
                'img-zoom' => $img_zoom,
            ];

            insert('product_image', $imgData);

            echo "<script>alert('Đã thêm thành công sản phẩm');</script>";
        } else {
            echo "<script>alert('Lỗi: Không thể thêm sản phẩm vào database.');</script>";
        }
    } else {

        $error_message = implode("\\n", $errors);
        echo "<script>alert('Chú ý:\\n$error_message');</script>";
    }
}


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
    <title>Thêm sản phẩm</title>

    <link rel="stylesheet" href="style.css">
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
                        <h3 class="mb-0">Thêm sản phẩm</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?php _HOST_URL; ?>?module=admin&action=index">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
                        </ol>
                    </div>
                </div>

                <div class="add-product">
                    <form method="POST" enctype="multipart/form-data">

                        <div class="name mb-3">
                            <label for="name">Tên sản phẩm </label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <label for="category" class="mb-3">Danh mục</label>
                        <div class="category mb-3">
                            <div class="row row-cols-2 row-cols-lg-6 g-2 g-lg-3 border rounded bg-white h-auto">
                                <?php
                                foreach ($categories as $category):
                                ?>

                                    <div class="col text-center mb-3">
                                        <input type="radio" class="btn-check" name="category" id="cat-<?php echo htmlspecialchars($category['ID']) ?>" autocomplete="off" value="<?php echo htmlspecialchars($category['ID']) ?>">
                                        <label class="btn btn-outline-primary w-75 " for="cat-<?php echo htmlspecialchars($category['ID']) ?>"><?php echo htmlspecialchars($category['name']) ?></label>
                                    </div>

                                <?php
                                endforeach;
                                ?>

                            </div>
                        </div>

                        <label for="brand" class="mb-3">Thương hiệu</label>
                        <div class="brand mb-3">
                            <div class="row row-cols-2 row-cols-lg-6 g-2 g-lg-3 border rounded bg-white overflow-y-auto"
                                style="max-height: 100px;">
                                <?php foreach ($brands as $brand): ?>
                                    <div class="col text-center">
                                        <input type="radio" class="btn-check" name="brand" id="bra-<?php echo htmlspecialchars($brand['ID']) ?>" autocomplete="off" value="<?php echo htmlspecialchars($brand['ID']) ?>">
                                        <label class="btn btn-outline-primary w-75 " for="bra-<?php echo htmlspecialchars($brand['ID']) ?>"><?php echo htmlspecialchars($brand['name']) ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <label for="style" class="mb-3">Phong cách</label>
                        <div class="style mb-3">
                            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 border rounded bg-white overflow-y-auto"
                                style="max-height: 100px;">
                                <?php foreach ($styles as $style): ?>
                                    <div class="col text-center">
                                        <input type="checkbox" class="btn-check" name="style[]" id="<?php echo htmlspecialchars($style['ID']) ?>" autocomplete="off" value="<?php echo htmlspecialchars($style['ID']) ?>">
                                        <label class="btn btn-outline-primary w-75 " for="<?php echo htmlspecialchars($style['ID']) ?>"><?php echo htmlspecialchars($style['name']) ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="size mb-3">
                            <label for="size">Kích thước</label>
                            <input type="text" class="form-control" id="size" name="size" placeholder="Dài: Xcm, Rộng: Xcm...">
                        </div>

                        <div class="color mb-3">
                            <label for="color">Màu sắc</label>
                            <input type="text" class="form-control" id="color" name="color">
                        </div>

                        <div class="description mb-3">
                            <label for="description">Mô tả sản phẩm</label>
                            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                        </div>

                        <div class="price mb-3">
                            <label for="price">Giá tiền</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>


                        <label for="thumb">Hình ảnh</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Ảnh đại diện (thumb)</span>
                            <input type="file" class="form-control" name="thumb">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Ảnh sau (back)</span>
                            <input type="file" class="form-control" name="img_back">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Ảnh trái (left)</span>
                            <input type="file" class="form-control" name="img_left">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Ảnh phải (right)</span>
                            <input type="file" class="form-control" name="img_right">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Ảnh zoom</span>
                            <input type="file" class="form-control" name="img_zoom">
                        </div>

                        <button type="submit" name="submit_add_product" class="btn btn-primary">Thêm sản phẩm</button>
                    </form>
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