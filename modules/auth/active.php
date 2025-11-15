<?php

// Ngăn chặn truy cập trực tiếp
if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

?>

<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/global.css" />
<title>Kích hoạt tài khoản</title>

<?php
layout('header-auth');

$filter = filterData($_GET);
echo '<pre>';
print_r($filter);
echo '</pre>';

?>

<div class="container d-flex justify-content-center mt-4">
    <div class="card bg-dark text-white" style="border-radius: 1rem; width: 450px;">
        <div class="card-body p-4 text-center">

            <h2 class="fw-bold text-uppercase mb-3">Kích hoạt tài khoản</h2>

            <?php if (!empty($msg)): ?>
            <div class="alert alert-<?php echo $msg_type; ?>">
                <?php echo $msg; ?>
            </div>
            <?php endif; ?>

            <a href="<?php echo _HOST_URL; ?>?module=auth&action=login" class="btn btn-primary mt-3">Đăng nhập ngay</a>

        </div>
    </div>
</div>

<?php
layout('footer');
?>