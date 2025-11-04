@extends('admin.common.master')

@section('title', 'Thêm tài khoản')

@section('content') 
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title fw-semibold mb-0">Thêm tài khoản</h5>
    </div>
    <div class="mt-3">
        <form method="POST" action="{{ route('admin.user.store') }}" id="form-save">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="username" class="form-label required">Tên tài khoản</label>
                    <input type="text" name="username" class="form-control" id="username" value="">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="password" class="form-label required">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="password" value="">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="name" class="form-label required">Họ và tên</label>
                    <input type="text" name="name" class="form-control" id="name" value="">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="role-id" class="form-label required">Vai trò</label>
                    <select name="role_id" class="form-select select2" id="role-id">
                        @foreach ($option['role'] as $key => $role)
                            <option value="{{ $key }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="birthday" class="form-label">Ngày sinh</label>
                    <input type="text" name="birthday" class="form-control" id="birthday" value="">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" name="address" class="form-control" id="address" value="">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" id="phone" value="">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="">
                </div>
            </div>
            <div class="d-flex justify-content-end mt-2">
                <button type="button" class="btn btn-light me-1 link" data-url="{{ route('admin.user.index') }}">Quay lại</button>
                <button type="button" class="btn btn-primary" id="btn-save">Tạo mới</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/user/create.js') }}?v={{ VERSION }}"></script>
@endpush
