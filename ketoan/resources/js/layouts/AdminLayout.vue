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
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';

export default {
    name: "AdminLayout",
    components: {
        Sidebar,
        Header,
        Footer
    }
};
</script>


<style>
/* Các style chung cho toàn bộ giao diện */
</style>
