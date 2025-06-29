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

    <div class="banner-area-ecommerce" style="background: linear-gradient(180deg, #e28831 0%, #FFFFFF 100%);">
        <div class="container cmw-1308 position-relative z-1">
            <div class="banner-content-ecommerce">
                <div class="title bg-border-color-50">
                    <div class="d-flex align-items-center justify-content-center" style="gap: 4px;">
                        <i class="ri-fire-fill text-primary-50"></i>
                        <span class="text-primary-50">Nền tảng kế toán thông minh</span>
                    </div>
                </div>
                <!-- SECTION 1: HERO -->
                <h2>Số liệu Chính xác, Quyết định Tức thì</h2>
                <p>Nền tảng kế toán thông minh giúp bạn tự động hóa tài chính, giải phóng thời gian để tập trung vào tăng trưởng.</p>
                <div class="d-flex flex-wrap align-items-center justify-content-center banner-btn" style="gap: 15px;">
                    <a href="#pricing" class="btn bg-primary text-white fw-medium fs-14 rounded-pill hover-bg landing-page-btn">Dùng thử Miễn phí Ngay</a>
                    <a href="#features" class="btn btn-outline-body-bg text-white fw-medium fs-14 rounded-pill hover-bg landing-page-btn">Khám phá Tính năng</a>
                </div>
            </div>

            <div class="banner-img">
                <img src="/assets/avatar/banner.png" alt="Dashboard phần mềm kế toán">
            </div>
        </div>
    </div>
    <!-- End Banner Area -->

    <!-- SECTION 2: ABOUT US -->
    <div class="why-trezo-area" id="about" style="margin-top: 100px;margin-bottom: 100px;">
        <div class="container cmw-1308">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <div class="why-trezo-img">
                        <img src="assets/avatar/about.jpg" alt="Về PNL International">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="why-trezo-content">
                        <span class="top-title2">Được tin cậy bởi 5.000+ Doanh nghiệp Việt Nam</span>
                        <h2>PNL INTERNATIONAL</h2>
                        <p>Không chỉ là một công cụ, mà là người bạn đồng hành tài chính đáng tin cậy. Chúng tôi tự hào mang đến giải pháp giúp các doanh nghiệp đơn giản hóa quy trình, tối ưu hóa lợi nhuận và phát triển bền vững.</p>

                        <div class="why-trezo-single-item-wrap">
                            <div class="row g-4 g-50">
                                <div class="col-6 col-sm-6">
                                    <div class="why-trezo-single-item">
                                        <h1>3x</h1>
                                        <span class="d-block">Tăng tốc độ xử lý nghiệp vụ</span>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <div class="why-trezo-single-item">
                                        <h1>98%</h1>
                                        <span class="d-block">Khách hàng hài lòng</span>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <div class="why-trezo-single-item">
                                        <h1>5k+</h1>
                                        <span class="d-block">Doanh nghiệp đã chuyển đổi số</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Trezo Area -->

    <!-- SECTION 3: FEATURES -->
    <div class="top-features-area bg-gray-200" id="features" style="padding-top: 40px;">
        <div class="container cmw-1308">
            <div class="section-title2 mx-auto text-center">
                <span class="top-title2">Tính năng cốt lõi</span>
                <h2>Giải pháp Kế toán Toàn diện</h2>
                <p>PNL trang bị cho bạn những công cụ thông minh để vận hành bộ máy tài chính hiệu quả.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6">
                    <div class="top-features-single-item position-relative z-1 mt-35">
                        <div class="top-features-content">
                            <img src="/assets/home/hoadontudong.svg" alt="Icon hóa đơn">
                            <h3>Tự động hóa Hóa đơn</h3>
                            <p>Quét và nhập liệu hóa đơn điện tử chỉ trong vài giây, loại bỏ hoàn toàn sai sót thủ công.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="top-features-single-item position-relative z-1">
                        <div class="top-features-content">
                            <img src="/assets/home/barchart.svg" alt="Icon biểu đồ">
                            <h3>Báo cáo Quản trị Real-time</h3>
                            <p>Theo dõi dòng tiền, lãi lỗ, công nợ tức thì trên dashboard trực quan, ra quyết định mọi lúc mọi nơi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="top-features-single-item position-relative z-1 mt-35">
                        <div class="top-features-content">
                            <img src="/assets/home/edit.svg" alt="Icon đối soát">
                            <h3>Tự động Đối soát Ngân hàng</h3>
                            <p>Tự động đối chiếu giao dịch ngân hàng với sổ sách, giúp dòng tiền luôn minh bạch và chính xác.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="top-features-single-item position-relative z-1">
                        <div class="top-features-content">
                            <img src="/assets/home/connects.svg" alt="Icon thuế">
                            <h3>Kê khai Thuế Chính xác</h3>
                            <p>Tự động tổng hợp dữ liệu và xuất các tờ khai thuế theo mẫu mới nhất, đảm bảo nộp báo cáo đúng hạn.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pricing-plans-area bg-gray-200 ptb-180" id="pricing">
        <div class="container cmw-1308">
            <div class="section-title mx-auto text-center">
                <span class="top-title2">Bảng giá</span>
                <h2>Lựa chọn Gói dịch vụ Phù hợp với Bạn</h2>
                <p>Bắt đầu miễn phí và nâng cấp khi bạn phát triển. Không có chi phí ẩn, không có bất ngờ.</p>
            </div>
            <div class="row g-4 justify-content-center">
  <div class="col-lg-4 col-md-6" v-for="pkg in packages" :key="pkg.id">
    <div class="pricing-plans-single-item position-relative z-1">
      <div class="pricing-header">
        <span class="trial">{{ pkg.name }}</span>
        <h1 v-if="pkg.price !== null">{{ pkg.price }}<sub class="text-body">VND/tháng</sub></h1>
        <h1 v-else>Liên hệ<sub class="text-body"></sub></h1>
        <p>
          <!-- Tùy chọn hiển thị mô tả dựa trên tên gói -->
          <span v-if="pkg.name === 'Gói Cơ Bản'">Dành cho công ty siêu nhỏ & freelancers.</span>
          <span v-else-if="pkg.name === 'Gói Phổ Biến'">Dành cho doanh nghiệp vừa và nhỏ.</span>
          <span v-else>Dành cho tập đoàn & yêu cầu riêng.</span>
        </p>
      </div>

      <div class="pricing-content">
        <h3>Tính năng:</h3>
        <ul class="p-0 list-unstyled">
          <li class="d-flex align-items-center" style="gap: 12px;">
            <img src="/assets/home/check.svg" alt="check">
            <span>Tự động hóa hóa đơn</span>
          </li>
          <li class="d-flex align-items-center" style="gap: 12px;">
            <img src="/assets/home/check.svg" alt="check">
            <span>Báo cáo tài chính cơ bản</span>
          </li>
          <li class="d-flex align-items-center" style="gap: 12px;">
            <img src="/assets/home/check.svg" alt="check">
            <span>Tích hợp ngân hàng</span>
          </li>
          <li class="d-flex align-items-center" style="gap: 12px;">
            <img src="/assets/home/check.svg" alt="check">
            <span>Hỗ trợ qua email</span>
          </li>
        </ul>
        <a href="#" class="btn btn-outline-primary fw-medium fs-14 rounded-pill hover-bg landing-page-btn w-100">
          Mua ngay {{ pkg.name }}
        </a>
      </div>
    </div>
  </div>
</div>

        </div>
    </div>

    <!-- SECTION 5: FINAL CTA -->
    <div class="supercharge-area">
        <div class="container cmw-1308">
            <div class="supercharge-content position-relative z-1" style="background: linear-gradient(278deg, #757DFF 23.88%, #eb262e 94.06%)">
                <h2>Sẵn sàng để thay đổi cách bạn làm kế toán?</h2>
                <p>Bắt đầu phát triển với dữ liệu thực, tự động hóa thực và kết quả thực.</p>
                <div class="d-flex flex-wrap justify-content-center mt-40" style="gap: 14px;">
                    <a href="#pricing" class="btn bg-white text-primary fw-medium fs-14 rounded-pill hover-bg landing-page-btn">Bắt đầu Dùng thử Miễn phí</a>
                    <a href="#" class="btn btn-outline-light text-white fw-medium fs-14 rounded-pill hover-bg landing-page-btn">Nhận Demo & Tư vấn</a>
                </div>
            </div>
        </div>
    </div>
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
import {
    defineComponent,
    ref,
    watch
} from 'vue';
import axios from 'axios';
import {
    inject
} from 'vue';
export default defineComponent({
    setup() {
        const packages = ref([]);
        const globalState = inject('globalState');
        const baseUrl = globalState.baseUrl;
        const getPackage = () => {
            axios
                .get(`${baseUrl}/api/packages`)
                .then((response) => {
                    packages.value = response.data;
                    console.log(packages.value);
                })
                .catch((error) => {
                    console.log(error);
                });
        };
        getPackage();
        return {
            packages,
        }
    }

})
</script>


<style lang="css">
body {
    font-family: 'Inter', sans-serif;
    background-color: #F8F9FC;
    color: #526077;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

h1, h2, h3, h4, h5, h6 {
    font-weight: 700;
    color: #23272E;
}

.section-title2 h2, .section-title2 .h2 {
    font-weight: 600;
}

/* --- Navigation Bar --- */
.navbar-for-landing-page {
    transition: all 0.4s ease-in-out;
}

.navbar-for-landing-page.sticky {
    padding-top: 15px !important;
    padding-bottom: 15px !important;
    background: rgba(255, 255, 255, 0.8) !important;
    backdrop-filter: saturate(180%) blur(15px);
    -webkit-backdrop-filter: saturate(180%) blur(15px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.navbar-for-landing-page.sticky .nav-link,
.navbar-for-landing-page.sticky .navbar-brand img {
    color: #3A4252 !important;
}

.navbar-for-landing-page .nav-link {
    transition: color 0.3s ease;
}

.navbar-for-landing-page .nav-link:hover,
.navbar-for-landing-page .nav-link.active {
    color: #4936F5 !important;
}
.navbar-for-landing-page.sticky .nav-link:hover,
.navbar-for-landing-page.sticky .nav-link.active {
    color: #4936F5 !important;
}

/* --- Logo Enhancements (Mới thêm) --- */
.navbar-brand img {
    transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
}

.navbar-brand:hover img {
    transform: scale(1.05); /* Phóng to nhẹ khi di chuột qua */
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15)); /* Thêm bóng đổ tinh tế */
}


/* --- Banner Section --- */
.banner-area-ecommerce {
    background: linear-gradient(180deg, #5D50FE 0%, #F8F9FC 100%);
    padding-top: 220px;
    padding-bottom: 100px;
}
.banner-content-ecommerce h2 {
    font-size: 64px;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.25;
}

.banner-img img {
    border-radius: 12px;
    box-shadow: 0 1rem 3rem rgba(35, 39, 46, 0.175) !important;
}


/* --- General Button Style --- */
.btn.landing-page-btn {
    padding: 12px 32px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
}
.btn.landing-page-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
}


/* --- Why Trezo Section --- */
.why-trezo-single-item h1 {
    color: #f67c01;
    font-weight: 700;
}
.why-trezo-single-item h1::before {
    display: none; /* Removing the old line */
}


/* --- Features Section --- */
.top-features-single-item {
    background-color: #FFFFFF;
    border: 1px solid #ECEEF2;
    border-radius: 16px;
    padding: 0;
    transition: all 0.3s ease-in-out;
    margin-top: 0 !important; /* Reset margin */
}

.top-features-single-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(67, 78, 97, 0.12);
    border-color: transparent;
}

.top-features-single-item .top-features-content {
    padding: 30px 25px;
    background-color: transparent;
}

.top-features-single-item .top-features-content img {
    border-radius: 50%;
    background: #ECF0FF;
    padding: 15px;
    width: 80px;
    height: 80px;
}

.top-features-single-item .top-features-content h3 {
    margin-top: 25px;
    margin-bottom: 10px;
    font-size: 20px;
}


/* --- Pricing Section --- */
.pricing-plans-single-item {
    background-color: #FFFFFF;
    border: 1px solid #ECEEF2;
    border-radius: 16px;
    padding: 40px 30px;
    transition: all 0.3s ease-in-out;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.pricing-plans-single-item .pricing-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    border-top: 1px solid #e2e8f0;
}
.pricing-plans-single-item .pricing-content ul {
    flex-grow: 1;
}

.pricing-plans-single-item:hover {
    box-shadow: 0 20px 40px rgba(67, 78, 97, 0.15);
    transform: translateY(-10px);
}

.pricing-plans-single-item.popular {
    border: 2px solid #4936F5;
    transform: scale(1.05);
    box-shadow: 0 20px 40px rgba(73, 54, 245, 0.15);
}
.pricing-plans-single-item.popular:hover {
    transform: scale(1.08) translateY(-10px);
}

.pricing-header .trial {
    font-weight: 600;
}
.pricing-header .popular-badge {
    background-color: #4936F5;
    color: white;
    border-color: #4936F5;
}


/* --- Supercharge CTA --- */
.supercharge-content {
    border-radius: 24px;
    padding: 80px 40px;
    background: linear-gradient(135deg, #4936F5 0%, #757DFF 100%);
}
.supercharge-content h2 {
    font-weight: 700;
}

/* --- Footer --- */
.footer-area-ecommerce {
    background: #F8F9FC;
    padding-top: 100px;
    padding-bottom: 40px;
}
.footer-single-item-ecommerce h3 {
    color: #23272E;
}

/* Responsive adjustments */
@media (max-width: 991px) {
    .navbar-for-landing-page.sticky {
        background: rgba(45, 53, 68, 0.95) !important;
    }
    .navbar-for-landing-page .nav-link {
        color: #fff !important;
    }
    .navbar-for-landing-page #navbarSupportedContent {
        background: #2D3544;
        border-radius: 10px;
        padding: 15px;
        margin-top: 10px;
    }
}

@media (max-width: 767px) {
    .banner-content-ecommerce h2 {
        font-size: 40px;
    }
    .banner-area-ecommerce {
        padding-top: 150px;
        padding-bottom: 70px;
    }
    .why-trezo-area, .pricing-plans-area, .footer-area-ecommerce {
        padding-top: 70px;
        padding-bottom: 70px;
    }
    .why-trezo-area {
        margin-top: 70px !important;
    }
}

</style>
