@extends('admin.common.auth')

@section('title', 'Đặt lại mật khẩu thành công')

@section('content')
  <div class="text-nowrap logo-img text-center d-block py-3 w-100">
    <div class="text-nowrap logo-img text-decoration-none d-flex flex-column align-items-center justify-content-center">
        <span class="brand-logo-text">HavenBlue</span>
        <span class="brand-logo-subtitle">SALES MANAGEMENT</span>
    </div>
  </div>
  <div class="text-center mb-4">
    <h4 class="mb-3 fw-bold">Đặt lại mật khẩu thành công</h4>
    <p class="text-muted mb-4">
      Mật khẩu của bạn đã được đặt lại thành công. 
      Bạn có thể đăng nhập bằng mật khẩu mới ngay bây giờ.
    </p>
  </div>
  <div class="text-center">
    <a class="btn btn-primary w-100 py-8 fs-4 mb-3 rounded-2" href="{{ route('admin.login.get') }}">
      Đăng nhập ngay
    </a>
  </div>
@endsection

