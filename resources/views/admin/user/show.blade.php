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
    <div class="card overflow-hidden">
        <div class="card-body p-0">
            <div class="row align-items-center">
                <div class="col-lg-4 order-lg-1 order-2">
                    <div class="d-flex align-items-center justify-content-around m-4">
                        <div class="text-center">
                            <i class="ti ti-file-description fs-6 d-block mb-2"></i>
                            <h4 class="mb-0 lh-1">938</h4>
                            <p class="mb-0 ">Posts</p>
                        </div>
                        <div class="text-center">
                            <i class="ti ti-user-circle fs-6 d-block mb-2"></i>
                            <h4 class="mb-0 lh-1">3,586</h4>
                            <p class="mb-0 ">Followers</p>
                        </div>
                        <div class="text-center">
                            <i class="ti ti-user-check fs-6 d-block mb-2"></i>
                            <h4 class="mb-0 lh-1">2,659</h4>
                            <p class="mb-0 ">Following</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-lg-2 order-1">
                    <div>
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <div class="d-flex align-items-center justify-content-center round-110">
                                <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden round-100">
                                <img src="{{ asset('images/profile/user-1.jpg') }}" alt="modernize-img" class="w-100 h-100">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="mb-0">{{ $user->username }}</h5>
                            <p class="mb-0">Designer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-last">
                    <ul class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-end my-3 mx-4 pe-xxl-4 gap-3">
                        @if(!empty($user->email))
                            <li>
                                <a class="btn btn-secondary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" 
                                    href="mailto:{{ $user->email }}"
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Gửi mail"
                                >
                                    <i class="ti ti-mail"></i>
                                </a>
                            </li>
                        @endif
                        @if($user->status == USER_STATUS_INACTIVE)
                            <li>
                                <button class="btn btn-primary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle link" 
                                    id="btn-unlock" 
                                    data-url="{{ route('admin.user.edit', request()->user) }}" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Mở khóa tài khoản"
                                >
                                    <i class="ti ti-lock-open"></i>
                                </button>
                            </li>
                        @endif
                        @if($user->status == USER_STATUS_ACTIVE)
                            <li>
                                <button class="btn btn-primary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle link" 
                                    id="btn-lock" 
                                    data-url="{{ route('admin.user.edit', request()->user) }}" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Khóa tài khoản"
                                >
                                    <i class="ti ti-lock"></i>
                                </button>
                            </li>
                        @endif
                        <li>
                            <button class="btn btn-danger d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" 
                                id="btn-delete" 
                                data-url="{{ route('admin.user.destroy') }}" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="Xóa tài khoản"
                            >
                                <i class="ti ti-trash"></i>
                            </button>
                        </li>
                        <li>
                            <button class="btn btn-success d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle link" 
                                id="btn-edit" 
                                data-url="{{ route('admin.user.edit', request()->user) }}" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="Chỉnh sửa thông tin"
                            >
                                <i class="ti ti-edit"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-primary-subtle rounded-2 rounded-top-0" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active hstack gap-2 rounded-0 py-6" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
                        <i class="ti ti-user-circle fs-5"></i>
                        <span class="d-none d-md-block">Profile</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link hstack gap-2 rounded-0 py-6" id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button" role="tab" aria-controls="pills-followers" aria-selected="false" tabindex="-1">
                        <i class="ti ti-heart fs-5"></i>
                        <span class="d-none d-md-block">Followers</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link hstack gap-2 rounded-0 py-6" id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab" aria-controls="pills-friends" aria-selected="false" tabindex="-1">
                        <i class="ti ti-user-circle fs-5"></i>
                        <span class="d-none d-md-block">Friends</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link hstack gap-2 rounded-0 py-6" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false" tabindex="-1">
                        <i class="ti ti-photo-plus fs-5"></i>
                        <span class="d-none d-md-block">Gallery</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
    <div class="mt-3">
        <div class="d-flex justify-content-end mt-2">
            <button type="button" class="btn btn-light me-1 link" data-url="{{ route('admin.user.index') }}">Quay lại</button>
        </div>
    </div>
@endsection
