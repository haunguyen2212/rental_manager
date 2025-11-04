@extends('admin.common.master')

@section('title', 'Import tài khoản')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title fw-semibold mb-0">Import tài khoản</h5>
    </div>
    <div class="mt-3">
        <div class="bg-light p-4 rounded-3 border mb-3">
            <div class="mb-3">
                Tại đây bạn có thể <strong class="text-dark">nhập (Import)</strong> dữ liệu từ file Excel, 
                hãy <a href="{{ route('admin.user.download_template') }}" class="fw-semibold text-decoration-none text-primary" id="link-download-template">tải file import mẫu</a> 
                để chuẩn bị dữ liệu đúng định dạng.
            </div>

            <div>
                <h6 class="fw-semibold text-dark mb-2">Lưu ý:</h6>
                <ul class="small text-muted ps-3 mb-0">
                <li>Chỉ chấp nhận file Excel định dạng <code>.xls</code> hoặc <code>.xlsx</code>.</li>
                <li>Vui lòng tải <strong>file mẫu</strong> và nhập dữ liệu theo đúng cột quy định.</li>
                <li>Sau khi import, dữ liệu hợp lệ sẽ được thêm tự động.</li>
                </ul>
            </div>
        </div>
        <div class="d-flex flex-column flex-sm-row gap-2 mt-2">
            <button id="btn-import" class="btn btn-success px-4">
                <i class="fa-solid fa-file-import"></i>
                <span>Import</span>
            </button>
        </div>
        <form action="{{ route('admin.user.import') }}" id="form-import" enctype="multipart/form-data">
            <input type="file" name="file" id="file-import" class="d-none" accept=".xlsx,.xls">
        </form>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/user/excel.js') }}?v={{ VERSION }}"></script>
@endpush
