const adminRoutes = [
    {
        path: "/admin",
        component: () =>import ("../layouts/AdminLayout.vue"),
        children: [
            {
                path: "dashboard",
                name: "admin-dashboard",
                component: () =>import ("../page/admin/dashboard/index.vue"),

            },
            {
                path: "accounting",
                name: "admin-accounting",
                component: () =>import ("../page/admin/accounting/index.vue"),

            },
            {
                path: "delivery",
                name: "admin-delivery",

                component: () =>import ("../page/admin/delivery/index.vue"),
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
                path: "product",
                name: "admin-product",
                component: () =>import ("../page/admin/product/index.vue"),
            },
            {
                path: "product/:id",
                name: "admin-product-detail",
                component: () =>import ("../page/admin/product/detail.vue"),
            },
            {
                path: "package",
                name: "admin-package",
                component: () =>import ("../page/admin/package/index.vue"),
                meta: { permission: "packages.index" },
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
            },
            {
                path: "setting",
                name: "admin-setting",
                component: () =>import ("../page/admin/setting/index.vue"),
            },
             {
                path: "storedProcedure",
                name: "admin-storedProcedure",
                component: () =>import ("../page/admin/storedProcedure/index.vue"),
            },
             {
                path: "complaints",
                name: "admin-complaints",
                component: () =>import ("../page/admin/complaints/index.vue"),
            },
            {
                path: "order",
                name: "admin-order",
                component: () =>import ("../page/admin/order/index.vue"),
            },
            {
                path: "saleonlineOrder",
                name: "admin-saleonlineOrder",
                component: () =>import ("../page/admin/saleonlineOrder/index.vue"),
            },
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
            path: "/cart",
            name: "cart",
            component: () => import("../page/client/cart.vue"),
        },
        {
            path: "login",
            name: "login",
            component: () => import("../page/auth/login.vue"),
        },
        {
            path: "forget-password",
            name: "forget-password",
            component: () => import("../page/auth/forgetPassword.vue"),
        },
        {
            path: "register",
            name: "register",
            component: () => import("../page/auth/register.vue"),
        },
        {
            path: "/:pathMatch(.*)*",
            name: "not-found",
            component: () => import("../page/errors/404.vue"),
        },

    ],
},
];


export default adminRoutes;
