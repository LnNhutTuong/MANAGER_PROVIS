<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

?>

<?php

//Ngan chan truye cap tu ben ngoai
if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

?>

<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/global.css" />

<title>Quên mật khẩu</title>

<?php
layout('header-auth');
?>

<div class="container d-flex justify-content-center mt-5 mb-5">
    <div class="form-container card bg-dark text-white" style="border-radius: 1rem;">
        <div class="card-body p-5 px-5 text-center">

            <div class="mb-md-3 mt-md-3 pb-2">

                <h2 class="fw-bold mb-2 text-uppercase">Quên mật khẩu</h2>

                <div class=" form-outline form-white mb-4">
                    <label class="form-label" for="typeEmailX">Email</label>
                    <div class="input-group">
                        <input type="email" id="typeEmailX" class="form-control form-control-lg" />
                        <button class="btn btn-light" style="border-left:1px solid black">Gửi</button>
                    </div>
                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="typeRamdonText">Mã xác nhận</label>
                    <input type="text" id="typeRamdonText" class="form-control form-control-lg" />
                </div>
                <button class="btn btn-outline-light btn-lg px-4" type="submit">Xác nhận</button>
            </div>

            <!-- QUEN MAT KHAU -->
            <div>
                <p class="mb-0">Bạn chưa có tài khoản? <a href="<?php echo _HOST_URL; ?>?module=auth&action=register" class="text-white-50 fw-bold">Đăng ký </a>
                </p>
            </div>

        </div>
    </div>
</div>

<!-- </div> -->

<?php
layout('footer');
?>