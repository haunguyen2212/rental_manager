@extends('admin.common.auth')

@section('title', 'Quên mật khẩu')

@section('content')
  <div class="text-nowrap logo-img text-center d-block py-3 w-100">
    <div class="text-nowrap logo-img text-decoration-none d-flex flex-column align-items-center justify-content-center">
        <span class="brand-logo-text">HavenBlue</span>
        <span class="brand-logo-subtitle">SALES MANAGEMENT</span>
    </div>
  </div>
  <p class="text-center mb-4">Quên mật khẩu</p>
  <p class="text-muted small text-center mb-4">Nhập email đã đăng kí của bạn, chúng tôi sẽ gửi link đặt lại mật khẩu đến email của bạn.</p>
  <form method="post" action="{{ route('admin.forgot-password.post') }}" id="form-forgot-password">
    <div id="msg">
      @include('admin.common.partials.error_message')
    </div>
    <div class="mb-4">
      <label for="email" class="form-label required">Email</label>
      <input type="text" class="form-control" id="email" name="email">
    </div>
    <button type="button" class="btn btn-primary w-100 py-8 fs-4 mb-3 rounded-2" id="btn-submit">Gửi yêu cầu</button>
    <div class="text-center">
      <a class="text-primary fw-bold" href="{{ route('admin.login.get') }}">
        <i class="ti ti-arrow-left me-1"></i>
        Quay lại đăng nhập
      </a>
    </div>
  </form>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/auth/forgot-password.js') }}?v={{ VERSION }}"></script>
@endpush
