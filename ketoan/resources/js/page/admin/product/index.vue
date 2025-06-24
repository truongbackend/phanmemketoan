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
    <div class="card bg-white border-0 rounded-3 mb-4">
      <div class="card-body p-25">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
          <form class="position-relative table-src-form me-0" @submit.prevent="fetchProducts">
            <input
              type="text"
              class="form-control border-0"
              placeholder="Tìm kiếm mã Sku, tên sản phẩm, …"
              v-model="searchKeyword"
            />
            <i class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y text-secondary">search</i>

          </form>
        </div>
         <vue3-datatable
          :rows="rows"
          :columns="cols"
          :loading="loading"
          :totalRows="totalRows"
          :isServerMode="true"
          :pageSize="params.pagesize"
          @change="onPageChange"
        >
          <template #cell(actions)="{ row }">
            <button class="btn btn-sm btn-info me-1">
              <i class="ri-eye-line"></i>
            </button>
            <button  class="btn btn-sm btn-primary me-1">
              <i class="ri-edit-line"></i>
            </button>
            <button class="btn btn-sm btn-danger">
              <i class="ri-delete-bin-6-line"></i>
            </button>
          </template>
        </vue3-datatable>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive, watch, onMounted } from 'vue';
import axios from 'axios';
import Vue3Datatable from '@bhplugin/vue3-datatable';
import '@bhplugin/vue3-datatable/dist/style.css';

const loading = ref(false);
const rows = ref<any[]>([]);
const totalRows = ref(0);
const searchKeyword = ref('');

const params = reactive({
  current_page: 1,
  pagesize: 10,
});

const cols = ref([
  { field: 'id', title: 'ID', isUnique: true, type: 'number' },
  { field: 'sku', title: 'Mã sàn' },
  { field: 'accounting_code', title: 'Mã hệ thống kế toán' },
  { field: 'product_name', title: 'Tên hàng' },
  { field: 'unit', title: 'Đơn vị' },
  { field: 'tax_rate', title: 'Thuế suất', type: 'number' },
  { field: 'actions', title: 'Thao tác', slot: true }
]);
async function fetchProducts() {
  loading.value = true;
  try {
    const response = await axios.get('/api/products', {
      params: {
        page: params.current_page,
        per_page: params.pagesize,
        search: searchKeyword.value || undefined,
      },
    });
    rows.value = response.data.data;
    totalRows.value = response.data.total;
  } catch (error) {
    console.error('Error fetching products:', error);
  } finally {
    loading.value = false;
  }
}

function onPageChange({ current_page, pagesize }: any) {
  params.current_page = current_page;
  params.pagesize = pagesize;
}

watch(
  () => [params.current_page, params.pagesize],
  () => fetchProducts()
);

onMounted(() => fetchProducts());
</script>

