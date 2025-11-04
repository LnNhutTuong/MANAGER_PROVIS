<?php

//Ngan chan truye cap tu ben ngoai
if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

?>

<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/global.css" />

<title>Đăng ký</title>


<?php
layout('header-auth');

$msg = '';
$msg_type = '';

if (isPost()) {
    $filter = filterData();

    $errors = [];

    //username
    if (empty(trim($filter['username']))) {
        $errors['username']['required'] = 'Họ tên không được để trống';
    } else {
        if (strlen(trim(($filter['username']))) <= 5) {
            $errors['username']['required'] = 'Họ tên phải dài hơn 6 ký tự';
        }
    }

    //email
    if (empty(trim($filter['email']))) {
        $errors['email']['required'] = 'Email không được để trống';
    } else {
        if (!validateEmail(trim($filter['email']))) {
            $errors['email']['required'] = 'Email không đúng định dạng';
        } else {
            $email = $filter['email'];

            $check = getRows("SELECT * FROM user WHERE email = '$email'");

            var_dump($check);
        }
    }

    //password
    if (empty(trim($filter['password']))) {
        $errors['password']['required'] = 'Mật khẩu không được để trống';
    } else {
        if (strlen(trim($filter['password'])) <= 6) {
            $errors['password']['required'] = 'Mật khẩu phải dài hơn 6 ký tự';

            if (trim($filter['password']) !== trim(($filter['confirm-password']))) {
                $errors['password']['required'] = 'Mật khẩu nhập lại không đúng ';
            }
        }
    }


    // if (empty($errors)) {
    //     $msg = 'Đăng ký thành công';
    //     $msg_type = 'green';
    // } else {
    //     $eUser = $errors['username']['required'];
    //     if ($eUser) {
    //         $msg = 'Không được bỏ trống, từ 5 ký tự.';
    //     }

    //     $eUser = $errors['email']['required'];
    //     if ($eUser) {
    //         $msg = 'Không được bỏ trống, chú ý cấu trúc Email.';
    //     }
    //     $msg_type = 'red';
    // }
}

?>


<!-- Section: Design Block -->
<section class="">
    <!-- Jumbotron -->
    <div class="px-3 py-4 px-md-5 text-center text-lg-start" style="background-color: hsla(0, 0%, 0%, 1.00)">
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

                <div class="col-lg-6 mb-5 mb-lg-2 mt-2 ml-2" style="width: 478px;">
                    <div class="card">
                        <div class="card-body py-4 px-md-3" style="background-color:black; color:white;">
                            <h1 class="text-center">Đăng ký</h1>
                            <form method="POST">

                                <div data-mdb-input-init class="form-outline mb-3">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="username">Tên đăng nhập</label>
                                        <input name='username' type="text" id="username" class="form-control" />
                                        <?php getMsg($msg, $msg_type) ?>
                                    </div>
                                </div>


                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" />
                                    <?php getMsg($msg, $msg_type) ?>
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="password">Mật khẩu</label>
                                    <input name="password" type="password" id="password" class="form-control" />
                                    <?php getMsg('Không được bỏ trống, phải có từ 6 ý tự.', $msg_type) ?>
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="confirm-password">Xác nhận mật khẩu</label>
                                    <input name="confirm-password" type="password" id="confirm-password" class="form-control" />
                                    <?php getMsg('Không được bỏ trống, phải trùng với mật khẩu ở trên', $msg_type) ?>

                                </div>

                                <!-- Submit button -->
                                <div class="text-center ">
                                    <button type="submit" class="btn btn-dark mt-3" style="width: 120px; height: 43px;">
                                        Đăng ký
                                    </button>
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