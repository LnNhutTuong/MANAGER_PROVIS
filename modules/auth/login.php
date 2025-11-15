<?php

//Ngan chan truye cap tu ben ngoai
if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

?>

<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/global.css" />


<title>Đăng nhập</title>


<?php
layout('header-auth');

$msg = '';
$msg_type = '';


$hashedPassword1 = password_hash('123456', PASSWORD_DEFAULT);
$hashedPassword2 = password_hash('123321', PASSWORD_DEFAULT);


if (isPost()) { // Kiểm tra khi người dùng bấm nút submit

    $filter = filterData();

    $username = $filter['username'];
    $password = $filter['password'];

    $user = selectOne("SELECT * FROM users WHERE username = ?", [$username]);

    // echo '<pre>';
    // print_r($user);
    // echo '</pre>';

    if (!empty($user)) {
        if (password_verify($password, $hashedPassword1)) {

            $_SESSION['user_name'] = $user['username'];
            $_SESSION['group_id'] = $user['group_id'];

            header('Location: ' . _HOST_URL);
            exit();
        } else {
            $msg = 'Sai tên đăng nhập hoặc mật khẩu.';
            $msg_type = 'red';
        }
    } else {
        $msg = 'Sai tên đăng nhập hoặc mật khẩu.';
        $msg_type = 'red';
    }
}

?>


<!-- Section: Design Block -->
<section class="">
    <!-- Jumbotron -->
    <div class="px-3 py-4 px-md-5 text-center text-lg-start" style="background-color: hsla(0, 0%, 0%, 1.00); margin-left: 160px">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
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

                <div class="col-lg-6 mb-5 mb-lg-0" style="width: 480px;">
                    <div class="card" style="box-shadow: rgba(255, 255, 255, 0.31) 0px 5px 15px !important;">
                        <div class=" card-body py-4 px-md-3 pt-5"
                            style="background-color:hsla(0, 2%, 12%, 1.00); 
                                        color:white;  height: 563px !important;
                                        padding-top: 5rem !important ;
                                        ">
                            <h1 class="text-center">Đăng nhập</h1>
                            <form method="POST">

                                <div data-mdb-input-init class="form-outline mb-3">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="username">Tên đăng nhập</label>
                                        <input name='username' type="text" id="username" class="form-control" />
                                        <?php getMsg($msg, $msg_type) ?>
                                    </div>
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="password">Mật khẩu</label>
                                    <input name="password" type="password" id="password" class="form-control" />
                                    <?php getMsg($msg, $msg_type) ?>
                                </div>

                                <!-- Forgot password -->
                                <div class="forgot-container mt-3">
                                    <p class="mb-0">Bạn quên mật khẩu? <a href="<?php echo _HOST_URL; ?>?module=auth&action=forgot" class="text-light-50 fw-bold">Lấy lại mật khẩu</a>
                                    </p>
                                </div>
                                <!-- Submit button -->
                                <div class="text-center ">
                                    <button type="submit" class="btn btn-dark mt-3" style="width: 120px; height: 43px;">
                                        Đăng nhập
                                    </button>
                                </div>

                                <div class="register-container mt-3 text-center">
                                    <p class="mb-0">Bạn chưa có tài khoản? <a href="<?php echo _HOST_URL; ?>?module=auth&action=register" class="text-light-50 fw-bold">Đăng ký </a>
                                    </p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
<?php
layout('footer');
?>