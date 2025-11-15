<?php
if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-C8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Home</title>

    <style>
        .skip-links {
            display: none;
        }
    </style>
</head>

<body>
    <div class="header-container">
        <nav class="navbar navbar-expand-lg bg-white shadow-sm border-bottom position-relative">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <a class="navbar-brand position-absolute top-50 start-50 translate-middle" href="<?php echo _HOST_URL; ?>">
                    <h1>PROVIS</h1>
                </a>

                <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo _HOST_URL; ?>">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo _HOST_URL; ?>?module=home&action=about">Giới thiệu</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="<?php echo _HOST_URL; ?>?module=home&action=product" role="button">
                                Sản phẩm
                            </a>
                            <!-- <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Denim</a></li>
                                <li><a class="dropdown-item" href="#">Vintage</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?php echo _HOST_URL; ?>?module=home&action=product">More</a></li>
                            </ul> -->
                        </li>
                    </ul>

                    <div class="d-flex align-items-center mx-end">
                        <form class="d-flex" role="search" method="GET" action="index.php">
                            <input type="hidden" name="module" value="home">
                            <input type="hidden" name="action" value="search">
                            <div class="input-group">
                                <input class="form-control" type="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Search" name="keyword" />
                                <button class="btn btn-dark" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>

                        <div class="ms-lg-3">
                            <?php if (isset($_SESSION['group_id']) && $_SESSION['group_id'] == 0) : ?>
                                <div class="nav-item dropdown user-menu text-center">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <span class="d-none d-md-inline">
                                            Hello, <?= $_SESSION['user_name'] ?>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end text-center">
                                        <li>
                                            <a href="<?= _HOST_URL ?>?module=admin&action=index" class="dropdown-item">
                                                Admin page
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="?action=logout">
                                                Đăng xuất
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            <?php elseif (isset($_SESSION['group_id']) && $_SESSION['group_id'] == 1) : ?>
                                <div class="nav-item dropdown user-menu text-center">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <span class="d-none d-md-inline">
                                            Hello, <?= $_SESSION['user_name'] ?>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end text-center">
                                        <li class="user-header text-bg-primary p-2">
                                            <p class="mb-0">Người dùng</p>
                                        </li>
                                        <li>
                                            <a href="<?= _HOST_URL ?>?module=customers&action=cart" class="dropdown-item">
                                                Giỏ hàng
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="?action=logout">
                                                Đăng xuất
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            <?php else : ?>
                                <div class="loginBtn d-flex align-items-center">
                                    <a class="btn btn-outline-dark btn-sm me-2" href="<?= _HOST_URL ?>?module=auth&action=login">
                                        Đăng nhập
                                    </a>
                                    <a class="btn btn-dark btn-sm" href="<?= _HOST_URL ?>?module=auth&action=register">
                                        Đăng ký
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>