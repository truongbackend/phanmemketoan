<template>
<div class="container">
    <div class="main-content d-flex flex-column p-0">
        <div class="m-auto m-1230">
            <div class="row align-items-center">
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="assets/images/register.jpg" class="rounded-3" alt="register">
                </div>
                <div class="col-lg-6">
                    <div class="mw-480 ms-lg-auto">
                        <div class="d-inline-block mb-4">
                            <img src="assets/images/logo.svg" class="rounded-3 for-light-logo" alt="login">
                            <img src="assets/images/white-logo.svg" class="rounded-3 for-dark-logo" alt="login">
                        </div>
                        <h3 class="fs-28 mb-2">Đăng kí tài khoản</h3>
                        <p class="fw-medium fs-16 mb-4">Đăng ký bằng tài khoản mạng xã hội hoặc nhập thông tin của bạn</p>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-sm-4">
                                <a href="https://www.google.com/" target="_blank" class="btn btn-outline-secondary bg-transparent w-100 py-2 hover-bg mb-4" style="border-color: #D6DAE1;">
                                    <img src="assets/images/google.svg" alt="google">
                                </a>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <a href="https://www.facebook.com/" target="_blank" class="btn btn-outline-secondary bg-transparent w-100 py-2 hover-bg mb-4" style="border-color: #D6DAE1;">
                                    <img src="assets/images/facebook2.svg" alt="facebook2">
                                </a>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <a href="https://www.apple.com/" target="_blank" class="btn btn-outline-secondary bg-transparent w-100 py-2 hover-bg mb-4" style="border-color: #D6DAE1;">
                                    <img src="assets/images/apple.svg" alt="apple">
                                </a>
                            </div>
                        </div>
                        <form @submit.prevent="register">
                            <div class="form-group mb-3">
                                <label class="label text-secondary">Họ và tên</label>
                                <input v-model="name" type="text" class="form-control" placeholder="Họ và tên" :class="{'is-invalid': !nameValid}">
                                <div v-if="!nameValid" class="invalid-feedback">Họ và tên không được để trống</div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label text-secondary">Email</label>
                                <input v-model="email" type="email" class="form-control" placeholder="abc@gmail.com" :class="{'is-invalid': !emailValid}">
                                <div v-if="!emailValid" class="invalid-feedback">Email không được để trống</div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label text-secondary">Mật khẩu</label>
                                <input v-model="password" type="password" class="form-control" placeholder="Mật khẩu" :class="{'is-invalid': submitted && (passwordEmpty || !passwordFormatValid)}" />
                                <div v-if="submitted && passwordEmpty" class="invalid-feedback">
                                    Mật khẩu không được để trống
                                </div>
                                <div v-else-if="submitted && !passwordFormatValid" class="invalid-feedback">
                                    Mật khẩu phải có ít nhất 1 chữ hoa và dài hơn 7 ký tự
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary fw-medium py-2 px-3 w-100">
                                    <div class="d-flex align-items-center justify-content-center py-1">
                                        <i class="material-symbols-outlined text-white fs-20 me-2">person_4</i>
                                        <span>Đăng ký</span>
                                    </div>
                                </button>
                            </div>

                            <div class="form-group">
                                <p>Bạn đồng ý với Điều khoản Dịch vụ của chúng tôi và xác nhận rằng bạn đã đọc và hiểu <a href="terms-conditions.html" class="fw-medium text-decoration-none">Chính sách Bảo mật</a></p>
                                <p>Bạn đã có tài khoản. <router-link :to="{ name: 'login' }" class="fw-medium text-primary text-decoration-none">Đăng nhập</router-link></p>
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
import {
    defineComponent,
    ref
} from 'vue';
import {
    useRouter
} from 'vue-router';
import {
    useToast
} from 'vue-toast-notification';
import Cookies from 'js-cookie';
export default defineComponent({
    setup() {
        const email = ref('');
        const password = ref('');
        const name = ref('');
        const nameValid = ref(true);
        const emailValid = ref(true);
        const passwordFormatValid = ref(true);
        const passwordEmpty = ref(true);
        const submitted = ref(false);

        const router = useRouter();
        const toast = useToast();

        const register = () => {
            submitted.value = true;

            nameValid.value = name.value.trim() !== '';
            emailValid.value = email.value.trim() !== '';
            passwordEmpty.value = password.value.trim() === '';
            passwordFormatValid.value = password.value.length > 7 && /[A-Z]/.test(password.value);

            if (!nameValid.value || !emailValid.value || passwordEmpty.value || !passwordFormatValid.value) {
                toast.error("Vui lòng kiểm tra lại thông tin nhập vào");
                return;
            }

            axios.post('/api/register', {
                    email: email.value,
                    name: name.value,
                    password: password.value
                })
                .then(({
                    data
                }) => {
                    if (data.error) {
                        toast.error(data.error);
                    } else {
                        const token = data.access_token;
                        const user = data.user;
                        Cookies.set('token', token, { expires: 7, path: '/' });
                        localStorage.setItem('user', JSON.stringify(user));
                        router.push('admin');
                        toast.success("Đăng ký thành công");
                    }
                })
                .catch((error) => {
                    if (error.response && error.response.data && error.response.data.errors) {
                        const errors = error.response.data.errors;
                        const firstError = Object.values(errors)[0][0];
                        toast.error(firstError);
                    } else {
                        toast.error("Đã có lỗi xảy ra. Vui lòng thử lại.");
                    }
                });
        };

        return {
            register,
            email,
            password,
            name,
            nameValid,
            emailValid,
            passwordEmpty,
            passwordFormatValid,
            submitted
        };
    }
});
</script>
