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
                        <div class="dropdown notifications noti" v-cloak>
                            <button class="btn btn-secondary border-0 p-0 position-relative badge" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="material-symbols-outlined">notifications</span>
                                <span v-if="unreadCount > 0" class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                    {{ unreadCount }}
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-lg p-0 border-0 dropdown-menu-end" style="min-width: 320px;">
                                <div class="d-flex justify-content-between align-items-center title p-3">
                                    <span class="fw-semibold fs-15 text-secondary">
                                        Thông báo
                                        <span class="fw-normal text-body fs-14">({{ notifications.length }})</span>
                                    </span>
                                    <button class="p-0 m-0 bg-transparent border-0 fs-14 text-primary" @click="markAllRead">
                                        Đánh dấu đã xem
                                    </button>
                                </div>

                                <div class="overflow-auto" style="max-height: 380px;" data-simplebar>
                                    <div v-for="note in notifications" :key="note.id" class="notification-menu" :class="{ unseen: !note.read_at }">
                                        <router-link :to="{ name: 'admin-notification' }" class="dropdown-item">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <i class="material-symbols-outlined" :class="iconClass(note.type)">{{ iconName(note.type) }}</i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="mb-1">{{ note.content }}</p>
                                                    <small class="fs-13 text-muted">{{ formatAgo(note.created_at) }}</small>
                                                </div>
                                            </div>
                                        </router-link>
                                    </div>
                                    <div v-if="notifications.length === 0" class="p-3 text-center text-muted">
                                        Không có thông báo
                                    </div>
                                </div>

                                <router-link :to="{ name: 'admin-notification' }" class="dropdown-item text-center text-primary d-block view-all fw-medium rounded-bottom-3">
                                    Xem tất cả thông báo
                                </router-link>
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
                                            <span class="ms-2">Logout</span>
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
    };
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
    // Logout
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
        .get("/api/notifications", { params: { per_page: 10 } })
        .then((res) => {
          this.notifications = res.data.data;
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
