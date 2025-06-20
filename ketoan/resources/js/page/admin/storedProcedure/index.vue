<template>
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h3 class="mb-0">Danh sách hóa đơn đã xuất</h3>
    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
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
      <form class="row g-3 align-items-end mb-4" @submit.prevent="getReceiptHistory">
        <div class="col-md-2 form-group">
          <label class="form-label text-secondary">Mã đơn hàng</label>
          <input
            type="text"
            class="form-control h-50"
            v-model="filters.order_code"
            placeholder="Tìm mã đơn"
          />
        </div>
        <div class="col-md-2 form-group">
          <label class="form-label text-secondary">Trạng thái hóa đơn</label>
          <select
            class="form-select form-control h-50"
            v-model="filters.order_export_receipt"
          >
            <option value="">Tất cả</option>
            <option :value="1">Đã xuất</option>
            <option :value="0">Chưa xuất</option>
          </select>
        </div>
        <div class="col-md-2 form-group">
          <label class="form-label text-secondary">Từ ngày</label>
          <input
            type="date"
            class="form-control h-50"
            v-model="filters.order_date_from"
          />
        </div>
        <div class="col-md-2 form-group">
          <label class="form-label text-secondary">Đến ngày</label>
          <input
            type="date"
            class="form-control h-50"
            v-model="filters.order_date_to"
          />
        </div>
        <div class="col-md-4 d-flex gap-2">
          <button
            type="submit"
            class="btn btn-outline-info fw-medium hover-white py-3 px-4 flex-grow-1"
          >
            <i class="ri-search-line"></i> Tìm kiếm
          </button>
          <button
            type="button"
            class="btn btn-outline-danger fw-medium hover-white py-3 px-4 flex-grow-1"
            @click="openBulkDeleteModal"
            :disabled="!selectedRows.length"
          >
            <i class="ri-delete-bin-line"></i> Xóa hóa đơn
          </button>
          <button
            type="button"
            class="btn btn-outline-success fw-medium hover-white py-3 px-4 flex-grow-1"
            @click="openImportModal"
          >
            <i class="ri-file-fill"></i> Import
          </button>
        </div>
      </form>
      <vue3-datatable
        :rows="rows"
        :columns="cols"
        :loading="loading"
        :totalRows="total_rows"
        :isServerMode="true"
        :pageSize="perPage"
        :hasCheckbox="true"
        :rowKey="'id'"
        v-model:selectedRows="selectedRows"
        @rowSelect="onRowSelect"
        paginationInfo="Hiển thị {0} đến {1} trên tổng {2} mục"
        @change="changeServer"
      >
        <template #id="data">
          <strong>#{{ data.value.id }}</strong>
        </template>
        <template #order_date="data">
          {{ formatDateTime(data.value.order_date) }}
        </template>
        <template #order_total_amount="data">
          {{ formatCurrency(data.value.order_total_amount) }}
        </template>
        <template #order_vat_amount="data">
          {{ formatCurrency(data.value.order_vat_amount) }}
        </template>
        <template #order_paid_amount="data">
          {{ formatCurrency(data.value.order_paid_amount) }}
        </template>
        <template #order_export_receipt="data">
          <span class="badge bg-success bg-opacity-10 text-success" v-if="data.value.order_export_receipt == 1">
            Đã xuất hóa đơn
          </span>
          <span class="badge bg-danger bg-opacity-10 text-danger" v-else>
            Chưa xuất hóa đơn
          </span>
        </template>
        <template #actions="data">
          <button
            type="button"
            class="btn btn-outline-danger"
            @click="openSingleDeleteModal(data.value.order_code)"
          >
            Xoá
          </button>
        </template>
      </vue3-datatable>
    </div>
  </div>

  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Xác nhận xoá</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          Bạn có chắc chắn muốn xoá <strong>{{ selectedRows.length }} đơn đã chọn</strong>? Hành động này không thể hoàn tác.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
          <button type="button" class="btn btn-danger text-white" @click="deleteReceiptHistory">Xoá</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importModalLabel">Import file danh sách đã xuất</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <form @submit.prevent="importReceiptHistory">
          <div class="modal-body">
            <div class="mb-3">
              <label for="fileInput" class="form-label">Chọn file (.xlsx, .csv)</label>
              <input
                class="form-control"
                type="file"
                id="fileInput"
                accept=".xlsx,.csv"
                @change="handleFileChange"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
            <button type="submit" class="btn btn-success text-white">Thêm</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, inject } from 'vue';
import Vue3Datatable from '@bhplugin/vue3-datatable';
import '@bhplugin/vue3-datatable/dist/style.css';
import axios from 'axios';
import { useToast } from 'vue-toast-notification';

const loading = ref(false);
const rows = ref<any[]>([]);
const total_rows = ref(0);
const perPage = ref(10);
const currentPage = ref(1);
const selectedRows = ref<any[]>([]);
const filters = ref({ order_code: '', order_export_receipt: '', order_date_from: '', order_date_to: '' });
const toast = useToast();

const cols = ref([
  { field: 'order_code', title: 'Mã đơn hàng' },
  { field: 'order_date', title: 'Ngày đơn hàng' },
  { field: 'order_total_amount', title: 'Tổng tiền hàng' },
  { field: 'order_vat_amount', title: 'Tiền thuế GTGT' },
  { field: 'order_paid_amount', title: 'Tổng thanh toán' },
  { field: 'order_export_receipt', title: 'Trạng thái' },
]);

const globalState: any = inject('globalState');
const baseUrl = globalState.baseUrl;

let importFile = ref<File | null>(null);
function handleFileChange(e: Event) {
  const target = e.target as HTMLInputElement;
  importFile.value = target.files?.[0] || null;
}

async function importReceiptHistory() {
  if (!importFile.value) {
    toast.error('Vui lòng chọn file để import.');
    return;
  }
  const formData = new FormData();
  formData.append('file_history', importFile.value);
  loading.value = true;
  try {
    await axios.post(`${baseUrl}/api/accounting/receipt-history/import`, formData, {
      headers: { 'Content-Type': 'multipart/form-data' }
    });
    toast.success('Import thành công');
    await getReceiptHistory();
    importFile.value = null;
  } catch (error) {
    console.error('Lỗi import:', error);
    toast.error('Import thất bại');
  } finally {
    loading.value = false;
    const modalEl = document.getElementById('importModal')!;
    (window as any).bootstrap.Modal.getInstance(modalEl)?.hide();
  }
}

function onRowSelect(rows: any[]) {
  selectedRows.value = rows;
}

function openBulkDeleteModal() {
  if (!selectedRows.value.length) {
    toast.error('Vui lòng chọn ít nhất một hóa đơn để xoá.');
    return;
  }
  const modalEl = document.getElementById('deleteModal')!;
  (window as any).bootstrap.Modal.getOrCreateInstance(modalEl).show();
}
function openImportModal() {
  const modalEl = document.getElementById('importModal')!;
  (window as any).bootstrap.Modal.getOrCreateInstance(modalEl).show();
}
function openSingleDeleteModal(code: string) {
  selectedRows.value = [{ order_code: code }];
  openBulkDeleteModal();
}

async function deleteReceiptHistory() {
  if (!selectedRows.value.length) {
    toast.error('Vui lòng chọn ít nhất một hóa đơn để xoá.');
    return;
  }
  const codesToDelete = selectedRows.value.map(r => r.order_code);
  loading.value = true;
  try {
    await axios.post(`${baseUrl}/api/accounting/receipt-history/delete/bulk`, { order_codes: codesToDelete });
    toast.success('Xóa thành công');
    await getReceiptHistory();
    selectedRows.value = [];
  } catch (error) {
    console.error('Lỗi khi xoá:', error);
    toast.error('Xóa thất bại');
  } finally {
    loading.value = false;
    const modalEl = document.getElementById('deleteModal')!;
    (window as any).bootstrap.Modal.getInstance(modalEl)?.hide();
  }
}

async function getReceiptHistory() {
  loading.value = true;
  try {
    const params: any = {
      page: currentPage.value,
      per_page: perPage.value,
      order_code: filters.value.order_code,
      order_export_receipt: filters.value.order_export_receipt,
    };
    if (filters.value.order_date_from) {
      const [year, month, day] = filters.value.order_date_from.split('-');
      params.order_date_from = `${day}/${month}/${year} 00:00:00`;
    }
    if (filters.value.order_date_to) {
      const [year, month, day] = filters.value.order_date_to.split('-');
      params.order_date_to = `${day}/${month}/${year} 23:59:59`;
    }
    const res = await axios.get(`${baseUrl}/api/accounting/receipt-history/list`, { params });
    rows.value = res.data.data;
    total_rows.value = res.data.total;
  } catch (error) {
    console.error('Lỗi lấy dữ liệu:', error);
  } finally {
    loading.value = false;
  }
}

function changeServer(data: any) {
  currentPage.value = data.current_page;
  perPage.value = data.pagesize;
  getReceiptHistory();
}

function formatCurrency(value: number) {
  return value != null ? value.toLocaleString('vi-VN') : '';
}

function formatDateTime(value: string) {
  if (!value) return '';
  const [datePart, timePart] = value.split(' ');
  if (datePart && timePart) {
    const [day, month, year] = datePart.split('/');
    const [hh, mm, ss] = timePart.split(':');
    if (day && month && year && hh && mm && ss) {
      const d = new Date(
        Number(year),
        Number(month) - 1,
        Number(day),
        Number(hh),
        Number(mm),
        Number(ss)
      );
      const D = String(d.getDate()).padStart(2, '0');
      const M = String(d.getMonth() + 1).padStart(2, '0');
      const Y = d.getFullYear();
      const H = String(d.getHours()).padStart(2, '0');
      const Min = String(d.getMinutes()).padStart(2, '0');
      const S = String(d.getSeconds()).padStart(2, '0');
      return `${D}/${M}/${Y} ${H}:${Min}:${S}`;
    }
  }
  const date = new Date(value);
  if (isNaN(date.getTime())) return value;
  const D = String(date.getDate()).padStart(2, '0');
  const M = String(date.getMonth() + 1).padStart(2, '0');
  const Y = date.getFullYear();
  const H = String(date.getHours()).padStart(2, '0');
  const Min = String(date.getMinutes()).padStart(2, '0');
  const S = String(date.getSeconds()).padStart(2, '0');
  return `${D}/${M}/${Y} ${H}:${Min}:${S}`;
}

onMounted(() => getReceiptHistory());
</script>
