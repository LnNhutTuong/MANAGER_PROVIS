<?php

//Ngan chan truye cap tu ben ngoai
if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

?>



<?php
layout('auth/header-auth');

$msg = '';
$msg_type = '';

if (isPost()) {
    $filter = filterData();   // Lấy dữ liệu đã lọc
    $oldData = $filter;
    $errors = [];

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
    }
    if (empty($errors['username'])) {
        $checkUsername = getRows("SELECT id FROM users WHERE username = '$username_value' ");
        // Lỗi này xảy ra khi hàm getRows() chưa được khai báo
        if ($checkUsername   == 0) {
            $errors['username']['check'] = 'Username không tồn tại trên hệ thống.';
        }
    }


    $password_value = trim($filter['password'] ?? '');
    if (empty($password_value)) {
        $errors['password']['required'] = 'Mật khẩu không được để trống';
    } else if (strlen($password_value) < 6) {
        $errors['password']['length'] = 'Mật khẩu phải dài hơn 6 ký tự';
    }

    if (empty($errors)) {
        $username = $filter['username'];
        $password = $filter['password'];

        $checkUsername = selectOne("SELECT * FROM users WHERE username = '$username'");
        if (!empty($checkUsername)) {
            if (!empty($password)) {
                $checkStatus = password_verify($password, $checkUsername['password']);
                if ($checkStatus) {
                    $token = sha1(uniqid() . time());
                    $data = [
                        'token' => $token,
                        'created_at' => date('Y:m:d H:i:s'),
                        'user_id' => $checkUsername['id']
                    ];
                    $insertToken = insert('token_login', $data);
                    if ($insertToken) {
                        redirect('/');
                    } else {
                        $msg = 'Đăng nhập không thành công';
                        $msg_type = 'danger';
                    }
                } else {
                    // Xử lý khi không tìm thấy username
                    $errors['password']['mismatch'] = 'Mật khẩu không đúng.';
                    $msg = 'Vui lòng kiểm tra dữ liệu nhập vào.';
                    $msg_type = 'danger';
                }
            }
        }
    } else {
        $msg = 'Dữ liệu không hợp lệ, hãy kiểm tra lại!';
        $msg_type = 'danger';
    }
}
?>



<title>Đăng nhập</title>

<!-- Section: Design Block -->
<section class="">
    <!-- Jumbotron -->
    <div class="px-3 py-4 px-md-5 text-center text-lg-start">
        <div class="container ">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight">
                        The best offer <br />
                        <span class="text-primary"> for your STYLE</span>
                    </h1>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Eveniet, itaque accusantium odio, soluta, corrupti aliquam
                        quibusdam tempora at cupiditate quis eum maiores libero
                        veritatis? Dicta facilis sint aliquid ipsum atque?
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 " style="width: 555px;">
                    <div class="card " style="height: 700px;">

                        <div class="card-body d-flex flex-column justify-content-evenly ">
                            <div>
                                <h1 class="text-center display-4 fw-bolder">Đăng nhập</h1>
                            </div>

                            <form method="POST" class="align-items-center">

                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div data-mdb-input-init class="form-outline mb-3">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="username">Tên đăng nhập</label>
                                            <input name='username' type="text" id="username" class="form-control"
                                                value="<?php echo (!empty($filter['username'])) ? $filter['username'] : ''; ?>"
                                                class="form-control form-control-lg" />
                                            <div style="padding: 5px; font-style: italic; color: red;">
                                                <?php echo !empty($errors['username']) ? reset($errors['username']) : ''; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Password input -->
                                    <div data-mdb-input-init class="form-outline mb-3">
                                        <label class="form-label" for="password">Mật khẩu</label>
                                        <input name="password" type="password" id="password" class="form-control"
                                            value="<?php echo (!empty($filter['password'])) ? $filter['password'] : ''; ?>"
                                            class="form-control form-control-lg" />
                                        <div style="padding: 5px; font-style: italic; color: red;">
                                            <?php echo !empty($errors['password']) ? reset($errors['password']) : ''; ?>
                                        </div>
                                    </div>

                                    <!-- Forgot password -->
                                    <div class="forgot-container mt-3">
                                        <p class="mb-0">Quên mật khẩu? <a
                                                href="<?php echo _HOST_URL; ?>?module=auth&action=forgot"
                                                class="text-light-50 fw-bold">Lấy lại mật khẩu</a>
                                        </p>
                                    </div>
                                    <!-- Submit button -->
                                    <div class="text-center ">
                                        <button type="submit" class="btn btn-dark mt-3" style="width: 120px; height: 43px;">
                                            Đăng nhập
                                        </button>
                                    </div>

                                    <div class="register-container mt-3 text-center">
                                        <p class="mb-0">Chưa có tài khoản? <a
                                                href="<?php echo _HOST_URL; ?>?module=auth&action=register"
                                                class="text-light-50 fw-bold">Đăng ký </a>
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