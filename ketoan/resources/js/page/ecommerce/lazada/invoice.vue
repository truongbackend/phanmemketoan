<template>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h3 class="mb-0">Xuất hóa đơn</h3>

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
                <span class="fw-medium">Xuất hóa đơn</span>
            </li>
        </ol>
    </nav>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <form @submit.prevent="callPushReceipt">
                    <div class="row">
                        <div class="align-items-center mb-4">
                            <div class="col-lg-3 col-sm-6">
                                <h5 class="mb-0 fs-17">Chọn ngày xuất hóa đơn lazada</h5>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Khoảng thời gian đơn hàng Lazada</label>
                                <a-config-provider :locale="viVN">
                                    <a-range-picker
                                        v-model:value="dateRange"
                                        format="DD/MM/YYYY"
                                        style="width: 100%; height: 55px;"
                                        :presets="presetRanges"
                                        :placeholder="['Ngày bắt đầu', 'Ngày kết thúc']"
                                    />
                                    </a-config-provider>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                Lấy dữ liệu
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {
    defineComponent,
    ref,
    computed,
    inject,
    reactive,onMounted
} from 'vue';
import {
    useToast
} from 'vue-toast-notification';
import moment from 'moment';
import axios from 'axios';
import dayjs from 'dayjs';
import 'dayjs/locale/vi';
dayjs.locale('vi');
import viVN from 'ant-design-vue/es/locale/vi_VN';
import Cookies from 'js-cookie';
export default defineComponent({
    setup() {
        const globalState = inject('globalState');
        const baseUrl = globalState.baseUrl;
        const toast = useToast();
        const setting = ref([]);
        const start = ref(null);
        const end = ref(null);
        const dateRange = computed({
            get: () =>
                start.value && end.value ? [start.value, end.value] : [],
            set([s, e]) {
                start.value = s;
                end.value = e;
            }
        });
        const presetRanges = [
            {
                label: 'Trong vòng tháng này',
                value: [dayjs().startOf('month'), dayjs()]
            },
            {
                label: 'Trong vòng 3 tháng trước',
                value: [dayjs().subtract(3, 'month'), dayjs()]
            }
        ];
        const app_id = ref('2b4eb0df-b6be-4c87-96f5-2bf7c51a8a5d');
        const org_company_code = ref('pnlinternationalinfovn');

        const form = reactive({
            saleType: 'domestic',
            paymentMethod: 'unpaid',
            includeSlip: false,
            attachInvoice: false,
            fromCashMachine: false
        });

        const formatDMY = m => (m ? m.format('DD/MM/YYYY') : '');

        const callPushReceipt = async () => {
    if (!start.value || !end.value) {
        return toast.error('Vui lòng chọn khoảng thời gian hợp lệ');
    }

    const payload = {
        created_after: formatDMY(start.value),
        created_before: formatDMY(end.value),
        sale_type: form.saleType,
        payment_method: form.paymentMethod,
        include_slip: form.includeSlip ? 1 : 0,
        attach_invoice: form.attachInvoice ? 1 : 0,
        from_cash_machine: form.fromCashMachine ? 1 : 0
    };
    try {
        const { data } = await axios.post(
            `${baseUrl}/api/e-commerce/lazada/push-receipt`,
            payload
        );
        if (data) {
            console.log("🧾 Danh sách đơn hàng:", data.data.orders);
            const taxInfo = data.orders.tax_invoice;
            console.log(taxInfo.value);
            postInvoice();
        } else {
            toast.error('Gửi hóa đơn thất bại. Không có đơn hàng phù hợp.');
        }

    } catch (err) {
        console.error("❌ Lỗi khi gửi hóa đơn:", err);
        toast.error('Đã xảy ra lỗi khi gửi hóa đơn.');
    }
};

        const getSettings = async () => {
            try {
                const response = await axios.get(
                    `${baseUrl}/api/setting-account-ecommerce`
                );
                if (response) {
                    setting.value = response.data.settings;
                } else {
                    toast.error('Không thể lấy cài đặt Lazada');
                }
            } catch (error) {
                console.error(error);
                toast.error('Lỗi khi lấy cài đặt Lazada');
            }
        };

        const postInvoice = async () => {
            const dataPost = {
                app_id: app_id.value,
                org_company_code: org_company_code.value,
                voucher: [
                    {
                        "voucher_type": 1,
                        "org_refno": "BS250107MG078VNN",
                        "refdate": "2025-07-09",
                        "posted_date": "2025-07-09",
                        "is_paid": false,
                        "include_invoice": 1,
                        "is_sale_with_outward": true,
                        "is_cash_register_invoice": true,
                        //Chứng từ ghi nợ
                        // Thông tin khách hàng

                        account_object_code: setting.value?.customer_code || "MACKH-MACDINH",
                        account_object_name: setting.value?.customer_name || "Khách hàng mặc định",
                        account_object_address: setting.value?.customer_address || "Địa chỉ khách hàng mặc định",
                        "term_id": null,
                        "due_day": null,
                        "due_date": null,

                    }
                ]
            };

    try {
        const token = Cookies.get('amiss_token');
        if (!token) {
            toast.error('Chưa kết nối với Amiss hoặc token đã hết hạn!');
            return;
        }

        const response = await axios.post(
            'https://actapp.misa.vn/apir/sync/actopen/save',
            dataPost,
            {
                headers: {
                    'X-MISA-AccessToken': token,
                    'Content-Type': 'application/json'
                }
            }
        );

        if (response.data.status) {
            toast.success('Đã gửi hóa đơn thành công');
        } else {
            toast.error('Gửi hóa đơn thất bại. Vui lòng thử lại sau.');
        }
    } catch (error) {
        console.error(error);
        toast.error('Đã xảy ra lỗi khi gửi hóa đơn.');
    }
};


        onMounted(() => {
            getSettings();
        });


        return {
            dateRange,
            presetRanges,
            form,
            callPushReceipt,
            setting,
            postInvoice,
            viVN
        };
    }
});
</script>
