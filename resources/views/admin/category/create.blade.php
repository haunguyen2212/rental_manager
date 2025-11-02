@extends('admin.common.master')

@section('content') 
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title fw-semibold mb-0">Thêm danh mục</h5>
    </div>
    <div class="mt-3">
        <form method="POST" action="{{ route('admin.category.store') }}" id="form-save">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="name" class="form-label required">Tên danh mục</label>
                    <input type="text" name="name" class="form-control" id="name" value="">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="password" class="form-label required">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" value="">
                </div>
                <div class="col-12 mb-3">
                    <label for="password" class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control" id="description" rows="10"></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-2">
                <button type="button" class="btn btn-light me-1 link" data-url="{{ route('admin.category.index') }}">Quay lại</button>
                <button type="button" class="btn btn-primary" id="btn-save">Tạo mới</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/category/create.js') }}?v={{ VERSION }}"></script>
@endpush