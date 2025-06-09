<template>
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
    <div class="card-body p-25">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <form class="position-relative table-src-form me-0">
                <input type="text" class="form-control border-0" placeholder="Tìm kiếm gói...." v-model="searchKeyword" />
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
                            <th scope="col">
                                STT
                            </th>
                            <th scope="col">
                                Thời gian
                            </th>
                            <th scope="col">
                               Hệ thống
                            </th>
                            <th scope="col">
                                Content
                            </th>
                            <th scope="col">
                                Trạng thái
                            </th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(Items, index) in packages" :key="index">
                            <td>
                                {{ index + 1 }}
                            </td>
                            <td>{{ Items.name }}</td>
                            <td class="text-secondary">{{ Items.price }}</td>
                            <td class="text-secondary">{{ Items.discould}} %</td>
                            <td class="text-secondary">{{ Items.expiration_time}}</td>
                            <td v-if="Items.status === 1" class="text-secondary">
                                <span class="badge bg-success bg-opacity-10 text-success fw-normal">Hoạt động</span>
                            </td>
                            <td v-else class="text-secondary">
                                <span class="badge bg-danger bg-opacity-10 text-danger fw-normal">Ngưng hoạt động</span>
                            </td>
                            <td class="text-secondary">
                                <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="modal" data-bs-target="#updateModal" @click="getPackageID(Items.id)">
                                    <i class="material-symbols-outlined fs-16 text-body">edit</i>
                                </button>
                                <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        @click="deleteId = Items.id">
                                    <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 p-4 border-bottom">
                        <h1 class="modal-title fs-18" id="createModal">Thêm mới</h1>
                        <button type="button" class="btn-close campaigns-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Tên gói dịch vụ</label>
                                        <input v-model="name" type="text" class="form-control h-60 border-border-color" placeholder="Gói cơ bản ...." :class="{'is-invalid': !nameValid}">
                                        <div v-if="!nameValid" class="invalid-feedback">Tên gói không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Giá tiền</label>
                                        <input v-model="formattedPrice" @input="updatePrice" type="text" class="form-control h-60 border-border-color" placeholder="12.000.000 đ" :class="{'is-invalid': !priceValid}">
                                        <div v-if="!priceValid" class="invalid-feedback">Giá tiền không hợp lệ</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Giảm giá (%)</label>
                                        <input v-model="discount" type="text" class="form-control h-60 border-border-color" placeholder="10%" :class="{'is-invalid': !discountValid}">
                                        <div v-if="!discountValid" class="invalid-feedback">Giảm giá phải là một số từ 0 đến 100</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Thời hạn(tháng)</label>
                                        <input type="text" v-model="expiration_time" class="form-control h-60 border-border-color" placeholder="1 tháng" :class="{'is-invalid': !expirationValid}">
                                        <div v-if="!expirationValid" class="invalid-feedback">Thời hạn không hợp lệ</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Ghi chú</label>
                                        <div class="form-group position-relative">
                                            <textarea v-model="note" class="form-control text-dark" placeholder="Thông tin gói hàng 1 hàng là 1 tính năng ... " cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end flex-wrap gap-3">
                                        <button type="button" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white" data-bs-dismiss="modal">Huỷ</button>
                                        <button type="button" class="btn btn-primary py-2 px-4 fw-medium fs-16" @click="createPackage"> <i class="ri-add-line text-white fw-medium"></i> Tạo mới</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                                        <label class="label text-secondary">Tên gói dịch vụ</label>
                                        <input v-model="name" type="text" class="form-control h-60 border-border-color" placeholder="Gói cơ bản ...." :class="{'is-invalid': !nameValid}">
                                        <div v-if="!nameValid" class="invalid-feedback">Tên gói không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Giá tiền</label>
                                        <input v-model="formattedPrice" @input="updatePrice" type="text" class="form-control h-60 border-border-color" placeholder="12.000.000 đ" :class="{'is-invalid': !priceValid}">
                                        <div v-if="!priceValid" class="invalid-feedback">Giá tiền không hợp lệ</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Giảm giá (%)</label>
                                        <input v-model="discount" type="text" class="form-control h-60 border-border-color" placeholder="10%" :class="{'is-invalid': !discountValid}">
                                        <div v-if="!discountValid" class="invalid-feedback">Giảm giá phải là một số từ 0 đến 100</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Thời hạn(tháng)</label>
                                        <input type="text" v-model="expiration_time" class="form-control h-60 border-border-color" placeholder="1 tháng" :class="{'is-invalid': !expirationValid}">
                                        <div v-if="!expirationValid" class="invalid-feedback">Thời hạn không hợp lệ</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Ghi chú</label>
                                        <div class="form-group position-relative">
                                            <textarea v-model="note" class="form-control text-dark" placeholder="Thông tin gói hàng 1 hàng là 1 tính năng ... " cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end flex-wrap gap-3">
                                        <button type="button" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white" data-bs-dismiss="modal">Huỷ</button>
                                        <button type="button" class="btn btn-primary py-2 px-4 fw-medium fs-16" @click="updatePackage"> <i class="ri-save-line text-white fw-medium"></i> Cập nhật</button>
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
import {
    useToast
} from 'vue-toast-notification';
import {
    inject
} from 'vue';
export default defineComponent({
    setup() {
        const packages = ref([]);
        const name = ref('');
        const price = ref('');
        const discount = ref('');
        const expiration_time = ref('');
        const note = ref('');
        const toast = useToast();
        const formattedPrice = ref('');
        const nameValid = ref(true);
        const priceValid = ref(true);
        const discountValid = ref(true);
        const expirationValid = ref(true);
        const searchKeyword = ref('');
        const packagesId = ref('');
        const globalState = inject('globalState');
        const baseUrl = globalState.baseUrl;
        const deleteId = ref(null);
        const formatPrice = (value) => {
            if (!value) return '';
            const cleaned = value.toString().replace(/[^\d]/g, '');
            return cleaned.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        };

        const cleanInput = (value) => {
            return value.toString().replace(/[^\d]/g, '');
        };

        const updatePrice = () => {
            price.value = cleanInput(formattedPrice.value);
            formattedPrice.value = formatPrice(price.value);
        };

        watch(price, (newVal) => {
            formattedPrice.value = formatPrice(newVal);
        });

        const getNotification = () => {
            const params = {};

            if (searchKeyword.value.trim() !== '') {
                params.search = searchKeyword.value.trim();
            }
            axios
                .get(`${baseUrl}/api/notification`, {
                    params
                })
                .then((response) => {
                    packages.value = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        };
        const confirmDelete = () => {
            if (!deleteId.value) return;

            axios.delete(`${baseUrl}/api/packages/${deleteId.value}`)
                .then(() => {
                    toast.success('Xoá gói thành công');
                    getPackage();
                    deleteId.value = null;
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                    modal.hide();
                })
                .catch((error) => {
                    toast.error('Xoá gói thất bại');
                    console.log(error);
                });
        };

        const getPackageID = (id) => {
            axios
                .get(`${baseUrl}/api/packages/${id}/edit`)
                .then((response) => {
                    const data = response.data;
                    packagesId.value = data.id;
                    name.value = data.name;
                    price.value = data.price;
                    discount.value = data.discould;
                    expiration_time.value = data.expiration_time;
                    note.value = data.note;
                    formattedPrice.value = formatPrice(price.value);
                })
                .catch((error) => {
                    toast.error('Xóa gói thất bại');
                    console.log(error);
                });
        };

        const createPackage = () => {
            nameValid.value = name.value.trim() !== '';
            priceValid.value = !isNaN(price.value) && parseFloat(price.value) > 0;
            discountValid.value = !isNaN(discount.value) && discount.value >= 0 && discount.value <= 100;
            expirationValid.value = !isNaN(expiration_time.value) && expiration_time.value > 0;

            if (nameValid.value && priceValid.value && discountValid.value && expirationValid.value) {
                axios
                    .post(`${baseUrl}/api/packages`, {
                        name: name.value,
                        price: price.value,
                        discould: discount.value,
                        expiration_time: expiration_time.value,
                        note: note.value,
                    })
                    .then((response) => {
                        getPackage();
                        toast.success("Tạo gói mới thành công");
                        const modal = bootstrap.Modal.getInstance(document.getElementById('createModal'));
                        modal.hide();
                        name.value = '';
                        price.value = '';
                        discount.value = '';
                        expiration_time.value = '';
                        note.value = '';

                    })
                    .catch((error) => {
                        if (error.response && error.response.status === 422) {
                            const errors = error.response.data.errors;

                            if (errors.name) {
                                toast.error(errors.name[0]);
                            } else {
                                toast.error("Có lỗi xảy ra khi tạo gói.");
                            }
                        }
                    });
            } else {
                toast.error("Vui lòng kiểm tra lại các trường dữ liệu");
            }
        };
        const updatePackage = () => {
            nameValid.value = name.value.trim() !== '';
            priceValid.value = !isNaN(price.value) && parseFloat(price.value) > 0;
            discountValid.value = !isNaN(discount.value) && discount.value >= 0 && discount.value <= 100;
            expirationValid.value = !isNaN(expiration_time.value) && expiration_time.value > 0;

            if (nameValid.value && priceValid.value && discountValid.value && expirationValid.value) {
                axios
                    .put(`${baseUrl}/api/packages/${packagesId.value}`, {
                        name: name.value,
                        price: price.value,
                        discould: discount.value,
                        expiration_time: expiration_time.value,
                        note: note.value,
                    })
                    .then(() => {
                        getPackage();
                        toast.success("Cập nhật gói thành công");
                        const modal = bootstrap.Modal.getInstance(document.getElementById('updateModal'));
                        modal.hide();
                    })
                    .catch((error) => {
                        if (error.response && error.response.status === 422) {
                            const errors = error.response.data.errors;
                            if (errors.name) {
                                toast.error(errors.name[0]);
                            } else {
                                toast.error("Có lỗi xảy ra khi tạo gói.");
                            }
                        }
                    });
            } else {
                toast.error("Vui lòng kiểm tra lại các trường dữ liệu");
            }
        };


        formattedPrice.value = formatPrice(price.value);

        getPackage();
        watch(searchKeyword, (newVal) => {
            getPackage();
        });

        return {
            packages,
            name,
            price,
            discount,
            expiration_time,
            note,
            formattedPrice,
            nameValid,
            priceValid,
            discountValid,
            expirationValid,
            createPackage,
            updatePrice,
            searchKeyword,
            getPackageID,
            packagesId,
            updatePackage,
            deleteId,
            confirmDelete
        };
    },
});
</script>
