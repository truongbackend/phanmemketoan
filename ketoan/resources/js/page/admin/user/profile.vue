<template>
    <div>
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card bg-primary border-0 rounded-3 welcome-box style-two mb-4 position-relative">
            <div class="card-body py-38 px-4">
              <div class="mb-2">
                <h3 class="text-white fw-semibold">Xin chào, <span class="text-danger-div">{{ userName }} !</span></h3>
                <p class="text-light">Đã gia hạn gói dịch vụ vào ngày {{ formattedDate }}.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xxl-4">
          <div class="row">
            <div class="col-xxl-12 col-md-6 col-lg-4">
              <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                  <h3 class="mb-3 mb-lg-4">Thông tin cá nhân</h3>
                  <ul class="ps-0 mb-0 list-unstyled">
                    <li class="d-flex align-items-center mb-2 pb-1">
                      <span>User ID:</span>
                      <span class="text-secondary fw-medium ms-1">{{ idUser }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-2 pb-1">
                      <span>Họ và tên:</span>
                      <span class="text-secondary fw-medium ms-1">{{ userName }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-2 pb-1">
                      <span>Email:</span>
                      <span class="text-secondary fw-medium ms-1">{{ email }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-2 pb-1">
                      <span>Địa chỉ:</span>
                      <span class="text-secondary fw-medium ms-1">New York, USA</span>
                    </li>
                    <li class="d-flex align-items-center">
                      <span>Ngày đăng ký:</span>
                      <span class="text-secondary fw-medium ms-1">{{ formattedDate }}</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-8">
          <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h3 class="mb-3 mb-lg-4">Hoạt động gần đây</h3>
              </div>

              <div class="position-relative timeline-item">
                <span class="time-line-date">20-02-2025</span>
                <div class="border-style-for-timeline">
                  <h4 class="fs-15 fw-medium mb-2">Đăng ký tài khoản</h4>
                  <p class="fs-14">We continued our weekly stand-up meetings where team members provided updates on their current tasks, discussed any roadblocks, and coordinated efforts for the week ahead.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        userName: '',
        email: '',
        idUser: '',
        created_at: '',
        formattedDate: ''
      };
    },
    mounted() {
      const user = JSON.parse(localStorage.getItem('user'));
      if (user) {
        this.userName = user.name;
        this.email = user.email;
        this.idUser = user.id;
        this.created_at = user.created_at;
        const date = new Date(this.created_at);
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();
        this.formattedDate = `${day}-${month}-${year}`;
      }
    }
  };
  </script>
