@extends('admin.common.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title fw-semibold mb-0">
            <span class="d-none d-md-inline">Danh sách người dùng</span>
            <span class="d-inline d-md-none">Người dùng</span>
        </h5>
        <div>
            <button type="button" class="btn btn-sm-md btn-success ms-0 me-md-1" id="btn-search"><i class="ti ti-search"></i><span class="d-none d-sm-inline"> Tìm kiếm</span></button>
            <button type="button" class="btn btn-sm-md btn-danger ms-0 me-md-1" id="btn-multi-delete" data-url="{{ route('admin.user.destroy') }}"><i class="ti ti-trash"></i><span class="d-none d-sm-inline"> Xóa</span></button>
            <button type="button" class="btn btn-sm-md btn-primary link" id="btn-create" data-url="{{ route('admin.user.create') }}"><i class="ti ti-plus"></i><span class="d-none d-sm-inline"> Thêm mới</span></button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
                <tr>
                    <th class="w-10">
                        <input type="checkbox" class="check-all" value="">
                    </th>
                    <th class="w-20">
                        <h6 class="fs-4 fw-semibold mb-0">Tên</h6>
                    </th>
                    <th class="w-15">
                        <h6 class="fs-4 fw-semibold mb-0">Vai trò</h6>
                    </th>
                    <th class="w-15">
                        <h6 class="fs-4 fw-semibold mb-0">Trạng thái</h6>
                    </th>
                    <th class="w-25">
                        <h6 class="fs-4 fw-semibold mb-0">Email</h6>
                    </th>
                    <th class="w-30"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><input type="checkbox" name="id[]" class="check-item" value="{{ $user->id ?? '' }}"></td>
                        <td>{{ $user->name ?? '' }}</td>
                        <td>{{ $user->role->name ?? '' }}</td>
                        <td>
                            <span class="badge {{ USER_STATUS_BADGE[$user->status] ?? '' }}">
                                {{ USER_STATUS[$user->status] ?? '' }}
                            </span>
                        </td>
                        <td>{{ $user->email ?? '' }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger btn-delete" data-id={{ $user->id ?? '' }} data-url="{{ route('admin.user.destroy') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                <i class="ti ti-trash"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-success btn-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh sửa">
                                <i class="ti ti-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary btn-detail" data-bs-toggle="tooltip" data-bs-placement="top" title="Chi tiết">
                                <i class="ti ti-info-circle"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links() }}
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/user/index.js') }}?v={{ VERSION }}"></script>
@endpush