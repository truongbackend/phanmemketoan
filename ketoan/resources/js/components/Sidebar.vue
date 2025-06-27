<template>
<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="#" class="d-block text-decoration-none position-relative">
            <span class="fs-5 fw-bold text-dark">PNL INTERNATIONAL</span>
        </a>
        <button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>

    <aside id="layout-menu" class="layout-menu menu-vertical menu" data-simplebar>
        <ul class="menu-inner">
        <li class="menu-item" v-if="hasPermission('notification.list')">
                <router-link :to="{ name: 'admin-dashboard' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Nổi bật</span>
                </router-link>
            </li>
            <li class="menu-title small">
                <span class="menu-title-text">Thương mại điện tử</span>
            </li>
            <li class="menu-item" v-if="hasPermission('notification.list')">
                <router-link :to="{ name: 'admin-order' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">shopping_bag</span>
                    <span class="title">Đơn hàng</span>
                </router-link>
            </li>
            <li class="menu-item" >
                <router-link :to="{ name: 'admin-delivery' }" class="menu-link" >
                    <span class="material-symbols-outlined menu-icon">calculate</span>
                    <span class="title">Xuất hoá đơn giao hàng</span>
                </router-link>
            </li>
            <li class="menu-item" v-if="hasPermission('product.list')">
                <router-link :to="{ name: 'admin-product' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">dataset</span>
                    <span class="title">Hàng hoá</span>
                </router-link>
            </li>

            <li class="menu-item" v-if="hasPermission('complaints.list')">
                <router-link :to="{ name: 'admin-storedProcedure' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">move_down</span>
                    <span class="title">Đối soát</span>
                </router-link>
            </li>

            <li class="menu-item" v-if="hasPermission('report.list')">
                <router-link :to="{ name: 'admin-accounting' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">pie_chart</span>
                    <span class="title">Báo cáo</span>
                </router-link>
            </li>
            <li class="menu-title small">
                <span class="menu-title-text">Hệ thống</span>
            </li>
             <li class="menu-item" v-if="hasPermission('package.list')">
                <router-link :to="{ name: 'admin-package' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">local_activity</span>
                    <span class="title">Gói dịch vụ</span>
                </router-link>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">account_box</span>
                    <span class="title">Người dùng</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item" v-if="hasPermission('role.list')">
                        <router-link :to="{ name: 'admin-role' }" class="menu-link" >
                            Nhóm quyền
                        </router-link>
                    </li>
                    <li class="menu-item" v-if="hasPermission('user.list')">
                        <router-link :to="{ name: 'admin-user' }" class="menu-link">
                            Người dùng
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="menu-item" v-if="hasPermission('notification.list')">
                <router-link :to="{ name: 'admin-notification' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">notifications</span>
                    <span class="title">Thông báo</span>
                </router-link>
            </li>

            <li class="menu-item" v-if="hasPermission('complaints.list')">
                <router-link :to="{ name: 'admin-complaints' }" class="menu-link">
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
            <li class="menu-title small">
                <span class="menu-title-text">Sàn thương mại điện tử</span>
            </li>
            <li class="menu-item" v-if="hasPermission('complaints.list')">
                <router-link :to="{ name: 'admin-setting' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">settings</span>
                    <span class="title">Thiết lập</span>
                </router-link>
            </li>
            <li class="menu-item" v-if="hasPermission('complaints.list')">
                <router-link :to="{ name: 'admin-saleonlineOrder' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">shopping_bag</span>
                    <span class="title">Đơn hàng</span>
                </router-link>
            </li>
             <li class="menu-item" v-if="hasPermission('complaints.list')">
                <router-link :to="{ name: 'admin-setting' }" class="menu-link">
                    <span class="material-symbols-outlined menu-icon">view_timeline</span>
                    <span class="title">Công nợ</span>
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
<style scope>
a.router-link-active.router-link-exact-active.menu-link {
  background-color: #ECF0FF;
  color:rgb(12, 120, 243);
}
</style>
