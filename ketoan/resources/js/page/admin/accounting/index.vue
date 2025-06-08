<template>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                        <h3 class="mb-0">Kế toán</h3>

                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb align-items-center mb-0 lh-1">
                                <li class="breadcrumb-item">
                                    <a href="#" class="d-flex align-items-center text-decoration-none">
                                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                                        <span class="text-secondary fw-medium hover">Trang chủ</span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span class="fw-medium">Kế toán</span>
                                </li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card bg-white border-0 rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <h4 class="fs-18 mb-4">Kê toán</h4>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="preview-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0">
                                            <ul class="nav nav-tabs justify-content-between border-0 mb-4 wizard-tabs" id="myTabstep" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link wh-48 bg-primary bg-opacity-10 rounded-circle p-0 active" id="step1-tab" data-bs-toggle="tab" data-bs-target="#step1-tab-pane" type="button" role="tab" aria-controls="step1-tab-pane" aria-selected="true">
                                                        <span class="fs-20 fw-bold text-primary">1</span>
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link wh-48 bg-primary bg-opacity-10 rounded-circle p-0" id="step2-tab" data-bs-toggle="tab" data-bs-target="#step2-tab-pane" type="button" role="tab" aria-controls="step2-tab-pane" aria-selected="false">
                                                        <span class="fs-20 fw-bold text-primary">2</span>
                                                    </button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabstepContent">
                                                <div class="tab-pane fade show active" id="step1-tab-pane" role="tabpanel" aria-labelledby="step1-tab" tabindex="0">
                                                    <h4 class="fs-18 fw-semibold">Chọn hệ thống</h4>
                                                    <p class="text-gray-light mb-4">Chọn các sàn mà bạn đang kinh doanh</p>
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">Chọn sàn thương mại điện tử</label>
                                                                    <div class="form-group position-relative">
                                                                        <select class="form-select form-control ps-5 h-55" aria-label="Default select example">
                                                                            <option selected class="text-dark">Chọn sàn thương mại</option>
                                                                            <option value="tiktok" class="text-dark">Tiktok</option>
                                                                            <option value="shoppe" class="text-dark">Shoppe</option>
                                                                            <option value="lazada" class="text-dark">Lazada</option>
                                                                            <option value="vietterpost" class="text-dark">Viettel Post</option>
                                                                        </select>
                                                                        <i class="ri-archive-stack-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">Chọn hệ thống kế toán</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="text" class="form-control text-dark ps-5 h-55" placeholder="Phần mềm Amis">
                                                                        <i class="ri-layout-horizontal-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade" id="step2-tab-pane" role="tabpanel" aria-labelledby="step2-tab" tabindex="0">
                                                    <h4 class="fs-18 fw-semibold">Xuất hóa đơn</h4>
                                                    <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="label">File từ sàn Lazada*</label>
                                                                    <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                                                                        <div class="product-upload">
                                                                            <label for="file-upload" class="file-upload mb-0">
                                                                                <i class="ri-upload-cloud-2-line fs-2 text-gray-light"></i>
                                                                                <span class="d-block fw-semibold text-body">Chọn file cần upload.</span>
                                                                            </label>
                                                                            <input id="file-upload" type="file">
                                                                        </div>
                                                                    </div>
                                                                    <label class="label mt-2">Nhấn vào đây để tải ví dụ từ sàn lazada</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="label">File mã hàng hóa*</label>
                                                                    <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                                                                        <div class="product-upload">
                                                                            <label for="file-upload" class="file-upload mb-0">
                                                                                <i class="ri-upload-cloud-2-line fs-2 text-gray-light"></i>
                                                                                <span class="d-block fw-semibold text-body">Chọn file cần upload.</span>
                                                                            </label>
                                                                            <input id="file-upload" type="file">
                                                                        </div>
                                                                    </div>
                                                                    <label class="label mt-2">Nhấn vào đây để tải ví dụ file Mã hàng hoá</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <p class="text-gray-light mb-4">Liên quan đến File bán hàng</p>
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">Kí tự đầu Số chứng từ</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                        <i class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">Kí tự đầu Số phiếu xuất</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                        <i class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">Mã khách hàng</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                        <i class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">Tên khách hàng</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">TK Tiền/Chi phí/Nợ</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">TK Doanh thu/Có</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">TK thuế GTGT</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">Mã kho</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">TK giá vốn</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">TK kho</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="text-gray-light mb-4">Liên quan đến File Công Nợ</p>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">Kí tự đầu Số chứng từ</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                        <i class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">TK Nợ</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                        <i class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">TK Có</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                        <i class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">Mã đối tượng nợ</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group mb-4">
                                                                    <label class="label">Mã đối tượng có</label>
                                                                    <div class="form-group position-relative">
                                                                        <input type="input" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                                                <div class="form-group d-flex gap-3">
                                                                    <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">Quay lại</button>
                                                                    <button type="submit" class="btn btn-primary py-3 px-5 fw-semibold text-white">Xuất hóa đơn</button>
                                                                </div>
                                                            </div>
                                </div>
                            </div>
                        </div>

                    </div>

</template>
<script>
</script>
