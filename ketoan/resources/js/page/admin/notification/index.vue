<template>
<div class="main-content-container overflow-hidden">
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Thông báo</h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <button class="btn btn-outline-primary fw-medium rounded-3 hover-bg" data-bs-toggle="modal" data-bs-target="#createModal">
                    <span class="d-flex align-items-center" style="gap: 5px;">
                        <i class="ri-add-line d-none d-sm-inline-block fs-20 lh-1"></i>
                        <span>Thêm mới</span>
                    </span>
                </button>
            </nav>
        </div>

        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="default-table-area all-products">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Nội dung</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(Items, index) in notifications" :key="index">
                                    <td class="text-body">{{ index + 1 }}</td>
                                    <td class="text-body">{{ Items.created_at }}</td>
                                    <td class="text-secondary fw-medium">{{ Items.notification }}</td>
                                    <td class="text-secondary fw-medium">{{ Items.content }}</td>
                                    <td>
                                        <span class="badge bg-danger bg-opacity-10 text-danger p-2 fs-12 fw-normal">Chưa đọc</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                                <i class="material-symbols-outlined fs-16 text-primary">visibility</i>
                                            </button>
                                            <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                                <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                        <span class="fs-13 fw-medium">Items per pages: 10</span>

                        <div class="d-flex align-items-center">
                            <span class="fs-13 fw-medium me-2">1 - 10 of 12</span>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mb-0 justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link icon" href="notification.html" aria-label="Previous">
                                            <i class="material-symbols-outlined">keyboard_arrow_left</i>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link icon" href="notification.html" aria-label="Next">
                                            <i class="material-symbols-outlined">keyboard_arrow_right</i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 p-4 border-bottom">
                        <h1 class="modal-title fs-18" id="createModal">Thêm mới thông báo</h1>
                        <button type="button" class="btn-close campaigns-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form @submit.prevent="createNotification">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Tiêu đề</label>
                                        <div class="form-group position-relative">
                                            <input type="text" v-model="newNotification.notification" class="form-control text-dark h-55" placeholder="Tiêu đề thông báo">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Nội dung</label>
                                    <textarea class="form-control text-dark" v-model="newNotification.content" rows="3" placeholder="Nội dung thông báo" required></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Loại thông báo</label>
                                    <select class="form-select form-control h-55" v-model="newNotification.type" aria-label="Default select example">
                                        <option selected="">Chọn loại thông báo</option>
                                        <option value="1">Cảnh báo</option>
                                        <option value="2">Hệ thống</option>
                                    </select>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-danger text-white me-2" data-bs-dismiss="modal">
                                        Hủy
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        Tạo mới
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
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
  setup() {
    const globalState = inject('globalState');
    const baseUrl = globalState.baseUrl;

    const notifications = ref([]);
    const searchKeyword = ref('');
    const newNotification = reactive({
      title: '',
      content: '',
      type:'',
    });
    const createModal = ref(null);

    // Lấy danh sách notifications
    const getNotifications = () => {
      const params = {};
      if (searchKeyword.value.trim()) {
        params.search = searchKeyword.value.trim();
      }
      axios
        .get(`${baseUrl}/api/notifications`, { params })
        .then((res) => {
          notifications.value = res.data.data;
        })
        .catch((err) => {
          console.error('Fetch notifications failed:', err);
        });
    };

    const createNotification = () => {
      axios
        .post(`${baseUrl}/api/notifications`, {
          notification: newNotification.notification,
          content: newNotification.content,
          	type: newNotification.	type,
        })
        .then((createRes) => {
            getNotifications();
          const id = createRes.data.data.id;

          return axios.post(`${baseUrl}/api/notifications/broadcast`, {
            notification_id: id,
          });
        })
        .then(() => {
          // Đóng modal
          const modalInstance = Modal.getInstance(createModal.value);
          modalInstance.hide();
          // Reset form
          newNotification.title = '';
          newNotification.content = '';
          newNotification.notification = '';
          // Reload bảng
          getNotifications();
        })
        .catch((err) => {
          console.error('Tạo hoặc gửi broadcast thất bại:', err);
        });
    };

    onMounted(() => {
      getNotifications();
      createModal.value = document.getElementById('createModal');
    });

    return {
      notifications,
      searchKeyword,
      newNotification,
      createModal,
      getNotifications,
      createNotification,
    };
  },
};
</script>
