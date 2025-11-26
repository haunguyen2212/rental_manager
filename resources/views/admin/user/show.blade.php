@extends('admin.common.master')

@section('title', 'Thông tin tài khoản')

@section('content') 
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title fw-semibold mb-0">
            <span class="d-none d-md-inline">Thông tin tài khoản</span>
            <span class="d-inline d-md-none">Tài khoản</span>
        </h5>
        <div>
            
        </div>
    </div>
    <div class="card shadow-sm border-0 overflow-hidden">
        <div class="card-body p-0">
            <!-- Profile Header Section -->
            <div class="bg-primary-subtle p-4 p-md-5">
                <div class="row align-items-center g-4">
                    <!-- Stats Section -->
                    <div class="col-lg-4 order-lg-1 order-2">
                        <div class="row g-3 g-md-4">
                            <div class="col-6 col-md-4">
                                <div class="text-center p-3 bg-white rounded-3 shadow-sm h-100">
                                    <i class="ti ti-file-description fs-4 text-primary d-block mb-2"></i>
                                    <h4 class="mb-0 fw-bold text-dark">938</h4>
                                    <p class="mb-0 small text-muted">Posts</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="text-center p-3 bg-white rounded-3 shadow-sm h-100">
                                    <i class="ti ti-user-circle fs-4 text-info d-block mb-2"></i>
                                    <h4 class="mb-0 fw-bold text-dark">3,586</h4>
                                    <p class="mb-0 small text-muted">Followers</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="text-center p-3 bg-white rounded-3 shadow-sm h-100">
                                    <i class="ti ti-user-check fs-4 text-success d-block mb-2"></i>
                                    <h4 class="mb-0 fw-bold text-dark">2,659</h4>
                                    <p class="mb-0 small text-muted">Following</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Avatar & User Info Section -->
                    <div class="col-lg-4 order-lg-2 order-1">
                        <div class="text-center">
                            <div class="d-inline-block position-relative mb-3">
                                <div class="rounded-circle overflow-hidden border border-4 border-white shadow-lg" style="width: 120px; height: 120px;">
                                    <img src="{{ asset('images/profile/user-1.jpg') }}" alt="{{ $user->username }}" class="w-100 h-100 object-fit-cover">
                                </div>
                            </div>
                            <h4 class="mb-1 fw-bold">{{ $user->username }}</h4>
                            <p class="mb-0 text-muted">
                                <i class="ti ti-briefcase me-1"></i>
                                Designer
                            </p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons Section -->
                    <div class="col-lg-4 order-lg-3 order-3">
                        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end gap-2">
                            @if(!empty($user->email))
                                <a class="btn btn-light btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm" 
                                    href="mailto:{{ $user->email }}"
                                    style="width: 40px; height: 40px;"
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Gửi mail"
                                >
                                    <i class="ti ti-mail fs-5"></i>
                                </a>
                            @endif
                            @if($user->status == USER_STATUS_INACTIVE)
                                <button class="btn btn-primary btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm link" 
                                    id="btn-unlock" 
                                    style="width: 40px; height: 40px;"
                                    data-url="{{ route('admin.user.edit', request()->user) }}" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Mở khóa tài khoản"
                                >
                                    <i class="ti ti-lock-open fs-5"></i>
                                </button>
                            @endif
                            @if($user->status == USER_STATUS_ACTIVE)
                                <button class="btn btn-warning btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm link" 
                                    id="btn-lock" 
                                    style="width: 40px; height: 40px;"
                                    data-url="{{ route('admin.user.edit', request()->user) }}" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Khóa tài khoản"
                                >
                                    <i class="ti ti-lock fs-5"></i>
                                </button>
                            @endif
                            <button class="btn btn-success btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm link" 
                                id="btn-edit" 
                                style="width: 40px; height: 40px;"
                                data-url="{{ route('admin.user.edit', request()->user) }}" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="Chỉnh sửa thông tin"
                            >
                                <i class="ti ti-edit fs-5"></i>
                            </button>
                            <button class="btn btn-danger btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm" 
                                id="btn-delete" 
                                style="width: 40px; height: 40px;"
                                data-url="{{ route('admin.user.destroy') }}" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="Xóa tài khoản"
                            >
                                <i class="ti ti-trash fs-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Tabs -->
            <div class="border-top">
                <ul class="nav nav-pills nav-justified bg-white" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-0 py-3 fw-semibold" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
                            <i class="ti ti-user-circle me-2"></i>
                            <span class="d-none d-md-inline">Profile</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-0 py-3 fw-semibold" id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button" role="tab" aria-controls="pills-followers" aria-selected="false" tabindex="-1">
                            <i class="ti ti-heart me-2"></i>
                            <span class="d-none d-md-inline">Followers</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-0 py-3 fw-semibold" id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab" aria-controls="pills-friends" aria-selected="false" tabindex="-1">
                            <i class="ti ti-user-circle me-2"></i>
                            <span class="d-none d-md-inline">Friends</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-0 py-3 fw-semibold" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false" tabindex="-1">
                            <i class="ti ti-photo-plus me-2"></i>
                            <span class="d-none d-md-inline">Gallery</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <div class="d-flex justify-content-end mt-2">
            <button type="button" class="btn btn-light me-1 link" data-url="{{ route('admin.user.index') }}">Quay lại</button>
        </div>
    </div>
@endsection
