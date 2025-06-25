<template>
  <div>
    <!-- Header and Search -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="mb-0">Danh sách mục hàng hoá</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="#"><i class="ri-home-4-line me-1"></i>Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">Hàng hoá</li>
        </ol>
      </nav>
    </div>

    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <input v-model="searchKeyword" @input="fetchProducts" type="text" class="form-control w-50" placeholder="Tìm kiếm SKU, tên sản phẩm..." />
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Thêm mới</button>
        </div>
        <vue3-datatable
          :rows="rows"
          :columns="cols"
          :loading="loading"
          :totalRows="totalRows"
          server-mode
          :pageSize="params.pagesize"
          @change="onPageChange"
        >
          <template #actions="data">
            <button class="btn btn-sm btn-info me-1" @click="viewDetails(rows)"><i class="ri-eye-line"></i></button>
            <button class="btn btn-sm btn-warning me-1" @click="editProduct(rows)"><i class="ri-edit-line"></i></button>
            <button class="btn btn-sm btn-danger" @click="promptDelete(data.value)"><i class="ri-delete-bin-line"></i></button>
          </template>
        </vue3-datatable>
      </div>
    </div>

    <div
      class="modal fade"
      id="deleteModal"
      tabindex="-1"
      aria-labelledby="deleteModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" style="max-width:550px">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Xóa sản phẩm</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body">
            Bạn có chắc chắn muốn xóa sản phẩm <strong>{{ selectedRow?.product_name }}</strong>?
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Hủy
            </button>
            <button
              type="button"
              class="btn btn-danger text-white"
              @click="confirmDelete"
            >
              Xóa
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <form @submit.prevent="createProduct">
            <div class="modal-header">
              <h5 class="modal-title">Thêm mới sản phẩm</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="row g-3 mb-4">
                <div class="col-md-4">
                  <label class="form-label">SKU</label>
                  <input v-model="sku" type="text" class="form-control" required />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Mã kế toán</label>
                  <input v-model="accountingCode" type="text" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Tên sản phẩm</label>
                  <input v-model="productName" type="text" class="form-control" required />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Đơn vị tính</label>
                  <input v-model="unit" type="text" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Thuế suất (%)</label>
                  <input v-model.number="taxRate" type="number" class="form-control" min="0" max="100" required />
                </div>
              </div>
              <hr />
              <h6>Chi tiết combo</h6>
              <div class="row g-3 align-items-end">
                <template v-for="(detail, idx) in comboDetails" :key="idx">
                  <div class="col-md-3">
                    <label class="form-label">Mã chi tiết</label>
                    <input v-model="detail.code" type="text" class="form-control" />
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Tên chi tiết</label>
                    <input v-model="detail.name" type="text" class="form-control" />
                  </div>
                  <div class="col-md-3">
                    <label class="form-label">Đơn vị</label>
                    <input v-model="detail.unit" type="text" class="form-control" />
                  </div>
                  <div class="col-md-2">
                    <label class="form-label">Số lượng</label>
                    <input v-model.number="detail.qty" type="number" class="form-control" min="1" />
                  </div>
                  <div class="col-md-1">
                    <button type="button" class="btn btn-outline-danger" @click="removeComboDetail(idx)">-</button>
                  </div>
                </template>
                <div class="col-12">
                  <button type="button" class="btn btn-outline-primary" @click="addComboDetail">
                    <i class="ri-add-line"></i> Thêm dòng
                  </button>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
              <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive, watch, onMounted, inject } from 'vue';
import axios from 'axios';
import Vue3Datatable from '@bhplugin/vue3-datatable';
import '@bhplugin/vue3-datatable/dist/style.css';
import { useToast } from 'vue-toast-notification';

// Toast & base URL
const toast = useToast();
const globalState: any = inject('globalState');
const baseUrl = globalState.baseUrl || '';

// Table state
const loading = ref(false);
const rows = ref<any[]>([]);
const totalRows = ref(0);
const searchKeyword = ref('');
const params = reactive({ current_page: 1, pagesize: 10 });
const cols = ref([
  { field: 'id', title: 'ID', isUnique: true, type: 'number' },
  { field: 'sku', title: 'SKU' },
  { field: 'accounting_code', title: 'Mã kế toán' },
  { field: 'product_name', title: 'Tên sản phẩm' },
  { field: 'unit', title: 'Đơn vị' },
  { field: 'tax_rate', title: 'Thuế suất (%)', type: 'number' },
  { field: 'actions', title: 'Thao tác', slot: true }
]);

// Selected for delete
const selectedRow = ref<any>(null);

// Fetch products
async function fetchProducts() {
  loading.value = true;
  try {
    const res = await axios.get(`${baseUrl}/api/products`, { params: { page: params.current_page, per_page: params.pagesize, search: searchKeyword.value || undefined } });
    rows.value = res.data.data;
    totalRows.value = res.data.total;
  } catch (e) {
    console.error(e);
  } finally {
    loading.value = false;
  }
}

function onPageChange({ current_page, pagesize }: any) {
  params.current_page = current_page;
  params.pagesize = pagesize;
  fetchProducts();
}

// Create form state
const sku = ref('');
const accountingCode = ref('');
const productName = ref('');
const unit = ref('');
const taxRate = ref<number | null>(null);
interface ComboDetail { code: string; name: string; unit: string; qty: number | null; }
const comboDetails = ref<ComboDetail[]>([{ code: '', name: '', unit: '', qty: null }]);

function addComboDetail() {
  comboDetails.value.push({ code: '', name: '', unit: '', qty: null });
}

function removeComboDetail(idx: number) {
  comboDetails.value.splice(idx, 1);
}

async function createProduct() {
  if (!sku.value || !productName.value || taxRate.value === null) {
    toast.error('Vui lòng nhập đủ thông tin');
    return;
  }
  const payload = {
    sku: sku.value,
    accounting_code: accountingCode.value,
    product_name: productName.value,
    unit: unit.value,
    tax_rate: taxRate.value,
    details: comboDetails.value.filter(d => d.name && d.qty != null).map(d => ({ combo_detail_code: d.code, detail_name: d.name, unit: d.unit, quantity: d.qty }))
  };
  try {
    await axios.post(`${baseUrl}/api/products`, payload);
    toast.success('Tạo thành công');
    fetchProducts();
    sku.value = '';
    accountingCode.value = '';
    productName.value = '';
    unit.value = '';
    taxRate.value = null;
    comboDetails.value = [{ code: '', name: '', unit: '', qty: null }];
    const modal = document.getElementById('createModal')!;
    (window as any).bootstrap.Modal.getInstance(modal)?.hide();
  } catch (err: any) {
    toast.error(err.response?.data?.message || 'Lỗi');
  }
}

function promptDelete(data: any) {
  selectedRow.value = data;

  // Show the delete confirmation modal programmatically
  const modalEl = document.getElementById('deleteModal')!;
  const bsModal = new (window as any).bootstrap.Modal(modalEl);
  bsModal.show();
}


// Confirm delete
async function confirmDelete() {
    console.log(selectedRow.value);
  if (!selectedRow.value) return;
  try {
    await axios.delete(`${baseUrl}/api/products/${selectedRow.value.id}`);
    toast.success('Xóa sản phẩm thành công');
    fetchProducts();
  } catch (e) {
    console.error('Error deleting product:', e);
    toast.error('Xóa sản phẩm thất bại');
  } finally {
    const modalEl = document.getElementById('deleteModal')!;
    const bsModal = (window as any).bootstrap.Modal.getInstance(modalEl);
    if (bsModal) bsModal.hide();
    selectedRow.value = null;
}
}

function viewDetails(row: any) {
console.log(row);


 }
function editProduct(row: any)  { /* ... */ }

watch(() => [params.current_page, params.pagesize], fetchProducts);
onMounted(fetchProducts);
</script>

<style scoped>
.table-src-form { width: 300px; }
</style>
