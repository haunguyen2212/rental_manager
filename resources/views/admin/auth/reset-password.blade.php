@extends('admin.common.auth')

@section('title', 'Đặt lại mật khẩu')

@section('content')
  <div class="text-nowrap logo-img text-center d-block py-3 w-100">
    <div class="text-nowrap logo-img text-decoration-none d-flex flex-column align-items-center justify-content-center">
        <span class="brand-logo-text">HavenBlue</span>
        <span class="brand-logo-subtitle">SALES MANAGEMENT</span>
    </div>
  </div>
  <p class="text-center mb-4">Đặt lại mật khẩu</p>
  <p class="text-muted small text-center mb-4">Vui lòng nhập mật khẩu mới cho tài khoản của bạn.</p>
  <form method="post" action="{{ route('admin.reset-password.post') }}" id="form-reset-password">
    <input type="hidden" name="token" value="{{ $token ?? request()->get('token') }}">
    <input type="hidden" name="email" value="{{ $email ?? request()->get('email') }}">
    <div id="msg">
      @include('admin.common.partials.error_message')
    </div>
    <div class="mb-3">
      <label for="password" class="form-label required">Mật khẩu mới</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-4">
      <label for="password_confirmation" class="form-label required">Xác nhận mật khẩu</label>
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>
    <button type="button" class="btn btn-primary w-100 py-8 fs-4 mb-3 rounded-2" id="btn-submit">Đặt lại mật khẩu</button>
    <div class="text-center">
      <a class="text-primary fw-bold" href="{{ route('admin.login.get') }}">
        <i class="ti ti-arrow-left me-1"></i>
        Quay lại đăng nhập
      </a>
    </div>
  </form>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/auth/reset-password.js') }}?v={{ VERSION }}"></script>
@endpush
