<template>
<header class="header-area bg-white mb-4 rounded-bottom-15" id="header-area">
    <div class="row align-items-center">
        <div class="col-lg-4 col-sm-6">
            <div class="left-header-content">
                <ul class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-sm-start">
                    <li>
                        <button class="header-burger-menu bg-transparent p-0 border-0" id="header-burger-menu">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                    </li>
                    <li>
                        <form class="src-form position-relative">
                            <input type="text" class="form-control" placeholder="Search here....." />
                            <button type="submit" class="src-btn position-absolute top-50 end-0 translate-middle-y bg-transparent p-0 border-0">
                                <span class="material-symbols-outlined">search</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-8 col-sm-6">
            <div class="right-header-content mt-2 mt-sm-0">
                <ul class="d-flex align-items-center justify-content-center justify-content-sm-end ps-0 mb-0 list-unstyled">
                    <li class="header-right-item">
                        <div class="light-dark">
                            <button class="switch-toggle settings-btn dark-btn p-0 bg-transparent border-0" id="switch-toggle">
                                <span class="dark"><i class="material-symbols-outlined">light_mode</i></span>
                                <span class="light"><i class="material-symbols-outlined">dark_mode</i></span>
                            </button>
                        </div>
                    </li>

                    <li class="header-right-item">
                        <button class="fullscreen-btn bg-transparent p-0 border-0" id="fullscreen-button">
                            <i class="material-symbols-outlined text-body">fullscreen</i>
                        </button>
                    </li>
                    <li class="header-right-item" id="notification-dropdown">
                        <div class="dropdown notifications noti" v-cloak data-bs-auto-close="outside">
                            <button class="btn btn-secondary border-0 p-0 position-relative badge" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="material-symbols-outlined">notifications_active</span>
                            </button>
                            <div class="dropdown-menu dropdown-lg p-0 border-0 dropdown-menu-end rounded-3" style="min-width: 450px;">
                                <div class="d-flex justify-content-between align-items-center title p-3">
                                    <span class="fw-semibold fs-20 text-secondary">
                                        Thông báo
                                    </span>
                                    <button class="p-0 m-0 bg-transparent border-0 fs-14 text-primary" @click="markAllRead">
                                        Đánh dấu tất cả đã đọc
                                    </button>
                                </div>
                                <ul class="nav nav-tabs px-3 pt-3 pb-2" role="tablist">
                                    <li class="nav-item me-4">
                                        <button class="nav-link p-0 fs-13" :class="{ active: activeTab==='all' }" @click.stop="activeTab='all'">
                                            Tất cả <span class="text-muted fs-12">({{ counts.all }})</span>
                                        </button>
                                    </li>
                                    <li class="nav-item me-4">
                                        <button class="nav-link p-0 fs-13" :class="{ active: activeTab==='system' }" @click.stop="activeTab='system'">
                                            Hệ thống <span class="text-muted fs-12">({{ counts.system }})</span>
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link p-0 fs-13" :class="{ active: activeTab==='warning' }" @click.stop="activeTab='warning'">
                                            Cảnh báo <span class="text-muted fs-12">({{ counts.warning }})</span>
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active overflow-auto" data-simplebar style="max-height: 580px;min-height:580px;" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">
                                        <div v-for="note in filteredNotifications" :key="note.id" class="notification-menu d-flex align-items-start" :class="{ unseenNotificitons: !note.read_at }">
                                            <router-link :to="{ name: 'admin-notification' }" class="dropdown-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="material-symbols-outlined" :class="iconClass(note.type)">{{ iconName(note.type) }}</i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <p class="fs-13 text-dark">{{ note.title }}</p>
                                                        <p>
                                                            <span class="fw-semibold fs-13 text-primary" @click="selectNote(note)" data-bs-toggle="modal" data-bs-target="#detailModal">
                                                                Xem chi tiết
                                                            </span>
                                                        </p>
                                                        <small class="fs-13 text-muted">{{ formatAgo(note.created_at) }}</small>
                                                    </div>
                                                </div>
                                            </router-link>
                                        </div>
                                        <div v-if="notifications.length === 0" class="p-3 text-center text-muted">
                                            Không có thông báo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="header-right-item">
                        <div class="dropdown admin-profile">
                            <div class="d-xxl-flex align-items-center bg-transparent border-0 text-start p-0 cursor dropdown-toggle" data-bs-toggle="dropdown">
                                <div class="flex-shrink-0">
                                    <img class="rounded-circle wh-40 administrator" src="/assets/images/administrator.jpg" alt="admin" />
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-none d-xxl-block">
                                            <div class="d-flex align-content-center">
                                                <h3>{{ userName }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-menu border-0 bg-white dropdown-menu-end">
                                <div class="d-flex align-items-center info">
                                    <div class="flex-shrink-0">
                                        <img class="rounded-circle wh-30 administrator" src="/assets/images/administrator.jpg" alt="admin" />
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h3 class="fw-medium">{{ userName }}</h3>
                                    </div>
                                </div>
                                <ul class="admin-link ps-0 mb-0 list-unstyled">
                                    <li>
                                        <router-link :to="{ name: 'admin-profile' }" class="dropdown-item admin-item-link d-flex align-items-center text-body" href="my-profile.html">
                                            <i class="material-symbols-outlined">account_circle</i>
                                            <span class="ms-2">Hồ sơ cá nhân</span>
                                        </router-link>
                                    </li>
                                    <li>
                                        <a @click="logout" class="dropdown-item admin-item-link d-flex align-items-center text-body" style="cursor: pointer">
                                            <i class="material-symbols-outlined">logout</i>
                                            <span class="ms-2">Đăng xuất</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog" style="max-width:650px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">{{ selectedNote?.title }}</h5>
            </div>
            <div class="modal-body" v-if="selectedNote?.content">
                <p>{{ selectedNote.content }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Cookies from "js-cookie";
import axios from "axios";

export default {
    name: "Header",
    data() {
        return {
            userName: null,
            notifications: [],
            unreadCount: 0,
            activeTab: 'all',
            selectedNote: null,
        };
    },
    computed: {
        counts() {
            return {
                all: this.notifications.length,
                system: this.notifications.filter(n => n.type === 'system').length,
                warning: this.notifications.filter(n => n.type === 'warning').length,
            };
        },
        filteredNotifications() {
            if (this.activeTab === 'all') return this.notifications;
            return this.notifications.filter(n => n.type === this.activeTab);
        }
    },
    mounted() {
        const user = JSON.parse(localStorage.getItem("user"));
        if (user && user.name) {
            this.userName = user.name;
        }
        this.fetchNotifications();
        if (window.Echo && user && user.id) {
            Echo.private(`App.Models.User.${user.id}`)
                .notification(() => {
                    this.fetchNotifications();
                });
        }
    },
    methods: {
        selectNote(note) {
            this.selectedNote = note;
        },
        async logout() {
            try {
                const response = await axios.post("/api/logout");
                if (response.status === 200) {
                    localStorage.removeItem("user");
                    Cookies.remove("token");
                    this.$router.push("/login");
                }
            } catch (error) {
                console.error("Có lỗi khi đăng xuất", error);
            }
        },
        fetchNotifications() {
            axios
                .get("/api/notifications", {
                    params: {
                        per_page: 10
                    }
                })
                .then((res) => {
                    this.notifications = res.data.data.map(note => ({
                        ...note,
                        type: note.type == 1 ?
                            'warning' : note.type == 2 ?
                            'system' : note.type,
                        read_at: note.pivot.read_at
                    }));
                    this.unreadCount = this.notifications.filter(n => !n.pivot.read_at).length;
                })
                .catch((err) => {
                    console.error("Fetch notifications failed:", err);
                });
        },
        markAllRead() {
            axios
                .post("/api/notifications/mark-read-all")
                .then(() => {
                    this.notifications.forEach(n => (n.read_at = new Date().toISOString()));
                    this.unreadCount = 0;
                })
                .catch(err => {
                    console.error("Mark all read failed:", err);
                });
        },
        async selectNote(note) {
            this.selectedNote = note;
            try {
                await axios.post(`/api/notifications/${note.id}/mark-read`);
                note.read_at = new Date().toISOString();
                this.unreadCount = this.notifications.filter(n => !n.read_at).length;
            } catch (err) {
                console.error('Mark read failed:', err);
            }
            const modal = new bootstrap.Modal(this.$refs.detailModal);
            modal.show();
        },
        formatAgo(datetime) {
            const diff = (Date.now() - new Date(datetime)) / 1000;
            if (diff < 60) return `${Math.floor(diff)} giây trước`;
            if (diff < 3600) return `${Math.floor(diff / 60)} phút trước`;
            if (diff < 86400) return `${Math.floor(diff / 3600)} giờ trước`;
            return `${Math.floor(diff / 86400)} ngày trước`;
        },
        iconName(type) {
            switch (type) {
                case "warning":
                    return "warning";
                case "system":
                    return "settings";
                default:
                    return "notifications";
            }
        },
        iconClass(type) {
            switch (type) {
                case "warning":
                    return "text-warning";
                case "system":
                    return "text-info";
                default:
                    return "text-primary";
            }
        },
    },
};
</script>
