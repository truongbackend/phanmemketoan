<template>
<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="" class="d-block text-decoration-none position-relative">
            <img src="assets/avatar/logo.webp" alt="logo-icon" />
            <span class="logo-text fw-bold text-dark">PNL</span>
        </a>
        <button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>

    <aside id="layout-menu" class="layout-menu menu-vertical menu" data-simplebar>
        <ul class="menu-inner">
            <li class="menu-item" >
                <router-link :to="{ name: 'admin-delivery' }" class="menu-link" >
                    <span class="material-symbols-outlined menu-icon">calculate</span>
                    <span class="title">Xuất hoá đơn giao hàng</span>
                </router-link>
            </li>
            <li class="menu-item" >
                <router-link :to="{ name: 'admin-package' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">local_activity</span>
                    <span class="title">Gói</span>
                </router-link>
            </li>
            <li class="menu-item">
                <router-link :to="{ name: 'admin-product' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">dataset</span>
                    <span class="title">Hàng hoá</span>
                </router-link>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">account_box</span>
                    <span class="title">Hệ thống</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <router-link :to="{ name: 'admin-role' }" class="menu-link">
                            Nhóm quyền
                        </router-link>
                    </li>
                    <li class="menu-item" v-if="hasPermission('user')">
                        <router-link :to="{ name: 'admin-user' }" class="menu-link">
                            Người dùng
                        </router-link>
                    </li>
                    <li class="menu-item">
                        <router-link :to="{ name: 'admin-setting' }" class="menu-link">
                            Cài đặt hệ thống
                        </router-link>
                    </li>

                </ul>
            </li>
            <li class="menu-item">
                <router-link :to="{ name: 'admin-accounting' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">pie_chart</span>
                    <span class="title">Báo cáo</span>
                </router-link>
            </li>
            <li class="menu-item">
                <router-link :to="{ name: 'admin-notification' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">notifications</span>
                    <span class="title">Thông báo</span>
                </router-link>
            </li>
            <li class="menu-item">
                <router-link :to="{ name: 'admin-accounting' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">forum</span>
                    <span class="title">Khiếu nại</span>
                </router-link>
            </li>
            <li class="menu-item">
                <router-link :to="{ name: 'admin-profile' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">contact_page</span>
                    <span class="title">Thông tin tài khoản</span>
                </router-link>
            </li>
        </ul>
    </aside>
</div>
</template>


<script>
export default {
    name: "Sidebar",
};
</script>
