<div class="modal fade" id="modal-search" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchModalLabel">Tìm kiếm tài khoản</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="GET" action="{{ route('admin.user.validate_search') }}" id="form-search">
            <div class="row px-3">
                <div id="msg-search"></div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="name" class="form-label">Tên / Tài khoản</label>
                    <input type="text" name="name" class="form-control" value="{{ request()->name }}">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="role-id" class="form-label">Vai trò</label>
                    <select name="role_id" class="form-select select2">
                        @foreach ($option['role'] as $key => $role)
                            <option value="{{ $key }}" {{ $key == request()->role_id ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select name="status" class="form-select select2">
                        @foreach ($option['user_status'] as $key => $status)
                            <option value="{{ $key }}" {{ $key == request()->status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="birthday" class="form-label">Ngày sinh</label>
                    <input type="text" name="birthday" class="form-control" id="search-birthday" value="{{ request()->birthday }}">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" value="{{ request()->phone }}">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ request()->email }}">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm-md btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-sm-md btn-primary" id="btn-search-submit">Tìm kiếm</button>
      </div>
    </div>
  </div>
</div>