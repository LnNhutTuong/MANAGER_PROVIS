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

//==============Kiem tra===============
 if (isPost()) {
    $filter = filterData();
    $errors = [];

    //username
    if (empty(trim($filter['username']))) {
        $errors['username']['required'] = 'Họ tên không được để trống';
    } else {
        if (strlen(trim(($filter['username']))) < 5) {
            $errors['username']['length'] = 'Họ tên phải dài hơn 6 ký tự';
        }
    }

    //email 
    if (empty(trim($filter['email']))) {
        $errors['email']['required'] = 'Email không được để trống';
    } else {
        if (!validateEmail(trim($filter['email']))) {
            $errors['email']['isEmail'] = 'Email không đúng định dạng';
        } else {
            $email = $filter['email'];
            $checkEmail = getRows("SELECT * FROM users WHERE email = '$email' ");
            if ($checkEmail>0) { // Giả định $check chứa dữ liệu hoặc trả về true/số > 0
                $errors['email']['check'] = 'Email đã tồn tại trên hệ thống.';
            }
        }
    }

    //phone
    if (empty(trim($filter['phone']))) {
        $errors['phone']['required'] = 'Số điện thoại không được để trống.';
    } else {
        if (!validatePhone($filter['phone'])) {
            $errors['phone']['validatePhone'] = 'Số điện thoại không hợp lệ (ví dụ: 0xxxxxxxx).';
        }
    }

    //password
    if (empty(trim($filter['password']))) {
        $errors['password']['required'] = 'Mật khẩu không được để trống';
    } else if(strlen(trim($filter['password'])) < 6) {
            $errors['password']['length'] = 'Mật khẩu phải dài hơn 6 ký tự';
    }
    
    //confirm-password
    if (empty(trim($filter['confirm-password']))) {
        $errors['confirm-password'] = 'Mật khẩu không được để trống';
    } else if(trim($filter['password']) !== trim($filter['confirm-password'])) {
            $errors['confirm-password']['like'] = 'Mật khẩu không trùng khớp';
    }
 

    if(empty($errors)){
        $msg = 'Đăng Ký tài khoảng thành công';
        $msg_type = 'succes';
    }else {
        $msg = 'Dữ liệu không hợp lệ, hãy kiểm tra lại!';
        $msg_type = 'danger';
    }

    
 }

// 
//===================================
?>

<!-- Section: Design Block -->
<section class="">
    <!-- Jumbotron -->
    <div class="px-3 py-4 px-md-5 text-center text-lg-start "
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

                <div class="col-lg-6 mb-5 mb-lg-0 " style="width: 480px;">
                    <div class="card" style="box-shadow: rgba(255, 255, 255, 0.31) 0px 5px 15px !important;">
                        <div class=" card-body py-4 px-md-3"
                            style="background-color:hsla(0, 2%, 12%, 1.00); color:white;">
                            <?php getMsg($msg, $msg_type)?>
                            <h1 class="text-center">Đăng ký</h1>
                            <form method="POST" action="" enctype="multipart/form-data">
                                <!-- Tên đăng nhập, email, phone, active-tocken, status-->
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="username">Tên đăng nhập</label>
                                        <input name='username' type="text" class="form-control form-control-lg"
                                            placeholder="Nhập tên">
                                        <div class="error">
                                            <?php echo !empty($errors['username']) ? $errors['username'] : false;?>lỗi
                                        </div>
                                    </div>
                                </div>


                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" name="email" class="form-control form-control-lg"
                                        placeholder="Email">

                                    <!-- phone input -->
                                    <div data-mdb-input-init class="form-outline mb-3">
                                        <label class="form-label" for="phone">Số điện thoại</label>
                                        <input name="phone" type="text" id="phone" class="form-control form-control-lg"
                                            placeholder="Phone">

                                    </div>

                                    <!-- Password input -->
                                    <div data-mdb-input-init class="form-outline mb-3">
                                        <label class="form-label" for="password">Mật khẩu</label>
                                        <input name="password" type="password" id="password"
                                            class="form-control form-control-lg" placeholder="Mật khẩu">

                                    </div>

                                    <!-- Password input -->
                                    <div data-mdb-input-init class="form-outline mb-3">
                                        <label class="form-label" for="confirm-password">Xác nhận mật khẩu</label>
                                        <input name="confirm-password" type="password" id="confirm-password"
                                            class="form-control form-control-lg" placeholder="Xác nhật mật khẩu">
                                    </div>

                                    <!-- Submit button -->
                                    <div class="text-center ">
                                        <button type="submit" class="btn btn-dark mt-3"
                                            style="width: 120px; height: 43px;">
                                            Đăng ký
                                        </button>
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


<!-- 
if(!empty($errors)){
        echo '<pre>';
        print_r($errors);
        echo '</pre>';
} 
-->