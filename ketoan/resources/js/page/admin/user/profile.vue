<template>
<div>
    <div class="d-flex align-items-start p-4 mb-4 rounded" style="border:1px dashed #ffc107; background-color:#fff8e5;">
        <i class="ri-error-warning-line fs-3 text-warning me-3 flex-shrink-0"></i>
        <div>
            <p class="mb-1 fw-semibold">
                Gói cước
                <span class="text-danger">{{ expiration_package }}</span>
                của bạn sắp hết hạn
            </p>
            <p class="mb-0 text-muted small">
                Để có nhiều cơ hội trải nghiệm các gói cước khác, gia hạn hoặc nâng cấp lên gói
                cước mới để tiếp tục sử dụng.
            </p>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="/assets/images/administrator.jpg" alt="Logo" class="rounded me-3"/>
                <div>
                    <h5 class="mb-1">COMPANY</h5>
                    <p class="text-muted mb-0">
                        <i class="bi bi-envelope me-1"></i>EMAIL<br />
                        <i class="bi bi-geo-alt me-1"></i>LOCATION
                    </p>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                <div class="d-flex align-items-center flex-grow-1 justify-content-center">
                <div class="text-center" style="min-width:140px; padding:.75rem; border:1px dashed #ced4da; border-radius:.5rem;">
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <i class="bi bi-gear-fill me-1"></i>
                        <span class="fw-bold">Demo – V2</span>
                    </div>
                    <small class="text-muted">Gói cước đang sử dụng</small>
                </div>
                <div class="text-center" style="min-width:140px; padding:.75rem; border:1px dashed #ced4da; border-radius:.5rem;">
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <i class="bi bi-clock-history text-success me-1"></i>
                        <span>08/07/2025</span>
                    </div>
                    <small class="text-muted">Ngày kích hoạt</small>
                </div>
                <div class="text-center" style="min-width:140px; padding:.75rem; border:1px dashed #ced4da; border-radius:.5rem;">
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <i class="bi bi-clock-fill text-danger me-1"></i>
                        <span>11/07/2025</span>
                    </div>
                    <small class="text-muted">Ngày hết hạn</small>
                </div>
                <div style="min-width:200px;">
                    <div class="d-flex align-items-center mb-1">
                        <small class="text-muted">Thời gian sử dụng: <strong>1/3</strong></small>
                        <small class="ms-2 fw-bold">33%</small>
                    </div>
                    <div class="progress" style="height:6px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width:33%;"></div>
                    </div>
                </div>
            </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-712">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-lg-4 mb-3">Thông tin cá nhân</h3>
                    <form>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Họ và tên</label>
                                    <input type="text" v-model="userName" class="form-control h-55" value="Alice" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Email</label>
                                    <input type="email" v-model="email" class="form-control h-55" value="johnson@trezo.com" disabled />
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Địa chỉ</label>
                                    <input type="text" v-model="address" class="form-control h-55" value="" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Số điện thoại</label>
                                    <input type="text" class="form-control h-55" v-model="phone" />
                                </div>
                            </div>

                            <h3 class="mb-lg-4 mb-3">Đổi mật khẩu</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Mật khẩu cũ</label>
                                        <div class="form-group">
                                            <div class="password-wrapper position-relative">
                                                <input :type="showPassword ? 'text' : 'password'" class="form-control h-55 text-dark" v-model="password" />
                                                <i @click="showPassword = !showPassword" :class="showPassword ? 'ri-eye-line' : 'ri-eye-off-line'" style="cursor:pointer; color: #a9a9c8; font-size: 16px; right: 15px" class="password-toggle-icon translate-middle-y top-50 position-absolute"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Mật khẩu mới</label>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="password-wrapper position-relative">
                                                    <input :type="showPasswordNew ? 'text' : 'password'" class="form-control h-55 text-dark" v-model="passwordNew" />
                                                    <i @click="showPasswordNew = !showPasswordNew" :class="showPasswordNew ? 'ri-eye-line' : 'ri-eye-off-line'" style="cursor:pointer; color: #a9a9c8; font-size: 16px; right: 15px" class="password-toggle-icon translate-middle-y top-50 position-absolute"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Xác nhận mật khẩu</label>
                                        <div class="form-group">
                                            <div class="password-wrapper position-relative">
                                                <input :type="showPasswordConfirm ? 'text' : 'password'" class="form-control h-55 text-dark" v-model="passwordConfirm" />
                                                <i @click="showPasswordConfirm = !showPasswordConfirm" :class="showPasswordConfirm ? 'ri-eye-line' : 'ri-eye-off-line'" style="cursor:pointer; color: #a9a9c8; font-size: 16px; right: 15px" class="password-toggle-icon translate-middle-y top-50 position-absolute"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex flex-wrap gap-3">
                                    <button class="btn btn-primary py-2 px-4 fw-medium fs-16" @click.prevent="updateUser">
                                        <i class="ri-add-line text-white fw-medium"></i> Cập nhật
                                    </button>
                                    <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">
                                        Đóng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {
    ref,
    onMounted
} from 'vue';
import {
    useToast
} from 'vue-toast-notification';
export default {
    setup() {
        const userName = ref('');
        const phone = ref('');
        const address = ref('');
        const email = ref('');
        const idUser = ref('');
        const created_at = ref('');
        const expiration_package = ref('');
        const formattedDate = ref('');
        const password = ref('');
        const passwordNew = ref('');
        const passwordConfirm = ref('');
        const showPassword = ref(false);
        const showPasswordNew = ref(false);
        const showPasswordConfirm = ref(false);
        const toast = useToast();
        onMounted(() => {
            const user = JSON.parse(localStorage.getItem("user"));
            console.log(user);
            if (user) {
                userName.value = user.name || '';
                email.value = user.email || '';
                phone.value = user.phone || '';
                address.value = user.address || '';
                idUser.value = user.id || '';
                created_at.value = user.created_at || '';
                expiration_package.value = user.expiration_package || '';
                const d = new Date(created_at.value);
                const day = d.getDate();
                const month = d.getMonth() + 1;
                const year = d.getFullYear();
                formattedDate.value = `${day}-${month}-${year}`;
            }
        });
        const updateUser = () => {
            if (passwordNew.value !== passwordConfirm.value) {
                toast.error("Mật khẩu mới và xác nhận không khớp!");
                return;
            }

            const payload = {
                name: userName.value,
                phone: phone.value,
                address: address.value,
                email: email.value,
            };

            if (password.value && passwordNew.value) {
                payload.old_password = password.value;
                payload.new_password = passwordNew.value;
            }

            axios.put(`/api/user/${idUser.value}`, payload)
                .then(res => {
                    toast.success("Cập nhật thành công!");
                    password.value = '';
                    passwordNew.value = '';
                    passwordConfirm.value = '';
                })
                .catch(err => {
                    if (err) {
                        const errors = err.response.data.error;
                        toast.error(errors);
                    }
                });
        };

        return {
            userName,
            phone,
            address,
            email,
            idUser,
            created_at,
            formattedDate,
            updateUser,
            password,
            passwordNew,
            passwordConfirm,
            showPassword,
            showPasswordNew,
            showPasswordConfirm,
            expiration_package
        };
    }
};
</script>
