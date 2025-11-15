<?php

if (!defined('_ximen')) {
    die('--- TRUY CẬP KHÔNG HỢP LỆ---');
}
require_once './template/playouts/header.php';
require_once './template/playouts/sidebar.php';


if (isset($_POST['submit_add_style'])) {

    $name = $_POST['name'] ?? '';

    if (empty($name)) {
        $errors[] = "Tên thương hiệu không được để trống";
    }

    $exists = selectOne("SELECT ID FROM style WHERE name = ?", [$name]);
    if ($exists) {
        $errors[] = "Tên phong cách \"$name\" đã tồn tại!";
    }

    if (empty($errors)) {
        $styleData = [
            'name' => $name,
        ];

        $newStyle = insert('style', $styleData);

        if ($newStyle) {
            echo "<script>
                    alert('Đã thêm thương hiệu \"$name\" thành công!');  
                    window.location.href = '" . _HOST_URL . "?module=admin&action=add-style';          
                  </script>";
            exit();
        } else {
            $errors[] = "Lỗi: Không thể thêm vào cơ sở dữ liệu.";
        }
    }

    if (!empty($errors)) {
        $error_message = implode("\\n", $errors);
        echo "<script>alert('Chú ý:\\n$error_message');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm thương hiệu </title>

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
                        <h3 class="mb-0">Thêm phong cách (Style) </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?php _HOST_URL; ?>?module=admin&action=index">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm phong cách</li>
                        </ol>
                    </div>
                </div>

                <div class="add-product">
                    <form method="POST" enctype="multipart/form-data">

                        <div class="name mb-3">
                            <label for="name">Tên phong cách</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <button type="submit" name="submit_add_style" class="btn btn-primary">Thêm phong cách </button>
                    </form>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
</body>

</html>


<?php
require_once './template/playouts/footer.php';
?>