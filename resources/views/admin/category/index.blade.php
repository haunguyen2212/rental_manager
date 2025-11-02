@extends('admin.common.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title fw-semibold mb-0">
            <span class="d-none d-md-inline">Tất cả danh mục</span>
            <span class="d-inline d-md-none">Danh mục</span>
        </h5>
        <div>
            <button type="button" class="btn btn-sm-md btn-success ms-0 me-md-1" id="btn-search"><i class="ti ti-search"></i><span class="d-none d-sm-inline"> Tìm kiếm</span></button>
            <button type="button" class="btn btn-sm-md btn-danger ms-0 me-md-1" id="btn-multi-delete" data-url="{{ route('admin.category.destroy') }}" {{ $categories->count() > 0 ? '' : 'disabled' }}><i class="ti ti-trash"></i><span class="d-none d-sm-inline"> Xóa</span></button>
            <button type="button" class="btn btn-sm-md btn-primary link" id="btn-create" data-url="{{ route('admin.category.create') }}"><i class="ti ti-plus"></i><span class="d-none d-sm-inline"> Thêm mới</span></button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-fixed text-nowrap mb-0 align-middle" id="table-student">
            <thead class="text-dark">
                <tr>
                    <th class="w-5">
                        <input type="checkbox" class="form-check-input check-all" value="">
                    </th>
                    <th class="w-8 sortable" data-sort="id">
                        <span class="fw-semibold mb-0">ID</span>
                    </th>
                    <th class="w-20 sortable" data-sort="name">
                        <span class="fw-semibold mb-0">Tên danh mục</span>
                    </th>
                    <th class="w-20 sortable" data-sort="slug">
                        <span class="fw-semibold mb-0">Slug</span>
                    </th>
                    <th class="w-37 sortable" data-sort="description">
                        <span class="fw-semibold mb-0">Mô tả</span>
                    </th>
                    <th class="w-10"></th>
                </tr>
            </thead>
            <tbody>
                @if($categories->count() > 0)
                    @foreach ($categories as $category)
                        <tr>
                            <td><input type="checkbox" name="id[]" class="form-check-input check-item" value="{{ $category->id ?? '' }}"></td>
                            <td>{{ $category->id ?? '' }}</td>
                            <td>{{ $category->name ?? '' }}</td>
                            <td>{{ $category->slug ?? '' }}</td>
                            <td>
                                <span class="text-ellipsis" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $category->description ?? '' }}">
                                    {{ $category->description ?? '' }}
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $category->id }}" data-url="{{ route('admin.category.destroy') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                    <i class="ti ti-trash"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-success btn-edit link" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Chỉnh sửa"
                                    data-url="{{ route('admin.category.edit', $category->id) }}"
                                >
                                    <i class="ti ti-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td class="text-center" colspan="6">Không tìm thấy dữ liệu</td>
                @endif
            </tbody>
        </table>
    </div>
    <div class="d-flex flex-column-reverse flex-lg-row justify-content-center justify-content-lg-between align-items-center mt-4 text-center text-lg-start gap-3">
        <div>
            @if($categories->total() > 0)
                <span class="text-muted small d-none d-lg-inline">
                    {{ "Hiển thị {$categories->firstItem()}~{$categories->lastItem()} trong số {$categories->total()} kết quả. " }}
                </span>
            @endif
            @if(!empty(request()->all()))
                <span class="text-muted small">
                    <a href="{{ route('admin.category.index') }}">Đặt lại tìm kiếm</a>
                </span>
            @endif
        </div>
        {{ $categories->links() }}
    </div>
    @include('admin.category.modal.search_modal')
@endsection

@push('scripts')
    <script>
        const CATEGORY_URL = '{{ route('admin.category.index') }}';
    </script>
    <script src="{{ asset('js/admin/category/index.js') }}?v={{ VERSION }}"></script>
@endpush