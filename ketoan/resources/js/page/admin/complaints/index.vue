<template>
    <div>
        <div
            class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4"
        >
            <h3 class="mb-0">Quản lý Khiếu nại</h3>
            <button
                class="btn btn-outline-primary"
                data-bs-toggle="modal"
                data-bs-target="#createModal"
                v-if="hasPermission('complaints.create')"
            >
            <span class="py-sm-1 d-block">
                    <i class="ri-add-line d-none d-sm-inline-block"></i>
                        <span>Thêm mới khiếu nại</span>
            </span>
            </button>
        </div>
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-25 default-table-area all-products px-20">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Người gửi</th>
                                <th scope="col">Mã đơn</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(c, i) in complaints" :key="c.id">
                                <td class="text-secondary">
                                    {{
                                        (pagination.current_page - 1) *
                                            pagination.per_page +
                                        i +
                                        1
                                    }}
                                </td>
                                <td class="text-secondary">{{ formatDate(c.created_at) }}</td>
                                <td class="text-secondary">{{ c.user.name }}</td>
                                <td class="text-secondary"> <p style="max-width: 300px;">{{ c.order_code || "-" }}</p></td>
                                <td class="text-secondary"><p style="max-width: 300px;">{{ c.content }}</p></td>
                                <td>
                                    <span
                                        class="badge"
                                        :class="{
                                            'bg-info bg-opacity-10 text-info':
                                                c.status === 'new',
                                            'bg-warning bg-opacity-10 text-warning':
                                                c.status === 'in_review',
                                            'bg-success bg-opacity-10 text-success':
                                                c.status === 'resolved',
                                        }"
                                    >
                                        {{statusText( c.status )}}
                                    </span>
                                </td>
                                <td>
                                    <button
                                        class="ps-0 border-0 bg-transparent lh-1 position-relative top-2"
                                        @click="openEditModal(c)" v-if="hasPermission('complaints.edit')"
                                    >
                                        <i class="material-symbols-outlined fs-16 text-body">edit</i>
                                    </button>
                                    <button
                                        class="ps-0 border-0 bg-transparent lh-1 position-relative top-2"
                                        @click="openDeleteModal(c.id)" v-if="hasPermission('complaints.delete')"
                                    >
                                        <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <nav
  v-if="pagination.last_page > 1"
  class="d-flex justify-content-end mt-3"
>
  <ul class="pagination mb-0">
    <li
      class="page-item"
      :class="{ disabled: pagination.current_page === 1 }"
    >
      <a
        class="page-link"
        href="#"
        @click.prevent="getNotifications(pagination.current_page - 1)"
      >
        Trước
      </a>
    </li>
    <li
      v-for="pageNum in pagination.last_page"
      :key="pageNum"
      class="page-item"
      :class="{ active: pageNum === pagination.current_page }"
    >
      <a
        class="page-link"
        href="#"
        @click.prevent="getNotifications(pageNum)"
      >
        {{ pageNum }}
      </a>
    </li>
    <li
      class="page-item"
      :class="{ disabled: pagination.current_page === pagination.last_page }"
    >
      <a
        class="page-link"
        href="#"
        @click.prevent="getNotifications(pagination.current_page + 1)"
      >
        Sau
      </a>
    </li>
  </ul>
</nav>

            </div>
        </div>

        <div class="modal fade" id="createModal" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" @submit.prevent="createComplaint">
                    <div class="modal-header">
                        <h5 class="modal-title">Tạo khiếu nại</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-secondary">Mã đơn hàng</label>
                            <input
                                v-model="newComplaint.order_code"
                                type="text"
                                class="form-control"
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary">Nội dung</label>
                            <textarea
                                v-model="newComplaint.content"
                                class="form-control"
                                rows="4"
                                required
                            ></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white"
                            data-bs-dismiss="modal"
                        >
                            Huỷ
                        </button>
                        <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                           <i class="ri-save-line text-white fw-medium"></i> Gửi
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1">
            <div class="modal-dialog" style="max-width: 550px;">
                <form class="modal-content" @submit.prevent="updateComplaint">
                    <div class="modal-header">
                        <h5 class="modal-title">Cập nhật khiếu nại</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-secondary">Nội dung</label>
                            <textarea
                                v-model="editComplaint.content"
                                class="form-control"
                                rows="4"
                            ></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary">Trạng thái</label>
                            <select
                                v-model="editComplaint.status"
                                class="form-select form-control"
                            >
                                <option value="new">Tạo mới</option>
                                <option value="in_review">Đang được xem xét</option>
                                <option value="resolved">Đã giải quyết</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white"
                            data-bs-dismiss="modal"
                        >
                            Huỷ
                        </button>
                        <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                        <i class="ri-save-line text-white fw-medium"></i>
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận xoá</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc muốn xoá khiếu nại này?
                    </div>
                    <div class="modal-footer">
                        <button
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Huỷ
                        </button>
                        <button class="btn btn-danger" @click="deleteComplaint">
                            Xoá
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import axios from "axios";
import { useToast } from "vue-toast-notification";

export default defineComponent({
    setup() {
        const complaints = ref([]);
        const pagination = ref({
            total: 0,
            per_page: 10,
            current_page: 1,
            last_page: 1,
        });
        const newComplaint = ref({ order_code: "", content: "" });
        const editComplaint = ref({ id: null, content: "", status: "new" });
        const deleteId = ref(null);
        const toast = useToast();
        const getNotifications = async (page = 1) => {
        if (page < 1 || page > pagination.value.last_page) return;

        try {
            const res = await axios.get("/api/complaints", {
            params: { per_page: pagination.value.per_page, page }
            });
            complaints.value = res.data.data;
            pagination.value = {
            total:        res.data.total,
            per_page:     res.data.per_page,
            current_page: res.data.current_page,
            last_page:    res.data.last_page
            };
        } catch {
            toast.error("Không tải được dữ liệu");
        }
        };


        const createComplaint = async () => {
            try {
                await axios.post("/api/complaints", newComplaint.value);
                toast.success("Tạo thành công");
                getNotifications();
                const modal = bootstrap.Modal.getInstance(
                    document.getElementById("createModal")
                );
                modal.hide();
                newComplaint.value = { order_code: "", content: "" };
            } catch {
                toast.error("Tạo thất bại");
            }
        };

        const openEditModal = (c) => {
            editComplaint.value = {
                id: c.id,
                content: c.content,
                status: c.status,
            };
            // Dùng getOrCreateInstance để chắc chắn có modal instance
            const editModal = bootstrap.Modal.getOrCreateInstance(
                document.getElementById("editModal")
            );
            editModal.show();
        };
        const updateComplaint = async () => {
            try {
                const { id, content, status } = editComplaint.value;
                await axios.patch(`/api/complaints/${id}`, { content, status });
                toast.success("Cập nhật thành công");
                getNotifications();
                // Lấy modal instance rồi hide
                const editModal = bootstrap.Modal.getInstance(
                    document.getElementById("editModal")
                );
                if (editModal) editModal.hide();
            } catch {
                toast.error("Cập nhật thất bại");
            }
        };

        const openDeleteModal = (id) => {
            deleteId.value = id;
            new bootstrap.Modal(document.getElementById("deleteModal")).show();
        };

        const deleteComplaint = async () => {
            try {
                await axios.delete(`/api/complaints/${deleteId.value}`);
                toast.success("Xoá thành công");
                getNotifications();
                const el = document.getElementById("deleteModal");
                const deleteModal = bootstrap.Modal.getInstance(el);
                if (deleteModal) {
                    deleteModal.hide();
                }
            } catch {
                toast.error("Xoá thất bại");
            }
        };

        const pad = (n) => n.toString().padStart(2, "0");
        const formatDate = (iso) => {
            const d = new Date(iso);
            return (
                [d.getFullYear(), pad(d.getMonth() + 1), pad(d.getDate())].join(
                    "-"
                ) +
                " " +
                [pad(d.getHours()), pad(d.getMinutes())].join(":")
            );
        };
        const statusText = status => {
        switch (status) {
            case 'new':        return 'Mới khởi tạo';
            case 'in_review':  return 'Đang xem xét';
            case 'resolved':   return 'Đã giải quyết';
            default:           return status;
        }
        };

        onMounted(() => getNotifications());

        return {
            complaints,
            pagination,
            newComplaint,
            editComplaint,
            deleteId,
            getNotifications,
            createComplaint,
            openEditModal,
            updateComplaint,
            openDeleteModal,
            deleteComplaint,
            formatDate,
            statusText
        };
    },
});
</script>

<style scoped>
.table > tbody > tr > td,
.table > thead > tr > th {
    vertical-align: middle;
}
</style>
