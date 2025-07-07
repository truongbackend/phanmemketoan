<template>
<div class="card border-0 rounded-2 p-4 bg-white mb-4">
    <div class="card-body p-4 py-5 p-xl-5 text-center">
        <h2 class="fs-24 fw-semibold mb-2">Bạn đang bán hàng trên kênh nào?</h2>
        <p class=" fs-14 m-auto">PNL INTERNATIONAL giúp bạn tối ưu thời gian chăm sóc khách hàng và lên đơn nhanh chóng</p>
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
import { inject, defineComponent, ref } from 'vue';

export default defineComponent({
  setup() {
    const globalState = inject('globalState');
    const baseUrl     = globalState.baseUrl;
    const codeUrl     = ref('0_132625_FiuQNPE2rukhfWjR7b3ND6Ws139');

    const authShop = async () => {
      try {
        const response = await axios.post(
          `${baseUrl}/api/e-commerce/lazada/auth-shop`
        );
        const authShopUrl = response.data.auth_url;
        if (authShopUrl) {
          window.location.href = authShopUrl;
        } else {
          console.error('No auth shop URL returned');
        }
        return response.data;
      } catch (error) {
        console.error('Error fetching shop data:', error);
        return null;
      }
    };
    const accessTokenShop = async () => {
      try {
        const response = await axios.get(
          `${baseUrl}/api/e-commerce/lazada/shop-access-token`,
          { params: { code: codeUrl.value } }
        );
        console.log('Access Token:', response.data);
        return response.data;
      } catch (error) {
        console.error('Error fetching access token:', error);
        return null;
      }
    };
    return {
      authShop,
      accessTokenShop,
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
