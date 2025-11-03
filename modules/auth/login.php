<?php

//Ngan chan truye cap tu ben ngoai
if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

?>



<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/global.css" />

<title>Đăng nhập</title>

<?php
// require_once './template/playouts/header-auth.php';
layout('header-auth');
?>

<!-- <div class="container d-flex justify-content-center mt-4 mb-4">
    <div class="form-container card bg-dark text-white" style="border-radius: 1rem;">
        <div class="card-body p-3 px-5 text-center">

            <div class="mb-md-3 mt-md-3 pb-2">

                <h2 class="fw-bold mb-2 text-uppercase">Đăng nhập</h2>
                <p class="text-white-50 mb-5">Chào mừng bạn đến với PROVIS!</p>

                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="typeUsernameX">Tài khoản</label>
                    <input type="text" id="typeUsernameX" class="form-control form-control-lg" />
                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="typePasswordX">Mật khẩu</label>
                    <input type="password" id="typePasswordX" class="form-control form-control-lg" />
                </div>

                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="<?php echo _HOST_URL; ?>?module=auth&action=forgot">Quên mật khẩu?</a></p>

                <button class="btn btn-outline-light btn-lg px-4" type="submit">Đăng nhập</button>
            </div>

            <div>
                <p class="mb-0">Bạn chưa có tài khoản? <a href="<?php echo _HOST_URL; ?>?module=auth&action=register" class="text-white-50 fw-bold">Đăng ký </a>
                </p>
            </div>

        </div>
    </div>
</div> -->

<!-- Section: Design Block -->
<section class="">
    <!-- Jumbotron -->
    <div class="px-3 py-4 px-md-5 text-center text-lg-start" style="background-color: hsla(0, 0%, 0%, 1.00)">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight">
                        The best offer <br />
                        <span class="text-primary">for your business</span>
                    </h1>
                    <p style="color: hsla(220, 2%, 76%, 1.00)">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Eveniet, itaque accusantium odio, soluta, corrupti aliquam
                        quibusdam tempora at cupiditate quis eum maiores libero
                        veritatis? Dicta facilis sint aliquid ipsum atque?
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 ">
                    <div class="card">
                        <div class="card-body py-5 px-md-5" style="background-color:black; color:white;">
                            <form>
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="form3Example1">First name</label>
                                            <input type="text" id="form3Example1" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="form3Example2" class="form-control" />
                                            <label class="form-label" for="form3Example2">Last name</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="email" id="form3Example3" class="form-control" />
                                    <label class="form-label" for="form3Example3">Email address</label>
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="form3Example4" class="form-control" />
                                    <label class="form-label" for="form3Example4">Password</label>
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-center mb-4">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                                    <label class="form-check-label" for="form2Example33">
                                        Subscribe to our newsletter
                                    </label>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                                    Sign up
                                </button>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p>or sign up with:</p>
                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>

                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-google"></i>
                                    </button>

                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </button>

                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-github"></i>
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