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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                                <li><a class="dropdown-item" href="<?php echo _HOST_URL; ?>?module=home&action=product">More</a></li>
                            </ul>
                        </li>

                    </ul>
                    <a class="navbar-brand " href="<?php echo _HOST_URL; ?>">
                        <h1>PROVIS</h1>
                    </a>

                    <form class=" d-flex " role="search">
                        <input class="form-control ms-5 me-2" type="search" placeholder="Tìm kiếm" aria-label="Search" style="width: 448px;" />
                    </form>

                    <a class="nav-link" href="<?php echo _HOST_URL; ?>?module=auth&action=login">Đăng nhập</a>

                </div>

            </div>
        </nav>
    </div>