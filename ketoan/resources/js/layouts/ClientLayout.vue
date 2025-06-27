<template>
<div class="container-fluid">
    <div class="main-content d-flex flex-column">
        <Header />
        <Sidebar />
        <div class="main-content-container overflow-hidden">
            <router-view></router-view>
        </div>
        <div class="flex-grow-1"></div>
        <Footer />
    </div>
</div>
</template>


<script>
import Sidebar from '../components/Sidebar.vue';

import { onMounted } from 'vue';

const loadScript = (src) => {
  return new Promise((resolve, reject) => {
    const script = document.createElement('script');
    script.src = src;
    script.onload = resolve;
    script.onerror = reject;
    document.head.appendChild(script);
  });
};

export default {
  name: "AdminLayout",
  components: {
    Sidebar,
    Header,
    Footer
  },
  setup() {
    onMounted(async () => {
      try {
        await loadScript('/assets/js/sidebar-menu.js');
        await loadScript('/assets/js/custom/custom.js');
        await loadScript('/assets/js/simplebar.min.js');
      } catch (error) {
        console.error('Error loading scripts:', error);
      }
    });
    return {};
  }
};
</script>



