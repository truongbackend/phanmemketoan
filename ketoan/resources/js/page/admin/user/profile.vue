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
      <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card bg-white border-0 rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <h3 class="mb-lg-4 mb-3">Thông tin cá nhân</h3>
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="form-group mb-4">
                                                    <label class="label text-secondary">First Name</label>
                                                    <input type="text" class="form-control h-55" value="Alice">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="form-group mb-4">
                                                    <label class="label text-secondary">Last Name</label>
                                                    <input type="text" class="form-control h-55" value="Johnson">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="form-group mb-4">
                                                    <label class="label text-secondary">Email Address</label>
                                                    <input type="email" class="form-control h-55" value="johnson@trezo.com">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="form-group mb-4">
                                                    <label class="label text-secondary">Phone Number</label>
                                                    <input type="text" class="form-control h-55" value="+1 444 555 6699">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="d-flex flex-wrap gap-3">
                                                    <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</button>
                                                    <button class="btn btn-primary py-2 px-4 fw-medium fs-16"> <i class="ri-add-line text-white fw-medium"></i> Save Information</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card bg-white border-0 rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <h3 class="mb-lg-4 mb-3">Cài đặt hệ thống</h3>

                                    <div class="mb-4">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Allow users to show your email
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                                            <label class="form-check-label" for="flexCheckChecked2">
                                                Allow users to show your experiences
                                            </label>
                                        </div>
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked3">
                                            <label class="form-check-label" for="flexCheckChecked3">
                                                Allow users to show your followers
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="label text-secondary">Who can tag you?</label>
                                        <div class="d-flex flex-wrap gap-3">
                                            <div class="form-check cursor">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Everyone
                                                </label>
                                            </div>
                                            <div class="form-check cursor">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Group Member
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="label text-secondary">Account Deletion Or Transfer</label>
                                        <p>Transfer this account to another person or to a company repositories.</p>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3">
                                        <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Delete Account</button>
                                        <button class="btn btn-primary py-2 px-4 fw-medium fs-16"> <i class="ri-arrow-left-right-line text-white fw-medium"></i>  Transfer Account</button>
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
