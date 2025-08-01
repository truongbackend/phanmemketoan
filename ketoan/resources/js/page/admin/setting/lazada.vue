<template>
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
          <h4>Thiết lập Lazada</h4>
          <p>Mỗi tài khoản sẽ được thiết lập cài đặt theo từng shop và tài khoản riêng.</p>

          <div class="card mb-4 border border-primary rounded-3 shadow-sm" v-for="shop in accountShop" :key="shop.id">
            <div class="card-body">
              <p class="text-success fw-bold">Tài khoản Lazada: {{ shop.account }}</p>
              <div class="row">
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-2">
                    <label class="label text-secondary">Số chứng từ</label>
                    <input type="text" class="form-control h-55" v-model="shopSettings[shop.id].documentNumber" />
                  </div>
                </div>

                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-2">
                    <label class="label text-secondary">Số phiếu xuất</label>
                    <input type="text" class="form-control h-55" v-model="shopSettings[shop.id].numberBallots" />
                  </div>
                </div>

                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-2">
                    <label class="label text-secondary">TK Tiền/Chi phí/Nợ (*)</label>
                    <input type="text" class="form-control h-55" v-model="shopSettings[shop.id].accountDebts" />
                  </div>
                </div>

                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-2">
                    <label class="label text-secondary">TK Doanh thu/Có (*)</label>
                    <input type="text" class="form-control h-55" v-model="shopSettings[shop.id].accountRevenue" />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="d-flex flex-wrap gap-3">
              <button type="button" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white" @click="resetForm">
                Hủy
              </button>
              <button class="btn btn-primary" @click="saveShopSettings">Lưu cài đặt Lazada</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toast-notification';

const toast = useToast();
const accountShop = ref([]);
const shopSettings = ref({});

const getAccountShop = () => {
  axios.get('/api/e-commerce/lazada/auth-shop-status')
    .then(res => {
      if (res.data.status === true) {
        accountShop.value = res.data.data.accounts;
        res.data.data.accounts.forEach(shop => {
          shopSettings.value[shop.id] = {
            documentNumber: '',
            numberBallots: '',
            accountDebts: '',
            accountRevenue: '',
            id: shop.id
          };
        });
      }
    })
    .catch(err => {
      console.error(err);
      toast.error('Có lỗi khi tải danh sách tài khoản Lazada.');
    });
};

const saveShopSettings = () => {
  axios.post('/api/setting-account-lazada', {
    settings: shopSettings.value,
  }).then(() => {
    toast.success('Lưu thành công!');
  }).catch(() => {
    toast.error('Có lỗi khi lưu cài đặt.');
  });
};

const resetForm = () => {
  Object.keys(shopSettings.value).forEach(shopId => {
    shopSettings.value[shopId] = {
      documentNumber: '',
      numberBallots: '',
      accountDebts: '',
      accountRevenue: ''
    };
  });
};

onMounted(() => {
  getAccountShop();
});
</script>


