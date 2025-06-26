<template>
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h3 class="mb-0">Chi tiết mục hàng hoá</h3>
    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
      <ol class="breadcrumb align-items-center mb-0 lh-1">
        <li class="breadcrumb-item">
          <router-link to="/" class="d-flex align-items-center text-decoration-none">
            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
            <span class="text-secondary fw-medium hover">Trang chủ</span>
          </router-link>
        </li>
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'admin-product' }" class="fw-medium">Hàng hóa</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <span class="fw-medium">Chi tiết</span>
        </li>
      </ol>
    </nav>
  </div>

  <div class="card bg-white border-0 rounded-3 mb-4">
    <div class="card-body p-0">
      <div class="p-4">
        <h3 class="mb-0">Chi tiết hàng hóa</h3>
      </div>
      <div class="default-table-area style-two all-projects pb-4">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <tr>
                <th>STT</th>
                <th>Mã sàn</th>
                <th>Mã hệ thống kế toán</th>
                <th>Tên sản phẩm</th>
                <th>Đơn vị tính</th>
                <th>Thuế suất (%)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ product.id }}</td>
                <td>{{ product.sku }}</td>
                <td>{{ product.accounting_code || '—' }}</td>
                <td>{{ product.product_name }}</td>
                <td>{{ product.unit || '—' }}</td>
                <td>{{ product.tax_rate }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-25">
            <vue3-datatable
            :loading="loading"
            :rows="productDetail"
            :columns="cols"
            :server-mode="false"
            :sortable="true"
            :pagination="false"
            class="table align-middle"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, inject } from 'vue';
import { useRoute }           from 'vue-router';
import axios                   from 'axios';
import { useToast }            from 'vue-toast-notification';
import Vue3Datatable           from "@bhplugin/vue3-datatable";
import "@bhplugin/vue3-datatable/dist/style.css";

const globalState: any = inject('globalState');
const baseUrl          = globalState.baseUrl || '';
const route            = useRoute();
const toast            = useToast();

const loading = ref(false);
const productDetail= ref(null);
const cols    = ref([
  { field: "combo_detail_code", title: "Mã chi tiết" },
  { field: "detail_name",        title: "Tên chi tiết combo" },
  { field: "unit",               title: "Đơn vị tính combo" },
  { field: "quantity",           title: "Số lượng", type: "number" },
]);

interface ComboDetail {
  combo_detail_code: string;
  detail_name:       string;
  unit:              string;
  quantity:          number;
}
interface Product {
  id:               number;
  sku:              string;
  accounting_code:  string;
  product_name:     string;
  unit:             string;
  tax_rate:         number;
  details:          ComboDetail[];
}

const product = ref<Partial<Product>>({});

async function fetchProduct() {
  const id = route.params.id as string;
  if (!id) {
    toast.error('Thiếu tham số sản phẩm');
    return;
  }

  loading.value = true;
  try {
    const res = await axios.get<Product>(`${baseUrl}/api/products/${id}`);
    product.value = res.data;
    productDetail.value = res.data.details || [];
  } catch (err: any) {
    toast.error(err.response?.data?.message || 'Không thể tải thông tin sản phẩm');
  } finally {
    loading.value = false;
  }
}

onMounted(fetchProduct);
</script>


<style scoped>
.table-responsive {
  margin: 0 1rem;
}
</style>
