<template>
  <div class="card border-0 rounded-2 p-4 bg-white mb-4">
    <div class="card-body p-4 py-5 p-xl-5 text-center">
      <h2 class="fs-24 fw-semibold mb-2">Bạn đang bán hàng trên kênh nào?</h2>
      <p class="fs-14 m-auto">PNL INTERNATIONAL giúp bạn tối ưu thời gian chăm sóc khách hàng và lên đơn nhanh chóng</p>
      <div class="py-4 mb-1">
        <img src="/assets/avatar/onlineOrder.jpg" alt="schedule">
      </div>
      <div class="d-flex flex-wrap gap-2 justify-content-center">
        <a href="" class="platform-btn d-inline-flex align-items-center rounded-2 border text-decoration-none">
          <img src="/assets/avatar/shoppe.png" class="me-2" />
          <span class="fs-14 fw-semibold">Shopee</span>
        </a>
        <p @click="authShop" class="platform-btn d-inline-flex align-items-center rounded-2 border text-decoration-none">
          <img src="/assets/avatar/lazada.jpg" class="me-2" />
          <span class="fs-14 fw-semibold">Lazada</span>
        </p>
        <a href="" class="platform-btn d-inline-flex align-items-center rounded-2 border text-decoration-none">
          <img src="/assets/avatar/tiktok.png" class="me-2" />
          <span class="fs-14 fw-semibold">Tiktok Shop</span>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { inject, defineComponent, ref, onMounted } from 'vue';
// Nếu bạn dùng vue-router, có thể import thêm:
// import { useRoute } from 'vue-router';

export default defineComponent({
  setup() {
    const globalState = inject('globalState');
    const baseUrl     = globalState.baseUrl;
    const codeUrl     = ref('');    // khởi tạo rỗng

    // Bước 1: Khởi tạo OAuth, chuyển hướng sang Lazada
    const authShop = async () => {
      try {
        const { data } = await axios.post(`${baseUrl}/api/e-commerce/lazada/auth-shop`);
        if (data.auth_url) {
          window.location.href = data.auth_url;
        }
      } catch (err) {
        console.error('Lỗi khi lấy URL xác thực:', err);
      }
    };

    // Bước 2: Lấy access token với code đã có


    onMounted(() => {
        const urlParams = new URLSearchParams(window.location.search);
        const code = urlParams.get('code');
        if (code) {
            axios.get(`${baseUrl}/api/e-commerce/lazada/shop-access-token`, { code })
            .then(response => {
                console.log('Access Token:', code);
                console.log('Responsessssss:', response.data);
                // Có thể lưu access token vào state hoặc localStorage nếu cần
            })
            .catch(err => {
                console.error('Lỗi khi lấy access token:', err);
            });
        }
    });

    return {
      authShop,
      codeUrl,
    };
  },
});
</script>

<style scoped>
.platform-btn {
  padding: 13px;
  border-color: #e0e0e0;
  color: #333;
  transition: background-color .2s, border-color .2s;
}
.platform-btn img {
  width: 20px;
  height: auto;
}
.platform-btn:hover {
  background-color: #f8f9fa;
  border-color: #ccc;
}
</style>
