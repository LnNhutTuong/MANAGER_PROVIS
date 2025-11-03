<?php

//Ngan chan truye cap tu ben ngoai
if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

?>

<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/global.css" />

<title>Đổi mật khẩu</title>


<?php
layout('header-auth');
?>

<div class="container d-flex justify-content-center mt-4">
    <div class="form-container card bg-dark text-white h-fit" style="border-radius: 1rem; height: fit-content">
        <div class="card-body p-3 px-5 text-center">

            <div class="mb-md-2 mt-md-2 pb-1">

                <h2 class="fw-bold mb-2 text-uppercase">Đổi mật khẩu</h2>

                <div class=" form-outline form-white mb-4">
                    <label class="form-label" for="typeEmailX">Email</label>
                    <div class="input-group">
                        <input type="email" id="typeEmailX" class="form-control form-control-lg" />
                        <button class="btn btn-light" style="border-left:1px solid black">Gửi</button>
                    </div>
                </div>

                <div class="form-outline form-white mb-3">
                    <label class="form-label" for="typePasswordX">Mật khẩu cũ</label>
                    <input type="password" id="typePasswordX" class="form-control form-control-lg" />
                </div>

                <!-- Xac nhan mat khau -->
                <div class="form-outline form-white mb-3">
                    <label class="form-label" for="typePasswordX">Mật khẩu mới</label>
                    <input type="password" id="typePasswordX" class="form-control form-control-lg" />
                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="typeRamdonText">Mã xác nhận</label>
                    <input type="text" id="typeRamdonText" class="form-control form-control-lg" />
                </div>


                <button class="btn btn-outline-light btn-lg px-4 " type="submit">Thực hiện</button>
            </div>

        </div>
    </div>
</div>

<!-- </div> -->

<?php
layout('footer');
?>