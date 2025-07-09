<template>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h3 class="mb-0">Xuất hóa đơn</h3>

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center mb-0 lh-1">
            <li class="breadcrumb-item">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                    <span class="text-secondary fw-medium hover">Trang chủ</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="fw-medium">Lazada</span>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="fw-medium">Xuất hóa đơn</span>
            </li>
        </ol>
    </nav>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <h3 class="mb-lg-4 mb-3">Lấy dữ liệu</h3>

                <form>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Chọn ngày xuất hóa đơn từ ngày</label>
                                <input type="date" class="form-control h-55">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Đến ngày</label>
                                <input type="date" class="form-control h-55">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Diễn giải</label>
                                <div class="mb-4">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                           Tên khách hàng
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                                        <label class="form-check-label" for="flexCheckChecked2">
                                            Mã đơn hàng
                                        </label>
                                    </div>
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked3">
                                        <label class="form-check-label" for="flexCheckChecked3">
                                            Tên sản phẩm
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Tên hàng</label>
                                <div class="mb-4">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                           Mã đơn hàng
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                                        <label class="form-check-label" for="flexCheckChecked2">
                                            Tên đơn hàng
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Tài khoản Thuế GTGT</label>
                                <input type="text" class="form-control h-55" value="33311">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Kho</label>
                                <input type="text" class="form-control h-55">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Tài khoản giá vốn</label>
                                <input type="text" class="form-control h-55" value="632">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Tài khoản kho</label>
                                <input type="text" class="form-control h-55" value="1561">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Hình thức thanh toán</label>
                                <select class="form-select form-control h-55" aria-label="Default select example">
                                    <option selected>TM/CK</option>
                                    <option value="1">Chuyển khoản</option>
                                    <option value="1">Tiền mặt</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</button>
                                <button class="btn btn-primary py-2 px-4 fw-medium fs-16"> <i class="ri-add-line text-white fw-medium"></i> Save Information</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>

</script>
