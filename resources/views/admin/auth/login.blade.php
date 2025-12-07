@extends('admin.common.auth')

@section('title', 'Đăng nhập')

@section('content')
  <div class="text-nowrap logo-img text-center d-block py-3 w-100">
    <div class="text-nowrap logo-img text-decoration-none d-flex flex-column align-items-center justify-content-center">
        <span class="brand-logo-text">HavenBlue</span>
        <span class="brand-logo-subtitle">SALES MANAGEMENT</span>
    </div>
  </div>
  <p class="text-center">Đăng nhập quản trị</p>
  <form method="post" action="{{ route('admin.login.post') }}" id="form-login">
    <div id="msg">
      @include('admin.common.partials.error_message')
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label required">Tài khoản</label>
      <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="mb-4">
      <label for="exampleInputPassword1" class="form-label required">Mật khẩu</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
      <div class="form-check">
        <input class="form-check-input primary" type="checkbox" value="" id="remember" name="remember" checked>
        <label class="form-check-label text-dark" for="remember">
          Ghi nhớ tôi
        </label>
      </div>
      <a class="text-primary fw-bold" href="{{ route('admin.forgot-password.get') }}">Quên mật khẩu</a>
    </div>
    <button type="button" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" id="btn-submit">Đăng nhập</button>
  </form>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/auth/login.js') }}?v={{ VERSION }}"></script>
@endpush