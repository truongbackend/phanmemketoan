const adminRoutes = [
    {
        path: "/app",
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
            },
             {
                path: "notification",
                name: "admin-notification",
                component: () =>import ("../page/admin/notification/index.vue"),
            },
            {
                path: "role",
                name: "admin-role",
                component: () =>import("../page/admin/role/index.vue"),
            },
            {
                path: "setting",
                name: "admin-setting",
                component: () =>import ("../page/admin/setting/index.vue"),
            },
            {
                path: "setting/lazada",
                name: "admin-setting-lazada",
                component: () =>import ("../page/admin/setting/lazada.vue"),
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
                path: "revenue",
                name: "admin-revenue",
                component: () =>import ("../page/admin/revenue/index.vue"),
            },
            {
                path: "sales-channel/channel-connection/lazada",
                name: "channel-connection-lazada",
                component: () =>import ("../page/ecommerce/lazada/index.vue"),
            },
            {
                path: "sales-channel/channel-connection/lazada/invoice",
                name: "channel-connection-lazada-invoice",
                component: () =>import ("../page/ecommerce/lazada/invoice.vue"),
            },
            {
                path: "sales-channel/channel-connection/shopee",
                name: "admin-channel-connection-shopee",
                component: () =>import ("../page/ecommerce/shopee/index.vue"),
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
            path: "cart",
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
