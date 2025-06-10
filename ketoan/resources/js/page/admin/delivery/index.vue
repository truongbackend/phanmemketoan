<template>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h3 class="mb-0">Giao hàng</h3>

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center mb-0 lh-1">
            <li class="breadcrumb-item">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                    <span class="text-secondary fw-medium hover">Trang chủ</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span class="fw-medium">Giao hàng</span>
            </li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <h4 class="fs-18 mb-4">Giao hàng</h4>

                <ul class="nav nav-tabs justify-content-between border-0 mb-4 wizard-tabs2" id="myTabstep2" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link p-0 d-flex align-items-center active" id="step5-tab" data-bs-toggle="tab" data-bs-target="#step5-tab-pane" type="button" role="tab" aria-controls="step5-tab-pane" aria-selected="true">
                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">1</span>
                            <div class="text-start ms-3">
                                <h4 class="fs-18 fw-semibold">Thông tin</h4>
                                <p class="text-gray-light mb-0">Chọn</p>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link p-0 d-flex align-items-center" id="step6-tab" data-bs-toggle="tab" data-bs-target="#step6-tab-pane" type="button" role="tab" aria-controls="step6-tab-pane" aria-selected="false">
                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">2</span>
                            <div class="text-start ms-3">
                                <h4 class="fs-18 fw-semibold">Upload file</h4>
                                <p class="text-gray-light mb-0">Import file giao hàng</p>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link p-0 d-flex align-items-center" id="step7-tab" data-bs-toggle="tab" data-bs-target="#step7-tab-pane" type="button" role="tab" aria-controls="step7-tab-pane" aria-selected="false">
                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">3</span>
                            <div class="text-start ms-3">
                                <h4 class="fs-18 fw-semibold">Đơn hàng</h4>
                                <p class="text-gray-light mb-0">Cài đặt</p>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link p-0 d-flex align-items-center" id="step8-tab" data-bs-toggle="tab" data-bs-target="#step8-tab-pane" type="button" role="tab" aria-controls="step8-tab-pane" aria-selected="false">
                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">4</span>
                            <div class="text-start ms-3">
                                <h4 class="fs-18 fw-semibold">Kết quả</h4>
                                <p class="text-gray-light mb-0">Trả kết quả</p>
                            </div>
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabstep2Content">
                    <div class="tab-pane fade show active" id="step5-tab-pane" role="tabpanel" aria-labelledby="step5-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">Đơn vị giao hàng</label>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark ps-5 h-55" placeholder="Viettel Post" disabled>
                                            <i class="ri-bus-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">Phần mềm hỗ trợ</label>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark ps-5 h-55" placeholder="Amis" disabled>
                                            <i class="ri-cake-3-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20" ></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group d-flex gap-3">
                                        <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">Quay lại</button>
                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white">Tiếp tục</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="step6-tab-pane" role="tabpanel" aria-labelledby="step6-tab" tabindex="0">
                        <h4 class="fs-18 fw-semibold">Upload file</h4>
                        <p class="text-gray-light mb-4">Lọc file giao hàng</p>
                        <form>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">File từ sàn Viettel Post</label>
                                        <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                                            <div class="product-upload">
                                                <label for="file-upload" class="file-upload mb-0">
                                                    <i class="ri-upload-cloud-2-line fs-2 text-gray-light"></i>
                                                    <span class="d-block fw-semibold text-body">Thả tập tin vào đây hoặc nhấp để tải lên.</span>
                                                </label>
                                                <input id="file-upload" type="file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">File push sale Viettelpost</label>
                                        <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                                            <div class="product-upload">
                                                <label for="file-upload" class="file-upload mb-0">
                                                    <i class="ri-upload-cloud-2-line fs-2 text-gray-light"></i>
                                                    <span class="d-block fw-semibold text-body">Thả tập tin vào đây hoặc nhấp để tải lên.</span>
                                                </label>
                                                <input id="file-upload" type="file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">File mã hàng hoá</label>
                                        <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                                            <div class="product-upload">
                                                <label for="file-upload" class="file-upload mb-0">
                                                    <i class="ri-upload-cloud-2-line fs-2 text-gray-light"></i>
                                                    <span class="d-block fw-semibold text-body">Thả tập tin vào đây hoặc nhấp để tải lên.</span>
                                                </label>
                                                <input id="file-upload" type="file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">Từ ngày</label>
                                        <div class="form-group position-relative">
                                            <input type="date" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                            <i class="ri-calendar-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">Đến ngày</label>
                                        <div class="form-group position-relative">
                                            <input type="date" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                            <i class="ri-calendar-2-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">Số phiếu xuất</label>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control ps-5 text-gray-light h-55" placeholder="Số phiếu">
                                            <i class="ri-input-field position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="label">Số phiếu xuất</label>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Lấy theo ngày giao hàng
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Lấy ngày hiện tại
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="label">Diễn giải lý do nộp</label>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Mã đơn hàng
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Tên sản phẩm
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Tên nguời mua
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group d-flex gap-3">
                                        <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">Quay lại</button>
                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white">Tiếp tục</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="step7-tab-pane" role="tabpanel" aria-labelledby="step7-tab" tabindex="0">
                        <h4 class="fs-18 fw-semibold">Đơn hàng xuất hoá đơn</h4>
                        <p class="text-gray-light mb-4">Cài đặt xuất hoá đơn và Diễn giải lý do nộp</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="default-table-area recent-orders">
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    STT
                                                </th>
                                                <th scope="col">MÃ ĐƠN HÀNG</th>
                                                <th scope="col">NGÀY GIAO HÀNG</th>
                                                <th scope="col">GIÁ TRỊ ĐƠN HÀNG</th>
                                                <th scope="col">COD</th>
                                                <th scope="col">HÓA ĐƠN BÁN HÀNG</th>
                                                <th scope="col">HÓA ĐƠN DỊCH VỤ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault12">
                                                        <label class="position-relative top-2 ms-1" for="flexCheckDefault12">#854</label>
                                                    </div>
                                                </td>
                                                <td class="text-body">+1 555-</td>
                                                <td class="text-body">Jun 19, 2024</td>
                                                <td class="text-body">$6855</td>
                                                <td class="text-body">Jun 19, 2024</td>
                                                <td class="text-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="hoadonbanhang">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check text-center">
                                                        <input class="form-check-input" type="checkbox" value="" id="hoadondichvu">
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="form-group d-flex gap-3">
                                        <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">Quay lại</button>
                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white">Tiếp tục</button>
                                    </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</template>

<script>
</script>
