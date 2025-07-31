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
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="setting-tab" data-bs-toggle="pill" data-bs-target="#setting" type="button" role="tab" aria-controls="setting" aria-selected="true">Cài đặt chung</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="settingLazada" data-bs-toggle="pill" data-bs-target="#settingLazada" type="button" role="tab" aria-controls="settingLazada" aria-selected="false">Lazada</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="settingShoppe" data-bs-toggle="pill" data-bs-target="#settingShoppe" type="button" role="tab" aria-controls="settingShoppe" aria-selected="false">Shoppe</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Tiktok</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Amis</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
            <div class="row justify-content-center">

      <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-3 mb-4">

          <div class="card-body p-4">
          <h4>Kết nối mã ứng dụng</h4>
            <form @submit.prevent="connectApiMisa">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group mb-4">
                        <label class="label">Key mã kết nối của công ty với Amiss</label>
                        <input
                            type="text"
                            v-model="misaAccessToken"
                            class="form-control text-gray-light h-55"
                            :class="{'is-invalid': !misaAccessTokenValid}"
                            />

                        <div v-if="!misaAccessTokenValid" class="invalid-feedback">
                            Tài khoản chưa được kết nối với Amiss
                        </div>
                        <div v-if="connectedCompany" class="mt-2 text-success">
                            <p class="mb-0 fw-bold">{{ connectedCompany }}</p>
                            <small class="text-muted">Hết hạn: {{ connectedExpired }}</small>
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
            <h4>Thiết lập Lazada</h4>
            <div class="row" v-for="shop in accountShop" :key="shop.id">
                <p class="text-secondary mb-4">{{shop.account}}</p>
                <div class="col-lg-6 col-sm-6">
                    <div class="form-group mb-4">
                            <label class="label text-secondary">Số chứng từ</label>
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
                            <label class="label text-secondary">Số phiếu xuất</label>
                            <input
                            type="text"
                            v-model="customerName"
                            class="form-control h-55"
                            placeholder="Nhập tên khách hàng"
                            />
                        </div>
                    </div>
                </div>
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
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-4">
                    <label class="label text-secondary">Số chứng từ</label>
                    <input
                      type="text"
                      v-model="documentNumber"
                      class="form-control h-55"
                      placeholder="Nhập số chứng từ"
                    />
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <div class="form-group mb-4">
                    <label class="label text-secondary">Số phiếu xuất</label>
                    <input
                      type="text"
                      v-model="numberBallots"
                      class="form-control h-55"
                      placeholder="Nhập số phiếu xuất"
                    />
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
                      Cập nhật
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
    </div>


  </div>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toast-notification';
import Cookies from 'js-cookie';
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
    const connectedCompany = ref(null);
    const connectedExpired = ref(null);
    const documentNumber = ref('');
    const numberBallots = ref('');
    const accountShop = ref([]);
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
         documentNumber.value = data.document_number_prefix || '';
            numberBallots.value = data.issue_voucher_prefix || '';
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
        document_number_prefix: documentNumber.value,
        issue_voucher_prefix: numberBallots.value,
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
    const getAccountShop = () => {
        axios
            .get(`/api/e-commerce/lazada/auth-shop-status`)
            .then(res => {
            if (res.data.status == true) {
                accountShop.value = res.data.data.accounts;
            }
            })
            .catch(err => {
                console.error('Lỗi khi lấy thông tin tài khoản:', err);
                toast.error('Lỗi khi lấy thông tin tài khoản. Vui lòng thử lại.');
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
                    const dataObj = JSON.parse(res.data.Data);
                    const accessTokenAmiss = dataObj.access_token;
                    const expiredDate = new Date(dataObj.expired_time);

                    Cookies.set('amiss_token', accessTokenAmiss, { expires: expiredDate, secure: true });
                    Cookies.set('amiss_app_name', dataObj.app_name, { expires: expiredDate, secure: true });
                    Cookies.set('amiss_expired', dataObj.expired_time, { expires: expiredDate, secure: true });
                    Cookies.set('amiss_key', misaAccessToken.value, { expires: expiredDate, secure: true });
                    misaAccessToken.value = '********';
                    connectedCompany.value = dataObj.app_name;
                    connectedExpired.value = expiredDate.toLocaleString();

                    toast.success('Kết nối ứng với phần mềm Amiss thành công!');
                } else {
                    toast.error('Kết nối thất bại');
                }
            })
            .catch(err => {
                console.error(err);
                toast.error('Không thể kết nối với Amiss!');
            });
        };
        const checkConnected = () => {
        const token = Cookies.get('amiss_token');
        const appName = Cookies.get('amiss_app_name');
        const expiredTime = Cookies.get('amiss_expired');
        const key = Cookies.get('amiss_key');

        if (token && appName && expiredTime && key) {
            connectedCompany.value = appName;
            connectedExpired.value = new Date(expiredTime).toLocaleString();
            misaAccessToken.value = '********';  // <-- Hiển thị mask
        }
        };





    const resetForm = () => loadSettings();
    onMounted(() => {
        loadSettings();
        checkConnected();
        getAccountShop();
    });

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
      connectApiMisa,
      connectedCompany,
      connectedExpired,
      documentNumber,
    numberBallots,
    accountShop,
      getAccountShop,

    };
  },
});
</script>

