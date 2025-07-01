<template>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h3 class="mb-0">Danh sách người dùng</h3>

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center mb-0 lh-1">
            <li class="breadcrumb-item">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                    <span class="text-secondary fw-medium hover">Trang chủ</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="fw-medium">Người dùng</span>
            </li>
        </ol>
    </nav>
</div>

<div class="card bg-white border-0 rounded-3 mb-4">
    <div class="card-body p-25">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <form class="position-relative table-src-form me-0">
                <input type="text" class="form-control border-0" placeholder="Tìm kiếm người dùng...." v-model="searchKeyword" />
                <i class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y text-secondary">search</i>
            </form>
            <button class="btn btn-outline-primary fw-medium rounded-3 hover-bg" data-bs-toggle="modal" data-bs-target="#createModal" v-if="hasPermission('user.create')">
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
                                Họ và tên
                            </th>
                            <th scope="col">
                                Email
                            </th>
                            <th scope="col">
                                Số điện thoại
                            </th>
                             <th scope="col">
                                Công ty
                            </th>
                             <th scope="col">
                                Mã số thuế
                            </th>

                            <th scope="col">
                                Ngày đăng ký
                            </th>
                            <th scope="col">
                                Ngày hết hạn
                            </th>
                            <th scope="col">
                                Thời gian
                            </th>
                            <th scope="col">
                                Trạng thái
                            </th>

                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(Items, index) in user" :key="index">
                            <td>
                                {{ index + 1 }}
                            </td>
                            <td>{{ Items.name }}</td>
                            <td class="text-secondary">{{ Items.email }}</td>
                            <td class="text-secondary">{{ Items.phone}}</td>
                            <td class="text-secondary">{{ Items.companyName}}</td>
                            <td class="text-secondary">{{ Items.companyTax}}</td>
                            <td class="text-secondary">{{ Items.create_package}}</td>
                            <td class="text-secondary">{{ Items.expiration_package}}</td>
                            <td class="text-secondary">{{ Items.duration }}</td>
                            <td v-if="Items.status === 1" class="text-secondary">
                                <span class="badge bg-success bg-opacity-10 text-success fw-normal">Hoạt động</span>
                            </td>
                            <td v-else class="text-secondary">
                                <span class="badge bg-danger bg-opacity-10 text-danger fw-normal">Ngưng hoạt động</span>
                            </td>
                            <td class="text-secondary d-flex gap-2">
                                <button class="btn btn-sm btn-light d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#updateModal" @click="getUserID(Items.id)">
                                    <i class="material-symbols-outlined fs-16 text-body">edit</i>
                                </button>
                                <button class="btn btn-sm btn-light d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#deleteModal" @click="deleteId = Items.id">
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
  <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;">
    <div class="modal-content rounded-0">
      <div class="modal-header border-0 p-4 border-bottom">
        <h1 class="modal-title fs-18" id="createModal">Thêm mới người dùng</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>
      <div class="modal-body p-4">
        <form>
          <div class="row">

            <!-- Họ và tên -->
            <div class="form-group mb-4 col-lg-12">
              <label class="label text-secondary">Họ và tên</label>
              <input v-model="name" type="text" class="form-control h-60" placeholder="Họ và tên..." :class="{'is-invalid': errors.name}">
              <div v-if="errors.name" class="invalid-feedback">{{ errors.name[0] }}</div>
            </div>

            <!-- Email -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Email</label>
              <input v-model="email" type="email" class="form-control h-60" placeholder="abc@gmail.com" :class="{'is-invalid': errors.email}">
              <div v-if="errors.email" class="invalid-feedback">{{ errors.email[0] }}</div>
            </div>

            <!-- Số điện thoại -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Số điện thoại</label>
              <input v-model="phone" type="text" class="form-control h-60" placeholder="012345678" :class="{'is-invalid': errors.phone}">
              <div v-if="errors.phone" class="invalid-feedback">{{ errors.phone[0] }}</div>
            </div>

            <!-- Địa chỉ -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Địa chỉ</label>
              <input v-model="address" type="text" class="form-control h-60" placeholder="Địa chỉ..." :class="{'is-invalid': errors.address}">
              <div v-if="errors.address" class="invalid-feedback">{{ errors.address[0] }}</div>
            </div>

            <!-- Ngày hết hạn -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Ngày hết hạn</label>
              <input v-model="expiration_package" type="date" class="form-control h-60" :class="{'is-invalid': errors.expiration_package}">
              <div v-if="errors.expiration_package" class="invalid-feedback">{{ errors.expiration_package[0] }}</div>
            </div>

            <!-- Gói dịch vụ -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Gói dịch vụ</label>
              <select v-model="selectedPackageId" class="form-select form-control h-60">
                <option v-for="pkg in packageList" :key="pkg.id" :value="pkg.id">{{ pkg.name }}</option>
              </select>
            </div>

            <!-- Trạng thái -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Trạng thái</label>
              <select v-model="selectedStatus" class="fform-select form-control h-60">
                <option value="1">Hoạt động</option>
                <option value="0">Ngưng hoạt động</option>
              </select>
            </div>

            <!-- Tên công ty -->
            <div class="form-group mb-4 col-lg-12">
              <label class="label text-secondary">Tên công ty</label>
              <input v-model="companyName" type="text" class="form-control h-60" placeholder="Tên công ty..." :class="{'is-invalid': errors.companyName}">
              <div v-if="errors.companyName" class="invalid-feedback">{{ errors.companyName[0] }}</div>
            </div>

            <!-- Mã số thuế -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Mã số thuế</label>
              <input v-model="companyTax" type="text" class="form-control h-60" placeholder="Mã số thuế..." :class="{'is-invalid': errors.companyTax}">
              <div v-if="errors.companyTax" class="invalid-feedback">{{ errors.companyTax[0] }}</div>
            </div>

            <!-- Nhóm quyền -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Nhóm quyền</label>
              <select v-model="selectedRole" class="form-select form-control h-60" :class="{'is-invalid': errors.role_id}">
                <option v-for="r in role" :key="r.id" :value="r.id">{{ r.name }}</option>
              </select>
              <div v-if="errors.role_id" class="invalid-feedback">{{ errors.role_id[0] }}</div>
            </div>

            <!-- Ghi chú -->
            <div class="form-group mb-4 col-lg-12">
              <label class="label text-secondary">Ghi chú</label>
              <textarea v-model="note" class="form-control text-dark" placeholder="Ghi chú..." rows="3"></textarea>
            </div>

            <!-- Buttons -->
            <div class="col-lg-12">
              <div class="d-flex justify-content-end flex-wrap gap-3">
                <button type="button" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary py-2 px-4 fw-medium fs-16" @click="createUser">
                  <i class="ri-add-line text-white fw-medium"></i> Tạo mới
                </button>
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
        <h1 class="modal-title fs-18" id="updateModal">Cập nhật người dùng</h1>
        <button type="button" class="btn-close campaigns-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form>
          <div class="row">

            <!-- Họ và tên -->
            <div class="form-group mb-4 col-lg-12">
              <label class="label text-secondary">Họ và tên</label>
              <input v-model="name" type="text" class="form-control h-60" placeholder="Họ và tên..." :class="{'is-invalid': errors.name}">
              <div v-if="errors.name" class="invalid-feedback">{{ errors.name[0] }}</div>
            </div>

            <!-- Email (disabled) -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Email</label>
              <input disabled v-model="email" type="email" class="form-control h-60" placeholder="abc@gmail.com">
            </div>

            <!-- Số điện thoại -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Số điện thoại</label>
              <input v-model="phone" type="text" class="form-control h-60" placeholder="012345678" :class="{'is-invalid': errors.phone}">
              <div v-if="errors.phone" class="invalid-feedback">{{ errors.phone[0] }}</div>
            </div>

            <!-- Địa chỉ -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Địa chỉ</label>
              <input v-model="address" type="text" class="form-control h-60" placeholder="Địa chỉ..." :class="{'is-invalid': errors.address}">
              <div v-if="errors.address" class="invalid-feedback">{{ errors.address[0] }}</div>
            </div>

            <!-- Ngày hết hạn -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Ngày hết hạn</label>
              <input v-model="expiration_package" type="date" class="form-control h-60" :class="{'is-invalid': errors.expiration_package}">
              <div v-if="errors.expiration_package" class="invalid-feedback">{{ errors.expiration_package[0] }}</div>
            </div>

            <!-- Gói dịch vụ -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Gói dịch vụ</label>
              <select v-model="selectedPackageId" class="form-select form-control h-60">
                <option v-for="pkg in packageList" :key="pkg.id" :value="pkg.id">{{ pkg.name }}</option>
              </select>
            </div>

            <!-- Trạng thái -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Trạng thái</label>
              <select v-model="selectedStatus" class="form-select form-control h-60">
                <option value="1">Hoạt động</option>
                <option value="0">Ngưng hoạt động</option>
              </select>
            </div>

            <!-- Tên công ty -->
            <div class="form-group mb-4 col-lg-12">
              <label class="label text-secondary">Tên công ty</label>
              <input v-model="companyName" type="text" class="form-control h-60" placeholder="Tên công ty..." :class="{'is-invalid': errors.companyName}">
              <div v-if="errors.companyName" class="invalid-feedback">{{ errors.companyName[0] }}</div>
            </div>

            <!-- Mã số thuế -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Mã số thuế</label>
              <input v-model="companyTax" type="text" class="form-control h-60" placeholder="Mã số thuế..." :class="{'is-invalid': errors.companyTax}">
              <div v-if="errors.companyTax" class="invalid-feedback">{{ errors.companyTax[0] }}</div>
            </div>

            <!-- Nhóm quyền -->
            <div class="form-group mb-4 col-lg-6">
              <label class="label text-secondary">Nhóm quyền</label>
              <select v-model="selectedRole" class="form-select form-control h-60" :class="{'is-invalid': errors.role_id}">
                <option v-for="r in role" :key="r.id" :value="r.id">{{ r.name }}</option>
              </select>
              <div v-if="errors.role_id" class="invalid-feedback">{{ errors.role_id[0] }}</div>
            </div>

            <!-- Ghi chú -->
            <div class="form-group mb-4 col-lg-12">
              <label class="label text-secondary">Ghi chú</label>
              <textarea v-model="note" class="form-control text-dark" placeholder="Ghi chú..." rows="3"></textarea>
            </div>

            <!-- Buttons -->
            <div class="col-lg-12">
              <div class="d-flex justify-content-end flex-wrap gap-3">
                <button type="button" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary py-2 px-4 fw-medium fs-16" @click="updateUser">
                  <i class="ri-add-line text-white fw-medium"></i> Cập nhật
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
</div>
</template>

<script>
import { defineComponent, ref, watch, inject } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toast-notification';
import { hasPermission } from '@/utils/permission';

export default defineComponent({
    setup() {
        const packageList = ref([]);
        const role = ref([]);
        const user = ref([]);
        const name = ref('');
        const phone = ref('');
        const address = ref('');
        const email = ref('');
        const companyName = ref('');
        const companyTax = ref('');
        const expiration_package = ref('');
        const note = ref('');
        const errors = ref({}); // Lưu lỗi server
        const toast = useToast();
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

        const getUser = () => {
            const params = {
                page: currentPage.value,
                per_page: perPage.value
            };
            if (searchKeyword.value.trim() !== '') {
                params.search = searchKeyword.value.trim();
            }
            axios.get(`${baseUrl}/api/user`, { params })
                .then((response) => {
                    const usersData = response.data.users.data;
                    const pagination = response.data.users;
                    user.value = usersData.map(u => {
                        const now = new Date();
                        const end = u.expiration_package ? new Date(u.expiration_package) : null;
                        let duration = '';
                        if (end) {
                            const diffTime = end.getTime() - now.getTime();
                            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                            if (diffDays < 0) {
                                duration = `Hết hạn ${Math.abs(diffDays)} ngày`;
                            } else {
                                const diffMonths = Math.floor(diffDays / 30);
                                duration = diffMonths > 0 ? `${diffMonths} tháng` : `${diffDays} ngày`;
                            }
                        }
                        return { ...u, duration };
                    });
                    packageList.value = response.data.packages;
                    const defaultPkg = packageList.value.find(p => p.default_packages === 1);
                    if (defaultPkg) {
                    selectedPackageId.value = defaultPkg.id;
                    if (defaultPkg.expiration_time) {
                        const now = new Date();
                        now.setDate(now.getDate() + parseInt(defaultPkg.expiration_time));
                        const yyyy = now.getFullYear();
                        const mm = String(now.getMonth() + 1).padStart(2, '0');
                        const dd = String(now.getDate()).padStart(2, '0');
                        expiration_package.value = `${yyyy}-${mm}-${dd}`;
                    }
                }
                    role.value = response.data.role;
                    const defaultRole = role.value.find(r => r.default_role === 1);
                    if (defaultRole) selectedRole.value = defaultRole.id;
                    totalPages.value = pagination.last_page;
                })
                .catch(console.log);
        };

        const createUser = () => {
            axios.post(`${baseUrl}/api/user`, {
                name: name.value,
                phone: phone.value,
                address: address.value,
                email: email.value,
                expiration_package: expiration_package.value,
                packages_id: selectedPackageId.value,
                status: selectedStatus.value,
                note: note.value,
                role_id: selectedRole.value,
                companyName: companyName.value,
                companyTax: companyTax.value,
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
                companyTax.value = '';
                companyName.value = '';
                selectedRole.value = null;
                errors.value = {}; // clear lỗi
            })
            .catch((error) => {
                const response = error.response;
                if (response?.data?.errors) {
                    errors.value = response.data.errors;
                } else {
                    errors.value = {};
                    const message = response?.data?.message || "Có lỗi xảy ra khi tạo người dùng";
                    toast.error(message);
                }
                console.log(error);
            });
        };

        const updateUser = () => {
    axios.put(`${baseUrl}/api/user/${userId.value}`, {
        name: name.value,
        phone: phone.value,
        address: address.value,
        email: email.value,
        expiration_package: expiration_package.value,
        packages_id: selectedPackageId.value,
        status: selectedStatus.value,
        note: note.value,
        role_id: selectedRole.value,
        companyName: companyName.value,
        companyTax: companyTax.value,
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
        companyTax.value = '';
        companyName.value = '';
        selectedRole.value = null;
        errors.value = {};
    })
    .catch((error) => {
        const response = error.response;
        if (response?.data?.errors) {
            errors.value = response.data.errors;
        } else {
            errors.value = {};
            const message = response?.data?.message || "Có lỗi xảy ra khi cập nhật người dùng";
            toast.error(message);
        }
        console.log(error);
    });
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
            axios.get(`${baseUrl}/api/user/${id}`)
                .then((response) => {
                    const data = response.data;
                    name.value = data.name;
                    phone.value = data.phone;
                    email.value = data.email;
                    address.value = data.address;
                    expiration_package.value = data.expiration_package;
                    note.value = data.note;
                    selectedPackageId.value = data.packages_id ?? null;
                    selectedStatus.value = data.status;
                    userId.value = data.id;
                    selectedRole.value = data.role_id ?? null;
                    companyTax.value = data.companyTax;
                    companyName.value = data.companyName;
                })
                .catch((error) => {
                    toast.error('Lấy thông tin người dùng thất bại');
                    console.log(error);
                });
        };

        watch(searchKeyword, () => {
            currentPage.value = 1;
            getUser();
        });

        getUser();

        return {
            user, name, phone, address, email, expiration_package, note,
            createUser, deleteId, confirmDelete, searchKeyword, currentPage, totalPages,
            changePage, packageList, selectedPackageId, selectedStatus, getUserID, userId,
            updateUser, role, selectedRole, companyTax, companyName, errors,
        };
    },
    methods: { hasPermission }
});

</script>
