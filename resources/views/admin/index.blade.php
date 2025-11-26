@extends('admin.common.master')

@section('title', 'Dashboard')

@section('content')
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Dashboard</h4>
            <p class="text-muted mb-0">Tổng quan hệ thống quản lý</p>
        </div>
        <div>
            <button class="btn btn-primary">
                <i class="ti ti-refresh me-2"></i>
                Làm mới
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-2 small">Tổng sản phẩm</p>
                            <h3 class="mb-0 fw-bold">1,234</h3>
                            <span class="badge bg-success-subtle text-success mt-2">
                                <i class="ti ti-arrow-up me-1"></i>
                                12.5%
                            </span>
                        </div>
                        <div class="bg-primary-subtle rounded-circle p-3">
                            <i class="ti ti-package fs-4 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-2 small">Tổng đơn hàng</p>
                            <h3 class="mb-0 fw-bold">856</h3>
                            <span class="badge bg-success-subtle text-success mt-2">
                                <i class="ti ti-arrow-up me-1"></i>
                                8.2%
                            </span>
                        </div>
                        <div class="bg-info-subtle rounded-circle p-3">
                            <i class="ti ti-shopping-cart fs-4 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-2 small">Tổng khách hàng</p>
                            <h3 class="mb-0 fw-bold">2,456</h3>
                            <span class="badge bg-success-subtle text-success mt-2">
                                <i class="ti ti-arrow-up me-1"></i>
                                15.3%
                            </span>
                        </div>
                        <div class="bg-success-subtle rounded-circle p-3">
                            <i class="ti ti-users fs-4 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-2 small">Doanh thu tháng</p>
                            <h3 class="mb-0 fw-bold">₫125M</h3>
                            <span class="badge bg-danger-subtle text-danger mt-2">
                                <i class="ti ti-arrow-down me-1"></i>
                                3.1%
                            </span>
                        </div>
                        <div class="bg-warning-subtle rounded-circle p-3">
                            <i class="ti ti-currency-dong fs-4 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <!-- Revenue Chart -->
        <div class="col-12 col-lg-8">
            <div class="card border h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-semibold">Doanh thu theo tháng</h5>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-primary active">Tháng</button>
                            <button type="button" class="btn btn-outline-primary">Năm</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center" style="height: 300px;">
                        <div class="text-center text-muted">
                            <i class="ti ti-chart-line fs-1 d-block mb-2"></i>
                            <p class="mb-0">Biểu đồ doanh thu</p>
                            <small>(Cần tích hợp thư viện chart)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Top Products -->
        <div class="col-12 col-lg-4">
            <div class="card border h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-semibold">Sản phẩm bán chạy</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary-subtle rounded p-2">
                                        <i class="ti ti-package text-primary"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-semibold">Sản phẩm A</h6>
                                    <p class="mb-0 small text-muted">125 đơn hàng</p>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-primary">Top 1</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-info-subtle rounded p-2">
                                        <i class="ti ti-package text-info"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-semibold">Sản phẩm B</h6>
                                    <p class="mb-0 small text-muted">98 đơn hàng</p>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-info">Top 2</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-success-subtle rounded p-2">
                                        <i class="ti ti-package text-success"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-semibold">Sản phẩm C</h6>
                                    <p class="mb-0 small text-muted">76 đơn hàng</p>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-success">Top 3</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning-subtle rounded p-2">
                                        <i class="ti ti-package text-warning"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-semibold">Sản phẩm D</h6>
                                    <p class="mb-0 small text-muted">65 đơn hàng</p>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-warning">Top 4</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-danger-subtle rounded p-2">
                                        <i class="ti ti-package text-danger"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-semibold">Sản phẩm E</h6>
                                    <p class="mb-0 small text-muted">54 đơn hàng</p>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-danger">Top 5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables Row -->
    <div class="row g-4 mb-4">
        <!-- Recent Orders -->
        <div class="col-12 col-lg-7">
            <div class="card border">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-semibold">Đơn hàng gần đây</h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 ps-4">Mã đơn</th>
                                    <th class="border-0">Khách hàng</th>
                                    <th class="border-0">Tổng tiền</th>
                                    <th class="border-0">Trạng thái</th>
                                    <th class="border-0 text-end pe-4">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-semibold">#ORD001</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary-subtle rounded-circle p-2 me-2">
                                                <i class="ti ti-user text-primary"></i>
                                            </div>
                                            <span>Nguyễn Văn A</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">₫1,250,000</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Hoàn thành</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-light">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-semibold">#ORD002</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-info-subtle rounded-circle p-2 me-2">
                                                <i class="ti ti-user text-info"></i>
                                            </div>
                                            <span>Trần Thị B</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">₫850,000</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">Đang xử lý</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-light">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-semibold">#ORD003</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success-subtle rounded-circle p-2 me-2">
                                                <i class="ti ti-user text-success"></i>
                                            </div>
                                            <span>Lê Văn C</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">₫2,100,000</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">Mới</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-light">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-semibold">#ORD004</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-warning-subtle rounded-circle p-2 me-2">
                                                <i class="ti ti-user text-warning"></i>
                                            </div>
                                            <span>Phạm Thị D</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">₫650,000</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger">Hủy</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-light">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-semibold">#ORD005</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-danger-subtle rounded-circle p-2 me-2">
                                                <i class="ti ti-user text-danger"></i>
                                            </div>
                                            <span>Hoàng Văn E</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">₫1,800,000</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Hoàn thành</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-light">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Activity -->
        <div class="col-12 col-lg-5">
            <!-- Quick Actions -->
            <div class="card border mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-semibold">Thao tác nhanh</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100 d-flex flex-column align-items-center py-3">
                                <i class="ti ti-plus fs-4 mb-2"></i>
                                <span class="small">Thêm sản phẩm</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-info w-100 d-flex flex-column align-items-center py-3">
                                <i class="ti ti-user-plus fs-4 mb-2"></i>
                                <span class="small">Thêm khách hàng</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-success w-100 d-flex flex-column align-items-center py-3">
                                <i class="ti ti-shopping-cart fs-4 mb-2"></i>
                                <span class="small">Tạo đơn hàng</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-warning w-100 d-flex flex-column align-items-center py-3">
                                <i class="ti ti-file-report fs-4 mb-2"></i>
                                <span class="small">Báo cáo</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card border">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-semibold">Hoạt động gần đây</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-primary-subtle rounded-circle p-2">
                                    <i class="ti ti-shopping-cart text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1 fw-semibold">Đơn hàng mới</h6>
                                <p class="mb-0 small text-muted">Đơn hàng #ORD005 đã được tạo</p>
                                <small class="text-muted">5 phút trước</small>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-success-subtle rounded-circle p-2">
                                    <i class="ti ti-check text-success"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1 fw-semibold">Sản phẩm đã thêm</h6>
                                <p class="mb-0 small text-muted">Sản phẩm "Áo thun nam" đã được thêm</p>
                                <small class="text-muted">15 phút trước</small>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-info-subtle rounded-circle p-2">
                                    <i class="ti ti-user text-info"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1 fw-semibold">Khách hàng mới</h6>
                                <p class="mb-0 small text-muted">Nguyễn Văn A đã đăng ký</p>
                                <small class="text-muted">1 giờ trước</small>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-warning-subtle rounded-circle p-2">
                                    <i class="ti ti-alert text-warning"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1 fw-semibold">Cảnh báo tồn kho</h6>
                                <p class="mb-0 small text-muted">Sản phẩm "Quần jean" sắp hết hàng</p>
                                <small class="text-muted">2 giờ trước</small>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="bg-danger-subtle rounded-circle p-2">
                                    <i class="ti ti-x text-danger"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1 fw-semibold">Đơn hàng hủy</h6>
                                <p class="mb-0 small text-muted">Đơn hàng #ORD004 đã bị hủy</p>
                                <small class="text-muted">3 giờ trước</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection