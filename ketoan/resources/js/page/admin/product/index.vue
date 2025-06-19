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

        </div>
        <vue3-datatable
            :rows="rows"
            :columns="cols"
            :loading="loading"
            :totalRows="total_rows"
            :isServerMode="true"
            :pageSize="params.pagesize"
            :showFirstPage="false"
            :showLastPage="false"
            @change="changeServer"
            />

    </div>
</div>

</template>
<script setup lang="ts">
    import { ref,reactive,onMounted, toRaw } from 'vue';
import Vue3Datatable from '@bhplugin/vue3-datatable'
import '@bhplugin/vue3-datatable/dist/style.css'
    const loading: any = ref(true);
    const total_rows = ref(0);

    const params = reactive({ current_page: 1, pagesize: 10 });
    const rows: any = ref(null);

    const cols =
        ref([
            { field: 'id', title: 'ID', isUnique: true, type: 'number' },
            { field: 'firstName', title: 'First Name' },
            { field: 'lastName', title: 'Last Name' },
            { field: 'email', title: 'Email' },
            { field: 'age', title: 'Age', type: 'number' },
            { field: 'dob', title: 'Birthdate', type: 'date' },
            { field: 'address.city', title: 'City' },
            { field: 'isActive', title: 'Active', type: 'bool' },
        ]) || [];

    onMounted(() => {
        setTimeout(() => {
            getUsers1();
        }, 10);
    });

    const changeServer = (data: any) => {
        params.current_page = data.current_page;
        params.pagesize = data.pagesize;
    };

    // disable first last pagination
    const loading1: any = ref(true);
    const total_rows1 = ref(0);

    const params1 = reactive({ current_page: 1, pagesize: 10 });
    const rows1: any = ref(null);

    const cols1 =
        ref([
            { field: 'id', title: 'ID', isUnique: true, type: 'number' },
            { field: 'firstName', title: 'First Name' },
            { field: 'lastName', title: 'Last Name' },
            { field: 'email', title: 'Email' },
            { field: 'age', title: 'Age', type: 'number' },
            { field: 'dob', title: 'Birthdate', type: 'date' },
            { field: 'address.city', title: 'City' },
            { field: 'isActive', title: 'Active', type: 'bool' },
        ]) || [];

   const getUsers1 = async () => {
    loading.value = true;

    await new Promise(r => setTimeout(r, 500)) // giả lập delay

    rows.value = Array.from({ length: 10 }, (_, i) => ({
        id: i + 1 + (params.current_page - 1) * params.pagesize,
        firstName: `Tên ${i + 1}`,
        lastName: `Họ`,
        email: `user${i}@example.com`,
        age: 20 + i,
        dob: '2000-01-01',
        address: { city: 'Hà Nội' },
        isActive: i % 2 === 0,
    }));

    total_rows.value = 50; // giả lập có 50 bản ghi
    loading.value = false;
};

</script>
<style>
    .alt-pagination .bh-pagination .bh-page-item {
        @apply !w-max min-w-[32px] !rounded;
    }

    /* next-prev-pagination */
    .next-prev-pagination .bh-pagination .bh-page-item {
        @apply !w-max min-w-[100px] !rounded;
    }
    .next-prev-pagination .bh-pagination > div:first-child {
        @apply flex-col font-semibold;
    }
    .next-prev-pagination .bh-pagination .bh-pagination-number {
        @apply mx-auto gap-3;
    }
</style>
