<div class="modal fade" id="modal-search" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchModalLabel">Tìm kiếm danh mục</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="GET" action="{{ route('admin.category.validate_search') }}" id="form-search">
            <div class="row px-3">
                <div id="msg-search"></div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="name" class="form-label">Tên danh mục</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ request()->name }}">
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ request()->slug }}">
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