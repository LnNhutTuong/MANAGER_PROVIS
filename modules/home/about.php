<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}


layout('/home/header-home');
?>


<link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATE; ?>/style/css/home/about.css">

<div class="body-container container">
    <div class="introduce-container  mt-4 mb-4 ">
        <div class="text-center">
            <h2>GIỚI THIỆU</h2>
        </div>
        <div class="row">
            <div class="introduce-full text-justify col-lg-9 ms-3">
                <span> Được thành lập năm 2025, là sự kết hợp của những thành viên đều có chung niềm đam mê thời trang
                    và mong muốn mang lại những giá trị bền vững cho cộng đồng. Chúng tôi tin rằng thời trang không chỉ là
                    về vẻ bề ngoài, mà còn là cách chúng ta tôn trọng chính bản thân mình và cả người khác thông qua những
                    lựa chọn trang phục hàng ngày.
                </span>
                <p>
                    Khi đến <span style="font-weight: bold;">PROVIS</span>, chúng tôi cam kết mang đến cho bạn những trải nghiệm mua sắm tuyệt vời nhất với sự đa dạng về
                    sản phẩm, từ những thiết kế thời trang hiện đại đến những món đồ cổ điển vượt thời gian. Chúng tôi luôn cập nhật
                    xu hướng mới nhất và chắc chắc sẽ giúp bạn xây dựng một tủ đồ đa dạng và thời trang hơn bao giờ hết. Đồng thời,
                    chúng tôi cũng chú trọng đến chất lượng sản phẩm, đảm bảo rằng mỗi món đồ bạn chọn từ <span style="font-weight: bold;">PROVIS</span> đều được làm từ những
                    chất liệu tốt nhất. Tuy là cửa hàng bán đồ thời trang đã qua sử dụng nhưng chúng tôi luôn kiểm tra kỹ lưỡng từng
                    sản phẩm để đảm bảo rằng bạn nhận được giá trị tốt nhất cho số tiền bạn bỏ ra.
                </p>
            </div>
            <div class="introduce-member col-lg-3">
                <h4 style="margin-left: 26px;">Thành viên</h4>
                <ul style="list-style-type: none;">
                    <li>Nguyễn Văn A - 20120001</li>
                    <li>Trần Thị B - 20120002</li>
                    <li>Phạm Văn C - 20120003</li>
                    <li>Lê Thị D - 20120004</li>
                    <li>Lê Thị D - 20120004</li>
                    <li>Lê Thị D - 20120004</li>

                </ul>
            </div>
        </div>


    </div>

    <div class="slogan-container mb-4">
        <div class="row slogan-content text-center d-flex align-items-center">
            <div class="col-lg-4 name d-flex align-items-center" style="writing-mode: vertical-lr; transform: rotate(180deg);">
                <h1>PROVIS</h1>
            </div>
            <div class="col-lg-4 boxIMG">
                <div
                    class="carousel slide"
                    data-bs-ride="carousel"
                    data-bs-interval="4000"
                    data-bs-pause="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/about/canh.jpg" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/about/canh2.jpg" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/about/canh3.jpg" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo _HOST_URL_TEMPLATE; ?>/assets/image/about/canh4.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 name  d-flex align-items-center" style="writing-mode: vertical-lr;">
                <h1>PROVIS</h1>
            </div>
        </div>
    </div>
</div>


<script>

</script>

<?php
layout('footer');
?>