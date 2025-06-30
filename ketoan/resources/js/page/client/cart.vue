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
<div class="why-trezo-area" id="about" style="margin-top: 160px; margin-bottom: 100px">
    <div class="container cmw-1308">
        <div class="row align-items-center g-4">
            <div class="main-content-container overflow-hidden">
                <div class="row">
                    <div class="col-xxl-8 col-lg-7">
                        <div class="card bg-white border-0 rounded-3 mb-4">
                            <div class="card-body p-4">
                                <h3 class="mb-lg-4 mb-3">Thanh toán</h3>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="label text-secondary">Tên khách hàng</label>
                                            <input type="text" class="form-control h-55" v-model="customerName" placeholder="Tên khách hàng">
                                            <div v-if="errors.customerName" class="invalid-feedback d-block">
                                            {{ errors.customerName }}
                                        </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="label text-secondary">Số điện thoại</label>
                                            <input type="text" class="form-control h-55" v-model="phone" placeholder="Số điện thoại">
                                            <div v-if="errors.phone" class="invalid-feedback d-block">
                                            {{ errors.phone }}
                                        </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="label text-secondary">Email</label>
                                            <input type="email" class="form-control h-55" v-model="email" placeholder="Email">
                                             <div v-if="errors.email" class="invalid-feedback d-block">
                                            {{ errors.email }}
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group mb-4">
                                            <label class="label text-secondary">Mã thuế Công ty / Cá nhân</label>
                                            <input type="text" class="form-control h-55" v-model="companyName" placeholder="Mã thuế Công ty / Cá nhân">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group mb-4">
                                            <label class="label text-secondary">Tên công ty</label>
                                            <input type="text" class="form-control h-55" v-model="companyTax" placeholder="Tên công ty">
                                        </div>
                                    </div>
                                     <div class="col-lg-6 col-sm-6">
                                        <div class="form-group mb-4">
                                            <label class="label text-secondary">Địa chỉ</label>
                                            <input type="text" class="form-control h-55" v-model="address" placeholder="Địa chỉ">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-4">
                                            <label class="label text-secondary">Ghi chú</label>
                                            <textarea rows="6" class="form-control" v-model="note" placeholder="Ghi chú...."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-wrap gap-3 button-back">
                                            <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white"><router-link :to="{ name: 'home' }">Quay lại</router-link></button>
                                            <button class="btn btn-primary py-2 px-4 fw-medium fs-16" @click="checkout"> <i class="ri-add-line text-white fw-medium"></i> Thanh toán</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card bg-white border-0 rounded-3 mb-4">
                            <div class="card-body p-4">
                                <h3 class="mb-3 mb-lg-4">Chi tiết đơn hàng</h3>
                                <div class="default-table-area mb-3 mb-lg-4">
                                    <div class="table-responsive">
                                        <table class="table align-middle">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Tên gói</th>
                                                    <th scope="col" class="text-end">Gía tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="item in cart" :key="item.id">
                                                <td>{{ item.name }} <span v-if="item.quantity > 1">x{{ item.quantity }}</span></td>
                                                <td class="text-end">{{ formatCurrency(item.price * item.quantity) }}</td>
                                            </tr>

                                            <tr>
                                                <td class="text-secondary fw-bold">Tổng cộng :</td>
                                                <td class="text-secondary fw-bold text-end">{{ formatCurrency(subtotal ) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                         <div v-if="cart.length === 0" class="text-center text-danger fw-medium py-3">
                                            Giỏ hàng của bạn đang trống!
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card bg-white border-0 rounded-3 mb-4">
                        <div class="card-body p-4">
                            <h3 class="mb-3 mb-lg-4">Thông tin thanh toán</h3>
                            <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <tbody>
                                <tr>
                                    <td class="fw-medium text-secondary">Ngân hàng:</td>
                                    <td class="text-end text-dark">Ngân hàng ACB</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium text-secondary">Số tài khoản:</td>
                                    <td class="text-end text-dark">63169968</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium text-secondary">Chủ tài khoản:</td>
                                    <td class="text-end text-dark">CÔNG TY TNHH PNL INTERNATIONAL</td>
                                </tr>


                                </tbody>
                            </table>
                            <div class="d-flex flex-wrap align-items-center justify-content-center gap-4 w-100">
                                <div class="flex-shrink-0">
                                    <img src="/assets/home/qr.jpg" alt="QR thanh toán" class="img-fluid rounded shadow-sm" style="max-width: 150px;">
                                </div>
                                <div class="flex-grow-1 text-start">
                                    <h5 class="fw-semibold mb-2" style="color:red;">Cú pháp chuyển khoản:</h5>
                                    <p class="fw-medium text-primary mb-0 fs-6">[Tên công ty/cá nhân] + [MST] + [Tên gói]</p>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="cartModal">Thông tin thanh toán</h1>
                    </div>
                    <div class="modal-body">
                            <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <tbody>
                                <tr>
                                    <td class="fw-medium text-secondary">Ngân hàng:</td>
                                    <td class="text-end text-dark">Ngân hàng ACB</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium text-secondary">Số tài khoản:</td>
                                    <td class="text-end text-dark">63169968</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium text-secondary">Chủ tài khoản:</td>
                                    <td class="text-end text-dark">CÔNG TY TNHH PNL INTERNATIONAL</td>
                                </tr>


                                </tbody>
                            </table>
                            <div class="d-flex flex-wrap align-items-center justify-content-center gap-4 w-100">
                                <div class="flex-shrink-0">
                                    <img src="/assets/home/qr.jpg" alt="QR thanh toán" class="img-fluid rounded shadow-sm" style="max-width: 150px;">
                                </div>
                                <div class="flex-grow-1 text-start">
                                    <h5 class="fw-semibold mb-2" style="color:red;">Cú pháp chuyển khoản:</h5>
                                    <p class="fw-medium text-primary mb-0 fs-6">[Tên công ty/cá nhân] + [MST] + [Tên gói]</p>
                                </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer button-back">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><router-link :to="{ name: 'home' }">Quay lại trang chủ</router-link> </button>
                        <button type="button" class="btn btn-danger text-white"><router-link :to="{ name: 'login' }">Hoàn thành</router-link> </button>
                    </div>
                </div>
            </div>
        </div>

<div class="footer-area-ecommerce ptb-180" style="background: linear-gradient(180deg, rgb(14, 14, 14) 0%, rgb(10, 10, 10) 100%)">
    <div class="container cmw-1308">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-3 col-sm-6">
                <div class="footer-single-item-ecommerce">
                    <a href="#" class="logo">
                        <img src="assets/home/logo.png" width="90px" class="black-logo" alt="logo pnl" />
                    </a>
                    <p>Email: info@pnl-international.com</p>
                    <p>SDT:0908511405</p>
                    <p>
                        Địa chỉ: Số 230/37, Lâm Thị Hố, Tổ 2, KP 11, Phường Tân Chánh Hiệp, Quận 12, Thành
                        phố Hồ Chí Minh, Việt Nam
                    </p>
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
<script setup>
import { ref, onMounted } from "vue";
import { inject } from "vue";
import { useToast } from 'vue-toast-notification';
import { useRouter } from "vue-router";
const cart = ref([]);
const subtotal = ref(0);
const customerName = ref("");
const phone = ref("");
const email = ref("");
const companyName = ref("");
const companyTax = ref("");
const address = ref("");
const note = ref("");
const toast = useToast();

const errors = ref({
  customerName: "",
  phone: "",
  email: "",
});
const globalState = inject("globalState");
const baseUrl = globalState.baseUrl;
const router = useRouter();
const formatCurrency = (amount) => {
  if (!amount) return "0 ₫";
  return amount.toLocaleString("vi-VN", { style: "currency", currency: "VND" });
};


const validateForm = () => {
  let isValid = true;
  errors.value = { customerName: "", phone: "", email: "" }; // reset lỗi

  if (!customerName.value.trim()) {
    errors.value.customerName = "Tên khách hàng không được để trống.";
    isValid = false;
  }
  if (!phone.value.trim()) {
    errors.value.phone = "Số điện thoại không được để trống.";
    isValid = false;
  }
  if (!email.value.trim()) {
    errors.value.email = "Email không được để trống.";
    isValid = false;
  }

  return isValid;
};
const checkout = () => {
  if (cart.value.length === 0) {
    toast.error("Giỏ hàng của bạn đang trống!");
    return;
  }
  if (!validateForm()) {
    return;
  }

  const orderData = {
    customer_name: customerName.value,
    phone: phone.value,
    email: email.value,
    company_name: companyName.value,
    company_tax: companyTax.value,
    address: address.value,
    note: note.value,
    package_id: cart.value[0]?.id ?? null,
    total_amount:cart.value[0]?.price ?? null,
  };

  axios.post(`${baseUrl}/api/orders`, orderData)
    .then(response => {
      toast.success("Đơn hàng đã được tạo thành công!");
      cart.value = [];
      localStorage.removeItem("cart");
      customerName.value = "";
      phone.value = "";
      email.value = "";
      companyName.value = "";
      companyTax.value = "";
      address.value = "";
      note.value = "";
     const modalElement = document.getElementById('cartModal');
      let modal = bootstrap.Modal.getInstance(modalElement);
      if (!modal) {
        modal = new bootstrap.Modal(modalElement);
      }
      modal.show();

    })
    .catch(error => {
      console.error("Đặt hàng thất bại:", error);
      toast.error("Có lỗi xảy ra khi gửi đơn hàng.");
    });
};

onMounted(() => {
  const storedCart = localStorage.getItem("cart");
  if (storedCart) {
    try {
      cart.value = JSON.parse(storedCart);
      subtotal.value = cart.value.reduce((sum, item) => sum + (item.price ?? 0) * item.quantity, 0);
    } catch (e) {
      console.error("Lỗi parse cart:", e);
      cart.value = [];
      subtotal.value = 0;
    }
  }
});
</script>
