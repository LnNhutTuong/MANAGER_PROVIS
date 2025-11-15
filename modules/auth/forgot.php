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

$msg = '';
$msg_type = '';

//==============Kiem tra===============
// if (isPost()) {
//     $filter = filterData();

//     $errors = [];

//     //username
//     if (empty(trim($filter['username']))) {
//         $errors['username']['required'] = 'Họ tên không được để trống';
//     } else {
//         if (strlen(trim(($filter['username']))) < 5) {
//             $errors['username']['required'] = 'Họ tên phải dài hơn 6 ký tự';
//         }
//     }

//     //email
//     if (empty(trim($filter['email']))) {
//         $errors['email']['required'] = 'Email không được để trống';
//     } else {
//         if (!validateEmail(trim($filter['email']))) {
//             $errors['email']['required'] = 'Email không đúng định dạng';
//         } else {
//             $email = $filter['email'];

//             $check = getRows("SELECT * FROM user WHERE email = '$email'");

//             var_dump($check);
//         }
//     }

//     //password
//     if (empty(trim($filter['password']))) {
//         $errors['password']['required'] = 'Mật khẩu không được để trống';
//     } else {
//         if (strlen(trim($filter['password'])) < 6) {
//             $errors['password']['required'] = 'Mật khẩu phải dài hơn 6 ký tự';

//             if (trim($filter['password']) !== trim(($filter['confirm-password']))) {
//                 $errors['password']['required'] = 'Mật khẩu nhập lại không đúng ';
//             }
//         }
//     }


//     if (empty($errors)) {
//         $msg = 'Đăng ký thành công';
//         $msg_type = 'green';
//     } else {
//         $eUser = $errors['username']['required'];
//         if ($eUser) {
//             $msg = 'Không được bỏ trống, từ 5 ký tự.';
//         }

//         $eUser = $errors['email']['required'];
//         if ($eUser) {
//             $msg = 'Không được bỏ trống, chú ý cấu trúc Email.';
//         }

//         $msg_type = 'red';
//     }
// }

// 
//===================================
?>



<!-- Section: Design Block -->
<section class="">
    <!-- Jumbotron -->
    <div class="px-3 py-4 px-md-5 text-center text-lg-start"
        style="background-color: hsla(0, 0%, 0%, 1.00); margin-left: 160px">
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
                        <div class="card-body py-4 px-md-3 pt-5" style="background-color:hsla(0, 2%, 12%, 1.00); 
                                        color:white;  height: 563px !important;
                                        padding-top: 7rem !important ;">
                            <h1 class="text-center">Quên mật khẩu</h1>
                            <form method="POST">

                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="typeEmailX">Email</label>
                                    <input type="email" id="typeEmailX" class="form-control form-control-lg" />
                                </div>

                                <!-- Submit button -->
                                <div class="text-center ">
                                    <button type="submit" class="btn btn-dark mt-3" style="width: 120px; height: 43px;">
                                        Gửi
                                    </button>
                                </div>

                                <div class="register-container mt-3 text-center">
                                    <p class="mb-0">Bạn chưa có tài khoản? <a
                                            href="<?php echo _HOST_URL; ?>?module=auth&action=register"
                                            class="text-light-50 fw-bold">Đăng ký </a>
                                    </p>
                                </div>

                                <div class="login-container mt-3 text-center">
                                    <p class="mb-0">Bạn đã có tài khoản? <a
                                            href="<?php echo _HOST_URL; ?>?module=auth&action=login"
                                            class="text-light-50 fw-bold">Đăng nhập </a>
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