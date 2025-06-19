<template>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Danh sách mục hàng hoá</h3>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Trang chủ</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Hàng hoá</span>
                </li>
            </ol>
        </nav>
    </div>
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-25">
            <form class="d-flex flex-wrap gap-2 align-items-end mb-4" @submit.prevent="getReceiptHistory">
                <div>
                    <label class="form-label mb-1">Mã đơn hàng</label>
                    <input type="text" class="form-control" placeholder="Tìm mã đơn hàng..."
                        v-model="filters.order_code" />
                </div>
                <div>
                    <label class="form-label mb-1">Trạng thái hóa đơn</label>
                    <select class="form-select form-control h-40" v-model="filters.order_export_receipt">
                        <option value="">Tất cả</option>
                        <option :value="1">Đã xuất hóa đơn</option>
                        <option :value="0">Chưa xuất hóa đơn</option>
                    </select>
                </div>
                <div>
                    <label class="form-label mb-1">Từ ngày</label>
                    <input type="date" class="form-control" v-model="filters.order_date_from" />
                </div>
                <div>
                    <label class="form-label mb-1">Đến ngày</label>
                    <input type="date" class="form-control" v-model="filters.order_date_to" />
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </form>
            <vue3-datatable :rows="receiptList" :columns="cols" :loading="loading" :totalRows="totalProducts"
                :isServerMode="true" :pageSize="perPage" :hasCheckbox="true"
                paginationInfo="Hiển thị {0} đến {1} trên tổng {2} mục" @change="changeServer" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, inject } from 'vue'
import axios from 'axios'
import Vue3Datatable from '@bhplugin/vue3-datatable'
import '@bhplugin/vue3-datatable/dist/style.css'
import { useToast } from 'vue-toast-notification'

const toast = useToast()
const globalState = inject('globalState')
const baseUrl = globalState.baseUrl

const loading = ref(false)
const receiptList = ref([])
const totalProducts = ref(0)
const perPage = 10
const currentPage = ref(1)

const filters = ref({
    order_code: '',
    order_export_receipt: '',
    order_date_from: '',
    order_date_to: '',
})

const cols = [
    { field: 'order_code', title: 'Mã đơn hàng' },
    { field: 'order_date', title: 'Ngày đơn hàng' },
    {
        field: 'order_total_amount',
        title: 'Tổng tiền hàng',
        callback: ({ order_total_amount }) => formatCurrency(order_total_amount),
    },
    {
        field: 'order_vat_amount',
        title: 'Tiền thuế GTGT',
        callback: ({ order_vat_amount }) => formatCurrency(order_vat_amount),
    },
    {
        field: 'order_paid_amount',
        title: 'Tổng thanh toán',
        callback: ({ order_paid_amount }) => formatCurrency(order_paid_amount),
    },
    {
        field: 'order_export_receipt',
        title: 'Trạng thái',
        useHtml: true,
        callback: ({ order_export_receipt }) => {
            const isExported = Boolean(Number(order_export_receipt));
            return `
                <span class="badge ${isExported ? 'bg-success text-success' : 'bg-danger text-danger'} bg-opacity-10 p-2 fs-12 fw-normal">
                    ${isExported ? 'Đã xuất' : 'Chưa xuất'}
                </span>
            `;
        },
    }

]

const getReceiptHistory = async () => {
    try {
        loading.value = true
        const params: any = {
            page: currentPage.value,
            per_page: perPage.value,
            ...filters.value,
        }
        const res = await axios.get(`${baseUrl}/api/accounting/receipt-history/list`, { params })
        receiptList.value = res.data.data;
        console.log(receiptList.value);
        totalProducts.value = res.data.total;
    } catch (e) {
        toast.error('Lỗi khi tải danh sách hoá đơn')
    } finally {
        loading.value = false
    }
}

const changeServer = (data: any) => {
    currentPage.value = data.current_page;
    perPage.value = data.pagesize;
    getReceiptHistory();
}
const formatCurrency = (val: number | string) =>
  new Intl.NumberFormat('vi-VN', {
    minimumFractionDigits: 0,
    maximumFractionDigits: 2
  }).format(Number(val ?? 0));
getReceiptHistory()
</script>
