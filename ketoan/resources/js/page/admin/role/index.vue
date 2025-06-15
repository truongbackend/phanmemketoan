<template>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <h3 class="mb-0">Quản lý nhóm quyền</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Trang chủ</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Quản lý nhóm quyền</span>
                </li>
            </ol>
        </nav>
    </div>
    <div class="card bg-white border-0 rounded-3 mb-3">
        <div class="card-body p-25">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <form class="position-relative table-src-form me-0">
                    <input type="text" class="form-control border-0" placeholder="Tìm kiếm gói...." />
                    <i
                        class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y text-secondary">search</i>
                </form>
                <button @click="openModal()"  class="btn btn-outline-primary fw-medium rounded-3 hover-bg" v-if="hasPermission('role.create')">
                    <span class="d-flex align-items-center" style="gap: 5px;">
                        <i class="ri-add-line d-none d-sm-inline-block fs-20 lh-1"></i>
                        <span>Thêm mới</span>
                    </span>
                </button>
            </div>
            <div class="default-table-area recent-orders">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">
                                    STT
                                </th>
                                <th scope="col">
                                    Nhóm quyền
                                </th>
                                <th scope="col">
                                    Ghi chú
                                </th>
                                <th scope="col">
                                    Trạng thái
                                </th>
                                <th scope="col">
                                    Ghi chú
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(role, i) in roles" :key="role.id">
                                <td>{{ i + 1 }}</td>
                                <td class="text-secondary">{{ role.name }}</td>
                                <td class="text-secondary">{{ role.note || '—' }}</td>
                                <td class="text-secondary">
                                    <span class="badge" :class="role.status ? 'bg-success' : 'bg-secondary'">
                                        {{ role.status ? 'Hoạt động' : 'Ẩn' }}
                                    </span>
                                </td>

                                <td class="text-secondary">
                                    <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" v-if="hasPermission('role.edit')"
                                        @click="openModal(role)">
                                        <i class="material-symbols-outlined fs-16 text-body">edit</i>
                                    </button>

                                    <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" v-if="hasPermission('role.list')"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        @click="deleteId = role.id">
                                        <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " style="max-width: 1120px;">
            <div class="modal-content p-4 p-md-5 bg-white">
                <div class="modal-header p-0 border-0">
                    <h3 class="mb-0">{{ form.id ? 'Cập nhật nhóm quyền' : 'Thêm nhóm quyền' }}</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 pt-4">
                    <form @submit.prevent="submitRole">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="label text-secondary">Thêm nhóm quyền</label>
                                    <input v-model="form.name" type="text" class="form-control h-55"
                                        placeholder="Thêm nhóm quyền" required />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="label text-secondary">Ghi chú</label>
                                    <input type="text" v-model="form.note" class="form-control h-55"
                                        placeholder="Ghi chú">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="label text-secondary">Trạng thái</label>
                                    <select class="form-control h-55" v-model="form.status">
                                        <option :value="1">Hoạt động</option>
                                        <option :value="0">Ẩn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input v-model="form.default_role"
       type="checkbox"
       class="form-check-input"
       :true-value="1"
       :false-value="0">

                                        <label class="form-check-label">Đặt làm mặc định</label>
                                    </div>
                                </div>
                            </div>
                            <h3 class="mb-3">Phân quyền chức năng</h3>
                            <div class="default-table-area recent-orders">
                                <div class="table-responsive ">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    Nhóm quyền
                                                </th>
                                                <th scope="col">
                                                    Danh sách
                                                </th>
                                                <th scope="col">
                                                    Thêm
                                                </th>
                                                <th scope="col">
                                                    Sửa
                                                </th>
                                                <th scope="col">
                                                    Xoá
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="perm in permissions" :key="perm.id">
                                                <td>{{ moduleLabel(perm.module) }}</td>
                                                <td class="text-dark">
                                                    <div class="form-check me-4">
                                                        <input class="form-check-input wh-20" type="checkbox"
                                                            v-model="form.permissions"
                                                            :value="perm.actions.find(a => a.key === 'list')?.id" />
                                                    </div>
                                                </td>
                                                <td class="text-dark">
                                                    <div class="form-check me-4">
                                                        <input class="form-check-input wh-20" type="checkbox"
                                                            v-model="form.permissions"
                                                            :value="perm.actions.find(a => a.key === 'create')?.id" />
                                                    </div>
                                                </td>
                                                <td class="text-dark">
                                                    <div class="form-check me-4">
                                                        <input class="form-check-input wh-20" type="checkbox"
                                                            v-model="form.permissions"
                                                            :value="perm.actions.find(a => a.key === 'edit')?.id" />
                                                    </div>
                                                </td>
                                                <td class="text-dark">
                                                    <div class="form-check me-4">
                                                        <input class="form-check-input wh-20" type="checkbox"
                                                            v-model="form.permissions"
                                                            :value="perm.actions.find(a => a.key === 'delete')?.id" />
                                                    </div>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 p-0 gap-2 mt-3">
                    <button type="button" class="btn btn-danger text-white px-3 m-0"
                        data-bs-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary hover-bg px-3 m-0" @click="submitRole">
                        <i class="ri-add-line"></i>
                        <span>{{ form.id ? 'Cập nhật' : 'Thêm mới' }}</span>
                    </button>


                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModal">Xác nhận xoá</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xoá mục này? Hành động này không thể hoàn tác.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-danger text-white" @click="deleteRole">Xoá</button>
                </div>
                </div>
            </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toast-notification';
import {
    inject
} from 'vue';

const toast = useToast();
const roles = ref([]);
const permissions = ref([]);
const deleteId = ref(null);
const default_role = ref(false);
const form = ref({
    id: null,
    name: '',
    note: '',
    status: 1,
    default_role: 0,
    permissions: []
});
const globalState = inject('globalState');
const baseUrl = globalState.baseUrl;
let modalInstance = null;
const loadAll = async () => {
    const [rRes, pRes] = await Promise.all([
        axios.get(`${baseUrl}/api/roles`),
        axios.get(`${baseUrl}/api/permissions`)
    ]);
    roles.value = rRes.data;
    default_role.value = roles.default_role == 1;
    permissions.value = pRes.data;
};

const openModal = (role = null) => {
    if (role) {
        form.value = {
            id: role.id,
            name: role.name,
            note: role.note,
            status: role.status,
            default_role: role.default_role,
            permissions: role.permissions.map(p => p.id)
        };
    } else {
        form.value = { id: null, name: '', note: '', status: 1, permissions: [] };
    }
    if (!modalInstance) {
        modalInstance = new bootstrap.Modal(document.getElementById('roleModal'));
    }
    modalInstance.show();
};
const submitRole = async () => {
    try {
        if (form.value.id) {
            await axios.put(`${baseUrl}/api/roles/${form.value.id}`, form.value);
            toast.success('Cập nhật thành công');
        } else {
            await axios.post('/api/roles', form.value);
            toast.success('Tạo mới thành công');
        }
        await loadAll();
        if (modalInstance) modalInstance.hide();
    } catch (err) {
        toast.error(err.response?.data?.message || 'Lỗi xử lý');
    }
};

const deleteRole = async () => {
    if (!deleteId.value) return;
    try {
        await axios.delete(`${baseUrl}/api/roles/${deleteId.value}`);
        toast.success('Xóa thành công');
        await loadAll();
        deleteId.value = null;
        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
        if (modal) modal.hide();
    } catch (err) {
        toast.error(err.response?.data?.message || 'Lỗi khi xoá');
    }
};
const moduleLabel = (moduleKey) => {
    const map = {
        user: 'Người dùng',
        role: 'Nhóm quyền',
        permission: 'Chức năng',
        product: 'Hàng hoá',
        report: 'Báo cáo',
        notification: 'Thông báo',
        package: 'Gói dịch vụ',
        complaints: 'Khiếu nại',
    };
    return map[moduleKey] || moduleKey;
};

onMounted(loadAll);
</script>
