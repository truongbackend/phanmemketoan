<template>
<nav class="navbar navbar-expand-lg bg-transparent navbar-for-landing-page" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/assets/home/logo.png" alt="logo" width="120px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="navbar_toggler">
                <span class="border-bottom border-3 border-white top"></span>
                <span class="border-bottom border-3 border-white middle my-5px"></span>
                <span class="border-bottom border-3 border-white bottom"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link fs-14 fw-medium text-body-bg hover p-0 active" href="#">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-14 fw-medium text-body-bg hover p-0" href="#about">Về chúng tôi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-14 fw-medium text-body-bg hover p-0" href="#features">Tính năng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-14 fw-medium text-body-bg hover p-0" href="#pricing">Bảng giá</a>
                    </li>
                </ul>
                <div class="othres">
                    <a href="#pricing" class="btn bg-white fw-medium fs-14 text-primary rounded-pill hover-bg">
                        Dùng thử
                    </a>
                    <a href="/login" class="btn bg-white fw-medium fs-14 text-primary rounded-pill hover-bg">
                        Đăng nhập
                    </a>
                </div>
            </div>
        </div>
    </nav>


<div class="row">
    <div class="col-xxl-8 col-lg-7">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <h3 class="mb-lg-4 mb-3">Thông tin thanh toán</h3>

                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Tên khách hàng</label>
                            <input type="text" class="form-control h-55" placeholder="Enter Customer Name">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Số điện thoại</label>
                            <input type="text" class="form-control h-55" placeholder="Enter Phone Number">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Email</label>
                            <input type="email" class="form-control h-55" placeholder="Enter Email Address">
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Tên công ty</label>
                            <input type="text" class="form-control h-55" placeholder="Enter zip postcode">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Địa chỉ công ty</label>
                            <input type="text" class="form-control h-55" placeholder="Enter Street Address">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Mã số thuế</label>
                            <input type="text" class="form-control h-55" placeholder="Enter Street Address">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Ghi chú</label>
                            <textarea rows="6" class="form-control" placeholder="Write your note here...."></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Quay lại</button>
                            <button class="btn btn-primary py-2 px-4 fw-medium fs-16"> <i class="ri-add-line text-white fw-medium"></i>Tạo đơn hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-lg-5">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <h3 class="mb-3 mb-lg-4">Chi tiết đơn hàng</h3>
                <div class="default-table-area mb-3 mb-lg-4">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Chi tiết</th>
                                    <th scope="col" class="text-end">Số tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Grand Total :</td>
                                    <td class="text-end">$1,105.00</td>
                                </tr>
                                <tr>
                                    <td>Discount :</td>
                                    <td class="text-end">-$105.00</td>
                                </tr>
                                <tr>
                                    <td>Tax :</td>
                                    <td class="text-end">$75.00</td>
                                </tr>
                                <tr>
                                    <td class="text-secondary fw-medium">Subtotal :</td>
                                    <td class="text-secondary fw-medium text-end">$1,000.00</td>
                                </tr>
                                <tr>
                                    <td>Shipping Charge :</td>
                                    <td class="text-end">$80.00</td>
                                </tr>
                                <tr>
                                    <td>Coupon Charge :</td>
                                    <td class="text-secondary text-end">$20.00</td>
                                </tr>
                                <tr>
                                    <td class="text-secondary fw-medium">Total :</td>
                                    <td class="text-secondary fw-medium text-end">$900.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-area-ecommerce ptb-180" style="background: linear-gradient(180deg, #FFFFFF 0%, #DDE4FF 100%);">
        <div class="container cmw-1308">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-single-item-ecommerce">
                        <a href="#" class="logo">
                            <img src="assets/images/black-logo.svg" class="black-logo" alt="logo pnl">
                        </a>
                        <p class="dec">Chào mừng đến với PNL, đối tác đáng tin cậy của bạn về các giải pháp kế toán toàn diện.</p>
                        <p>info@pnl-international.com</p>
                        <p>0908511405</p>
                        <p>Số 230/37, Lâm Thị Hố, Tổ 2, KP 11, Phường Tân Chánh Hiệp, Quận 12, Thành phố Hồ Chí Minh, Việt Nam</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-single-item-ecommerce pl-130">
                        <h3>Liên kết nhanh</h3>
                        <ul class="p-0 m-0 list-unstyled import-link">
                            <li><a href="#">Trang chủ</a></li>
                            <li><a href="#about">Về chúng tôi</a></li>
                            <li><a href="#features">Tính năng</a></li>
                            <li><a href="#pricing">Bảng giá</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="footer-single-item-ecommerce pl-130">
                        <h3>Tài nguyên</h3>
                        <ul class="p-0 m-0 list-unstyled import-link">
                            <li><a href="#">Trung tâm trợ giúp</a></li>
                            <li><a href="#">Tài liệu hướng dẫn</a></li>
                            <li><a href="#">Câu hỏi thường gặp</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-single-item-ecommerce pl-80">
                        <h3>Pháp lý</h3>
                        <ul class="p-0 m-0 list-unstyled info-link">
                            <li><a href="#">Chính sách bảo mật</a></li>
                            <li><a href="#">Điều khoản dịch vụ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
