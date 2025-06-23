<template>
<div class="container-fluid">
            <div class="main-content d-flex flex-column p-0">
                <div class="m-auto text-center">
                    <img src="/assets/images/error.png" class="mw-430 mb-4 w-100" alt="error">
                    <h3 class="fs-24 mb-3">Có vẻ như chúng tôi không tìm thấy trang này, vui lòng thử lại sau.</h3>
                    <p class="mb-4">Nhưng đừng lo lắng ! Đội ngũ của chúng tôi sẽ khắc phục sớm.</p>
                    <button @click="$router.go(-1)" class="btn btn-primary py-2 px-4 fs-16 fw-medium">
                        <span class="d-inline-block py-1">Quay lại trang chủ</span>
                    </button>
                </div>
            </div>
        </div>
</template>
