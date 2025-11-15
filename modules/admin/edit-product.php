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



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_edit_product'])) {

    $name = $_POST['name'] ?? '';
    $category_id = $_POST['category'] ?? null;
    $brand_id = $_POST['brand'] ?? null;
    $style_ids_new = $_POST['style'] ?? [];
    $color = $_POST['color'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;

    $size = '';
    if ($category_id == 2) {
        $size = $_POST['size_2'] ?? '';
    } elseif ($category_id == 7) {
        $size = $_POST['size_7'] ?? '';
    } else {
        $size = $_POST['size_default'] ?? '';
    }

    $data_products = [
        'name' => $name,
        'category_id' => $category_id,
        'brand_id' => $brand_id,
        'size' => $size,
        'color' => $color,
        'description' => $description,
        'price' => $price
    ];

    update('products', $data_products, ['ID' => $product_id]);

    delete('product_style', ['product_id' => $product_id]);

    if (!empty($style_ids_new)) {
        foreach ($style_ids_new as $style_id) {
            insert('product_style', [
                'product_id' => $product_id,
                'style_id' => $style_id
            ]);
        }
    }

    delete('product_style', ['product_id' => $product_id]);


    echo "<script>
        alert('Cập nhật sản phẩm thành công!');
        window.location.href = '" . _HOST_URL . "?module=admin&action=infor-product&id=" . $product_id . "';
      </script>";
    exit();
}



// GET=============================================




$product = selectOne("SELECT * FROM products WHERE ID = $product_id");

$images = selectOne("SELECT * FROM product_image WHERE product_id = $product_id");

$styles_data = selectAll("SELECT style_id FROM product_style WHERE product_id = $product_id");

$style_ids = [];
if ($styles_data) {
    foreach ($styles_data as $style) {
        $style_ids[] = $style['style_id'];
    }
}



$categories = selectAll("SELECT * FROM category");
$brands = selectAll("SELECT * FROM brand");
$styles = selectAll("SELECT * FROM style");


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>

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
                        <h3 class="mb-0">Chỉnh sửa sản phẩm</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?php _HOST_URL; ?>?module=admin&action=index">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa sản phẩm</li>
                        </ol>
                    </div>
                </div>

                <div class="add-product">

                    <form method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['ID']); ?>">

                        <div class="name mb-3">
                            <label for="name">Tên sản phẩm </label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']) ?>">
                        </div>

                        <label for="category" class="mb-3">Danh mục</label>

                        <div class="category mb-3">
                            <div class="row row-cols-2 row-cols-lg-6 g-2 g-lg-3 border rounded bg-white h-auto">
                                <?php
                                foreach ($categories as $category):
                                ?>

                                    <div class="col text-center mb-3">

                                        <input type="radio"
                                            class="btn-check"
                                            name="category"
                                            id="cat-<?php echo htmlspecialchars($category['ID']) ?>"
                                            autocomplete="off"
                                            value="<?php echo htmlspecialchars($category['ID']) ?>"
                                            <?php echo ($category['ID'] == $product['category_id']) ? 'checked' : ''; ?>>

                                        <label class="btn btn-outline-primary w-75 "
                                            for="cat-<?php echo htmlspecialchars($category['ID']) ?>">
                                            <?php echo htmlspecialchars($category['name']) ?>
                                        </label>

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
                                <div class="col text-center">
                                    <a href="<?php _HOST_URL; ?>?module=admin&action=add-brand" class="btn btn-outline-success" id="btn-add-brand">
                                        Thêm thương hiệu
                                    </a>
                                </div>
                                <?php foreach ($brands as $brand): ?>
                                    <div class="col text-center">

                                        <input type="radio"
                                            class="btn-check"
                                            name="brand"
                                            id="bra-<?php echo htmlspecialchars($brand['ID']) ?>"
                                            autocomplete="off" value="<?php echo htmlspecialchars($brand['ID']) ?>"
                                            value="<?php echo htmlspecialchars($brand['ID']) ?>"
                                            <?php echo ($brand['ID'] == $product['brand_id']) ? 'checked' : ''; ?>>

                                        <label class="btn btn-outline-primary w-75 "
                                            for="bra-<?php echo htmlspecialchars($brand['ID']) ?>">
                                            <?php echo htmlspecialchars($brand['name']) ?>
                                        </label>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <label for="style" class="mb-3">Phong cách</label>
                        <div class="style mb-3">
                            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 border rounded bg-white overflow-y-auto"
                                style="max-height: 100px;">
                                <div class="col text-center">
                                    <a href="<?php _HOST_URL; ?>?module=admin&action=add-style" class="btn btn-outline-success" id="btn-add-brand">
                                        Thêm phong cách
                                    </a>
                                </div>
                                <?php foreach ($styles as $style):
                                ?>
                                    <div class="col text-center">
                                        <input type="checkbox"
                                            class="btn-check" name="style[]"
                                            id="<?php echo htmlspecialchars($style['ID']) ?>"
                                            autocomplete="off" value="<?php echo htmlspecialchars($style['ID']) ?>"
                                            value="<?php echo htmlspecialchars($style['ID']) ?>"
                                            <?php echo in_array($style['ID'], $style_ids) ? 'checked' : ''; ?>>
                                        <!-- thang nay hoi kho hieu vi no la mang nen phai echo mang -->

                                        <label class="btn btn-outline-primary w-75 "
                                            for="<?php echo htmlspecialchars($style['ID']) ?>">
                                            <?php echo htmlspecialchars($style['name']) ?>
                                        </label>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>




                        <!-- co 3 danh muc chinh nen se co cac cach de lay so do khac nhau:
                            ao: dai/length, rong/width, vai/shoulder
                        quan: dai/length, rong/width, ong/pant leg,
                        giay: size: => so do quy ra size = xai google cho nhanh ai ranh ngoi tinh lam gi
                        -->


                        <div class="size-block mb-3" data-category-id='2' style="display:none">
                            <label for="size">Kích thước</label>
                            <textarea type="text" class="form-control" id="size_2" name="size_2" rows="5"
                                placeholder="Dài / Length: Xcm
                                Rộng / Width: Xcm
                                Ống / Pant leg: Xcm"><?php echo htmlspecialchars($product['size']); ?></textarea>
                        </div>

                        <div class="size-block mb-3" data-category-id='7' style="display:none">
                            <label for="size">Kích thước</label>
                            <textarea type="text" class="form-control" id="size_7" name="size_7" rows="5"
                                placeholder="Size: (40,39,38)
                                cm đổi sang size bằng GOOGLE"><?php echo htmlspecialchars($product['size']); ?></textarea>
                        </div>


                        <div class="size-block mb-3" data-category-id='default' style="display:none">
                            <label for="size">Kích thước</label>
                            <textarea type="text" class="form-control" id="size_default" name="size_default" rows="5"
                                placeholder="Dài / Length: Xcm
                                Rộng / Width: Xcm
                                Vai / Shoulder: Xcm"><?php echo htmlspecialchars($product['size']); ?></textarea>
                        </div>


                        <div class="color mb-3">
                            <label for="color">Màu sắc</label>
                            <input type="text" class="form-control"
                                id="color"
                                name="color"
                                value="<?php echo htmlspecialchars($product['color']); ?>">
                        </div>

                        <div class="description mb-3">

                            <label for="description">Mô tả sản phẩm</label>

                            <textarea class="form-control" id="description" name="description" rows="5"><?php echo htmlspecialchars($product['description']); ?>
                            </textarea>
                        </div>

                        <div class="price mb-3">
                            <label for="price">Giá tiền</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
                        </div>


                        <label for="thumb">Hình ảnh (Để trống nếu không muốn thay đổi)</label>
                        <div class="row ">

                            <div class="col ">
                                <div class="input-group mb-1 d-flex flex-column align-items-center">
                                    <span class="input-group-text" style="width: fit-content;">Ảnh đại diện (cũ)</span>
                                    <img src="<?php echo htmlspecialchars($product['thumb']); ?>" height="230" class="ms-2">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width:fit-content;">Ảnh đại diện (mới)</span>
                                    <input type="file" class="form-control" name="thumb">
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-1 d-flex flex-column align-items-center ">
                                    <span class="input-group-text" style="width:fit-content;">Ảnh sau (cũ)</span>
                                    <img src="<?php echo htmlspecialchars($images['img_back']); ?>" height="230" class="ms-2">
                                </div>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" style="width:fit-content;">Ảnh sau (mới)</span>
                                    <input type="file" class="form-control" name="img_back">
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-1 d-flex flex-column align-items-center">
                                    <span class="input-group-text" style="width: fit-content;">Ảnh sau (cũ)</span>
                                    <img src="<?php echo htmlspecialchars($images['img_left']); ?>" height="230" class="ms-2">
                                </div>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" style="width: fit-content;">Ảnh sau (mới)</span>
                                    <input type="file" class="form-control" name="img_left">
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-1 d-flex flex-column align-items-center">
                                    <span class="input-group-text" style="width:fit-content;">Ảnh sau (cũ)</span>
                                    <img src="<?php echo htmlspecialchars($images['img_right']); ?>" height="230" class="ms-2">
                                </div>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text" style="width: fit-content;">Ảnh sau (mới)</span>
                                    <input type="file" class="form-control" name="img_right">
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-1 d-flex flex-column align-items-center">
                                    <span class="input-group-text" style="width: fit-content;">Ảnh sau (cũ)</span>
                                    <img src="<?php echo htmlspecialchars($images['img_zoom']); ?>" height="230" class="ms-2">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: fit-content;">Ảnh sau (mới)</span>
                                    <input type="file" class="form-control" name="img_zoom">
                                </div>
                            </div>

                        </div>
                </div>

                <button type="submit" name="submit_edit_product" class="btn btn-primary">Chỉnh sửa sản phẩm</button>
                </form>
            </div>
        </div>
        <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->



    <script src="<?php echo _HOST_URL_TEMPLATE; ?>/style/js/admin/checkedRadio.js"></script>

</body>

</html>


<?php
require_once './template/playouts/footer.php';
?>