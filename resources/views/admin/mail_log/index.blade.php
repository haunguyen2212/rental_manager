@extends('admin.common.master')

@section('title', 'Gửi mail')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h5 class="card-title fw-semibold mb-0">Gửi mail</h5>
        </div>
        <div>
            <button type="button" class="btn btn-sm-md btn-primary" id="btn-refresh">
                <i class="ti ti-refresh"></i>
                <span class="d-none d-sm-inline">Làm mới</span>
            </button>
        </div>
    </div>

        <div class="table-responsive">
            <table class="table table-hover table-fixed mb-0 align-middle">
                <thead class="text-dark">
                    <tr>
                        <th class="w-5">
                            <span class="fw-semibold mb-0">#</span>
                        </th>
                        <th class="w-20">
                            <span class="fw-semibold mb-0">Người nhận</span>
                        </th>
                        <th class="w-25">
                            <span class="fw-semibold mb-0">Tiêu đề</span>
                        </th>
                        <th class="w-15">
                            <span class="fw-semibold mb-0">Template</span>
                        </th>
                        <th class="w-15">
                            <span class="fw-semibold mb-0">Thời gian gửi</span>
                        </th>
                        <th class="w-10">
                            <span class="fw-semibold mb-0">Trạng thái</span>
                        </th>
                        <th class="w-10">
                            <span class="fw-semibold mb-0"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($mails) && $mails->count() > 0)
                    @foreach ($mails as $index => $mail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div>
                                    <div class="fw-semibold">{{ $mail->to_name }}</div>
                                    <small class="text-muted">{{ $mail->to_email }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 300px;" title="{{ $mail->subject }}">
                                    {{ $mail->subject }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary">
                                    {{ $mail->body }}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    @if($mail->sent_at->diffInMinutes(now()) < 60)
                                        {{ $mail->sent_at->diffInMinutes(now()) }} phút trước
                                    @elseif($mail->sent_at->diffInHours(now()) < 24)
                                        {{ $mail->sent_at->diffInHours(now()) }} giờ trước
                                    @else
                                        {{ $mail->sent_at->format('d/m/Y H:i') }}
                                    @endif
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success">
                                    <i class="ti ti-check me-1"></i>
                                    {{ $mail->template }}
                                </span>
                            </td>
                            <td>
                                <button type="button" 
                                    class="btn btn-sm btn-info btn-view-detail" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal-mail-detail"
                                    data-mail-id="{{ $mail->id }}"
                                    data-mail-to="{{ $mail->to }}"
                                    data-mail-to-name="{{ $mail->to_name }}"
                                    data-mail-subject="{{ $mail->subject }}"
                                    data-mail-content="{{ htmlspecialchars($mail->content, ENT_QUOTES, 'UTF-8') }}"
                                    data-mail-template="{{ $mail->template }}"
                                    data-mail-sent-at="{{ $mail->sent_at->format(DATETIME_FORMAT_VIEW) }}"
                                    data-mail-attachments="{{ htmlspecialchars(json_encode($mail->attachments), ENT_QUOTES, 'UTF-8') }}"
                                    title="Xem chi tiết">
                                    <i class="ti ti-eye"></i>
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
    @include('admin.mail_log.modal.detail_modal')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#btn-refresh').on('click', function() {
                location.reload();
            });

            $('.btn-view-detail').on('click', function() {
                const mailId = $(this).data('mail-id');
                const mailTo = $(this).data('mail-to');
                const mailToName = $(this).data('mail-to-name');
                const mailSubject = $(this).data('mail-subject');
                const mailContent = $(this).data('mail-content');
                const mailTemplate = $(this).data('mail-template');
                const mailSentAt = $(this).data('mail-sent-at');
                let mailAttachments = $(this).data('mail-attachments');
                
                if (typeof mailAttachments === 'string') {
                    try {
                        mailAttachments = JSON.parse(mailAttachments);
                    } catch (e) {
                        mailAttachments = [];
                    }
                }

                $('#modal-mail-to').html(mailToName + ' &lt;' + mailTo + '&gt;');
                $('#modal-mail-subject').text(mailSubject);
                $('#modal-mail-template').text(mailTemplate);
                $('#modal-mail-sent-at').text(mailSentAt);
                $('#modal-mail-content').text(mailContent);

                const attachmentsContainer = $('#modal-mail-attachments');
                const attachmentsContainerWrapper = $('#modal-mail-attachments-container');
                attachmentsContainer.empty();
                
                if (mailAttachments && Array.isArray(mailAttachments) && mailAttachments.length > 0) {
                    attachmentsContainerWrapper.removeClass('d-none');
                    mailAttachments.forEach(function(attachment) {
                        attachmentsContainer.append(
                            '<div class="d-flex align-items-center gap-2 mb-2">' +
                            '<i class="ti ti-paperclip text-muted"></i>' +
                            '<span class="text-muted">' + attachment + '</span>' +
                            '</div>'
                        );
                    });
                } else {
                    attachmentsContainerWrapper.addClass('d-none');
                }
            });
        });
    </script>
@endpush

