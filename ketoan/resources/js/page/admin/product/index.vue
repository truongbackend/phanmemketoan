<template>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h3 class="mb-0">Danh sách mục hàng hoá</h3>

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center mb-0 lh-1">
            <li class="breadcrumb-item">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                    <span class="text-secondary fw-medium hover">Trang chủ</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="fw-medium">Hàng hoá</span>
            </li>
        </ol>
    </nav>
</div>

<div class="card bg-white border-0 rounded-3 mb-4">
    <div class="card-body p-25">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <form class="position-relative table-src-form me-0">
                <input type="text" class="form-control border-0" placeholder="Tìm kiếm mã sàn , mã hệ thống kế toán , ...." v-model="searchKeyword" />
                <i class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y text-secondary">search</i>
            </form>
            <button class="btn btn-outline-primary fw-medium rounded-3 hover-bg" data-bs-toggle="modal" data-bs-target="#createModal">
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <i class="ri-add-line d-none d-sm-inline-block fs-20 lh-1"></i>
                    <span>Thêm mới</span>
                </span>
            </button>

        </div>
        <div class="default-table-area all-products px-20">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th class="text-center bg-info text-white" colspan="6">
                                Tổng hợp
                            </th>
                            <th class="text-center bg-warning text-white" colspan="5">
                                Tổng hợp
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">
                                STT
                            </th>
                            <th scope="col">
                               Mã sàn
                            </th>
                            <th scope="col">
                                Mã hệ thống kế toán
                            </th>
                            <th scope="col">
                                Tên hàng
                            </th>
                            <th scope="col">
                                DVT
                            </th>
                            <th scope="col">
                                Thuế suất
                            </th>
                            <th scope="col">
                                Mã chi tiết combo
                            </th>
                            <th scope="col">
                                Tên
                            </th>
                            <th scope="col">
                                DVT
                            </th>
                             <th scope="col">
                                Số lượng
                            </th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(Items, index) in productList" :key="index">
                            <td>
                                {{ index + 1 }}
                            </td>
                            <td>{{ Items.market_code }}</td>
                            <td class="text-secondary">{{ Items.accounting_system_code }}</td>
                            <td class="text-secondary">{{ Items.product_name}}</td>
                            <td class="text-secondary">{{ Items.unit}}</td>
                            <td class="text-secondary">{{ Items.tax_rate}}</td>
                            <td class="text-secondary">{{ Items.combo_detail_code}}</td>
                            <td class="text-secondary">{{ Items.combo_name }}</td>
                            <td class="text-secondary">{{ Items.combo_unit }}</td>
                            <td class="text-secondary">{{ Items.quantity }}</td>
                            <td class="text-secondary">
                                <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="modal" data-bs-target="#updateModal" @click="getUserID(Items.id)">
                                    <i class="material-symbols-outlined fs-16 text-body">edit</i>
                                </button>
                                <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="modal" data-bs-target="#deleteModal" @click="deleteId = Items.id">
                                    <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap p-4">
                <span class="fs-13 fw-medium">Hiển thị: 10</span>
                <div class="d-flex align-items-center">
                    <span class="fs-13 fw-medium me-2">1 - 10 của 12</span>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0 justify-content-center">
                            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                <a class="page-link icon" href="#" @click.prevent="changePage(currentPage - 1)">
                                    <i class="material-symbols-outlined">keyboard_arrow_left</i>
                                </a>
                            </li>

                            <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: page === currentPage }">
                                <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
                            </li>

                            <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                                <a class="page-link icon" href="#" @click.prevent="changePage(currentPage + 1)">
                                    <i class="material-symbols-outlined">keyboard_arrow_right</i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 845px;">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 p-4 border-bottom">
                        <h1 class="modal-title fs-18" id="createModal">Thêm mới</h1>
                        <button type="button" class="btn-close campaigns-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form>
                            <h3 class="fs-16 fw-semibold mb-20">Tổng hợp</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Mã sàn</label>
                                        <input v-model="market_code" type="text" class="form-control h-60 border-border-color" placeholder="Mã sàn ...." :class="{'is-invalid': !nameValid}">
                                        <div v-if="!nameValid" class="invalid-feedback">Họ và tên không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Mã hệ thống kế toán</label>
                                        <input v-model="accounting_system_code" type="text" class="form-control h-60 border-border-color" placeholder="Họ và tên ...." :class="{'is-invalid': !nameValid}">
                                        <div v-if="!nameValid" class="invalid-feedback">Họ và tên không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Tên hàng</label>
                                        <input v-model="product_name" type="text" class="form-control h-60 border-border-color" placeholder="012345678" :class="{'is-invalid': !phoneValid}">
                                        <div v-if="!phoneValid" class="invalid-feedback">Số điện thoại không hợp lệ</div>
                                    </div>
                                </div>
                                 <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">DVT</label>
                                        <input v-model="unit" type="text" class="form-control h-60 border-border-color" placeholder="Địa chỉ ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Thuế suất</label>
                                        <input v-model="tax_rate" type="text" class="form-control h-60 border-border-color" placeholder="Địa chỉ ...">
                                    </div>
                                </div>
                                <h3 class="fs-16 fw-semibold mb-20">Chi tiết</h3>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Mã chi tiết combo</label>
                                        <input v-model="combo_detail_code" type="text" class="form-control h-60 border-border-color" placeholder="Địa chỉ ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Tên</label>
                                        <input v-model="combo_name" type="text" class="form-control h-60 border-border-color" placeholder="Địa chỉ ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">DVT</label>
                                        <input v-model="combo_unit" type="text" class="form-control h-60 border-border-color" placeholder="Địa chỉ ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Số lượng</label>
                                        <input v-model="quantity" type="text" class="form-control h-60 border-border-color" placeholder="Địa chỉ ...">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end flex-wrap gap-3">
                                        <button type="button" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white" data-bs-dismiss="modal">Huỷ</button>
                                        <button type="button" class="btn btn-primary py-2 px-4 fw-medium fs-16" @click="createUser"> <i class="ri-add-line text-white fw-medium"></i> Tạo mới</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModal">Xác nhận xoá</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc chắn muốn xoá mục này? Hành động này không thể hoàn tác.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        <button type="button" class="btn btn-danger text-white" @click="confirmDelete">Xoá</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 p-4 border-bottom">
                        <h1 class="modal-title fs-18" id="updateModal">Cập nhật</h1>
                        <button type="button" class="btn-close campaigns-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Họ và tên</label>
                                        <input v-model="name" type="text" class="form-control h-60 border-border-color" placeholder="Họ và tên ...." :class="{'is-invalid': !nameValid}">
                                        <div v-if="!nameValid" class="invalid-feedback">Họ và tên không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Email</label>
                                        <input disabled v-model="email" type="email" class="form-control h-60 border-border-color" placeholder="abc@gmail.com" :class="{'is-invalid': !emailValid}">
                                        <div v-if="!email" class="invalid-feedback">Email không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Số điện thoại</label>
                                        <input v-model="phone" type="text" class="form-control h-60 border-border-color" placeholder="012345678" :class="{'is-invalid': !phoneValid}">
                                        <div v-if="!phoneValid" class="invalid-feedback">Số điện thoại không hợp lệ</div>
                                    </div>
                                </div>
                                 <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Địa chỉ</label>
                                        <input v-model="address" type="text" class="form-control h-60 border-border-color" placeholder="Địa chỉ ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Ngày hết hạn</label>
                                        <input v-model="expiration_package" type="date" class="form-control h-60 border-border-color" placeholder="10%" :class="{'is-invalid': !expirationValid}">
                                        <div v-if="!expirationValid" class="invalid-feedback">Ngày hết hạn không hợp lệ</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Gói dịch vụ</label>
                                        <select v-model="selectedPackageId" class="form-select form-control h-60">
                                            <option v-for="pkg in packageList" :key="pkg.id" :value="pkg.id">
                                                {{ pkg.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Trạng thái</label>
                                        <select v-model="selectedStatus" class="form-select form-control h-60" aria-label="Default select example">
                                            <option value="1" class="text-dark">Hoạt động</option>
                                            <option value="0" class="text-dark">Ngưng hoạt động</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Ghi chú</label>
                                        <div class="form-group position-relative">
                                            <textarea v-model="note" class="form-control text-dark" placeholder="Ghi chú ... " cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end flex-wrap gap-3">
                                        <button type="button" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white" data-bs-dismiss="modal">Huỷ</button>
                                        <button type="button" class="btn btn-primary py-2 px-4 fw-medium fs-16" @click="updateUser"> <i class="ri-add-line text-white fw-medium"></i> Cập nhât mới</button>
                                    </div>
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
import {
    defineComponent,
    ref,
    watch
} from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toast-notification';
import { inject } from 'vue';
import { hasPermission } from '@/utils/permission';
export default defineComponent({
    setup() {
        const productList = ref([]);
        const role = ref([]);
        const user = ref([]);
        const name = ref('');
        const phone = ref('');
        const address = ref('');
        const email = ref('');
        const expiration_package = ref('');
        const note = ref('');
        const toast = useToast();
        const nameValid = ref(true);
        const emailValid = ref(true);
        const phoneValid = ref(true);
        const addressValid = ref(true);
        const expirationValid = ref(true);
        const searchKeyword = ref('');
        const userId = ref('');
        const globalState = inject('globalState');
        const baseUrl = globalState.baseUrl;
        const deleteId = ref(null);
        const currentPage = ref(1);
        const perPage = ref(10);
        const totalPages = ref(1);
        const selectedPackageId = ref(null);
        const selectedStatus = ref(1);
        const selectedRole = ref('');
        const getProduct = () => {
            const params = {
                page: currentPage.value,
                per_page: perPage.value
            };
            if (searchKeyword.value.trim() !== '') {
                params.search = searchKeyword.value.trim();
            }
            axios.get(`${baseUrl}/api/product`, { params })
                .then((response) => {
                    productList.value = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        };

        const createUser = () => {
            nameValid.value = name.value.trim() !== '';
            emailValid.value = email.value.trim() !== '' && /\S+@\S+\.\S+/.test(email.value);
            phoneValid.value = typeof phone.value === 'string' ? phone.value.trim() === '' || /^\d{9,11}$/.test(phone.value) : true;
            expirationValid.value = expiration_package.value !== '';
            if (nameValid.value && emailValid.value && phoneValid.value && addressValid.value && expirationValid.value) {
                axios.post(`${baseUrl}/api/user`, {
                    name: name.value,
                    phone: phone.value,
                    address: address.value,
                    email: email.value,
                    expiration_package: expiration_package.value,
                    package_id: selectedPackageId.value,
                    status: selectedStatus.value,
                    note: note.value,
                    role_id: selectedRole.value
                })
                .then(() => {
                    getUser();
                    toast.success("Tạo người dùng thành công");
                    const modal = bootstrap.Modal.getInstance(document.getElementById('createModal'));
                    modal.hide();
                    name.value = '';
                    phone.value = '';
                    address.value = '';
                    email.value = '';
                    expiration_package.value = '';
                    note.value = '';
                    selectedPackageId.value = null;
                    selectedStatus.value = 1;
                })
                .catch((error) => {
                    toast.error("Có lỗi xảy ra khi tạo người dùng");
                    console.log(error);
                });
            } else {
                toast.error("Vui lòng kiểm tra lại các trường dữ liệu");
            }
        };
        const updateUser = () => {
            nameValid.value = name.value.trim() !== '';
            emailValid.value = email.value.trim() !== '' && /\S+@\S+\.\S+/.test(email.value);
            phoneValid.value = typeof phone.value === 'string' ? phone.value.trim() === '' || /^\d{9,11}$/.test(phone.value) : true;
            expirationValid.value = expiration_package.value !== '';
            if (nameValid.value && emailValid.value && phoneValid.value && expirationValid.value) {
                axios.put(`${baseUrl}/api/user/${userId.value}`, {
                    name: name.value,
                    phone: phone.value,
                    address: address.value,
                    email: email.value,
                    expiration_package: expiration_package.value,
                    package_id: selectedPackageId.value,
                    status: selectedStatus.value,
                    note: note.value,
                })
                .then(() => {
                    getUser();
                    toast.success("Cập nhật người dùng thành công");
                    const modal = bootstrap.Modal.getInstance(document.getElementById('updateModal'));
                    modal.hide();
                    name.value = '';
                    phone.value = '';
                    address.value = '';
                    email.value = '';
                    expiration_package.value = '';
                    note.value = '';
                    selectedPackageId.value = null;
                    selectedStatus.value = '';
                })
                .catch((error) => {
                    toast.error("Có lỗi xảy ra khi tạo người dùng");
                    console.log(error);
                });
            } else {
                toast.error("Vui lòng kiểm tra lại các trường dữ liệu");
            }
        };

        const confirmDelete = () => {
            if (!deleteId.value) return;
            axios.delete(`${baseUrl}/api/user/${deleteId.value}`)
                .then(() => {
                    toast.success('Xoá người dùng thành công');
                    getUser();
                    deleteId.value = null;
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                    modal.hide();
                })
                .catch((error) => {
                    toast.error('Xoá người dùng thất bại');
                    console.log(error);
                });
        };

        const changePage = (page) => {
            currentPage.value = page;
            getUser();
        };
        const getUserID = (id) => {
            axios
                .get(`${baseUrl}/api/user/${id}`)
                .then((response) => {
                    const data = response.data;
                    name.value = data.name;
                    phone.value = data.phone;
                    email.value = data.email;
                    address.value = data.address;
                    expiration_package.value = data.expiration_package;
                    note.value = data.note;
                    selectedPackageId.value = data.packages_id;
                    selectedStatus.value = data.status;
                    userId.value = data.id;
                })
                .catch((error) => {
                    toast.error('Lấy thông tin người dùng thất bại');
                    console.log(error);
                });
        };
        watch(searchKeyword, () => {
            currentPage.value = 1;
            getProduct();
        });
        getProduct();
        return {
            user,
            name,
            phone,
            address,
            email,
            expiration_package,
            note,
            nameValid,
            emailValid,
            phoneValid,
            addressValid,
            expirationValid,
            createUser,
            deleteId,
            confirmDelete,
            searchKeyword,
            currentPage,
            totalPages,
            changePage,
            productList,
            selectedPackageId,
            selectedStatus,
            getUserID,
            userId,
            updateUser,
            role,
            selectedRole
        };
    },
    methods: {
        hasPermission
    }
});
</script>
