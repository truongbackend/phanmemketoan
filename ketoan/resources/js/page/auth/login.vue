<template>
    <div class="container">
        <div class="main-content d-flex flex-column p-0">
            <div class="m-auto m-1230">
                <div class="row align-items-center">
                    <div class="col-lg-6 d-none d-lg-block">
                        <img src="assets/avatar/login.jpg" class="rounded-3" alt="login">
                    </div>
                    <div class="col-lg-6">
                        <div class="mw-480 ms-lg-auto">
                            <div class="d-inline-block mb-4">
                                <img src="assets/images/white-logo.svg" class="rounded-3 for-dark-logo" alt="login">
                            </div>
                            <h3 class="fs-28 mb-2">Phần mềm kế toán Pnl International</h3>
                            <p class="fw-medium fs-16 mb-4">Giải pháp kinh doanh cho thương mại điện tử</p>
                            <form @submit.prevent="login">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Email</label>
                                    <input v-model="email" type="email" class="form-control h-55" placeholder="Email của bạn">
                                </div>
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Password</label>
                                    <input v-model="password" type="password" class="form-control h-55" placeholder="Mật khẩu">
                                </div>
                                <div class="form-group mb-4">
                                    <router-link :to="{ name: 'forget-password' }" class="text-decoration-none text-primary fw-semibold">Quên mật khẩu?</router-link>
                                </div>
                                <div class="form-group mb-4">
                                    <button type="submit" class="btn btn-primary fw-medium py-2 px-3 w-100">
                                        <div class="d-flex align-items-center justify-content-center py-1">
                                            <i class="material-symbols-outlined text-white fs-20 me-2">login</i>
                                            <span>Đăng nhập</span>
                                        </div>
                                    </button>
                                </div>
                                <div class="form-group">
                                    <p>Bạn chưa có tài khoản.  <router-link :to="{ name: 'register' }" class="fw-medium text-primary text-decoration-none">Đăng ký ngay</router-link> hoặc quay lại <router-link :to="{ name: 'home' }" class="fw-medium text-primary text-decoration-none">Trang chủ</router-link></p>
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
import { defineComponent, ref ,  inject } from 'vue';
import { useRouter } from 'vue-router';
import { useToast } from 'vue-toast-notification';
import Cookies from 'js-cookie';

export default defineComponent({
    setup() {
        const email = ref('');
        const password = ref('');
        const router = useRouter();
        const toast = useToast();
        const globalState = inject('globalState');
        const baseUrl = globalState.baseUrl;
        const login = () => {
            if (!email.value || !password.value) {
                toast.error("Không được để trống email và mật khẩu");
                return;
            }

            axios.post(`${baseUrl}/api/login`, {
                email: email.value,
                password: password.value
            })
            .then(({ data }) => {
                if (data.error) {
                    toast.error(data.error);
                } else {
                    const token = data.access_token;
                    console.log(token);
                    const user = data.user;

                     Cookies.set('token', data.access_token, {
                        expires: 7,
                        path: '/'
                        });
                    localStorage.setItem('user', JSON.stringify(user));
                    router.push('admin/dashboard');
                    toast.success("Đăng nhập thành công");

                }
            })
            .catch((error) => {
                if (error.response) {
                    const errors = error.response.data.error;
                    toast.error(errors);
                }

            });
        };

        return {
            login,
            email,
            password,
        };
    }
});


</script>
