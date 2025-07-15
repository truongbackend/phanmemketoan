<template>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h3 class="mb-0">Kết nối sàn Lazada</h3>

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center mb-0 lh-1">
            <li class="breadcrumb-item">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                    <span class="text-secondary fw-medium hover">Trang chủ</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="fw-medium">Lazada</span>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="fw-medium">Kết nối sàn</span>
            </li>
        </ol>
    </nav>
</div>
    <div class="card border-0 bg-white" style="height: 700px; margin: auto;">
        <div class="card-body p-4 py-5 p-xl-5 text-center" v-if="!accountShop.length">
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
                <i class="ri-link me-2" ></i>Kết nối
            </button>
        </div>
        <div class="card-body p-4" v-else>
            <h2 class="fs-20 fw-semibold mb-4">Danh sách các shop đã kích hoạt</h2>
            <div class="row">
                        <div class="col-xl-3 col-xxl-3 col-lg-3" v-for="(item, index) in accountShop" :key="index">
                            <div class="card bg-white border-1 border-dotted rounded-3 mb-3">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1 mb-1 mb-lg-3">
                                        <h6 class="mb-0">{{item.account}}</h6>
                                            <div class="d-flex align-items-center ms-auto">
                                                <span class="wh-11 bg-success rounded-1 me-1"></span>
                                                <div class="dropdown action-opt">
                                                <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i data-feather="more-horizontal"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:;" @click="refeshAccountShop(item.id)">
                                                            <i data-feather="refresh-cw"></i>
                                                            Làm mới
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:;" @click="deactivateAccountShop(item.id)">
                                                            <i data-feather="x-circle"></i>
                                                            Xóa kết nối
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:;">
                                                            <i data-feather="settings"></i>
                                                            Thiêt lập
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="ps-0 mb-0 list-unstyled">
                                        <li class="d-flex align-items-center justify-content-between mb-2 pb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="/assets/avatar/lazada.jpg" width="40px" class="rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="fw-medium fs16 mb-0">Lazada</h6>
                                                    <span class="fs-12">{{item.expires_at}}</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        <div class="card-footer bg-white">
            <button @click="connectLazada" class="btn btn-outline-info fw-medium rounded-3 hover-white mt-3 py-2 px-4"><i class="ri-add-circle-fill me-2"></i>Thêm kết nối</button>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
import { inject, defineComponent,onMounted,ref,nextTick } from 'vue';
import {
    useToast
} from 'vue-toast-notification';
export default defineComponent({
  setup() {
    const globalState = inject('globalState');
    const baseUrl = globalState.baseUrl;
    const toast = useToast();
    const accountShop = ref([]);

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

    const getAccountShop = () => {
        axios
            .get(`${baseUrl}/api/e-commerce/lazada/auth-shop-status`)
            .then(res => {
            if (res.data.status == true) {
                accountShop.value = res.data.data.accounts;
                nextTick(() => {
                    feather.replace();
                });
            }
            })
            .catch(err => {
                console.error('Lỗi khi lấy thông tin tài khoản:', err);
                toast.error('Lỗi khi lấy thông tin tài khoản. Vui lòng thử lại.');
            });
    };
    const refeshAccountShop = (token_id) => {
        axios
            .post(`${baseUrl}/api/e-commerce/lazada/refresh-token-by-id`,{ token_id })
            .then(res => {
            if (res.data.status == true) {
                toast.success('Token đã được làm mới thành công');
            }
            })
            .catch(err => {
                console.error('Lỗi khi lấy thông tin tài khoản:', err);
                toast.error('Lỗi khi lấy thông tin tài khoản. Vui lòng thử lại.');
            });
    };
    const deactivateAccountShop = (token_id) => {
        axios
            .post(`${baseUrl}/api/e-commerce/lazada/deactivate-token`,{ token_id })
            .then(res => {
            if (res.data.status == true) {
                toast.success('Tài khoản đã được hủy kích hoạt thành công');
                getAccountShop();
            }
            })
            .catch(err => {
                console.error('Lỗi khi lấy thông tin tài khoản:', err);
                toast.error('Lỗi khi lấy thông tin tài khoản. Vui lòng thử lại.');
            });
    };
    onMounted(() => {
        getAccountShop();
    });

    return {
      connectLazada,
      getAccountShop,
      accountShop,
      refeshAccountShop,
      deactivateAccountShop
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
