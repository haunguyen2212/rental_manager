@extends('admin.common.master')

@section('content') 
        <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title fw-semibold mb-0">
            <span class="d-none d-md-inline">Thông tin tài khoản</span>
            <span class="d-inline d-md-none">Tài khoản</span>
        </h5>
        <div>
            <button type="button" class="btn btn-sm-md btn-danger ms-0 me-md-1" id="btn-delete" data-url="{{ route('admin.user.destroy') }}"><i class="ti ti-trash"></i><span class="d-none d-sm-inline"> Xóa</span></button>
            <button type="button" class="btn btn-sm-md btn-success ms-0 me-md-1 link" id="btn-edit" data-url="{{ route('admin.user.edit', request()->user) }}"><i class="ti ti-edit"></i><span class="d-none d-sm-inline"> Chỉnh sửa</span></button>
        </div>
    </div>
    <div class="mt-3">
        <div class="d-flex justify-content-end mt-2">
            <button type="button" class="btn btn-light me-1 link" data-url="{{ route('admin.user.index') }}">Quay lại</button>
        </div>
    </div>
@endsection
