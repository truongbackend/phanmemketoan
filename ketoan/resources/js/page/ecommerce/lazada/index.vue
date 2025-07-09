<template>
    <div class="card border-0 rounded-2 p-4 bg-white mb-4" style="height: 700px; margin: auto;">
        <div class="card-body p-4 py-5 p-xl-5 text-center">
        <h2 class="fs-24 fw-semibold mb-2">Bạn đang bán hàng trên kênh lazada</h2>
        <p class="fs-14 m-auto">PNL INTERNATIONAL giúp bạn tối ưu thời gian xuất hóa đơn thuế nhanh chóng</p>
        <div class="d-flex flex-wrap gap-2 justify-content-center mt-3">
            <div class="d-flex align-items-center justify-content-center mb-4 gap-3">
                <div class="facebook-icon d-flex align-items-center justify-content-center">
                    <img src="/assets/avatar/lazada.jpg" width="50px" class="me-2" />
                </div>
                <div class="text-start">
                    <h2 class="fs-24 fw-semibold mb-1">Lazada</h2>
                    <p class="fs-14 text-muted mb-0">Official Account</p>
                </div>
            </div>
        </div>
        <button type="button" @click="connectLazada" class="btn btn-info fw-medium text-white py-2 px-4">
            <i class="ri-link me-2" ></i>Kết nối </button>
        </div>
        <div class="card-footer bg-white">
            <button @click="connectLazada" class="btn btn-outline-info fw-medium rounded-3 hover-white mt-3 py-2 px-4"><i class="ri-add-circle-fill me-2"></i>Thêm kết nối</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { inject, defineComponent } from 'vue';
import {
    useToast
} from 'vue-toast-notification';
export default defineComponent({
  setup() {
    const globalState = inject('globalState');
    const baseUrl = globalState.baseUrl;
    const toast = useToast();

    const connectLazada = async () => {
        try {
            const { data } = await axios.post(`${baseUrl}/api/e-commerce/lazada/auth-shop`);
            if (!data.auth_url) return;
            const w = 1200;
            const h = 680;
            const dualScreenLeft = window.screenLeft ?? window.screenX;
            const dualScreenTop  = window.screenTop  ?? window.screenY;
            const width  = window.innerWidth
                        || document.documentElement.clientWidth
                        || screen.width;
            const height = window.innerHeight
                        || document.documentElement.clientHeight
                        || screen.height;
            const left = Math.round(dualScreenLeft + (width  - w) / 2);
            const top  = Math.round(dualScreenTop  + (height - h) / 2);

            const popup = window.open(
            data.auth_url,
            'LazadaAuth',
            `width=${w},height=${h},top=${top},left=${left},resizable=yes,scrollbars=yes`
            );
            if (!popup) {
                console.error('Không thể mở popup. Vui lòng tắt chặn popup.');
                return;
            }
            const timer = setInterval(() => {
            let href;
            try {
                href = popup.location.href;
            } catch {
                return;
            }
            const code = new URL(href).searchParams.get('code');
            if (code) {
                clearInterval(timer);
                popup.close();
                fetchAccessToken(code);
            }
            if (popup.closed) clearInterval(timer);
            }, 500);
        } catch (err) {
            console.error('Lỗi khi lấy URL xác thực:', err);
        }
        };


    const fetchAccessToken = (code) => {
      axios
        .get(`${baseUrl}/api/e-commerce/lazada/shop-access-token`, { params: { code } })
        .then(res => {
          console.log('Access token response:', res.data);
          res.data.success
            ? toast.success('Kết nối thành công với Lazada!')
            : toast.error('Lỗi khi kết nối với Lazada. Vui lòng thử lại.');
        })
        .catch(err => {
          console.error('Lỗi khi lấy access token:', err);
        });
    };

    const addConnection = () => {
      console.log('Bạn vừa click Thêm kết nối');
    };

    return {
      connectLazada,
      addConnection,
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
