<template>
  <nav
    class="navbar navbar-expand-lg bg-transparents fixed-top navbar-for-landing-page"
    id="navbar"
  >
    <div class="container">
      <a class="navbar-brand" href="/">
        <h3 class="logo-home">PNL INTERNATIONAL</h3>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
        id="navbar_toggler"
      >
        <span class="border-bottom border-3 border-white top"></span>
        <span class="border-bottom border-3 border-white middle my-5px"></span>
        <span class="border-bottom border-3 border-white bottom"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
          <li class="nav-item">
            <a class="nav-link fs-14 fw-medium text-body-bg hover p-0 active" href="/"
              >Trang chủ</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link fs-14 fw-medium text-body-bg hover p-0" href="#about"
              >Về chúng tôi</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link fs-14 fw-medium text-body-bg hover p-0" href="#features"
              >Tính năng</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link fs-14 fw-medium text-body-bg hover p-0" href="#pricing"
              >Bảng giá</a
            >
          </li>
        </ul>
        <div class="othres">
          <router-link :to="{ name: 'register' }" class="btn btn-outline-body-bg text-white fw-medium fs-14 rounded-pill hover-bg landing-page-btn" style="margin-right:10px;">Dùng thử miễn phí</router-link>
          <router-link :to="{ name: 'login' }" class="btn btn-outline-body-bg text-white fw-medium fs-14 rounded-pill hover-bg landing-page-btn">Đăng nhập</router-link>
        </div>
      </div>
    </div>
  </nav>

  <div
    class="banner-area-ecommerce"
    style="background: linear-gradient(180deg, #3584fc 0%, #ffffff 100%)"
  >
    <div class="container cmw-1308 position-relative z-1">
      <div class="banner-content-ecommerce">
        <div class="title bg-border-color-50">
          <div class="d-flex align-items-center justify-content-center" style="gap: 4px">
            <i class="ri-fire-fill text-primary-50"></i>
            <span class="text-primary-50">Nền tảng kế toán thông minh</span>
          </div>
        </div>
        <h2>Giải pháp bán hàng thông minh</h2>
         <h2>Gói gọn trong một nền tảng. </h2>
        <div
          class="d-flex flex-wrap align-items-center justify-content-center banner-btn"
          style="gap: 15px"
        >
          <router-link :to="{ name: 'register' }"
            class="btn bg-primary text-white fw-medium fs-14 rounded-pill hover-bg landing-page-btn"
            >Dùng thử Miễn phí Ngay</router-link >
         <router-link :to="{ name: 'register' }"
            href="#features"
            class="btn btn-outline-body-bg text-white fw-medium fs-14 rounded-pill hover-bg landing-page-btn"
            >Khám phá Tính năng</router-link >
        </div>
      </div>

      <div class="banner-img">
        <img src="/assets/avatar/banner.png" alt="Dashboard phần mềm kế toán" />
      </div>
    </div>
  </div>
  <div class="why-trezo-area" id="about" style="margin-top: 100px; margin-bottom: 100px">
    <div class="container cmw-1308">
      <div class="row align-items-center g-4">
        <div class="col-lg-6">
          <div class="why-trezo-img">
            <img src="assets/avatar/about.jpg" alt="Về PNL International" />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="why-trezo-content">
            <span class="top-title2">Được tin cậy bởi 5.000+ Doanh nghiệp Việt Nam</span>
            <h2>PNL INTERNATIONAL</h2>
            <p>
              Không chỉ là một công cụ, mà là người bạn đồng hành tài chính đáng tin cậy.
              Chúng tôi tự hào mang đến giải pháp giúp các doanh nghiệp đơn giản hóa quy
              trình, tối ưu hóa lợi nhuận và phát triển bền vững.
            </p>

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
  <div class="top-features-area bg-gray-200" id="features" style="padding-top: 40px">
    <div class="container cmw-1308">
      <div class="mx-auto text-center">
        <span class="top-title2">Tính năng cốt lõi</span>
        <h2>Giải pháp Kế toán Toàn diện</h2>
        <p>
          PNL trang bị cho bạn những công cụ thông minh để vận hành bộ máy tài chính hiệu
          quả.
        </p>
      </div>
      <div class="row g-4 mt-3">
        <div class="col-lg-3 col-sm-6">
          <div class="top-features-single-item position-relative z-1 mt-35">
            <div class="top-features-content">
              <img src="/assets/home/hoadontudong.svg" alt="Icon hóa đơn" />
              <h3>Tự động hóa Hóa đơn</h3>
              <p>
                Quét và nhập liệu hóa đơn điện tử chỉ trong vài giây, loại bỏ hoàn toàn
                sai sót thủ công.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="top-features-single-item position-relative z-1">
            <div class="top-features-content">
              <img src="/assets/home/barchart.svg" alt="Icon biểu đồ" />
              <h3>Dịch vụ xuất hóa đơn</h3>
              <p>
                Xuất hóa đơn một cách nhanh chóng, chính xác và hiệu quả. Trải nghiệm quy trình xử lý hóa đơn mượt mà, đáng tin cậy và tiết kiệm thời gian cho doanh nghiệp của bạn
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="top-features-single-item position-relative z-1 mt-35">
            <div class="top-features-content">
              <img src="/assets/home/edit.svg" alt="Icon đối soát" />
              <h3>Đối soát công nợ</h3>
              <p>
                Quản lý công nợ dễ dàng và chính xác hơn bao giờ hết. Toàn bộ quy trình được tự động hóa để đảm bảo sự liền mạch, minh bạch và tiết kiệm thời gian.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="top-features-single-item position-relative z-1">
            <div class="top-features-content">
              <img src="/assets/home/connects.svg" alt="Icon thuế" />
              <h3>Dịch vụ quản lý tình trạng đơn hàng</h3>
              <p>
                Kiểm soát tình trạng đơn hàng dễ dàng hơn bao giờ hết. Dù là đơn trả hàng hay hoàn trả một phần không mất thời gian lọc, tìm kiếm, đối soát thủ công
              </p>
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
        <p>
          Bắt đầu miễn phí và nâng cấp khi bạn phát triển. Không có chi phí ẩn, không có
          bất ngờ.
        </p>
      </div>
      <div class="row g-4 justify-content-center">
        <div class="col-lg-4 col-md-6" v-for="pkg in packages" :key="pkg.id">
          <div class="pricing-plans-single-item position-relative z-1">
            <div class="pricing-header">
              <span class="trial">{{ pkg.name }}</span>
              <h1 v-if="pkg.price !== null">
                {{ formatCurrency(pkg.price) }}<sub class="text-body">VND/tháng</sub>
              </h1>
              <h1 v-else>Liên hệ<sub class="text-body"></sub></h1>
              <p>

                <span v-if="pkg.name === 'Gói Cơ Bản'"
                  >Dành cho công ty siêu nhỏ & freelancers.</span
                >
                <span v-else-if="pkg.name === 'Gói Phổ Biến'"
                  >Dành cho doanh nghiệp vừa và nhỏ.</span
                >
                <span v-else>Dành cho tập đoàn & yêu cầu riêng.</span>
              </p>
            </div>

            <div class="pricing-content">
              <h3>Tính năng:</h3>
              <ul class="p-0 list-unstyled">
                <li class="d-flex align-items-center" style="gap: 12px">
                  <img src="/assets/home/check.svg" alt="check" />
                  <span>Tự động hóa hóa đơn</span>
                </li>
                <li class="d-flex align-items-center" style="gap: 12px">
                  <img src="/assets/home/check.svg" alt="check" />
                  <span>Báo cáo tài chính cơ bản</span>
                </li>
                <li class="d-flex align-items-center" style="gap: 12px">
                  <img src="/assets/home/check.svg" alt="check" />
                  <span>Tích hợp ngân hàng</span>
                </li>
                <li class="d-flex align-items-center" style="gap: 12px">
                  <img src="/assets/home/check.svg" alt="check" />
                  <span>Hỗ trợ qua email</span>
                </li>
              </ul>
              <button
                type="button"
                @click="addToCart(pkg)"
                class="btn btn-outline-primary fw-medium fs-14 rounded-pill hover-bg landing-page-btn w-100"
                >
                Mua ngay
                </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="supercharge-area">
    <div class="container cmw-1308">
      <div
        class="supercharge-content position-relative z-1"
        style="background: linear-gradient(278deg, #757dff 23.88%, #eb262e 94.06%)"
      >
        <h2>Sẵn sàng để thay đổi cách bạn làm kế toán?</h2>
        <p>Bắt đầu phát triển với dữ liệu thực, tự động hóa thực và kết quả thực.</p>
        <div class="d-flex flex-wrap justify-content-center mt-40" style="gap: 14px">
          <router-link :to="{ name: 'register' }"
            class="btn bg-white text-primary fw-medium fs-14 rounded-pill hover-bg landing-page-btn"
            >Bắt đầu Dùng thử Miễn phí</router-link>
          <router-link :to="{ name: 'register' }"
            class="btn btn-outline-light text-white fw-medium fs-14 rounded-pill hover-bg landing-page-btn"
            >Nhận Demo & Tư vấn</router-link>
        </div>
      </div>
    </div>
  </div>
  <div
    class="footer-area-ecommerce ptb-180"
    style="background: linear-gradient(180deg, rgb(14, 14, 14) 0%, rgb(10, 10, 10) 100%)"
  >
    <div class="container cmw-1308">
      <div class="row g-4 justify-content-center">
        <div class="col-lg-3 col-sm-6">
          <div class="footer-single-item-ecommerce">
            <a href="#" class="logo">
              <img src="assets/home/logo.png" width="160px" class="black-logo" alt="logo pnl" />
            </a>
            <ul class="p-0 m-0 list-unstyled import-link">
              <li>CÔNG TY TNHH PNL INTERNATIONAL</li>
              <li>Email: info@pnl-international.com</li>
              <li>Số điện thoại : 0908 511 405</li>
              <li>MST: 0316996806</li>
              <li> Địa chỉ: Số 230/37, Lâm Thị Hố, Tổ 2, KP 11, Phường Tân Chánh Hiệp, Quận 12, Thành
              phố Hồ Chí Minh, Việt Nam</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="footer-single-item-ecommerce pl-130 text-white">
            <h3>Liên kết nhanh</h3>
            <ul class="p-0 m-0 list-unstyled import-link">
              <li>Trang chủ</li>
              <li>Về chúng tôi</li>
              <li>Tính năng</li>
              <li>Bảng giá</li>
            </ul>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <div class="footer-single-item-ecommerce pl-130">
            <h3 style="color:white">Tài nguyên</h3>
            <ul class="p-0 m-0 list-unstyled import-link">
              <li>Trung tâm trợ giúp</li>
              <li>Tài liệu hướng dẫn</li>
              <li>Câu hỏi thường gặp</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="footer-single-item-ecommerce pl-80">
            <h3 style="color:white">Pháp lý</h3>
            <ul class="p-0 m-0 list-unstyled info-link">
              <li>Chính sách bảo mật</li>
              <li>Điều khoản dịch vụ</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { defineComponent, ref, watch } from "vue";
import axios from "axios";
import { inject } from "vue";
import { useRouter } from "vue-router";
export default defineComponent({
  setup() {
    const packages = ref([]);
    const globalState = inject("globalState");
    const baseUrl = globalState.baseUrl;
    const router = useRouter();
    const cart = ref([]);
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
    const addToCart = (pkg) => {
        const existingIndex = cart.value.findIndex((item) => item.id === pkg.id);
        if (existingIndex !== -1) {
            cart.value[existingIndex].quantity += 1;
        } else {
            cart.value.push({
            id: pkg.id,
            name: pkg.name,
            price: pkg.price,
            quantity: 1,
            });
        }
        localStorage.setItem("cart", JSON.stringify(cart.value));
        router.push("/cart");
    };
    const formatCurrency = (amount) => {
    if (!amount) return "0 ₫";
    return amount.toLocaleString("vi-VN", { style: "currency", currency: "VND" });
    };
    getPackage();
    return {
      packages,
      addToCart,
       cart,
       formatCurrency
    };
  },
});
</script>

