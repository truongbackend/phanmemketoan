<template>
    <div class="main-content-container overflow-hidden">
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Kế toán</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb align-items-center mb-0 lh-1">
            <li class="breadcrumb-item">
              <a href="#" class="d-flex align-items-center text-decoration-none">
                <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                <span class="text-secondary fw-medium hover">Trang chủ</span>
              </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              <span class="fw-medium">Kế toán</span>
            </li>
          </ol>
        </nav>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
              <h4 class="fs-18 mb-4">Kê toán</h4>
              <div class="tab-content">
                <!-- Add your content here (form, tables, etc.) -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    name: "MainContent",
  };
  </script>

  <style scoped>
  /* Các style tùy chỉnh cho Main Content */
  </style>
