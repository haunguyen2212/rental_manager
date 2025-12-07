@extends('admin.common.auth')

@section('title', 'Lỗi đặt lại mật khẩu')

@section('content')
  <div class="text-nowrap logo-img text-center d-block py-3 w-100">
    <div class="text-nowrap logo-img text-decoration-none d-flex flex-column align-items-center justify-content-center">
        <span class="brand-logo-text">HavenBlue</span>
        <span class="brand-logo-subtitle">SALES MANAGEMENT</span>
    </div>
  </div>
  <div class="text-center mb-4">
    <span class="mb-3">{{ session('error') ?? __('messages.system_error') }}</span>
  </div>
  <div class="text-center">
    <button type="button" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2 link" data-url="{{ route('admin.forgot-password.get') }}">
      Yêu cầu lại link đặt lại mật khẩu
    </button>
    <div>
      <a class="text-primary fw-bold" href="{{ route('admin.login.get') }}">
        <i class="ti ti-arrow-left me-1"></i>
        Quay lại đăng nhập
      </a>
    </div>
  </div>
@endsection

