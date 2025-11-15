<?php

// Ngăn chặn truy cập trực tiếp
if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

require_once './includes/session.php';


layout('auth/header-auth');

$msg = '';
$msg_type = '';
$errors = [];
$oldData = [];

//============== Xử lý submit form ===============
if (isPost()) {
    $filter = filterData();   // Lấy dữ liệu đã lọc
    $oldData = $filter;       // Lưu lại để fill lại form

    //------------- USERNAME -------------
    $username_value = trim($filter['username'] ?? '');

    if (empty($username_value)) {
        $errors['username']['required'] = 'Username không được để trống';
    } else {
        if (strlen($username_value) < 6) {
            $errors['username']['length'] = 'Username phải dài hơn 6 ký tự';
        }
        if (strpos($username_value, ' ') !== false) {
            $errors['username']['no_space'] = 'Username không được chứa khoảng trắng.';
        }
        // Có dấu / ký tự unicode
        if (preg_match('/[^\x00-\x7F]+/', $username_value)) {
            $errors['username']['no_accent'] = 'Username không được chứa ký tự có dấu hoặc ký tự đặc biệt.';
        }

        // Nếu không có lỗi cơ bản thì mới kiểm tra trùng
        if (empty($errors['username'])) {
            $checkUsername = getRows("SELECT * FROM users WHERE username = '$username_value' ");
            if ($checkUsername > 0) {
                $errors['username']['check'] = 'Username đã tồn tại trên hệ thống.';
            }
        }
    }

    //------------- EMAIL -------------
    $email_value = trim($filter['email'] ?? '');

    if (empty($email_value)) {
        $errors['email']['required'] = 'Email không được để trống';
    } else {
        if (!validateEmail($email_value)) {
            $errors['email']['isEmail'] = 'Email không đúng định dạng';
        } else {
            $checkEmail = getRows("SELECT * FROM users WHERE email = '$email_value' ");
            if ($checkEmail > 0) {
                $errors['email']['check'] = 'Email đã tồn tại trên hệ thống.';
            }
        }
    }

    //------------- PHONE -------------
    $phone_value = trim($filter['phone'] ?? '');

    if (empty($phone_value)) {
        $errors['phone']['required'] = 'Số điện thoại không được để trống.';
    } else {
        if (!validatePhone($phone_value)) {
            $errors['phone']['isPhone'] = 'Số điện thoại không hợp lệ (ví dụ: 0xxxxxxxx).';
        } else {
            $checkPhone = getRows("SELECT * FROM users WHERE phone = '$phone_value' ");
            if ($checkPhone > 0) {
                $errors['phone']['check'] = 'Số điện thoại đã tồn tại trên hệ thống.';
            }
        }
    }

    //------------- PASSWORD -------------
    $password_value = trim($filter['password'] ?? '');

    if (empty($password_value)) {
        $errors['password']['required'] = 'Mật khẩu không được để trống';
    } else if (strlen($password_value) < 6) {
        $errors['password']['length'] = 'Mật khẩu phải dài hơn 6 ký tự';
    }

    //------------- CONFIRM PASSWORD -------------
    $confirm_password_value = trim($filter['confirm-password'] ?? '');

    if (empty($confirm_password_value)) {
        $errors['confirm-password']['required'] = 'Mật khẩu không được để trống';
    } else if ($password_value !== $confirm_password_value) {
        $errors['confirm-password']['like'] = 'Mật khẩu không trùng khớp';
    }

    //------------- NẾU KHÔNG CÓ LỖI -------------
    if (empty($errors)) {
        $activeToken = sha1(uniqid() . time());

        $data = [
            'username'     => $username_value,
            'email'        => $email_value,
            'phone'        => $phone_value,
            'password'     => password_hash($password_value, PASSWORD_DEFAULT),
            'active_token' => $activeToken,
            'status'       => 0, // chưa kích hoạt
            'created_at'   => date('Y-m-d H:i:s')
        ];

        $insertStatus = insert('users', $data);

        if ($insertStatus) {
            // Gửi email kích hoạt
            $emailTo = $email_value;
            $subject = 'Kích hoạt tài khoản hệ thống';
            $content  = 'Chúc mừng bạn đã đăng ký thành công tài khoản tại website của chúng tôi.<br>';
            $content .= 'Để kích hoạt tài khoản, bạn hãy click vào đường link bên dưới:<br>';
            $content .= _HOST_URL . '/?module=auth&action=active&token=' . $activeToken . '<br><br>';
            $content .= 'Trân trọng.';

            sendMail($emailTo, $subject, $content);

            $msg = 'Đăng ký tài khoản thành công, vui lòng kiểm tra email để kích hoạt.';
            $msg_type = 'success';

            // Xoá dữ liệu form sau khi đăng ký thành công
            $oldData = [];
        } else {
            $msg = 'Đăng ký tài khoản không thành công, vui lòng thử lại.';
            $msg_type = 'danger';
        }
    } else {
        $msg = 'Dữ liệu không hợp lệ, hãy kiểm tra lại!';
        $msg_type = 'danger';
    }
}

?>
<title>Đăng ký</title>

<section class="">
    <div class="px-3 py-4 px-md-5 text-center text-lg-start"
        style="background-color: hsla(0, 0%, 0%, 1.00); margin-left: 160px">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">

                <!-- Cột giới thiệu bên trái -->
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight">
                        The best offer <br />
                        <span class="text-primary"> for your STYLE</span>
                    </h1>
                    <p style="color: hsla(220, 2%, 76%, 1.00)">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Eveniet, itaque accusantium odio, soluta, corrupti aliquam
                        quibusdam tempora at cupiditate quis eum maiores libero
                        veritatis? Dicta facilis sint aliquid ipsum atque?
                    </p>
                </div>

                <!-- Cột form đăng ký bên phải -->
                <div class="col-lg-6 mb-5 mb-lg-0" style="width: 480px;">
                    <div class="card" style="box-shadow: rgba(255, 255, 255, 0.31) 0px 5px 15px !important;">
                        <div class="card-body py-4 px-md-3"
                            style="background-color:hsla(0, 2%, 12%, 1.00); color:white;">

                            <h1 class="text-center">Đăng ký</h1>

                            <?php if (!empty($msg)): ?>
                                <div class="alert alert-<?php echo $msg_type; ?> mt-3">
                                    <?php echo $msg; ?>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="" enctype="multipart/form-data">

                                <!-- Username -->
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="username">Tên đăng nhập</label>
                                    <input name="username" type="text" id="username"
                                        value="<?php echo !empty($oldData['username']) ? htmlspecialchars($oldData['username']) : ''; ?>"
                                        class="form-control form-control-lg" placeholder="Nhập tên">
                                    <div style="padding: 5px; font-style: italic; color: red;">
                                        <?php echo !empty($errors['username']) ? reset($errors['username']) : ''; ?>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" name="email" id="email"
                                        value="<?php echo !empty($oldData['email']) ? htmlspecialchars($oldData['email']) : ''; ?>"
                                        class="form-control form-control-lg" placeholder="Email">
                                    <div style="padding: 5px; font-style: italic; color: red;">
                                        <?php echo !empty($errors['email']) ? reset($errors['email']) : ''; ?>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="phone">Số điện thoại</label>
                                    <input name="phone" type="text" id="phone"
                                        value="<?php echo !empty($oldData['phone']) ? htmlspecialchars($oldData['phone']) : ''; ?>"
                                        class="form-control form-control-lg" placeholder="Phone">
                                    <div style="padding: 5px; font-style: italic; color: red;">
                                        <?php echo !empty($errors['phone']) ? reset($errors['phone']) : ''; ?>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="password">Mật khẩu</label>
                                    <input name="password" type="password" id="password"
                                        class="form-control form-control-lg" placeholder="Mật khẩu">
                                    <div style="padding: 5px; font-style: italic; color: red;">
                                        <?php echo !empty($errors['password']) ? reset($errors['password']) : ''; ?>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="confirm-password">Xác nhận mật khẩu</label>
                                    <input name="confirm-password" type="password" id="confirm-password"
                                        class="form-control form-control-lg" placeholder="Xác nhận mật khẩu">
                                    <div style="padding: 5px; font-style: italic; color: red;">
                                        <?php echo !empty($errors['confirm-password']) ? reset($errors['confirm-password']) : ''; ?>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-dark mt-3" style="width: 120px; height: 43px;">
                                        Đăng ký
                                    </button>
                                </div>

                                <div class="login-container mt-3 text-center">
                                    <p class="mb-0">
                                        Bạn đã có tài khoản?
                                        <a href="<?php echo _HOST_URL; ?>?module=auth&action=login"
                                            class="text-light-50 fw-bold">Đăng nhập</a>
                                    </p>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php
layout('footer');
?>