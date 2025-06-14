<template>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h3 class="mb-0">Giao hàng</h3>

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center mb-0 lh-1">
            <li class="breadcrumb-item">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                    <span class="text-secondary fw-medium hover">Trang chủ</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="fw-medium">Giao hàng</span>
            </li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <h4 class="fs-18 mb-4">Giao hàng</h4>

                <ul class="nav nav-tabs justify-content-between border-0 mb-4 wizard-tabs2" id="myTabstep2" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link p-0 d-flex align-items-center active" id="step5-tab" data-bs-toggle="tab" data-bs-target="#step5-tab-pane" type="button" role="tab" aria-controls="step5-tab-pane" aria-selected="true">
                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">1</span>
                            <div class="text-start ms-3">
                                <h4 class="fs-18 fw-semibold">Thông tin</h4>
                                <p class="text-gray-light mb-0">Chọn</p>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link p-0 d-flex align-items-center" id="step6-tab" data-bs-toggle="tab" data-bs-target="#step6-tab-pane" type="button" role="tab" aria-controls="step6-tab-pane" aria-selected="false">
                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">2</span>
                            <div class="text-start ms-3">
                                <h4 class="fs-18 fw-semibold">Upload file</h4>
                                <p class="text-gray-light mb-0">Import file giao hàng</p>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link p-0 d-flex align-items-center" id="step7-tab" data-bs-toggle="tab" data-bs-target="#step7-tab-pane" type="button" role="tab" aria-controls="step7-tab-pane" aria-selected="false">
                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">3</span>
                            <div class="text-start ms-3">
                                <h4 class="fs-18 fw-semibold">Đơn hàng</h4>
                                <p class="text-gray-light mb-0">Cài đặt</p>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link p-0 d-flex align-items-center" id="step8-tab" data-bs-toggle="tab" data-bs-target="#step8-tab-pane" type="button" role="tab" aria-controls="step8-tab-pane" aria-selected="false">
                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">4</span>
                            <div class="text-start ms-3">
                                <h4 class="fs-18 fw-semibold">Kết quả</h4>
                                <p class="text-gray-light mb-0">Trả kết quả</p>
                            </div>
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabstep2Content">
                    <div class="tab-pane fade show active" id="step5-tab-pane" role="tabpanel" aria-labelledby="step5-tab" tabindex="0">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Đơn vị giao hàng</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5 h-55" placeholder="Viettel Post" disabled>
                                        <i class="ri-bus-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Phần mềm hỗ trợ</label>
                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control text-dark ps-5  h-55" placeholder="Amis" disabled>
                                        <i class="ri-cake-3-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group d-flex gap-3">
                                    <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">Quay lại</button>
                                    <button @click="goToTab('step6-tab')" class="btn btn-primary py-3 px-5 fw-semibold text-white">Tiếp tục</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="step6-tab-pane" role="tabpanel" aria-labelledby="step6-tab" tabindex="0">
                        <h4 class="fs-18 fw-semibold">Upload file</h4>
                        <p class="text-gray-light mb-4">Lọc file giao hàng</p>
                        <form @submit.prevent="sendFileDelivery">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">File từ sàn Viettel Post</label>
                                        <input type="file" class="form-control text-gray-light h-55" @change="handleFileUpload($event, 'file_info')" :class="{'is-invalid': !FileInfoValid}">
                                        <div v-if="!FileInfoValid" class="invalid-feedback">File từ sàn Viettel Post không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">File push sale Viettel Post</label>
                                        <input type="file" class="form-control text-gray-light h-55" @change="handleFileUpload($event, 'file_push_sale')" :class="{'is-invalid': !file_push_saleValid}">
                                        <div v-if="!file_push_saleValid" class="invalid-feedback">File push sale Viettel Post không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">File mã hàng hoá</label>
                                        <input type="file" class="form-control text-gray-light h-55" @change="handleFileUpload($event, 'file_data_product')" :class="{'is-invalid': !file_data_productValid}">
                                        <div v-if="!file_data_productValid" class="invalid-feedback">File mã hàng hoá không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">Từ ngày</label>
                                        <div class="form-group position-relative">
                                            <input v-model="reporting_date_from" :class="{'is-invalid': !reporting_date_fromValid}" type="datetime-local" class="form-control  text-gray-light h-55" placeholder="Chọn ngày bắt đầu">
                                            <div v-if="!reporting_date_fromValid" class="invalid-feedback">
                                                Ngày bắt đầu không được để trống
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">Đến ngày</label>
                                        <div class="form-group position-relative">
                                            <input type="datetime-local" v-model="reporting_date_to" :class="{'is-invalid': !reporting_date_toValid}" class="form-control text-gray-light h-55" placeholder="Enter number">
                                            <div v-if="!reporting_date_toValid" class="invalid-feedback">
                                                Đến ngày không được để trống
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">Số phiếu xuất</label>
                                        <div class="form-group position-relative">
                                            <input type="text" v-model="export_receipt_number" class="form-control  text-gray-light h-55" placeholder="Số phiếu">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label class="label">Ngày hạch toán</label>

                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="ngayhoachtoan1" :value="1" v-model="posting_date">
                                        <label class="form-check-label" for="ngayhoachtoan1">
                                            Lấy theo ngày giao hàng
                                        </label>
                                    </div>

                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="ngayhoachtoan2" :value="2" v-model="posting_date">
                                        <label class="form-check-label" for="ngayhoachtoan2">
                                            Lấy ngày hiện tại
                                        </label>
                                    </div>

                                    <div v-if="!posting_dateValid" class="invalid-feedback d-block">
                                        Vui lòng chọn ngày hạch toán
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label class="label">Diễn giải lý do nộp</label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :value="'VTP_KEY1'" id="reason1" v-model="submission_reason" />
                                        <label class="form-check-label" for="reason1">
                                            Mã đơn hàng
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :value="'VTP_KEY2'" id="reason2" v-model="submission_reason" />
                                        <label class="form-check-label" for="reason2">
                                            Tên sản phẩm
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :value="'VTP_KEY3'" id="reason3" v-model="submission_reason" />
                                        <label class="form-check-label" for="reason3">
                                            Tên người mua
                                        </label>
                                    </div>
                                    <div v-if="!submission_reasonValid" class="invalid-feedback d-block">
                                        Vui lòng chọn Diễn giải lý do nộp
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">Mã khách hàng</label>
                                        <div class="form-group position-relative">
                                            <input v-model="customer_code" type="text" class="form-control  text-gray-light h-55" placeholder="Mã khách hàng" :class="{'is-invalid': !customer_codeValid}">
                                            <div v-if="!customer_codeValid" class="invalid-feedback d-block">
                                                Vui lòng điền mã khách hàng
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">TK Tiền/Chi phí/Nợ</label>
                                        <div class="form-group position-relative">
                                            <input v-model="account_cash_expense_debt" type="text" class="form-control  text-gray-light h-55" placeholder="Số phiếu" value="131">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">TK Doanh thu/Có</label>
                                        <div class="form-group position-relative">
                                            <input v-model="account_revenue_credit" type="text" class="form-control  text-gray-light h-55" placeholder="Số phiếu" value="5111">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">TK thuế GTGT</label>
                                        <div class="form-group position-relative">
                                            <input type="text" v-model="account_vat_tax" class="form-control  text-gray-light h-55" placeholder="Số phiếu" value="33311">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">Mã kho</label>
                                        <div class="form-group position-relative">
                                            <input type="text" v-model="warehouse_code" :class="{'is-invalid': !warehouse_codeValid}" class="form-control  text-gray-light h-55" placeholder="Mã kho">
                                            <div v-if="!warehouse_codeValid" class="invalid-feedback d-block">
                                                Vui lòng không để trống Mã kho
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">TK giá vốn</label>
                                        <div class="form-group position-relative">
                                            <input type="text" v-model="account_cost_of_goods_sold" class="form-control  text-gray-light h-55" placeholder="Số phiếu" value="632">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">TK Kho</label>
                                        <div class="form-group position-relative">
                                            <input type="text" v-model="account_inventory" class="form-control  text-gray-light h-55" placeholder="Số phiếu" value="1561">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group d-flex gap-3">
                                        <button type="button" class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">Quay lại</button>
                                        <button type="submit" class="btn btn-primary py-3 px-5 fw-semibold text-white">Tiếp tục</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="step7-tab-pane" role="tabpanel" aria-labelledby="step7-tab" tabindex="0">
                        <h4 class="fs-18 fw-semibold">Đơn hàng xuất hoá đơn</h4>
                        <p class="text-gray-light mb-4">Cài đặt xuất hoá đơn và Diễn giải lý do nộp</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="default-table-area recent-orders">
                                    <div class="table-responsive">
                                        <table class="table align-middle">
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        STT
                                                    </th>
                                                    <th scope="col">MÃ ĐƠN HÀNG</th>
                                                    <th scope="col">NGÀY GIAO HÀNG</th>
                                                    <th scope="col">GIÁ TRỊ ĐƠN HÀNG</th>
                                                    <th scope="col">COD</th>
                                                    <th scope="col">HÓA ĐƠN BÁN HÀNG</th>
                                                    <th scope="col">HÓA ĐƠN DỊCH VỤ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in order" :key="index">
                                                    <td class="text-body">{{ index + 1 }}</td>
                                                    <td class="text-body">{{ item.delivery_code }}</td>
                                                    <td class="text-body">{{ item.date_change_status }}</td>
                                                    <td class="text-body">{{ item.total_amount}}</td>
                                                    <td class="text-body">{{ item.cod }}</td>
                                                    <td class="text-body">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" :disabled="!item.allow_sales_invoice_export" :id="'hoadonbanhang_' + index" v-model="item.is_sale_invoice_checked">
                                                            <label class="form-check-label" :for="'hoadonbanhang_' + index"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-body">
                                                        <div class="form-check text-center">
                                                            <input class="form-check-input" type="checkbox" :disabled="!item.allow_service_invoice_export" :id="'hoadondichvu_' + index" v-model="item.is_service_invoice_checked">
                                                            <label class="form-check-label" :for="'hoadondichvu_' + index"></label>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="form-group d-flex gap-3">
                                    <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">Quay lại</button>
                                    <button @click="goToTab('step8-tab')" class="btn btn-primary py-3 px-5 fw-semibold text-white">Tiếp tục</button>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</template>

<script>
import {
    defineComponent,
    ref,
    watch,
    inject,
    onMounted
} from 'vue';
import axios from 'axios';
import {
    useToast
} from 'vue-toast-notification';

export default defineComponent({
    setup() {
        const toast = useToast();
        const globalState = inject('globalState');
        const baseUrl = globalState.baseUrl;
        const reporting_date_from = ref('');
        const reporting_date_to = ref('');
        const export_receipt_number = ref('');
        const posting_date = ref(null);
        const account_cash_expense_debt = ref('131');
        const account_revenue_credit = ref('5111');
        const account_vat_tax = ref('33311');
        const warehouse_code = ref('');
        const account_cost_of_goods_sold = ref('632');
        const customer_code = ref('');
        const account_inventory = ref('1561');
        const submission_reason = ref([]);

        const file_info = ref(null);
        const file_push_sale = ref(null);
        const file_data_product = ref(null);
        const order = ref([]);
        const FileInfoValid = ref(true);
        const file_push_saleValid = ref(true);
        const file_data_productValid = ref(true);
        const reporting_date_fromValid = ref(true);
        const reporting_date_toValid = ref(true);
        const posting_dateValid = ref(true);
        const submission_reasonValid = ref(true);
        const warehouse_codeValid = ref(true);
        const customer_codeValid = ref(true);
        const handleFileUpload = (event, fileType) => {
            const file = event.target.files[0];
            if (file) {
                switch (fileType) {
                    case 'file_info':
                        file_info.value = file;
                        break;
                    case 'file_push_sale':
                        file_push_sale.value = file;
                        break;
                    case 'file_data_product':
                        file_data_product.value = file;
                        break;
                    default:
                        break;
                }
                toast.success(`File ${file.name} đã được chọn.`);
            } else {
                toast.info('Chưa có file nào được chọn.');
            }
        };
        const goToTab = (tabId) => {
            const tabElement = document.getElementById(tabId);
            if (tabElement) {
                const bsTab = new bootstrap.Tab(tabElement);
                bsTab.show();
            } else {
                console.warn(`Tab with ID '${tabId}' not found.`);
            }
        };

        const sendFileDelivery = async () => {
            FileInfoValid.value = !!file_info.value;
            file_push_saleValid.value = !!file_push_sale.value;
            file_data_productValid.value = !!file_data_product.value;
            reporting_date_fromValid.value = !!reporting_date_from.value;
            reporting_date_toValid.value = !!reporting_date_to.value;
            posting_dateValid.value = posting_date.value === 1 || posting_date.value === 2;
            submission_reasonValid.value = submission_reason.value.length > 0;
            warehouse_codeValid.value = !!warehouse_code.value.trim();
            customer_codeValid.value = !!customer_code.value.trim();
            if (
                !FileInfoValid.value ||
                !file_push_saleValid.value ||
                !file_data_productValid.value ||
                !reporting_date_fromValid.value ||
                !reporting_date_toValid.value ||
                !posting_dateValid.value ||
                !submission_reasonValid.value ||
                !warehouse_codeValid.value ||
                !customer_codeValid.value
            ) {
                toast.error('Vui lòng điền đầy đủ thông tin trước khi gửi.');
                return;
            }
            const formData = new FormData();
            const formatDateTime = (isoDateTimeString) => {
                if (!isoDateTimeString) return '';
                const date = new Date(isoDateTimeString);

                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
                const year = date.getFullYear();
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');
                const seconds = String(date.getSeconds()).padStart(2, '0');

                return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
            };

            const formatted_date_from = formatDateTime(reporting_date_from.value);
            const formatted_date_to = formatDateTime(reporting_date_to.value);

            formData.append('reporting_date_from', formatted_date_from);
            formData.append('reporting_date_to', formatted_date_to);
            formData.append('export_receipt_number', export_receipt_number.value);
            formData.append('posting_date', posting_date.value);
            formData.append('customer_code', customer_code.value);
            formData.append('account_cash_expense_debt', account_cash_expense_debt.value);
            formData.append('account_revenue_credit', account_revenue_credit.value);
            formData.append('account_vat_tax', account_vat_tax.value);
            formData.append('warehouse_code', warehouse_code.value);
            formData.append('account_cost_of_goods_sold', account_cost_of_goods_sold.value);
            formData.append('account_inventory', account_inventory.value);
            if (submission_reason.value.length > 0) {
                submission_reason.value.forEach(reason => {
                    formData.append('submission_reason[]', reason);
                });
            }
            if (file_info.value) {
                formData.append('file_info', file_info.value);
            }
            if (file_push_sale.value) {
                formData.append('file_push_sale', file_push_sale.value);
            }
            if (file_data_product.value) {
                formData.append('file_data_product', file_data_product.value);
            }

            try {
                const response = await axios.post(`${baseUrl}/api/accounting/invoice-processing/viettel-post/data`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                if (response) {
                    toast.success('Dữ liệu giao hàng đã được gửi thành công!');
                    order.value = response.data.case_data;
                    goToTab('step7-tab');

                } else {
                    toast.error(`Lỗi: ${response.data.message || 'Không thể gửi dữ liệu.'}`);
                }
            } catch (error) {
                toast.error('Có lỗi xảy ra khi gửi dữ liệu. Vui lòng thử lại.');
            }
        };

        return {
            reporting_date_from,
            reporting_date_to,
            export_receipt_number,
            posting_date,
            account_cash_expense_debt,
            account_revenue_credit,
            account_vat_tax,
            warehouse_code,
            account_cost_of_goods_sold,
            customer_code,
            account_inventory,
            submission_reason,
            handleFileUpload,
            sendFileDelivery,
            goToTab,
            file_info,
            file_push_sale,
            file_data_product,
            order,
            FileInfoValid,
            file_push_saleValid,
            file_data_productValid,
            reporting_date_fromValid,
            reporting_date_toValid,
            posting_dateValid,
            submission_reasonValid,
            warehouse_codeValid,
            customer_codeValid,

            handleFileUpload,
            sendFileDelivery,
            goToTab
        };
    },
});
</script>
