<template>
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Thông báo</h3>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <button class="btn btn-outline-primary fw-medium rounded-3 hover-bg" data-bs-toggle="modal"
                    data-bs-target="#createModal" v-if="hasPermission('complaints.create')">
                    <span class="d-flex align-items-center" style="gap:5px">
                        <span class="py-sm-1 d-block">
                        <i class="ri-add-line d-none d-sm-inline-block"></i>
                            <span>Thêm mới thông báo</span>
                        </span>
                    </span>
                </button>
            </nav>
        </div>
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="table-responsive default-table-area all-products">
                    <div class="table-responsive">

                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ngày</th>
                                    <th>Loại</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, idx) in notifications" :key="item.id || idx">
                                    <td>{{ idx + 1 }}</td>
                                    <td @click="toggleRead(item)">{{ formatDate(item.created_at) }}</td>
                                    <td @click="toggleRead(item)" class="text-secondary fw-medium">
                                        {{ item.type === '1' ? 'Cảnh báo' : 'Hệ thống' }}
                                    </td>
                                    <td @click="toggleRead(item)" class="text-secondary fs-14 fw-medium text-primary" style="width:300px;">{{ item.title }}</td>
                                    <td @click="toggleRead(item)" class="text-secondary fs-14 fw-medium text-primary" style="width:300px;">{{ item.content }}</td>
                                    <td>
                                        <span class="badge" :class="item.pivot.read_at
                                            ? 'bg-success bg-opacity-10 text-success'
                                            : 'bg-danger bg-opacity-10 text-danger'">
                                            {{ item.pivot.read_at ? 'Đã đọc' : 'Chưa đọc' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <button v-if="hasPermission('complaints.edit')" class="btn btn-sm btn-link p-0" @click="toggleRead(item)"
                                                :title="item.pivot.read_at ? 'Đánh dấu chưa đọc' : 'Đánh dấu đã đọc'">
                                                <i class="material-symbols-outlined fs-16"
                                                    :class="item.pivot.read_at ? 'text-secondary' : 'text-primary'">visibility</i>
                                            </button>
                                            <button v-if="hasPermission('complaints.delete')" class="btn btn-sm btn-link p-0" @click="openDeleteModal(item.id)"
                                                title="Xóa">
                                                <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="notifications.length === 0">
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Chưa có thông báo
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav v-if="pagination.total > pagination.per_page" class="d-flex justify-content-end mt-3">
                            <ul class="pagination mb-0">
                                <li class="page-item" :class="{ disabled: pagination.current_page === 1 }">
                                    <a class="page-link" href="#"
                                        @click.prevent="getNotifications(pagination.current_page - 1)">Trước</a>
                                </li>
                                <li v-for="page in pagination.last_page" :key="page" class="page-item"
                                    :class="{ active: page === pagination.current_page }">
                                    <a class="page-link" href="#" @click.prevent="getNotifications(page)">{{ page }}</a>
                                </li>
                                <li class="page-item"
                                    :class="{ disabled: pagination.current_page === pagination.last_page }">
                                    <a class="page-link" href="#"
                                        @click.prevent="getNotifications(pagination.current_page + 1)">Sau</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width:550px">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title fs-18" id="createModalLabel">Thêm mới thông báo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form @submit.prevent="createNotification">
                            <div class="mb-4">
                                <label class="form-label text-secondary">Tiêu đề</label>
                                <input v-model="newNotification.title" type="text" class="form-control h-55"
                                    placeholder="Tiêu đề thông báo" required />
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-secondary">Nội dung</label>
                                <textarea v-model="newNotification.content" class="form-control" rows="3"
                                    placeholder="Nội dung thông báo" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-secondary">Loại thông báo</label>
                                <select v-model="newNotification.type" class="form-select form-control h-55" required>
                                    <option disabled value="">Chọn loại thông báo</option>
                                    <option value="1">Cảnh báo</option>
                                    <option value="2">Hệ thống</option>
                                </select>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Tạo mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width:550px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Xóa thông báo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Bạn có chắc chắn muốn xóa thông báo này?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" @click="confirmDelete">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, inject, onMounted, reactive } from 'vue';
import axios from 'axios';

export default {
    name: 'NotificationPage',
    setup() {
        const { baseUrl } = inject('globalState');
        const notifications = ref([]);
        const pagination = ref({
            current_page: 1,
            last_page: 1,
            total: 0,
            per_page: 10,
        });
        const newNotification = reactive({ title: '', content: '', type: '' });
        const notificationToDelete = ref(null);
        const createModalEl = ref(null);
        const deleteModalEl = ref(null);
        let createModalInstance;
        let deleteModalInstance;

        const getNotifications = (page = 1) => {
            axios
                .get(`${baseUrl}/api/notifications`, {
                    params: {
                        per_page: pagination.value.per_page,
                        page,
                    },
                })
                .then(res => {
                    notifications.value = res.data.data;
                    pagination.value = {
                        current_page: res.data.current_page,
                        last_page: res.data.last_page,
                        total: res.data.total,
                        per_page: res.data.per_page,
                    };
                })
                .catch(err => console.error('Fetch failed:', err));
        };

        const createNotification = () => {
        axios
            .post(`${baseUrl}/api/notifications`, { ...newNotification })
            .then(res => {
            const id = res.data.data.id;
            return axios.post(`${baseUrl}/api/notifications/${id}/broadcast`);
            })
            .then(() => {
            createModalInstance.hide();
            Object.assign(newNotification, { title: '', content: '', type: '' });
            getNotifications(pagination.value.current_page);
            })
            .catch(err => console.error('Create/broadcast failed:', err));
        };


        const toggleRead = item => {
            const url = item.pivot.read_at
                ? `${baseUrl}/api/notifications/${item.id}/mark-unread`
                : `${baseUrl}/api/notifications/${item.id}/mark-read`;
            axios
                .post(url)
                .then(() => {
                    item.pivot.read_at = item.pivot.read_at ? null : new Date().toISOString();
                })
                .catch(err => console.error('Toggle read failed:', err));
        };

        const openDeleteModal = id => {
            notificationToDelete.value = id;
            deleteModalInstance = window.bootstrap.Modal.getOrCreateInstance(deleteModalEl.value);
            deleteModalInstance.show();
        };

        const confirmDelete = () => {
            axios
                .delete(`${baseUrl}/api/notifications/${notificationToDelete.value}`)
                .then(() => {
                    deleteModalInstance.hide();
                    getNotifications(pagination.value.current_page);
                })
                .catch(err => console.error('Delete failed:', err));
        };

        const formatDate = datetime => {
            const d = new Date(datetime);
            const dd = String(d.getDate()).padStart(2, '0');
            const mm = String(d.getMonth() + 1).padStart(2, '0');
            const yyyy = d.getFullYear();
            const hh = String(d.getHours()).padStart(2, '0');
            const mi = String(d.getMinutes()).padStart(2, '0');
            return `${dd}/${mm}/${yyyy} ${hh}:${mi}`;
        };

        onMounted(() => {
            getNotifications();
            createModalEl.value = document.getElementById('createModal');
            deleteModalEl.value = document.getElementById('deleteModal');
            createModalInstance = window.bootstrap.Modal.getOrCreateInstance(createModalEl.value);
            deleteModalInstance = window.bootstrap.Modal.getOrCreateInstance(deleteModalEl.value);
        });

        return {
            notifications,
            pagination,
            newNotification,
            notificationToDelete,
            getNotifications,
            createNotification,
            toggleRead,
            openDeleteModal,
            confirmDelete,
            formatDate,
        };
    },
};
</script>
