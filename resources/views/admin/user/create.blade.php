@extends('admin.common.master')

@section('content') 
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title fw-semibold mb-0">Thêm người dùng</h5>
    </div>
    <div class="mt-3">
        <form method="POST" action="{{ route('admin.user.store') }}" id="form-save">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="username" class="form-label required">Họ và tên</label>
                    <input type="text" name="name" class="form-control" id="username" value="">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="password" class="form-label required">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="password" value="">
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
