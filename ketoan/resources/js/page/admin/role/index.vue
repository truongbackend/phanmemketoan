<template>
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h4>Quản lý Role & Permissions</h4>
      <button class="btn btn-primary" @click="openModal()">Thêm Role</button>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>STT</th>
          <th>Role</th>
          <th>Ghi chú</th>
          <th>Trạng thái</th>
          <th>Permissions</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(role, i) in roles" :key="role.id">
          <td>{{ i+1 }}</td>
          <td>{{ role.name }}</td>
          <td>{{ role.note || '—' }}</td>
          <td>
            <span class="badge" :class="role.status ? 'bg-success' : 'bg-secondary'">
              {{ role.status ? 'Hoạt động' : 'Ẩn' }}
            </span>
          </td>
          <td>
            <span class="badge bg-info me-1" v-for="p in role.permissions" :key="p.id">{{ p.name }}</span>
          </td>
          <td>
            <button class="btn btn-sm btn-info me-1" @click="openModal(role)">Sửa</button>
            <button class="btn btn-sm btn-danger" @click="deleteRole(role.id)">Xóa</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modal Thêm/Sửa -->
    <div class="modal fade" id="roleModal" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <form class="modal-content" @submit.prevent="submitRole">
          <div class="modal-header">
            <h5 class="modal-title">{{ form.id ? 'Cập nhật Role' : 'Thêm Role' }}</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Tên Role</label>
              <input v-model="form.name" class="form-control" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Ghi chú</label>
              <textarea v-model="form.note" class="form-control" rows="2"></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Trạng thái</label>
              <select v-model="form.status" class="form-select">
                <option :value="1">Hoạt động</option>
                <option :value="0">Ẩn</option>
              </select>
            </div>
            <h3 class="mb-3 mb-lg-4">Danh sách chức năng</h3>
            <div class="mb-3">
            <div class="row">
                <div class="col-4">
                    <label class="form-label"><span class="fs-14 fw-medium">Chức năng</span>
                    </label>
                </div>
                 <div class="col-2">
                    <label class="form-label"><span class="fs-14 fw-medium">Danh sách</span>
                    </label>
                </div>
                <div class="col-2">
                    <label class="form-label"><span class="fs-14 fw-medium">Thêm</span>
                    </label>
                </div>
                <div class="col-2">
                    <label class="form-label"><span class="fs-14 fw-medium">Sửa</span>
                    </label>
                </div>
                <div class="col-2">
                    <label class="form-label"><span class="fs-14 fw-medium">Xóa</span>
                    </label>
                </div>
            </div>
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="col-2" v-for="perm in permissions" :key="perm.id">
                  <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           :id="'perm-'+perm.id"
                           :value="perm.id"
                           v-model="form.permissions" />
                    <label class="form-check-label" :for="'perm-'+perm.id">
                      {{ perm.name }}
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button class="btn btn-primary" type="submit">
              {{ form.id ? 'Cập nhật' : 'Thêm mới' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toast-notification';

const toast = useToast();
const roles = ref([]);
const permissions = ref([]);
const form = ref({
  id: null,
  name: '',
  note: '',
  status: 1,
  permissions: []
});

// Load roles + permissions
const loadAll = async () => {
  const [rRes, pRes] = await Promise.all([
    axios.get('/api/roles'),
    axios.get('/api/permissions')
  ]);
  roles.value = rRes.data;
  permissions.value = pRes.data;
};

// Mở modal, nếu có role thì nạp dữ liệu
const openModal = (role=null) => {
  if (role) {
    form.value = {
      id: role.id,
      name: role.name,
      note: role.note,
      status: role.status,
      permissions: role.permissions.map(p => p.id)
    };
  } else {
    form.value = { id: null, name:'', note:'', status:1, permissions: [] };
  }
  new bootstrap.Modal(document.getElementById('roleModal')).show();
};

// Gửi tạo hoặc cập nhật
const submitRole = async () => {
  try {
    if (form.value.id) {
      await axios.put(`/api/roles/${form.value.id}`, form.value);
      toast.success('Cập nhật thành công');
    } else {
      await axios.post('/api/roles', form.value);
      toast.success('Tạo mới thành công');
    }
    await loadAll();
    bootstrap.Modal.getInstance(document.getElementById('roleModal')).hide();
  } catch (err) {
    toast.error(err.response?.data?.message || 'Lỗi xử lý');
  }
};

// Xóa role
const deleteRole = async (id) => {
  if (!confirm('Xác nhận xóa role này?')) return;
  await axios.delete(`/api/roles/${id}`);
  toast.success('Xóa thành công');
  await loadAll();
};

onMounted(loadAll);
</script>
