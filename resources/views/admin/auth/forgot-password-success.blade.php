@extends('admin.common.auth')

@section('title', 'Gửi email thành công')

@section('content')
  <div class="text-nowrap logo-img text-center d-block py-3 w-100">
    <div class="text-nowrap logo-img text-decoration-none d-flex flex-column align-items-center justify-content-center">
        <span class="brand-logo-text">HavenBlue</span>
        <span class="brand-logo-subtitle">SALES MANAGEMENT</span>
    </div>
  </div>
  <div class="text-center mb-4">
    <h4 class="mb-3 fw-bold">Email đã được gửi thành công</h4>
    <p class="text-muted mb-4">
      Chúng tôi đã gửi link đặt lại mật khẩu đến email của bạn. 
      Vui lòng kiểm tra hộp thư đến và làm theo hướng dẫn trong email.
      Nếu không nhận được email, vui lòng kiểm tra thư mục spam hoặc yêu cầu gửi lại.
    </p>
  </div>
  <div class="text-center">
    <button class="btn btn-primary w-100 py-8 fs-4 mb-3 rounded-2 link" data-url="{{ route('admin.forgot-password.get') }}">
      Gửi lại email
    </button>
    <div>
      <a class="text-primary fw-bold" href="{{ route('admin.login.get') }}">
        <i class="ti ti-arrow-left me-1"></i>
        Quay lại đăng nhập
      </a>
    </div>
  </div>
@endsection

