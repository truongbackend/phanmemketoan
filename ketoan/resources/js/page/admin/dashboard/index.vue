<template>
  <div class="card border-0 rounded-2 p-4 bg-white mb-4">
    <h3 class="fs-18 mb-4">
      Phần mềm quyết toán – Quản lý nhàn tênh cùng PNL INTERNATIONAL
    </h3>

    <div class="mb-1 pb-4">
      <h4 class="fs-14 fw-semibold text-body-color-50 mb-2">
        Kết nối sàn thương mại điện tử
      </h4>
      <p class="mb-0">
        Quản lý hàng hoá tập trung, xử lý đơn hàng nhanh chóng,
        kiểm soát chính xác hiệu quả bán hàng từ mọi kênh bán.
      </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
      <a
        v-for="platform in platforms"
        :key="platform.name"
        :href="platform.link"
        class="platform-btn d-inline-flex align-items-center rounded-2 border text-decoration-none"
      >
        <img :src="platform.icon" :alt="platform.name" class="me-2" />
        <span class="fs-14 fw-semibold">{{ platform.name }}</span>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      platforms: [
        {
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
