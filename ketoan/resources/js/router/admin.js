const adminRoutes = [
    {
        path: "/admin",
        component: () =>import ("../layouts/AdminLayout.vue"),
        children: [
            {
                path: "accounting",
                name: "admin-accounting",
                component: () =>import ("../page/admin/accounting/index.vue"),
            },
            {
                path: "profile",
                name: "admin-profile",
                component: () =>import ("../page/admin/user/profile.vue"),
            },
            {
                path: "user",
                name: "admin-user",
                component: () =>import ("../page/admin/user/index.vue"),
            },
            {
                path: "package",
                name: "admin-package",
                component: () =>import ("../page/admin/package/index.vue"),
            },
        ]
    },
    {
        path: "/",
        component: () =>import ("../layouts/AuthLayout.vue"),
        children: [
            {
                path: "login",
                name: "login",
                component: () =>import ("../page/auth/login.vue"),
            },
        ]
    },
];

export default adminRoutes;
