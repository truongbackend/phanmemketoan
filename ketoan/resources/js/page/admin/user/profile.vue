<template>
<div>
    <div class="card bg-info border-0 rounded-3 welcome-box mb-4">
                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class=" position-relative top-5 mt-6 mb-8">
                                                <h3 class="text-white fw-semibold mb-1">Xin chào, <span class="text-danger-div">{{ userName }}</span></h3>
                                                <p class="text-white">Đã gia hạn gói dịch vụ vào ngày {{expiration_package}}</p>
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
                                                <i @click="showPassword = !showPassword"
                                                    :class="showPassword ? 'ri-eye-line' : 'ri-eye-off-line'"
                                                    style="cursor:pointer; color: #a9a9c8; font-size: 16px; right: 15px"
                                                    class="password-toggle-icon translate-middle-y top-50 position-absolute"></i>
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
                                            <i @click="showPasswordNew = !showPasswordNew"
                                                :class="showPasswordNew ? 'ri-eye-line' : 'ri-eye-off-line'"
                                                style="cursor:pointer; color: #a9a9c8; font-size: 16px; right: 15px"
                                                class="password-toggle-icon translate-middle-y top-50 position-absolute"></i>
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
                                            <i @click="showPasswordConfirm = !showPasswordConfirm"
                                                :class="showPasswordConfirm ? 'ri-eye-line' : 'ri-eye-off-line'"
                                                style="cursor:pointer; color: #a9a9c8; font-size: 16px; right: 15px"
                                                class="password-toggle-icon translate-middle-y top-50 position-absolute"></i>
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
import { useToast } from 'vue-toast-notification';
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
            if ( passwordNew.value !== passwordConfirm.value) {
                toast.error("Mật khẩu mới và xác nhận không khớp!");
                return;
            }

            const payload = {
                name: userName.value,
                phone: phone.value,
                address: address.value,
                email:email.value,
            };

            if (password.value && passwordNew.value) {
                payload.old_password = password.value;
                payload.new_password = passwordNew.value;
            }

            axios.put(`/api/user/${idUser.value}`, payload )
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
