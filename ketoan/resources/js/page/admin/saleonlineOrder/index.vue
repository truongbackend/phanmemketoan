<template>
<div class="card border-0 rounded-2 p-4 bg-white mb-4">
    <h3 class="fs-18 mb-4">
        Đơn hàng
    </h3>
    <div class="card-body p-4 py-5 p-xl-5 text-center">
        <h2 class="fs-24 fw-semibold mb-2">Bạn đang bán hàng trên kênh nào?</h2>
        <p class=" fs-14 m-auto">PNL INTERNATIONAL giúp bạn tối ưu thời gian chăm sóc khách hàng và lên đơn nhanh chóng</p>
        <div class="py-4 mb-1">
            <img src="/assets/avatar/onlineOrder.jpg" alt="schedule">
        </div>
        <div class="d-flex flex-wrap gap-2 justify-content-center">
        <a v-for="platform in platforms" :key="platform.name" :href="platform.link" class="platform-btn d-inline-flex align-items-center rounded-2 border text-decoration-none">
            <img :src="platform.icon" :alt="platform.name" class="me-2" />
            <span class="fs-14 fw-semibold">{{ platform.name }}</span>
        </a>
    </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            platforms: [{
                    name: 'Shopee',
                    link: '#',
                    icon: '/assets/avatar/shoppe.png'
                },
                {
                    name: 'Tiktok Shop',
                    link: '#',
                    icon: '/assets/avatar/tiktok.png'
                },
                {
                    name: 'Lazada',
                    link: '#',
                    icon: '/assets/avatar/lazada.jpg'
                },
            ]
        }
    }
}
</script>

<style scoped>
.platform-btn {
    padding: 13px;
    border-color: #e0e0e0;
    color: #333;
    transition: background-color .2s, border-color .2s;
}

.platform-btn img {
    width: 20px;
    height: auto;
}

.platform-btn:hover {
    background-color: #f8f9fa;
    border-color: #ccc;
}
</style>
