<template>
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h3 class="mb-0">Danh sách mục hàng hoá</h3>
    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
      <ol class="breadcrumb align-items-center mb-0 lh-1">
        <li class="breadcrumb-item">
          <a href="#" class="d-flex align-items-center text-decoration-none">
            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
            <span class="text-secondary fw-medium hover">Trang chủ</span>
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <span class="fw-medium">Hàng hóa</span>
        </li>
      </ol>
    </nav>
  </div>
  <div>
    <div class="card bg-white border-0 rounded-3 mb-4">
      <div class="card-body p-25">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
          <form class="position-relative table-src-form me-0">
            <input
              type="text"
              class="form-control border-0"
              placeholder="Tìm kiếm hàng hoá..."
              v-model="searchKeyword"
            />
            <i class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y text-secondary">search</i>
          </form>
          <div class="d-flex gap-2 flex-wrap">
            <button
                class="btn btn-outline-success fw-medium rounded-3 hover-white"
                @click="triggerImport"
                data-bs-toggle="modal"
                data-bs-target="#importModal"
                >
                <span class="d-flex align-items-center" style="gap: 5px">
                    <span class="material-symbols-outlined"> export_notes </span>
                    <span>Import Excel</span>
                </span>
            </button>
            <button
                class="btn btn-outline-primary fw-medium rounded-3 hover-bg"
                data-bs-toggle="modal"
                data-bs-target="#createModal"
                @click="openCreateModal"
            >
                <span class="d-flex align-items-center" style="gap: 5px">
                <span class="py-sm-1 d-block">
                    <i class="ri-add-line d-none d-sm-inline-block"></i>
                        <span>Thêm mới hàng hóa</span>
                    </span>
                </span>
            </button>
          </div>

        </div>
        <vue3-datatable
           :rows="rows"
           :columns="cols"
           :loading="loading"
           :totalRows="totalRows"
           :isServerMode="true"
           :pageSize="params.pagesize"
            paginationInfo="Hiển thị {0} đến {1} trên tổng {2} mục"
            :showNumbersCount="5"
            class="alt-pagination"
            @change="onPageChange"
        >

          <template #actions="{ value }">
            <div class="d-flex gap-2">
            <router-link
            :to="{ name: 'admin-product-detail', params: { id: value.id } }"
            class="btn btn-sm btn-light d-flex align-items-center justify-content-center"
            title="Xem chi tiết"
            >
            <i class="ri-eye-line text-primary fs-16"></i>
            </router-link>

            <button
            type="button"
            class="btn btn-sm btn-light d-flex align-items-center justify-content-center"
            @click="editProduct(value)"
            title="Chỉnh sửa"
            >
            <i class="ri-edit-line fs-16 text-info"></i>
            </button>

            <button
            type="button"
            class="btn btn-sm btn-light d-flex align-items-center justify-content-center"
            @click="promptDelete(value)"
            title="Xoá"
            >
            <i class="ri-delete-bin-line fs-16 text-danger"></i>
            </button>
        </div>
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
      <div class="modal-dialog" style="max-width: 550px">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Xóa sản phẩm</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Bạn có chắc chắn muốn xóa sản phẩm
            <strong>{{ selectedRow?.product_name }}</strong>?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button
              type="button"
              class="btn btn-danger text-white"
              @click="confirmDelete"
            >Xóa</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <form @submit.prevent="saveProduct">
            <div class="modal-header">
              <h5 class="modal-title">{{ modalTitle }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="row g-3 mb-4">
                <div class="col-md-4">
                  <label class="form-label text-secondary">Mã sàn</label>
                  <input v-model="form.sku" type="text" class="form-control" required />
                </div>
                <div class="col-md-4">
                  <label class="form-label text-secondary">Mã kế toán</label>
                  <input v-model="form.accountingCode" type="text" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label text-secondary">Tên sản phẩm</label>
                  <input v-model="form.productName" type="text" class="form-control" required />
                </div>
                <div class="col-md-4">
                  <label class="form-label text-secondary">Đơn vị tính</label>
                  <input v-model="form.unit" type="text" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label text-secondary">Thuế suất (%)</label>
                  <input
                    v-model.number="form.taxRate"
                    type="number"
                    class="form-control"
                    min="0"
                    max="100"
                    required
                  />
                </div>
              </div>
              <hr />
              <h6>Chi tiết combo</h6>
              <div class="row g-3 align-items-end">
                <template v-for="(detail, idx) in form.comboDetails" :key="idx">
                  <div class="col-md-3">
                    <label class="form-label text-secondary">Mã chi tiết</label>
                    <input v-model="detail.code" type="text" class="form-control" />
                  </div>
                  <div class="col-md-3">
                    <label class="form-label text-secondary">Tên chi tiết</label>
                    <input v-model="detail.name" type="text" class="form-control" />
                  </div>
                  <div class="col-md-3">
                    <label class="form-label text-secondary">Đơn vị</label>
                    <input v-model="detail.unit" type="text" class="form-control" />
                  </div>
                  <div class="col-md-2">
                    <label class="form-label text-secondary">Số lượng</label>
                    <input
                      v-model.number="detail.qty"
                      type="number"
                      class="form-control"
                      min="1"
                    />
                  </div>
                  <div class="col-md-1 d-flex align-items-center justify-content-center">
                    <button
                        class="btn p-2 border-0 bg-transparent"
                        @click="removeComboDetail(idx)"
                        title="Xoá dòng"
                    >
                        <i class="material-symbols-outlined fs-18 text-danger">delete</i>
                    </button>
                    </div>
                </template>
                <div class="col-12">
                  <button
                    type="button"
                    class="btn btn-primary fw-medium text-white py-2 px-4"
                    @click="addComboDetail"
                  >
                    <i class="ri-add-line"></i> Thêm dòng
                  </button>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger fw-medium py-2 px-4 hover-white" data-bs-dismiss="modal">
                    <span>Hủy</span>
                </button>
                <button class="btn btn-outline-primary fw-medium py-2 px-4 hover-white">
                    <span>{{ modalSubmitText }}</span>
                </button>
            </div>
          </form>
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
        <form @submit.prevent="importProducts">
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
            <button type="button" class="btn btn-outline-danger fw-medium py-2 px-4 hover-white" data-bs-dismiss="modal">
                <span>Hủy</span>
            </button>
            <button class="btn btn-outline-primary fw-medium py-2 px-4 hover-white" type="submit">
                <span>Thêm mới</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive, watch, onMounted, inject, computed } from "vue";
import axios from "axios";
import Vue3Datatable from "@bhplugin/vue3-datatable";
import "@bhplugin/vue3-datatable/dist/style.css";
import { useToast } from "vue-toast-notification";
import { debounce } from "lodash";

interface ComboDetail {
  code: string;
  name: string;
  unit: string;
  qty: number | null;
}

const toast = useToast();
const globalState: any = inject("globalState");
const baseUrl = globalState.baseUrl || "";

const loading = ref(false);
const rows = ref<any[]>([]);
const totalRows = ref(0);
const searchKeyword = ref("");
const params = reactive({ current_page: 1, pagesize: 50 });
const selectedRow = ref<any>(null);
const editingId = ref<number | null>(null);
let importFile = ref<File | null>(null);
const cols = ref([
  { field: "id", title: "ID", isUnique: true, type: "number", width: "60px" },
  { field: "sku", title: "Mã sàn" , width: "200px"},
  { field: "accounting_code", title: "Mã hệ thống kế toán" , width: "200px" },
  { field: "product_name", title: "Tên sản phẩm" },
  { field: "unit", title: "Đơn vị" , width: "80px" },
  { field: "tax_rate", title: "Thuế suất (%)", type: "number" , width: "50px" },
  { field: "actions", title: "Thao tác", slot: true, width: "120px", sort: false },
]);

const form = reactive({
  sku: "",
  accountingCode: "",
  productName: "",
  unit: "",
  taxRate: null as number | null,
  comboDetails: [{ code: "", name: "", unit: "", qty: null }] as ComboDetail[],
});

const modalTitle = computed(() =>
  editingId.value ? "Cập nhật hàng hóa" : "Thêm mới hàng hóa"
);
const modalSubmitText = computed(() => (editingId.value ? "Cập nhật" : "Thêm mới"));

async function fetchProducts() {
  loading.value = true;
  try {
    const apiParams: any = {
      page: params.current_page,
      per_page: params.pagesize,
    };
    if (searchKeyword.value) {
      apiParams.search = searchKeyword.value;
    }
    const res = await axios.get(`${baseUrl}/api/products`, { params: apiParams });
    rows.value = res.data.data;
    totalRows.value = res.data.total;
  } catch (e) {
    console.error(e);
    toast.error("Tải danh sách sản phẩm thất bại.");
  } finally {
    loading.value = false;
  }
}

function resetForm() {
  editingId.value = null;
  form.sku = "";
  form.accountingCode = "";
  form.productName = "";
  form.unit = "";
  form.taxRate = null;
  form.comboDetails = [{ code: "", name: "", unit: "", qty: null }];
}

function openCreateModal() {
  resetForm();
}

function addComboDetail() {
  form.comboDetails.push({ code: "", name: "", unit: "", qty: 1 });
}

function removeComboDetail(idx: number) {
    if (form.comboDetails.length > 1) {
        form.comboDetails.splice(idx, 1);
    } else {
        toast.info("Không thể xóa dòng chi tiết cuối cùng.");
    }
}

async function saveProduct() {
  if (!form.sku || !form.productName || form.taxRate === null) {
    toast.error("Vui lòng nhập đủ thông tin bắt buộc (SKU, Tên sản phẩm, Thuế suất).");
    return;
  }

  const payload = {
    sku: form.sku,
    accounting_code: form.accountingCode,
    product_name: form.productName,
    unit: form.unit,
    tax_rate: form.taxRate,
    details: form.comboDetails
      .filter((d) => d.name && d.qty != null && d.qty > 0)
      .map((d) => ({
        combo_detail_code: d.code,
        detail_name: d.name,
        unit: d.unit,
        quantity: d.qty,
      })),
  };

  loading.value = true;
  try {
    if (editingId.value) {
      await axios.put(`${baseUrl}/api/products/${editingId.value}`, payload);
      toast.success("Cập nhật sản phẩm thành công");
    } else {
      await axios.post(`${baseUrl}/api/products`, payload);
      toast.success("Tạo sản phẩm thành công");
    }

    fetchProducts();
    const modalEl = document.getElementById("createModal")!;
    const bsModal = (window as any).bootstrap.Modal.getInstance(modalEl);
    bsModal?.hide();
  } catch (err: any) {
    toast.error(err.response?.data?.message || "Lỗi khi lưu sản phẩm");
  } finally {
    loading.value = false;
  }
}


function editProduct(product: any) {
    editingId.value = product.id;
    axios.get(`${baseUrl}/api/products/${product.id}`)
        .then(res => {
            const productData = res.data;
            form.sku = productData.sku;
            form.accountingCode = productData.accounting_code;
            form.productName = productData.product_name;
            form.unit = productData.unit;
            form.taxRate = Number(productData.tax_rate);

            if (productData.details && productData.details.length > 0) {
                form.comboDetails = productData.details.map((d: any) => ({
                    code: d.combo_detail_code,
                    name: d.detail_name,
                    unit: d.unit,
                    qty: d.quantity,
                }));
            } else {
                form.comboDetails = [{ code: "", name: "", unit: "", qty: null }];
            }

            const modalEl = document.getElementById("createModal")!;
            const bsModal = new (window as any).bootstrap.Modal(modalEl);
            bsModal.show();
        })
        .catch(err => {
            toast.error("Không thể tải thông tin sản phẩm để chỉnh sửa.");
            console.error(err);
        });
}


function promptDelete(data: any) {
  selectedRow.value = data;
  const modalEl = document.getElementById("deleteModal")!;
  const bsModal = new (window as any).bootstrap.Modal(modalEl);
  bsModal.show();
}

async function confirmDelete() {
  if (!selectedRow.value) return;

  try {
    await axios.delete(`${baseUrl}/api/products/${selectedRow.value.id}`);
    toast.success("Xóa sản phẩm thành công");
    fetchProducts();
  } catch (e) {
    console.error("Error deleting product:", e);
    toast.error("Xóa sản phẩm thất bại");
  } finally {
    const modalEl = document.getElementById("deleteModal")!;
    const bsModal = (window as any).bootstrap.Modal.getInstance(modalEl);
    bsModal?.hide();
    selectedRow.value = null;
  }
}

function onPageChange({ current_page, pagesize }: any) {
  params.current_page = current_page;
  params.pagesize = pagesize;
  fetchProducts();
}

function handleFileChange(e: Event) {
  const target = e.target as HTMLInputElement;
  importFile.value = target.files?.[0] || null;
}
async function importProducts() {
  if (!importFile.value) {
    toast.error('Vui lòng chọn file để import.');
    return;
  }
  const formData = new FormData();
  formData.append('file_product', importFile.value);
  loading.value = true;
  try {
    await axios.post(`${baseUrl}/api/products/import`, formData, {
      headers: { 'Content-Type': 'multipart/form-data' }
    });
    toast.success('Import thành công');
    await fetchProducts();
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

watch(searchKeyword, debounce(() => {
    params.current_page = 1;
    fetchProducts();
}, 500));

onMounted(() => {
    fetchProducts();
    const createModalEl = document.getElementById('createModal');
    if (createModalEl) {
        createModalEl.addEventListener('hidden.bs.modal', () => {
            resetForm();
        });
    }
});
</script>

<style scoped>
.table-src-form {
  width: 300px;
}
.ps-0 {
    padding-left: 0.5rem !important;
}
</style>
