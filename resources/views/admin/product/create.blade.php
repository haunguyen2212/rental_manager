@extends('admin.common.master')

@section('title', 'Thêm sản phẩm')

@section('content') 
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title fw-semibold mb-0">Thêm sản phẩm</h5>
    </div>
    <div class="mt-3">
        <form method="POST" action="{{ route('admin.product.store') }}" id="form-save">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="name" class="form-label required">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" id="name" value="">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="slug" class="form-label required">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" value="">
                </div>
            </div>
            
            <!-- Product Type Selection -->
            <div class="row mb-3">
                <div class="col-12">
                    <label class="form-label required mb-3">Loại sản phẩm</label>
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="product_type" id="product_type_simple" value="simple" checked>
                            <label class="form-check-label" for="product_type_simple">
                                Sản phẩm đơn giản
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="product_type" id="product_type_variable" value="variable">
                            <label class="form-check-label" for="product_type_variable">
                                Sản phẩm có biến thể
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Variant Attributes Management (only for variable products) -->
            <div id="variant-attributes-section" class="mb-4 d-none">
                <div class="card border shadow-sm mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">
                            <iconify-icon icon="solar:settings-bold" class="me-2"></iconify-icon>
                            Chọn biến thể sản phẩm
                        </h6>
                    </div>
                    <div class="card-body">
                        <div id="variant-attributes-list">
                            <div class="variant-attribute-item mb-3" data-attribute-index="0">
                                <div class="row align-items-end">
                                    <div class="col-md-10 mb-2 mb-md-0">
                                        <label class="form-label">Biến thể</label>
                                        <select class="form-select variant-attribute-select">
                                            <option value="">-- Chọn biến thể --</option>
                                            <option value="color">Màu sắc</option>
                                            <option value="size">Kích thước</option>
                                            <option value="material">Chất liệu</option>
                                            <option value="style">Kiểu dáng</option>
                                            <option value="capacity">Dung tích</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-attribute d-none">
                                            <iconify-icon icon="solar:trash-bin-minimalistic-bold"></iconify-icon> Xóa
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-add-attribute">
                                <iconify-icon icon="solar:add-circle-bold"></iconify-icon> Thêm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product Variant Groups -->
            <div id="product-variant-groups">
                <div class="product-variant-group" data-group-index="0">
                    <div class="card border shadow-sm variant-card mb-3">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center variant-header">
                            <h6 class="mb-0 fw-semibold">
                                <iconify-icon icon="solar:box-bold" class="me-2"></iconify-icon>
                                Biến thể sản phẩm <span class="variant-number">#1</span>
                            </h6>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-group d-none">
                                <iconify-icon icon="solar:trash-bin-minimalistic-bold"></iconify-icon> Xóa
                            </button>
                        </div>
                        <div class="card-body group-input-variant">
                            <div class="row variant-selectors-row">
                                <!-- Variant selectors will be dynamically added here -->
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label required">Mã sản phẩm (SKU)</label>
                                    <input type="text" name="sku[0]" class="form-control" value="">
                                </div>
                                <div class="col-12 col-md-6 mb-3 display-flg-wrapper">
                                    <label class="form-label">Trạng thái hiển thị</label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="display_flg[0]" id="display_flg_visible_0" value="1" checked>
                                            <label class="form-check-label" for="display_flg_visible_0">
                                                Hiện
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="display_flg[0]" id="display_flg_hidden_0" value="0">
                                            <label class="form-check-label" for="display_flg_hidden_0">
                                                Ẩn
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label required">Ảnh đại diện</label>
                                    <div class="image-upload-wrapper">
                                        <input type="file" name="product_image[0]" class="product-image-input d-none" accept="image/*" />
                                        <div class="image-upload-area product-image-upload-area">
                                            <div class="image-upload-placeholder">
                                                <iconify-icon icon="solar:gallery-add-bold" style="font-size: 48px; color: #6c757d;"></iconify-icon>
                                                <p class="mt-3 mb-0 text-muted">Click để chọn ảnh hoặc kéo thả ảnh vào đây</p>
                                                <small class="text-muted">Chỉ chấp nhận file ảnh (JPG, PNG, GIF)</small>
                                            </div>
                                        </div>
                                        <div class="image-preview-container mt-0 d-none">
                                            <div class="image-preview-wrapper">
                                                <img src="" alt="Preview" class="image-preview" />
                                                <div class="image-preview-overlay">
                                                    <button type="button" class="btn btn-sm btn-light me-2 btn-change-image">
                                                        <iconify-icon icon="solar:pen-bold"></iconify-icon> Đổi ảnh
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete-image">
                                                        <iconify-icon icon="solar:trash-bin-minimalistic-bold"></iconify-icon> Xóa
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label">Ảnh bổ sung</label>
                                    <div class="multiple-image-upload-wrapper">
                                        <input type="file" name="other_image[0][]" class="other-image-input d-none" accept="image/*" multiple />
                                        <div class="image-upload-area multiple-image-upload-area">
                                            <div class="image-upload-placeholder">
                                                <iconify-icon icon="solar:gallery-add-bold" style="font-size: 48px; color: #6c757d;"></iconify-icon>
                                                <p class="mt-3 mb-0 text-muted">Click để chọn ảnh hoặc kéo thả ảnh vào đây</p>
                                                <small class="text-muted">Có thể chọn nhiều ảnh (JPG, PNG, GIF)</small>
                                            </div>
                                        </div>
                                        <div class="multiple-image-preview-container d-none">
                                            <div class="row g-3 image-preview-grid"></div>
                                            <div class="row g-3 mt-2">
                                                <div class="col-12 col-md-4">
                                                    <div class="image-upload-area add-more-image-area" style="min-height: 150px; padding: 20px;">
                                                        <div class="image-upload-placeholder">
                                                            <iconify-icon icon="solar:gallery-add-bold" style="font-size: 32px; color: #6c757d;"></iconify-icon>
                                                            <p class="mt-2 mb-0 text-muted small">Thêm ảnh</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label class="form-label required">Giá gốc</label>
                                    <input type="number" name="price[0]" class="form-control" value="">
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label class="form-label">Giá khuyến mãi</label>
                                    <input type="number" name="sale_price[0]" class="form-control" value="">
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label class="form-label required">Số lượng tồn</label>
                                    <input type="number" name="stock_quantity[0]" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 mb-3 variant-controls">
                    <button type="button" class="btn btn-outline-primary" id="btn-add-variant-group">
                        <iconify-icon icon="solar:add-circle-bold"></iconify-icon> Thêm biến thể
                    </button>
                </div>
                <div class="col-12 mb-3">
                    <label for="short_description" class="form-label">Mô tả ngắn</label>
                    <textarea name="short_description" class="form-control" id="short_description" rows="5"></textarea>
                </div>
                <div class="col-12 mb-3">
                    <label for="description" class="form-label">Mô tả chi tiết</label>
                    <textarea name="description" class="form-control" id="description" rows="10"></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-2">
                <button type="button" class="btn btn-light me-1 link" data-url="{{ route('admin.product.index') }}">Quay lại</button>
                <button type="button" class="btn btn-primary" id="btn-save">Tạo mới</button>
            </div>
        </form>
    </div>
@endsection

@push('styles')
<style>
    .image-upload-wrapper {
        position: relative;
    }

    .image-upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 40px 20px;
        text-align: center;
        background-color: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease;
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-upload-area:hover {
        border-color: #0d6efd;
        background-color: #e7f1ff;
    }

    .image-upload-area.drag-over {
        border-color: #0d6efd;
        background-color: #cfe2ff;
    }

    .image-upload-placeholder {
        pointer-events: none;
    }

    .image-preview-container {
        margin-top: 15px;
    }

    .image-preview-wrapper {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #dee2e6;
        background-color: #fff;
        max-width: 100%;
    }

    .image-preview {
        width: 100%;
        height: auto;
        display: block;
        max-height: 400px;
        object-fit: contain;
    }

    .image-preview-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .image-preview-wrapper:hover .image-preview-overlay {
        opacity: 1;
    }

    .image-preview-overlay .btn {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    /* Multiple image upload styles */
    .multiple-image-upload-wrapper {
        position: relative;
    }

    .multiple-image-preview-container {
        margin-top: 15px;
    }

    .multiple-image-preview-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #dee2e6;
        background-color: #fff;
        aspect-ratio: 1;
    }

    .multiple-image-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .multiple-image-preview-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .multiple-image-preview-item:hover .multiple-image-preview-overlay {
        opacity: 1;
    }

    .multiple-image-preview-overlay .btn {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    /* Product Variant Group Styles */
    .product-variant-group {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-variant-group .card {
        transition: all 0.3s ease;
    }

    .product-variant-group .card-header {
        border-bottom: 2px solid #dee2e6;
    }

    .variant-number {
        color: #0d6efd;
        font-weight: 600;
    }

    /* Simple product mode - hide card border and header */
    .product-simple-mode .variant-card {
        border: none !important;
        box-shadow: none !important;
    }

    .product-simple-mode .variant-header {
        display: none !important;
    }

    .product-simple-mode .variant-controls {
        display: none !important;
    }

    .product-simple-mode .btn-remove-group {
        display: none !important;
    }
</style>
@endpush

@push('scripts')
    <script src="{{ asset('js/admin/image-upload.js') }}"></script>
    <script src="{{ asset('js/admin/product/create.js') }}"></script>
@endpush