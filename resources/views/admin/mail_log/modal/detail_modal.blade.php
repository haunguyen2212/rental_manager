<div class="modal fade" id="modal-mail-detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mailDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mailDetailModalLabel">
                    <i class="ti ti-mail me-2"></i>
                    Chi tiết email
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mail-detail">
                    <!-- Thông tin người nhận -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="ti ti-user me-1"></i>
                            Người nhận
                        </label>
                        <div class="p-3 bg-light rounded">
                            <div id="modal-mail-to" class="mb-0"></div>
                        </div>
                    </div>

                    <!-- Tiêu đề -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="ti ti-tag me-1"></i>
                            Tiêu đề
                        </label>
                        <div class="p-3 bg-light rounded">
                            <div id="modal-mail-subject" class="mb-0 fw-semibold"></div>
                        </div>
                    </div>

                    <!-- Template -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="ti ti-file-text me-1"></i>
                            Template
                        </label>
                        <div class="p-3 bg-light rounded">
                            <span id="modal-mail-template" class="badge bg-secondary-subtle text-secondary"></span>
                        </div>
                    </div>

                    <!-- Thời gian gửi -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="ti ti-clock me-1"></i>
                            Thời gian gửi
                        </label>
                        <div class="p-3 bg-light rounded">
                            <div id="modal-mail-sent-at" class="mb-0"></div>
                        </div>
                    </div>

                    <!-- Nội dung email -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="ti ti-file-description me-1"></i>
                            Nội dung
                        </label>
                        <div class="p-3 bg-light rounded" style="max-height: 400px; overflow-y: auto;">
                            <div id="modal-mail-content" class="mb-0" style="white-space: pre-wrap; line-height: 1.8;"></div>
                        </div>
                    </div>

                    <!-- File đính kèm -->
                    <div class="mb-4 d-none" id="modal-mail-attachments-container">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="ti ti-paperclip me-1"></i>
                            File đính kèm
                        </label>
                        <div class="p-3 bg-light rounded" id="modal-mail-attachments">
                            <!-- Attachments will be inserted here -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm-md btn-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>
                    Đóng
                </button>
            </div>
        </div>
    </div>
</div>

