const adminRoutes = [
    {
        path: "/admin",
        component: () =>import ("../layouts/AdminLayout.vue"),
        children: [
            {
                path: "accounting",
                icon: 'calculate',
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
             {
                path: "notification",
                name: "admin-notification",
                component: () =>import ("../page/admin/notification/index.vue"),
            },
            {
                path: "role",
                name: "admin-role",
                component: () => import("../page/admin/role/index.vue"),
            }
        ]
    },
    {
    path: "/",
    component: () => import("../layouts/AuthLayout.vue"),
    children: [
        {
            path: "",
            name: "home",
            component: () => import("../page/client/home.vue"),
        },
        {
            path: "login",
            name: "login",
            component: () => import("../page/auth/login.vue"),
        },
        {
            path: "register",
            name: "register",
            component: () => import("../page/auth/register.vue"),
        },
    ]
}

];

export default adminRoutes;
