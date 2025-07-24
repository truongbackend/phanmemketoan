<template>
  <div>
    <!-- Header & Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
      <h3 class="mb-0">Thiết lập chung</h3>
      <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
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
            <span class="fw-medium">Cài đặt</span>
          </li>
        </ol>
      </nav>
    </div>

    <div class="row justify-content-center">

      <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-3 mb-4">

          <div class="card-body p-4">
          <h4>Kết nối mã ứng dụng</h4>
            <form @submit.prevent="connectApiMisa">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group mb-4">
                            <label class="label">Key mã kết nối của công ty với Amiss </label>
                            <input
                                type="text"
                                v-model="misaAccessToken"
                                class="form-control text-gray-light h-55"
                                :class="{'is-invalid': !misaAccessTokenValid}" />
                            <div v-if="!misaAccessTokenValid" class="invalid-feedback">
                                Tài khoản chưa được kết nối với Amiss
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 d-flex">
                        <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-15 d-flex align-items-center gap-2">
                            <i class="ri-link-unlink-m fs-16"></i>
                            Liên kết
                        </button>
                    </div>
                </div>
            </form>

            <h4>Cài đặt chung xuất hóa đơn</h4>

            <form @submit.prevent="settingaccountEcommerce">
              <div class="row">
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-4">
                    <label class="label text-secondary">Mã khách hàng</label>
                    <input
                      type="text"
                      v-model="customerCode"
                      class="form-control h-55"
                      placeholder="Nhập mã khách hàng"
                    />
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-4">
                    <label class="label text-secondary">Tên khách hàng</label>
                    <input
                      type="text"
                      v-model="customerName"
                      class="form-control h-55"
                      placeholder="Nhập tên khách hàng"
                    />
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-4">
                    <label class="label text-secondary">Diễn giải</label>
                    <div class="mb-4">
                      <div
                        class="form-check mb-3"
                        v-for="opt in interpretationOptions"
                        :key="opt.value"
                      >
                        <input
                          class="form-check-input"
                          type="checkbox"
                          :id="opt.id"
                          v-model="interpretation"
                          :value="opt.value"
                        />
                        <label class="form-check-label" :for="opt.id">
                          {{ opt.label }}
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-4">
                    <label class="label text-secondary">Tên hàng</label>
                    <div class="mb-4">
                      <div
                        class="form-check mb-3"
                        v-for="opt in productNameOptions"
                        :key="opt.value"
                      >
                        <input
                          class="form-check-input"
                          type="checkbox"
                          :id="opt.id"
                          v-model="productNameSetting"
                          :value="opt.value"
                        />
                        <label class="form-check-label" :for="opt.id">
                          {{ opt.label }}
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-4">
                    <label class="label text-secondary">Tài khoản Thuế GTGT</label>
                    <input
                      type="text"
                      v-model="addedTaxVat"
                      class="form-control h-55"
                    />
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-4">
                    <label class="label text-secondary">Kho</label>
                    <input
                      type="text"
                      v-model="warehouse"
                      class="form-control h-55"
                    />
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-4">
                    <label class="label text-secondary">Tài khoản giá vốn</label>
                    <input
                      type="text"
                      v-model="accountCapitalPrice"
                      class="form-control h-55"
                    />
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-4">
                    <label class="label text-secondary">Tài khoản kho</label>
                    <input
                      type="text"
                      v-model="accountWarehouse"
                      class="form-control h-55"
                    />
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-4">
                    <label class="label text-secondary">Hình thức thanh toán</label>
                    <select
                      class="form-select form-control h-55"
                      v-model="paymentMethod"
                    >
                      <option value="1">TM/CK</option>
                      <option value="2">Chuyển khoản</option>
                      <option value="3">Tiền mặt</option>
                    </select>
                  </div>
                </div>



                <div class="col-lg-12">
                  <div class="d-flex flex-wrap gap-3">
                    <button
                      type="button"
                      class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white"
                      @click="resetForm"
                    >
                      Hủy
                    </button>
                    <button
                      type="submit"
                      class="btn btn-primary py-2 px-4 fw-medium fs-16"
                    >
                      Lưu cài đặt chung
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toast-notification';
export default defineComponent({
  name: 'SettingIndex',
  setup() {
    const customerCode = ref('');
    const customerName = ref('');
    const addedTaxVat = ref('33311');
    const warehouse = ref('');
    const accountCapitalPrice = ref('632');
    const accountWarehouse = ref('1561');
    const misaAccessToken = ref('');
    const paymentMethod = ref('');
    const appIDAmiss = ref('2b4eb0df-b6be-4c87-96f5-2bf7c51a8a5d');
    const companyCodeAmiss = ref('pnlinternationalinfovn');
    const misaAccessTokenValid = ref(true);
    const interpretation = ref([]);
    const productNameSetting = ref([]);

    const interpretationOptions = [
      { value: '1', label: 'Tên khách hàng', id: 'chkInterp1' },
      { value: '2', label: 'Mã đơn hàng', id: 'chkInterp2' },
      { value: '3', label: 'Tên sản phẩm', id: 'chkInterp3' },
    ];
    const productNameOptions = [
      { value: '1', label: 'Mã đơn hàng', id: 'chkProd1' },
      { value: '2', label: 'Tên đơn hàng', id: 'chkProd2' },
    ];
    const toast = useToast();

    const loadSettings = () => {
      axios
        .get('/api/setting-account-ecommerce')
        .then(res => {
          const data = res.data.settings;
          customerCode.value = data.customer_code || '';
          customerName.value = data.customer_name || '';
          addedTaxVat.value = data.added_tax_vat ?? addedTaxVat.value;
          warehouse.value = data.warehouse || '';
          accountCapitalPrice.value = data.account_capital_price || '';
          accountWarehouse.value = data.account_warehouse || '';
          paymentMethod.value = data.payment_method?.toString() || '';
          interpretation.value = Array.isArray(data.interpretation) ? data.interpretation : [];
          productNameSetting.value = Array.isArray(data.product_name_setting) ? data.product_name_setting : [];
        })
        .catch(err => {
          console.error('Lỗi khi tải cài đặt:', err);
        });
    };

    const settingaccountEcommerce = () => {
      const payload = {
        customer_code: customerCode.value,
        customer_name: customerName.value,
        interpretation: interpretation.value,
        product_name_setting: productNameSetting.value,
        added_tax_vat: addedTaxVat.value,
        warehouse: warehouse.value,
        account_capital_price: accountCapitalPrice.value,
        account_warehouse: accountWarehouse.value,
        payment_method: paymentMethod.value,
      };
      axios
        .post('/api/setting-account-ecommerce', payload)
        .then(res => {
            toast.success('Cài đặt đã được lưu thành công!');
            loadSettings();
        })
        .catch(err => {
          console.error(err);
        });
    };
    const connectApiMisa = () => {
        misaAccessTokenValid.value = !!misaAccessToken.value;
        if (!misaAccessTokenValid.value) {
            toast.error('Vui lòng nhập mã kết nối!');
            document.getElementById('preloader').style.display = 'none';
            return;
        }

        const payload = {
            app_id: appIDAmiss.value,
            access_code: misaAccessToken.value,
            org_company_code: companyCodeAmiss.value,
        };

        axios
            .post('https://actapp.misa.vn/api/oauth/actopen/connect', payload)
            .then(res => {
                if (res.data.Success === true) {
                    toast.success('Cài đặt đã được lưu thành công!');
                } else {
                    toast.error('Kết nối thất bại');
                }
            })
            .catch(err => {
                console.error(err);
                toast.error('Không thể kết nối với Amiss!');
            });
    };


    const resetForm = () => loadSettings();
    onMounted(loadSettings);

    return {
      customerCode,
      customerName,
      addedTaxVat,
      warehouse,
      accountCapitalPrice,
      accountWarehouse,
      paymentMethod,
      interpretation,
      productNameSetting,
      interpretationOptions,
      productNameOptions,
      settingaccountEcommerce,
      resetForm,
      companyCodeAmiss,
      misaAccessToken,
      appIDAmiss,
      misaAccessTokenValid,
      connectApiMisa
    };
  },
});
</script>

