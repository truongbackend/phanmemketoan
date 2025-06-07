<template>
    <div class="sidebar-area" id="sidebar-area">
            <div class="logo position-relative">
                <a href="index.html" class="d-block text-decoration-none position-relative">
                    <span class="logo-text fw-bold text-dark">Trezo</span>
                </a>
                <button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu">
                    <i data-feather="x"></i>
                </button>
            </div>

            <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
                <ul class="menu-inner">
                    <li class="menu-title small text-uppercase">
                        <span class="menu-title-text">MAIN</span>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle active">
                            <span class="material-symbols-outlined menu-icon">person</span>
                            <span class="title">Users</span>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="team-members.html" class="menu-link">
                                    Team Members
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="users-list.html" class="menu-link">
                                    Users List
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="add-user.html" class="menu-link">
                                    Add User
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="logout.html" class="menu-link">
                            <span class="material-symbols-outlined menu-icon">logout</span>
                            <span class="title">Logout</span>
                        </a>
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

  <style scoped>
  /* Các style tùy chỉnh cho Sidebar */
  </style>
