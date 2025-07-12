<template>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <form @submit.prevent="callPushReceipt">
                    <div class="row">
                        <div class="row align-items-center mb-4">
                            <!-- 1/4: Tiêu đề -->
                            <div class="col-lg-3 col-sm-6">
                                <h5 class="mb-0 fs-17 text-info">Chọn ngày xuất hóa đơn lazada</h5>
                            </div>

                            <!-- 2/4: Checkbox Kiêm phiếu xuất -->
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="includeSlip" v-model="form.includeSlip" />
                                <label class="form-check-label text-secondary" for="includeSlip">
                                    Kiêm phiếu xuất
                                </label>
                                </div>
                            </div>

                            <!-- 3/4: Checkbox Lập kèm hóa đơn -->
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="attachInvoice" v-model="form.attachInvoice" />
                                <label class="form-check-label text-secondary" for="attachInvoice">
                                    Lập kèm hóa đơn
                                </label>
                                </div>
                            </div>

                            <!-- 4/4: Checkbox Máy tính tiền -->
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="fromCashMachine" v-model="form.fromCashMachine" />
                                <label class="form-check-label text-secondary" for="fromCashMachine">
                                    Là hóa đơn từ máy tính tiền
                                </label>
                                </div>
                            </div>
                            </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Khoảng thời gian đơn hàng Lazada</label>
                                <a-range-picker v-model:value="dateRange" format="DD/MM/YYYY" style="width: 100%; height: 55px;" :ranges="presetRanges" placeholder="Chọn khoảng ngày" />
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Bán hàng trong nước</label>
                                <select class="form-select form-control h-55" v-model="form.saleType">
                                    <option value="domestic">1. Bán hàng trong nước</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Hình thức thanh toán</label>
                                <select class="form-select form-control h-55" v-model="form.paymentMethod">
                                    <option value="unpaid">Chưa thu tiền</option>
                                    <option value="paid_date">Thu tiền ngày</option>
                                    <option value="bank">Chuyển khoản</option>
                                </select>
                            </div>
                        </div>



                        <h5 class="mb-3 fs-17 text-info">Chứng từ ghi nợ</h5>

                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Mã khách hàng</label>
                                <select class="form-select form-control h-55" v-model="form.paymentMethod">
                                    <option value="unpaid">Không có MST</option>
                                    <option value="paid_date">Có MST</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Tên khách hàng</label>
                                <select class="form-select form-control h-55" v-model="form.paymentMethod">
                                    <option value="unpaid">Không có MST</option>
                                    <option value="paid_date">Có MST</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Mã số thuế / CCCD Chủ hộ</label>
                                <input type="text" class="form-control h-55" placeholder="Nhập mã số thuế hoặc CCCD" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Người liên hệ</label>
                                <input type="text" class="form-control h-55" placeholder="Người liên hệ" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Địa chỉ</label>
                                <select class="form-select form-control h-55" v-model="form.paymentMethod">
                                    <option value="unpaid">Không có MST</option>
                                    <option value="paid_date">Có MST</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Nhân viên bán hàng</label>
                                <input type="text" class="form-control h-55" placeholder="Nhân viên bán hàng" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Diễn giải</label>
                                <input type="text" class="form-control h-55" placeholder="Nhân viên bán hàng" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Điều khoản</label>
                                <input type="text" class="form-control h-55" placeholder="Điều khoản" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Số ngày được nợ</label>
                                <input type="text" class="form-control h-55" placeholder="Số ngày được nợ" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Hạn thanh toán</label>
                                <input type="text" class="form-control h-55" placeholder="Hạn thanh toán" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Ngày hạch toán</label>
                                <input type="text" class="form-control h-55" placeholder="Ngày hạch toán" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Ngày chứng từ</label>
                                <input type="text" class="form-control h-55" placeholder="Ngày chứng từ" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Số chứng từ</label>
                                <input type="text" class="form-control h-55" placeholder="Ngày chứng từ" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Loại tiền</label>
                                <input type="text" class="form-control h-55" placeholder="VND" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Chiết khấu</label>
                                <input type="text" class="form-control h-55" placeholder="Không chiết khấu" />
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                Gửi hóa đơn
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
    reactive
} from 'vue';
import {
    useToast
} from 'vue-toast-notification';
import moment from 'moment';
import axios from 'axios';

export default defineComponent({
    setup() {
        const globalState = inject('globalState');
        const baseUrl = globalState.baseUrl;
        const toast = useToast();

        // Date range
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
        const presetRanges = {
            'Trong vòng tháng này': [
                moment().startOf('month'),
                moment()
            ],
            'Trong vòng 3 tháng trước': [
                moment().subtract(3, 'months'),
                moment()
            ]
        };

        // Các trường mới
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
                const {
                    data
                } = await axios.post(
                    `${baseUrl}/api/e-commerce/lazada/push-receipt`,
                    payload
                );
                data.status ?
                    toast.success('Đã gửi hóa đơn thành công') :
                    toast.error('Gửi hóa đơn thất bại. Vui lòng thử lại sau.');
            } catch (err) {
                console.error(err);
                toast.error('Đã xảy ra lỗi khi gửi hóa đơn.');
            }
        };

        return {
            dateRange,
            presetRanges,
            form,
            callPushReceipt
        };
    }
});
</script>
