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
                <h3 class="mb-lg-4 mb-3">Lấy dữ liệu sàn </h3>

                <ul class="nav nav-tabs justify-content-between border-0 mb-4 wizard-tabs2" id="myTabstep2" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link p-0 d-flex align-items-center active" id="step5-tab" data-bs-toggle="tab" data-bs-target="#step5-tab-pane" type="button" role="tab" aria-controls="step5-tab-pane" aria-selected="true">
                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">1</span>
                            <div class="text-start ms-3">
                                <h4 class="fs-18 fw-semibold">Lấy dữ liệu</h4>
                                <p class="text-gray-light mb-0">Đơn hàng lazada</p>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link p-0 d-flex align-items-center" id="step6-tab" data-bs-toggle="tab" data-bs-target="#step6-tab-pane" type="button" role="tab" aria-controls="step6-tab-pane" aria-selected="false">
                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">2</span>
                            <div class="text-start ms-3">
                                <h4 class="fs-18 fw-semibold">Personal Info</h4>
                                <p class="text-gray-light mb-0">Setup Information</p>
                            </div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link p-0 d-flex align-items-center" id="step7-tab" data-bs-toggle="tab" data-bs-target="#step7-tab-pane" type="button" role="tab" aria-controls="step7-tab-pane" aria-selected="false">
                            <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-block">3</span>
                            <div class="text-start ms-3">
                                <h4 class="fs-18 fw-semibold">Social Links</h4>
                                <p class="text-gray-light mb-0">Add Social Links</p>
                            </div>
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabstep2Content">
                    <div class="tab-pane fade show active" id="step5-tab-pane" role="tabpanel" aria-labelledby="step5-tab" tabindex="0">
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">Từ ngày</label>
                                        <div class="form-group position-relative">
                                            <input type="date" class="form-control text-dark h-55" placeholder="Enter Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">Đến ngày</label>
                                        <div class="form-group position-relative">
                                            <input type="date" class="form-control text-dark h-55" placeholder="Enter Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group d-flex gap-3">
                                        <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">Back</button>
                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white">Next</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="step6-tab-pane" role="tabpanel" aria-labelledby="step6-tab" tabindex="0">
                        <h4 class="fs-18 fw-semibold">Tạo chứng từ bán hàng</h4>
                        <p class="text-gray-light mb-4">Phần mềm Amis</p>
                        <form>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control text-gray-light" placeholder="Bán hàng trong nước">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control text-gray-light" placeholder="Chuyển khoản">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" :value="'VTP_KEY1'" id="reason1"/>
                                            <label class="form-check-label" for="reason1">
                                            Kiểm phiếu xuất
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-4">
                                        <label class="label">Kiểm phiếu xuất</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" :value="'VTP_KEY1'" id="reason1"/>
                                            <label class="form-check-label" for="reason1">
                                            Mã đơn hàng
                                            </label>
                                        </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :value="'VTP_KEY2'" id="reason2"/>
                                        <label class="form-check-label" for="reason2">
                                            Tên sản phẩm
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" :value="'VTP_KEY3'" id="reason3" />
                                        <label class="form-check-label" for="reason3">
                                            Tên người mua
                                        </label>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">State</label>
                                        <div class="form-group position-relative">
                                            <select class="form-select form-control ps-5 h-55" aria-label="Default select example">
                                                <option selected class="text-dark">South poal evenue state 4C</option>
                                                <option value="1" class="text-dark">United States</option>
                                                <option value="2" class="text-dark">Canada</option>
                                                <option value="3" class="text-dark">France</option>
                                            </select>
                                            <i class="ri-font-size position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label class="label">Zip Code</label>
                                        <div class="form-group position-relative">
                                            <input type="number" class="form-control ps-5 text-gray-light h-55" placeholder="Enter number">
                                            <i class="ri-hashtag position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label">Order Notes :</label>
                                        <div class="form-group position-relative">
                                            <textarea class="form-control ps-5 text-dark" placeholder="Some demo text ... " cols="30" rows="5"></textarea>
                                            <i class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group d-flex gap-3">
                                        <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">Back</button>
                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white">Next</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="step7-tab-pane" role="tabpanel" aria-labelledby="step7-tab" tabindex="0">
                        <h4 class="fs-18 fw-semibold">Social Information</h4>
                        <p class="text-gray-light mb-4">Fill all Information as below</p>
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">Facebook</label>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark ps-5 h-55" placeholder="URL">
                                            <i class="ri-facebook-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">Twitter</label>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark ps-5 h-55" placeholder="URL">
                                            <i class="ri-twitter-x-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">Linkedin</label>
                                        <div class="form-group position-relative">
                                            <input type="email" class="form-control text-dark ps-5 h-55" placeholder="URL">
                                            <i class="ri-linkedin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">YouTube</label>
                                        <div class="form-group position-relative">
                                            <input type="number" class="form-control text-dark ps-5 h-55" placeholder="URL">
                                            <i class="ri-youtube-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group d-flex gap-3">
                                        <button class="btn btn-primary bg-primary bg-opacity-10 text-primary py-3 px-5 fw-semibold border-0">Back</button>
                                        <button type="submit" class="btn btn-primary py-3 px-5 fw-semibold text-white">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</template>

<script>

</script>
