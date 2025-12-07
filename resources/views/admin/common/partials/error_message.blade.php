<div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon {{ session('success') ? '' : 'd-none' }}" id="alert-success" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <div class="d-flex align-items-center me-3 me-md-0">
    <i class="ti ti-info-circle fs-5 me-2 text-success"></i>
    <span class="message-text">{{ session('success') ?? '' }}</span>
  </div>
</div>
<div class="alert customize-alert alert-dismissible alert-light-danger bg-danger-subtle text-danger fade show remove-close-icon {{ session('error') ? '' : 'd-none' }}" id="alert-error" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <div class="d-flex align-items-center me-3 me-md-0">
    <i class="ti ti-info-circle fs-5 me-2 text-danger"></i>
    <span class="message-text">{{ session('error') ?? '' }}</span>
  </div>
</div>