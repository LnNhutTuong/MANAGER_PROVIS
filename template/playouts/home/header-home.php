<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Home</title>

    <style>
        .skip-links {
            display: none;
        }
    </style>
</head>

<body>
    <div class="header-container" style="border-bottom:1px solid black">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse row" id="navbarSupportedContent">
                    <div class="feture col-lg-4">
                        <ul class="navbar-nav me-auto mb-2">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?php echo _HOST_URL; ?>">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo _HOST_URL; ?>?module=home&action=about">Giới thiệu</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="<?php echo _HOST_URL; ?>?module=home&action=product" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sản phẩm
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Denim</a></li>
                                    <li><a class="dropdown-item" href="#">Vintage</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <?php if (isset($_SESSION['group_id']) && $_SESSION['group_id'] == 0): ?>
                                        <li><a class="dropdown-item" href="<?php echo _HOST_URL; ?>?module=home&action=product">More</a></li>
                                        <li><a class="dropdown-item" href="<?php echo _HOST_URL; ?>?module=admin&action=add-product">Thêm sản phẩm</a></li>
                                    <?php else: ?>
                                        <li><a class="dropdown-item" href="<?php echo _HOST_URL; ?>?module=home&action=product">More</a></li>
                                    <?php endif; ?>

                                </ul>
                            </li>

                        </ul>
                    </div>

                    <div class="nameBrand col-lg-4 align-items-center d-flex justify-content-center">
                        <a class="navbar-brand" href="<?php echo _HOST_URL; ?>">
                            <h1>PROVIS</h1>
                        </a>
                    </div>

                    <div class="searchBar col-lg-3" style="width: 333px;">
                        <form class="navber-form" role="search">
                            <input class="form-control  " type="search" placeholder="Tìm kiếm" aria-label="Search" />
                        </form>
                    </div>


                    <?php if (isset($_SESSION['group_id']) && $_SESSION['group_id'] == 0): ?>
                        <li class="nav-item dropdown user-menu col-lg-1 text-center" style="list-style-type: none;">
                            <div class="dropdown-toggle" data-bs-toggle="dropdown">
                                <span class="d-none d-md-inline">
                                    Hello, <?= $_SESSION['user_name'] ?>
                                </span>
                            </div>

                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-start text-center">
                                <!-- <li class="user-header text-bg-primary">
                                    <p>Admin</p>
                                </li> -->

                                <a href="<?= _HOST_URL ?>?module=admin&action=index" class="btn btn-default btn-flat">
                                    Admin page
                                </a>

                                <hr />

                                <a class="nav-link" href="?action=logout">
                                    Đăng xuất
                                </a>
                            </ul>
                        </li>

                    <?php elseif (isset($_SESSION['group_id']) && $_SESSION['group_id'] == 1): ?>
                        <li class="nav-item dropdown user-menu col-lg-1 text-center" style="list-style-type: none;">
                            <div class="dropdown-toggle" data-bs-toggle="dropdown">
                                <span class="d-none d-md-inline">
                                    Hello, <?= $_SESSION['user_name'] ?>
                                </span>
                            </div>

                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-start text-center">
                                <li class="user-header text-bg-primary">
                                    <p>Người dùng</p>
                                </li>

                                <a href="<?= _HOST_URL ?>?module=customers&action=cart" class="btn btn-default btn-flat">
                                    Giỏ hàng
                                </a>

                                <hr />

                                <a class="nav-link" href="?action=logout">
                                    Đăng xuất
                                </a>
                            </ul>
                        </li>

                    <?php else: ?>
                        <div class="loginBtn col-lg-1">
                            <a class="nav-link" href="<?= _HOST_URL ?>?module=auth&action=login">
                                Đăng nhập
                            </a>
                            <a class="nav-link" href="<?= _HOST_URL ?>?module=auth&action=register">
                                Đăng ký
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>