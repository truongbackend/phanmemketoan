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
                            <th scope="col">
                                STT
                            </th>
                            <th scope="col">
                               Mã đơn hàng
                            </th>
                            <th scope="col">
                               Ngày đơn hàng
                            </th>
                            <th scope="col">
                               Tổng tiền hàng
                            </th>
                            <th scope="col">
                               Tiền thuê GTGT
                            </th>
                            <th scope="col">
                                Tổng tiền thanh toán
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
                                <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="modal" data-bs-target="#updateModal" @click="getProductID(Items.id)">
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
                    <span class="fs-13 fw-medium me-2">1 - 10 of {{ totalProducts }}</span>
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
                        <form @submit.prevent="createProduct">
                            <h3 class="fs-16 fw-semibold mb-20">Thông tin chung</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Mã sàn</label>
                                        <input v-model="market_code" type="text" class="form-control h-60 border-border-color" placeholder="Mã sàn ...." :class="{'is-invalid': !marketCodeValid}">
                                        <div v-if="!marketCodeValid" class="invalid-feedback">Mã sàn không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Mã hệ thống kế toán</label>
                                        <input v-model="accounting_system_code" type="text" class="form-control h-60 border-border-color" placeholder="Mã hệ thống kế toán ...." :class="{'is-invalid': !accountingSystemCodeValid}">
                                        <div v-if="!accountingSystemCodeValid" class="invalid-feedback">Mã hệ thống kế toán không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Tên hàng</label>
                                        <input v-model="product_name" type="text" class="form-control h-60 border-border-color" placeholder="Tên hàng" :class="{'is-invalid': !productNameValid}">
                                        <div v-if="!productNameValid" class="invalid-feedback">Tên hàng không được để trống</div>
                                    </div>
                                </div>
                                 <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Đơn vị tính</label>
                                        <input v-model="unit" type="text" class="form-control h-60 border-border-color" placeholder="Đơn vị tính ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Thuế suất</label>
                                        <input v-model="tax_rate" type="number" class="form-control h-60 border-border-color" placeholder="Thuế suất ...">
                                    </div>
                                </div>
                                <h3 class="fs-16 fw-semibold mb-20">Chi tiết combo</h3>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Mã chi tiết combo</label>
                                        <input v-model="combo_detail_code" type="text" class="form-control h-60 border-border-color" placeholder="Mã chi tiết combo ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Tên chi tiết combo</label>
                                        <input v-model="combo_name" type="text" class="form-control h-60 border-border-color" placeholder="Tên chi tiết combo ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Đơn vị tính chi tiết combo</label>
                                        <input v-model="combo_unit" type="text" class="form-control h-60 border-border-color" placeholder="Đơn vị tính chi tiết combo ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Số lượng chi tiết combo</label>
                                        <input v-model="quantity" type="number" class="form-control h-60 border-border-color" placeholder="Số lượng chi tiết combo ...">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end flex-wrap gap-3">
                                        <button type="button" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white" data-bs-dismiss="modal">Huỷ</button>
                                        <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16"> <i class="ri-add-line text-white fw-medium"></i> Tạo mới</button>
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
            <div class="modal-dialog modal-dialog-centered" style="max-width: 845px;">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 p-4 border-bottom">
                        <h1 class="modal-title fs-18" id="updateModal">Cập nhật</h1>
                        <button type="button" class="btn-close campaigns-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form @submit.prevent="updateProduct">
                            <h3 class="fs-16 fw-semibold mb-20">Thông tin chung</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Mã sàn</label>
                                        <input v-model="market_code" type="text" class="form-control h-60 border-border-color" placeholder="Mã sàn ...." :class="{'is-invalid': !marketCodeValid}">
                                        <div v-if="!marketCodeValid" class="invalid-feedback">Mã sàn không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Mã hệ thống kế toán</label>
                                        <input v-model="accounting_system_code" type="text" class="form-control h-60 border-border-color" placeholder="Mã hệ thống kế toán ...." :class="{'is-invalid': !accountingSystemCodeValid}">
                                        <div v-if="!accountingSystemCodeValid" class="invalid-feedback">Mã hệ thống kế toán không được để trống</div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Tên hàng</label>
                                        <input v-model="product_name" type="text" class="form-control h-60 border-border-color" placeholder="Tên hàng" :class="{'is-invalid': !productNameValid}">
                                        <div v-if="!productNameValid" class="invalid-feedback">Tên hàng không được để trống</div>
                                    </div>
                                </div>
                                 <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Đơn vị tính</label>
                                        <input v-model="unit" type="text" class="form-control h-60 border-border-color" placeholder="Đơn vị tính ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Thuế suất</label>
                                        <input v-model="tax_rate" type="number" class="form-control h-60 border-border-color" placeholder="Thuế suất ...">
                                    </div>
                                </div>
                                <h3 class="fs-16 fw-semibold mb-20">Chi tiết combo</h3>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Mã chi tiết combo</label>
                                        <input v-model="combo_detail_code" type="text" class="form-control h-60 border-border-color" placeholder="Mã chi tiết combo ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Tên chi tiết combo</label>
                                        <input v-model="combo_name" type="text" class="form-control h-60 border-border-color" placeholder="Tên chi tiết combo ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Đơn vị tính chi tiết combo</label>
                                        <input v-model="combo_unit" type="text" class="form-control h-60 border-border-color" placeholder="Đơn vị tính chi tiết combo ...">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Số lượng chi tiết combo</label>
                                        <input v-model="quantity" type="number" class="form-control h-60 border-border-color" placeholder="Số lượng chi tiết combo ...">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end flex-wrap gap-3">
                                        <button type="button" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white" data-bs-dismiss="modal">Huỷ</button>
                                        <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16"> <i class="ri-add-line text-white fw-medium"></i> Cập nhật</button>
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
        const toast = useToast();
        const searchKeyword = ref('');
        const deleteId = ref(null);
        const currentPage = ref(1);
        const perPage = ref(10);
        const totalPages = ref(1);
        const totalProducts = ref(0); // New ref for total products count

        // Product fields for create and update
        const productId = ref(null);
        const market_code = ref('');
        const accounting_system_code = ref('');
        const product_name = ref('');
        const unit = ref('');
        const tax_rate = ref(null);
        const combo_detail_code = ref('');
        const combo_name = ref('');
        const combo_unit = ref('');
        const quantity = ref(null);

        // Validation refs for product fields
        const marketCodeValid = ref(true);
        const accountingSystemCodeValid = ref(true);
        const productNameValid = ref(true);

        const globalState = inject('globalState');
        const baseUrl = globalState.baseUrl;

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
                    productList.value = response.data.data; // Assuming API returns { data: [], total: N }
                    totalProducts.value = response.data.total; // Get total count from API response
                    totalPages.value = Math.ceil(totalProducts.value / perPage.value);
                })
                .catch((error) => {
                    console.log(error);
                });
        };

        const createProduct = () => {
            // Validate product fields
            marketCodeValid.value = market_code.value.trim() !== '';
            accountingSystemCodeValid.value = accounting_system_code.value.trim() !== '';
            productNameValid.value = product_name.value.trim() !== '';

            if (marketCodeValid.value && accountingSystemCodeValid.value && productNameValid.value) {
                axios.post(`${baseUrl}/api/product`, {
                    market_code: market_code.value,
                    accounting_system_code: accounting_system_code.value,
                    product_name: product_name.value,
                    unit: unit.value,
                    tax_rate: tax_rate.value,
                    combo_detail_code: combo_detail_code.value,
                    combo_name: combo_name.value,
                    combo_unit: combo_unit.value,
                    quantity: quantity.value,
                })
                .then(() => {
                    getProduct();
                    toast.success("Tạo sản phẩm thành công");
                    const modal = bootstrap.Modal.getInstance(document.getElementById('createModal'));
                    modal.hide();
                    market_code.value = '';
                    accounting_system_code.value = '';
                    product_name.value = '';
                    unit.value = '';
                    tax_rate.value = null;
                    combo_detail_code.value = '';
                    combo_name.value = '';
                    combo_unit.value = '';
                    quantity.value = null;
                })
                .catch((error) => {
                    toast.error("Có lỗi xảy ra khi tạo sản phẩm");
                    console.log(error);
                });
            } else {
                toast.error("Vui lòng kiểm tra lại các trường dữ liệu bắt buộc");
            }
        };

        const updateProduct = () => {
            // Validate product fields
            marketCodeValid.value = market_code.value.trim() !== '';
            accountingSystemCodeValid.value = accounting_system_code.value.trim() !== '';
            productNameValid.value = product_name.value.trim() !== '';

            if (marketCodeValid.value && accountingSystemCodeValid.value && productNameValid.value) {
                axios.put(`${baseUrl}/api/product/${productId.value}`, {
                    market_code: market_code.value,
                    accounting_system_code: accounting_system_code.value,
                    product_name: product_name.value,
                    unit: unit.value,
                    tax_rate: tax_rate.value,
                    combo_detail_code: combo_detail_code.value,
                    combo_name: combo_name.value,
                    combo_unit: combo_unit.value,
                    quantity: quantity.value,
                })
                .then(() => {
                    getProduct();
                    toast.success("Cập nhật sản phẩm thành công");
                    const modal = bootstrap.Modal.getInstance(document.getElementById('updateModal'));
                    modal.hide();
                    // Clear form fields
                    market_code.value = '';
                    accounting_system_code.value = '';
                    product_name.value = '';
                    unit.value = '';
                    tax_rate.value = null;
                    combo_detail_code.value = '';
                    combo_name.value = '';
                    combo_unit.value = '';
                    quantity.value = null;
                })
                .catch((error) => {
                    toast.error("Có lỗi xảy ra khi cập nhật sản phẩm");
                    console.log(error);
                });
            } else {
                toast.error("Vui lòng kiểm tra lại các trường dữ liệu bắt buộc");
            }
        };

        const confirmDelete = () => {
            if (!deleteId.value) return;
            axios.delete(`${baseUrl}/api/product/${deleteId.value}`)
                .then(() => {
                    toast.success('Xoá sản phẩm thành công');
                    getProduct();
                    deleteId.value = null;
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                    modal.hide();
                })
                .catch((error) => {
                    toast.error('Xoá sản phẩm thất bại');
                    console.log(error);
                });
        };

        const changePage = (page) => {
            currentPage.value = page;
            getProduct();
        };

        const getProductID = (id) => {
            axios
                .get(`${baseUrl}/api/product/${id}`)
                .then((response) => {
                    const data = response.data;
                    productId.value = data.id;
                    market_code.value = data.market_code;
                    accounting_system_code.value = data.accounting_system_code;
                    product_name.value = data.product_name;
                    unit.value = data.unit;
                    tax_rate.value = data.tax_rate;
                    combo_detail_code.value = data.combo_detail_code;
                    combo_name.value = data.combo_name;
                    combo_unit.value = data.combo_unit;
                    quantity.value = data.quantity;
                })
                .catch((error) => {
                    toast.error('Lấy thông tin sản phẩm thất bại');
                    console.log(error);
                });
        };

        watch(searchKeyword, () => {
            currentPage.value = 1;
            getProduct();
        });

        getProduct();

        return {
            productList,
            searchKeyword,
            deleteId,
            currentPage,
            totalPages,
            totalProducts, // return totalProducts
            changePage,
            getProductID,
            confirmDelete,
            createProduct,
            updateProduct,
            // Product data properties
            market_code,
            accounting_system_code,
            product_name,
            unit,
            tax_rate,
            combo_detail_code,
            combo_name,
            combo_unit,
            quantity,
            // Validation properties
            marketCodeValid,
            accountingSystemCodeValid,
            productNameValid,
        };
    },
    methods: {
        hasPermission
    }
});
</script>
