<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}
?>

<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/global.css" />

<title>Kích hoạt tài khoảng thành công</title>


<?php
layout('header-auth');
?>

<div class="container d-flex justify-content-center mt-4">
    <div class="form-container card bg-dark text-white h-fit" style="border-radius: 1rem; height: fit-content">
        <div class="card-body p-3 px-5 text-center">

            <div class="mb-md-2 mt-md-2 pb-1">

                <h2 class="fw-bold mb-2 text-uppercase">Kích hoạt tài khoảng thành công</h2>

                <div class="login-container mt-3 text-center">
                    <p class="mb-0"><a href="<?php echo _HOST_URL; ?>?module=auth&action=login"
                            class="text-light-50 fw-bold">Đăng nhập ngay</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- </div> -->

<?php
layout('footer');
?>