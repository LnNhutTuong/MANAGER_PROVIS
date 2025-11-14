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

$msg = '';
$msg_type = '';

$filter = filterData($_GET);  // lấy token từ URL

if (!empty($filter['token'])) {

    $token = $filter['token'];

    // Lấy user có token giống như trong DB
    $user = selectOne("SELECT * FROM users WHERE active_token = '$token'");

    if (!empty($user)) {

        // Nếu user chưa kích hoạt
        if ((int)$user['status'] === 0) {

            $dataUpdate = [
                'status'       => 1,                     // đổi thành kích hoạt
                'active_token' => null,                  // xóa token
                'update_at'    => date('Y-m-d H:i:s')    // cập nhật thời gian
            ];

            // Khóa chính là cột id
            $condition = 'id = ' . intval($user['id']);

            $updateStatus = update('users', $dataUpdate, $condition);

            if ($updateStatus) {
                $msg = 'Tài khoản của bạn đã được kích hoạt thành công!';
                $msg_type = 'success';
            } else {
                $msg = 'Lỗi hệ thống, không thể kích hoạt tài khoản.';
                $msg_type = 'danger';
            }

        } else {
            // Đã kích hoạt từ trước
            $msg = 'Tài khoản này đã được kích hoạt trước đó.';
            $msg_type = 'info';
        }

    } else {
        // Không tìm thấy token
        $msg = 'Link kích hoạt không hợp lệ hoặc token đã hết hạn.';
        $msg_type = 'danger';
    }

} else {
    $msg = 'Không tìm thấy mã kích hoạt.';
    $msg_type = 'danger';
}

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