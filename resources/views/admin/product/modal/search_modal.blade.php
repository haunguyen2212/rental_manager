<div class="modal fade" id="modal-search" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchModalLabel">Tìm kiếm sản phẩm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="GET" action="{{ route('admin.product.validate_search') }}" id="form-search">
            <div class="row px-3">
                <div id="msg-search"></div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="{{ request()->name }}">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ request()->slug }}">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="category_id" class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select select2">
                        @foreach ($option['category'] as $key => $category)
                            <option value="{{ $key }}" {{ $key === request()->category_id ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="type" class="form-label">Loại sản phẩm</label>
                    <select name="type" class="form-select select2">
                        @foreach ($option['type'] as $key => $type)
                            <option value="{{ $key }}" {{ $key === request()->type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select name="status" class="form-select select2">
                        @foreach ($option['status'] as $key => $status)
                            <option value="{{ $key }}" {{ $key === request()->status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
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

