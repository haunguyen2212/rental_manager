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
            <div class="row mb-3">
                <div class="col-12">
                    <label class="form-label required mb-3">Loại sản phẩm</label>
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="product_type" id="product_type_simple" value="{{ SINGLE_PRODUCT }}" checked>
                            <label class="form-check-label" for="product_type_simple">
                                Sản phẩm đơn giản
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="product_type" id="product_type_variable" value="{{ VARIANT_PRODUCT }}">
                            <label class="form-check-label" for="product_type_variable">
                                Sản phẩm có biến thể
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label required">Ảnh đại diện</label>
                    <div class="image-upload-wrapper">
                        <input type="file" name="product_image" class="product-image-input d-none" accept="image/*" />
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
                        <input type="file" name="other_image[]" class="other-image-input d-none" accept="image/*" multiple />
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
            </div>
            <div class="row mb-3">
                <div class="variant-groups-container">
                    <div class="variant-group-item mb-4 border p-3 rounded" data-index="0">
                        <div class="variant-header d-flex justify-content-between align-items-center mb-3 d-none">
                            <h6 class="mb-0">Biến thể #<span class="variant-number">1</span></h6>
                            <button type="button" class="btn btn-sm btn-danger btn-remove-variant-group d-none">
                                <iconify-icon icon="solar:trash-bin-minimalistic-bold"></iconify-icon> Xóa
                            </button>
                        </div>
                        <div class="row mb-3 variant-name-wrapper d-none">
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label required">Tên biến thể</label>
                                <input type="text" name="variant_name[0]" class="form-control variant-name-input" value="">
                            </div>
                            <div class="col-12 col-md-6 mb-3 sku-in-variant-wrapper">
                                <label class="form-label">Mã sản phẩm (SKU)</label>
                                <input type="text" name="sku[0]" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row mb-3 sku-simple-wrapper">
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Mã sản phẩm (SKU)</label>
                                <input type="text" name="sku[0]" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row mb-3 variant-image-wrapper d-none">
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Ảnh đại diện biến thể</label>
                                <div class="image-upload-wrapper">
                                    <input type="file" name="variant_image[0]" class="variant-image-input d-none" accept="image/*" />
                                    <div class="image-upload-area variant-image-upload-area">
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
                            <div class="col-12 col-md-6 mb-3 display-flg-wrapper d-none">
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
                <div class="col-12 mb-3 d-flex justify-content-start">
                    <button type="button" class="btn btn-primary btn-add-variant-group d-none" id="btn-add-variant-group">
                        <iconify-icon icon="solar:add-circle-bold"></iconify-icon> Thêm biến thể
                    </button>
                </div>
            </div>
            <div class="row">
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

@push('scripts')
    <script src="{{ asset('js/admin/image-upload.js') }}"></script>
    <script src="{{ asset('js/admin/product/create.js') }}"></script>
@endpush