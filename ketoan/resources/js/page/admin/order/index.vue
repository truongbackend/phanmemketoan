<template>
  <div>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
      <h3 class="mb-0">Đơn hàng</h3>
      <button
        class="btn btn-outline-primary fw-medium rounded-3 hover-bg"
        data-bs-toggle="modal"
        data-bs-target="#createOrderModal"
      >
        <span class="d-flex align-items-center" style="gap: 5px;">
          <i class="ri-add-line d-none d-sm-inline-block fs-20 lh-1"></i>
          <span>Tạo đơn hàng</span>
        </span>
      </button>
    </div>

    <div class="card bg-white border-0 rounded-3 mb-4">
      <div class="card-body p-25">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
          <form class="position-relative table-src-form me-0">
            <input
              type="text"
              class="form-control border-0"
              placeholder="Tìm kiếm khách hàng..."
              v-model="searchKeyword"
            />
            <i class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y text-secondary">search</i>
          </form>
        </div>

        <div class="default-table-area all-products px-20">
          <div class="table-responsive">
            <table class="table align-middle">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên khách hàng</th>
                  <th>Email</th>
                  <th>Số điện thoại</th>
                  <th>Gói dịch vụ</th>
                  <th>Số tiền</th>
                  <th>Thời gian</th>
                  <th>Trạng thái</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in orders" :key="item.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ item.customer_name }}</td>
                  <td>{{ item.email }}</td>
                  <td class="text-secondary">{{ item.phone }}</td>
                  <td class="text-secondary">{{ item.package ? item.package.name : 'Không có gói' }}</td>
                  <td class="text-secondary">{{ formatPrice(item.total_amount) }} đ</td>
                  <td class="text-secondary">{{ formatDate(item.created_at) }}</td>
                  <td class="text-secondary">
                    <span
                      v-if="Number(item.status) === 1"
                      class="badge bg-success bg-opacity-10 text-success fw-normal"
                      >Hoạt động</span
                    >
                    <span
                      v-else
                      class="badge bg-danger bg-opacity-10 text-danger fw-normal"
                      >Ngưng hoạt động</span
                    >
                  </td>
                </tr>
                <tr v-if="orders.length === 0">
                  <td colspan="8" class="text-center text-muted">Không có đơn hàng nào.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal tạo đơn hàng -->
    <div class="modal fade" id="createOrderModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;">
        <div class="modal-content rounded-0">
          <div class="modal-header border-0 p-4 border-bottom">
            <h1 class="modal-title fs-18">Tạo đơn hàng</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body p-4">
            <form @submit.prevent="createOrder">
              <div v-if="users.length > 0" class="mb-3">
                <label class="form-label">Chọn người dùng</label>
                <select v-model="orderForm.user_id" class="form-select" required>
                  <option disabled value="">Chọn người dùng</option>
                  <option v-for="u in users" :key="u.id" :value="u.id">{{ u.name }} ({{ u.email }})</option>
                </select>
              </div>

              <div v-else>
                <div class="mb-3">
                  <label class="form-label">Tên người dùng</label>
                  <input type="text" class="form-control bg-light" :value="currentUser.name" readonly />
                </div>
                <div class="mb-3">
                  <label class="form-label">Email người dùng</label>
                  <input type="text" class="form-control bg-light" :value="currentUser.email" readonly />
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input v-model="orderForm.phone" type="text" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input v-model="orderForm.address" type="text" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Gói dịch vụ</label>
                <select v-model="orderForm.package_id" class="form-select" required>
                  <option disabled value="">Chọn gói dịch vụ</option>
                  <option v-for="pkg in packages" :key="pkg.id" :value="pkg.id">{{ pkg.name }}</option>
                </select>
                <div v-if="selectedPackage" class="mt-2 text-primary fw-medium">
                  Giá gói: {{ formatPrice(selectedPackage.price) }} đ
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Số tiền</label>
                <input v-model="orderForm.total_amount" type="number" min="0" class="form-control" required />
              </div>
              <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="submit" class="btn btn-primary">Tạo mới</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, watch, onMounted, computed } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toast-notification';
import { inject } from 'vue';

export default defineComponent({
  setup() {
    const orders = ref([]);
    const packages = ref([]);
    const users = ref([]);
    const currentUser = ref({});
    const searchKeyword = ref('');
    const orderForm = ref({
      user_id: '',
      phone: '',
      address: '',
      package_id: '',
      total_amount: '',
    });

    const toast = useToast();
    const globalState = inject('globalState');
    const baseUrl = globalState.baseUrl;

    const selectedPackage = computed(() => {
      return packages.value.find(pkg => pkg.id === orderForm.value.package_id) || null;
    });

    const formatPrice = (value) => {
      if (!value) return '0';
      const cleaned = value.toString().replace(/[^\d]/g, '');
      return cleaned.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    };

    const formatDate = (value) => {
      if (!value) return '';
      const date = new Date(value);
      const day = String(date.getDate()).padStart(2, '0');
      const month = String(date.getMonth() + 1).padStart(2, '0');
      const year = date.getFullYear();
      const hours = String(date.getHours()).padStart(2, '0');
      const minutes = String(date.getMinutes()).padStart(2, '0');
      return `${day}/${month}/${year} ${hours}:${minutes}`;
    };

    const getOrders = () => {
      const params = {};
      if (searchKeyword.value.trim() !== '') {
        params.search = searchKeyword.value.trim();
      }
      axios
        .get(`${baseUrl}/api/orders`, { params })
        .then((response) => {
          orders.value = response.data;
        })
        .catch((error) => {
          console.error('Lỗi khi lấy danh sách đơn hàng:', error);
        });
    };

    const getPackages = () => {
      axios
        .get(`${baseUrl}/api/packages`)
        .then((res) => (packages.value = res.data))
        .catch((err) => console.error('Lỗi lấy packages:', err));
    };

    const getAllUsers = () => {
      axios.get(`${baseUrl}/api/users`) // cần API trả user đang hoạt động
        .then(res => users.value = res.data)
        .catch(err => console.error('Lỗi lấy users:', err));
    };

    const getCurrentUser = () => {
       const userData = JSON.parse(localStorage.getItem("user"));
      console.log(userData);
      currentUser.value = userData || {};
    };

    const createOrder = () => {
      axios
        .post(`${baseUrl}/api/orders`, orderForm.value)
        .then(() => {
          toast.success('Đơn hàng được tạo thành công');
          getOrders();
          const modal = bootstrap.Modal.getInstance(document.getElementById('createOrderModal'));
          modal.hide();
          orderForm.value = { user_id: '', phone: '', address: '', package_id: '', total_amount: '' };
        })
        .catch((error) => {
          console.error('Lỗi tạo đơn hàng:', error);
          toast.error('Tạo đơn hàng thất bại');
        });
    };

    watch(() => orderForm.value.package_id, (newId) => {
      const pkg = packages.value.find(p => p.id === newId);
      if (pkg) {
        orderForm.value.total_amount = pkg.price;
      } else {
        orderForm.value.total_amount = '';
      }
    });

    watch(searchKeyword, () => getOrders());

    onMounted(() => {
      getOrders();
      getPackages();

     
    });

    return {
      searchKeyword,
      orders,
      formatPrice,
      formatDate,
      packages,
      orderForm,
      createOrder,
      users,
      currentUser,
      selectedPackage,
    };
  },
});
</script>
