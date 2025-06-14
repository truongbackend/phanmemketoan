<template>
<div class="container">
            <div class="main-content d-flex flex-column p-0">
                <div class="m-auto m-1230">
                    <div class="row align-items-center">
                        <div class="col-lg-6 d-none d-lg-block">
                            <img src="assets/avatar/forgot.jpg" class="rounded-3" alt="forgot" width="540px">
                        </div>
                        <div class="col-lg-6">
                            <div class="mw-480 ms-lg-auto">
                                <!-- <div class="d-inline-block mb-4">
                                    <img src="assets/images/logo.svg" class="rounded-3 for-light-logo" alt="login">
                                    <img src="assets/images/white-logo.svg" class="rounded-3 for-dark-logo" alt="login">
                                </div> -->
                                <h3 class="fs-28 mb-2">Quên mật khẩu Pnl International?</h3>
                                <p class="fw-medium fs-16 mb-4">Nhập email đã đăng ký để nhận lại mật khẩu mới qua email.</p>
                                <form @submit.prevent="resetPasword">
                                    <div class="form-group mb-3">
                                        <label class="label text-secondary">Email</label>
                                        <input type="email" class="form-control" v-model="email" placeholder="pnl@gmail.com">
                                    </div>
                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn btn-primary fw-medium py-2 px-3 w-100" :disabled="submitted">
                                            <div class="d-flex align-items-center justify-content-center py-1">
                                                <i class="material-symbols-outlined text-white fs-20 me-2">autorenew</i>
                                                <span>Gửi</span>
                                            </div>
                                        </button>
                                    </div>


                                    <div class="form-group">
                                        <p>Quay lại trang <router-link :to="{ name: 'login' }" class="fw-medium text-primary text-decoration-none">Đăng nhập</router-link></p>
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
import { defineComponent, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useToast } from 'vue-toast-notification';

export default defineComponent({
    setup() {
        const email = ref('');
        const toast = useToast();
        const submitted = ref(false);
        const resetPasword = () => {
            if (!email.value) {
                toast.error("Không được để trống email");  // Sử dụng toast
                return;
            }

            axios.post('/api/resetPassword', {
                email: email.value,
            })
            .then(({ data }) => {
                if (data.error) {
                    toast.error(data.error);
                } else {
                    toast.success("Quên mật khẩu thành công");
                    submitted.value = true;

                }
            })
            .catch((error) => {
                submitted.value = false;
                if (error.response && error.response.data?.message) {
                    toast.error(error.response.data.message);
                } else {
                    toast.error("Đã có lỗi xảy ra.");
                }

            });
        };

        return {
            resetPasword,
            email,
            submitted
        };
    }
});


</script>


