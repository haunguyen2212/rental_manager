@extends('admin.common.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title fw-semibold mb-0">
            <span class="d-none d-md-inline">Danh sách tài khoản</span>
            <span class="d-inline d-md-none">Tài khoản</span>
        </h5>
        <div>
            <button type="button" class="btn btn-sm-md btn-success ms-0 me-md-1" id="btn-search"><i class="ti ti-search"></i><span class="d-none d-sm-inline"> Tìm kiếm</span></button>
            <button type="button" class="btn btn-sm-md btn-danger ms-0 me-md-1" id="btn-multi-delete" data-url="{{ route('admin.user.destroy') }}" {{ $users->count() > 0 ? '' : 'disabled' }}><i class="ti ti-trash"></i><span class="d-none d-sm-inline"> Xóa</span></button>
            <button type="button" class="btn btn-sm-md btn-primary link" id="btn-create" data-url="{{ route('admin.user.create') }}"><i class="ti ti-plus"></i><span class="d-none d-sm-inline"> Thêm mới</span></button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover text-nowrap mb-0 align-middle">
            <thead class="text-dark">
                <tr>
                    <th class="w-5">
                        <input type="checkbox" class="form-check-input check-all" value="">
                    </th>
                    <th class="w-20">
                        <h6 class="fw-semibold mb-0">Tài khoản</h6>
                    </th>
                    <th class="w-20">
                        <h6 class="fw-semibold mb-0">Họ và tên</h6>
                    </th>
                    <th class="w-15">
                        <h6 class="fw-semibold mb-0">Vai trò</h6>
                    </th>
                    <th class="w-15">
                        <h6 class="fw-semibold mb-0">Trạng thái</h6>
                    </th>
                    <th class="w-25">
                        <h6 class="fw-semibold mb-0">Email</h6>
                    </th>
                    <th class="w-30"></th>
                </tr>
            </thead>
            <tbody>
                @if($users->count() > 0)
                    @foreach ($users as $user)
                        <tr>
                            <td><input type="checkbox" name="id[]" class="form-check-input check-item" value="{{ $user->id ?? '' }}"></td>
                            <td>{{ $user->username ?? '' }}</td>
                            <td>{{ $user->name ?? '' }}</td>
                            <td>{{ $user->role->name ?? '' }}</td>
                            <td>
                                <h6 class="mb-0">
                                    <span class="badge {{ USER_STATUS_BADGE[$user->status] ?? '' }}">
                                        {{ USER_STATUS[$user->status] ?? '' }}
                                    </span>
                                </h6>
                            </td>
                            <td>{{ $user->email ?? '' }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger btn-delete" data-id={{ $user->id ?? '' }} data-url="{{ route('admin.user.destroy') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                    <i class="ti ti-trash"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-success btn-edit link" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Chỉnh sửa"
                                    data-url="{{ route('admin.user.edit', $user->id) }}"
                                >
                                    <i class="ti ti-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-secondary btn-detail link" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Chi tiết"
                                    data-url="{{ route('admin.user.show', $user->id) }}"
                                >
                                    <i class="ti ti-info-circle"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td class="text-center" colspan="7">Không tìm thấy dữ liệu</td>
                @endif
            </tbody>
        </table>
    </div>
    <div class="d-flex flex-column-reverse flex-lg-row justify-content-center justify-content-lg-between align-items-center mt-4 text-center text-lg-start gap-3">
        <div>
            @if($users->total() > 0)
                <span class="text-muted small d-none d-lg-inline">
                    {{ "Hiển thị {$users->firstItem()}~{$users->lastItem()} trong số {$users->total()} kết quả. " }}
                </span>
            @endif
            @if(!empty(request()->all()))
                <span class="text-muted small">
                    <a href="{{ route('admin.user.index') }}">Đặt lại tìm kiếm</a>
                </span>
            @endif
        </div>
        {{ $users->links() }}
    </div>
    @include('admin.user.modal.search_modal')
@endsection

@push('scripts')
    <script>
        const USER_URL = '{{ route('admin.user.index') }}';
    </script>
    <script src="{{ asset('js/admin/user/index.js') }}?v={{ VERSION }}"></script>
@endpush