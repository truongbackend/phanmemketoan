

<template>
    <nav class="navbar navbar-expand-lg bg-transparent fixed-top navbar-for-landing-page" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/assets/home/logo.png" alt="logo" width="120px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="navbar_toggler">
                <span class="border-bottom border-3 border-white top"></span>
                <span class="border-bottom border-3 border-white middle my-5px"></span>
                <span class="border-bottom border-3 border-white bottom"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link fs-14 fw-medium text-body-bg hover p-0 active" href="#">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-14 fw-medium text-body-bg hover p-0" href="#about">Về chúng tôi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-14 fw-medium text-body-bg hover p-0" href="#features">Tính năng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-14 fw-medium text-body-bg hover p-0" href="#pricing">Bảng giá</a>
                    </li>
                </ul>
                <div class="othres">
                    <a href="#pricing" class="btn bg-white fw-medium fs-14 text-primary rounded-pill hover-bg">
                        Dùng thử
                    </a>
                    <a href="/login" class="btn bg-white fw-medium fs-14 text-primary rounded-pill hover-bg">
                        Đăng nhập
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <router-view></router-view>

    <div class="footer-area-ecommerce ptb-180" style="background: linear-gradient(180deg, #FFFFFF 0%, #DDE4FF 100%);">
        <div class="container cmw-1308">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-single-item-ecommerce">
                        <a href="#" class="logo">
                            <img src="assets/images/black-logo.svg" class="black-logo" alt="logo pnl">
                        </a>
                        <p class="dec">Chào mừng đến với PNL, đối tác đáng tin cậy của bạn về các giải pháp kế toán toàn diện.</p>
                        <p>info@pnl-international.com</p>
                        <p>0908511405</p>
                        <p>Số 230/37, Lâm Thị Hố, Tổ 2, KP 11, Phường Tân Chánh Hiệp, Quận 12, Thành phố Hồ Chí Minh, Việt Nam</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-single-item-ecommerce pl-130">
                        <h3>Liên kết nhanh</h3>
                        <ul class="p-0 m-0 list-unstyled import-link">
                            <li><a href="#">Trang chủ</a></li>
                            <li><a href="#about">Về chúng tôi</a></li>
                            <li><a href="#features">Tính năng</a></li>
                            <li><a href="#pricing">Bảng giá</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="footer-single-item-ecommerce pl-130">
                        <h3>Tài nguyên</h3>
                        <ul class="p-0 m-0 list-unstyled import-link">
                            <li><a href="#">Trung tâm trợ giúp</a></li>
                            <li><a href="#">Tài liệu hướng dẫn</a></li>
                            <li><a href="#">Câu hỏi thường gặp</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-single-item-ecommerce pl-80">
                        <h3>Pháp lý</h3>
                        <ul class="p-0 m-0 list-unstyled info-link">
                            <li><a href="#">Chính sách bảo mật</a></li>
                            <li><a href="#">Điều khoản dịch vụ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  <script>
  export default {
    name: "FrontEnd",
  };
  </script>
