<template>
    <div class="main-content-container overflow-hidden">
        <div class="main-content-container overflow-hidden">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                        <h3 class="mb-0">Thông báo</h3>

                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb align-items-center mb-0 lh-1">
                                <li class="breadcrumb-item">
                                    <a href="#" class="d-flex align-items-center text-decoration-none">
                                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                                        <span class="text-secondary fw-medium hover">Trang chủ</span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span class="fw-medium">Thông báo</span>
                                </li>
                            </ol>
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
                </div>

    </div>
</template>

<script>
import { ref, inject, onMounted } from 'vue';
import axios from 'axios';

export default {
  setup() {
    // Lấy baseUrl từ globalState
    const globalState = inject('globalState');
    const baseUrl = globalState.baseUrl;

    // Reactive state
    const notifications = ref([]);
    const searchKeyword = ref('');

    // Hàm fetch notifications
    const getNotifications = () => {
      const params = {};

      if (searchKeyword.value.trim() !== '') {
        params.search = searchKeyword.value.trim();
      }

      axios
        .get(`${baseUrl}/api/notifications`, { params })
        .then(response => {
          notifications.value = response.data.data;
        })
        .catch(error => {
          console.error('Failed to fetch notifications:', error);
        });
    };

    onMounted(() => {
      getNotifications();
    });

    return {
      notifications,
      searchKeyword,
      getNotifications
    };
  }
};
</script>

