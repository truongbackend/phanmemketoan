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
      <!-- FORM LỌC -->
      <form class="d-flex flex-wrap gap-2 align-items-end mb-4" @submit.prevent="getReceiptHistory">
        <div>
          <label class="form-label mb-1">Mã đơn hàng</label>
          <input type="text" class="form-control" placeholder="Tìm mã đơn hàng..." v-model="filters.order_code" />
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

      <!-- BẢNG DỮ LIỆU -->
      <div class="table-responsive">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>STT</th>
              <th>Mã đơn hàng</th>
              <th>Ngày đơn hàng</th>
              <th>Tổng tiền hàng</th>
              <th>Tiền thuế GTGT</th>
              <th>Tổng thanh toán</th>
              <th>Thông tin</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in receiptList" :key="index">
              <td>{{ (currentPage - 1) * perPage + index + 1 }}</td>
              <td>{{ item.order_code }}</td>
              <td class="text-secondary">{{ item.order_date }}</td>
              <td class="text-secondary">{{ formatCurrency(item.order_total_amount) }}</td>
              <td class="text-secondary">{{ formatCurrency(item.order_vat_amount) }}</td>
              <td class="text-secondary">{{ formatCurrency(item.order_paid_amount) }}</td>
              <td>
                <span
                  :class="item.order_export_receipt == 0
                          ? 'badge bg-danger bg-opacity-10 text-danger p-2 fs-12 fw-normal'
                          : 'badge bg-success bg-opacity-10 text-success p-2 fs-12 fw-normal'"
                >
                  {{ item.order_export_receipt == 0 ? 'Không xuất hóa đơn' : 'Đã xuất hóa đơn' }}
                </span>
              </td>
              <td class="text-secondary">
                <button class="btn btn-sm bg-transparent text-body" data-bs-toggle="modal" data-bs-target="#updateModal" @click="getProductID(item.id)">
                  <i class="material-symbols-outlined fs-16">edit</i>
                </button>
                <button class="btn btn-sm bg-transparent text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" @click="deleteId = item.id">
                  <i class="material-symbols-outlined fs-16">delete</i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- PHÂN TRANG -->
      <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap p-4">
        <span class="fs-13 fw-medium">Hiển thị: {{ perPage }}</span>
        <div class="d-flex align-items-center">
          <span class="fs-13 fw-medium me-2">
            {{ (currentPage - 1) * perPage + 1 }} - {{ Math.min(currentPage * perPage, totalProducts) }} of {{ totalProducts }}
          </span>
          <nav aria-label="Page navigation">
            <ul class="pagination mb-0 justify-content-center">
              <li class="page-item" :class="{ disabled: currentPage === 1 }">
                <a class="page-link icon" href="#" @click.prevent="changePage(currentPage - 1)">
                  <i class="material-symbols-outlined">keyboard_arrow_left</i>
                </a>
              </li>
              <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: page === currentPage }">
                <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
              </li>
              <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                <a class="page-link icon" href="#" @click.prevent="changePage(currentPage + 1)">
                  <i class="material-symbols-outlined">keyboard_arrow_right</i>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, inject, h, computed } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toast-notification';

export default defineComponent({
  setup() {
    const receiptList = ref([]);
    const currentPage = ref(1);
    const perPage = ref(10);
    const totalProducts = ref(0);
    const deleteId = ref(null);
    const filters = ref({
      order_code: '',
      order_export_receipt: '',
      order_date_from: '',
      order_date_to: ''
    });

    const toast = useToast();
    const globalState = inject('globalState');
    const baseUrl = globalState.baseUrl;

    const totalPages = computed(() => Math.ceil(totalProducts.value / perPage.value));

    const getReceiptHistory = () => {
      const params = {
        page: currentPage.value,
        per_page: perPage.value
      };

      if (filters.value.order_code) params.order_code = filters.value.order_code;
      if (filters.value.order_export_receipt !== '') params.order_export_receipt = filters.value.order_export_receipt;
      if (filters.value.order_date_from) params.order_date_from = filters.value.order_date_from;
      if (filters.value.order_date_to) params.order_date_to = filters.value.order_date_to;

      axios.get(`${baseUrl}/api/accounting/receipt-history/list`, { params })
        .then(res => {
          receiptList.value = res.data.data;
          totalProducts.value = res.data.total;
        })
        .catch(err => console.error(err));
    };

    const changePage = (page) => {
      if (page < 1 || page > totalPages.value) return;
      currentPage.value = page;
      getReceiptHistory();
    };

    const getProductID = (id) => {
      toast.info(`Chọn chỉnh sửa sản phẩm #${id}`);
    };

    const formatCurrency = (value) => {
      if (!value) return '0';
      return new Intl.NumberFormat('vi-VN').format(value);
    };

    getReceiptHistory();

    return {
      receiptList,
      filters,
      currentPage,
      perPage,
      totalProducts,
      totalPages,
      changePage,
      getReceiptHistory,
      getProductID,
      deleteId,
      formatCurrency
    };
  }
});
</script>


