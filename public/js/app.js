const APP = {}

$(function(){
    'use strict'

    APP.loading = function () {
        $('#loader-wrapper').show();
    }

    APP.loaded = function () {
        $('#loader-wrapper').hide();
    }

    APP.isLoading = function () {
        return $('#loader-wrapper').is(':visible');
    };

    APP.getFormData = function ($form) {
        let formData = new FormData();
        let arr = $form.serializeArray();
        for(let i = 0; i < arr.length; i++){
            formData.append(arr[i].name, arr[i].value);
        }
        $form.find('input[type="file"]').each(function () {
            if (this.files.length > 0) {
                formData.append(this.name, this.files[0]);
            }
        });
        return formData;
    }

    APP.linkButton = function () {
        $('button.link').on('click', function(){
            APP.loading();
            let url = $(this).attr('data-url');
            if(url){
                window.location.href = url;
            }
        });
    }

    APP.setupAjax = function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    APP.ajax = function (url, method, data, successCallback, errorCallback) {
        $.ajax({
            url: url,
            type: method,
            data: data,
            processData: !(data instanceof FormData),
            contentType: (data instanceof FormData) ? false : 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function (res) {
                if (typeof successCallback === 'function') {
                    successCallback(res);
                }
            },
            error: function (xhr) {
                if (typeof errorCallback === 'function') {
                    errorCallback(xhr);
                } else {
                    APP.alertDanger(xhr.responseJSON?.message ?? 'Có lỗi xảy ra, vui lòng thử lại sao');
                    if(APP.isLoading()){
                        APP.loaded();
                    }
                }
            }
        });
    }

    APP.select2 = function () {
        $('.select2').each(function () {
            const $parentModal = $(this).closest('.modal');
            
            $(this).select2({
                theme: 'bootstrap-5',
                allowClear: false,
                width: '100%',
                dropdownParent: $parentModal.length ? $parentModal : $(document.body)
            });
        });
    };

    APP.setCookie = function (name, value, days = 7) {
        let expires = "";
        if(days) {
            let date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/";
    }

    APP.getCookie = function (name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i].trim();
            if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length));
        }
        return null;
    }

    APP.deleteCookie = function (name) {
        document.cookie = name + "=; Max-Age=-99999999; path=/";
    }

    APP.showAlertMessage = function () {
        let message_success = APP.getCookie('message_success');
        if(message_success){
            $('#alert-success').removeClass('d-none');
            $('#alert-success').find('.message-text').html(message_success);
            APP.deleteCookie('message_success');
        }
    }

    APP.checkAllCheckbox = function (check_all_selector) {
        $('body').on('change', check_all_selector, function(){
            let isChecked = $(this).is(':checked');
            $(this).closest('table').find('.check-item:not(:disabled):visible').prop('checked', isChecked);
        })

        $('body').on('change', '.check-item', function(){
            let $table = $(this).closest('table');
            let $checkAll = $table.find(check_all_selector);
            let $checkboxes = $table.find('.check-item:not(:disabled):visible');
            let allChecked = $checkboxes.length && $checkboxes.filter(':checked').length === $checkboxes.length;
            $checkAll.prop('checked', allChecked);
        });
    }

    APP.getCheckedValues = function(inputName) {
        let values = [];
        $(`input[name^="${inputName}["]:checked:not(:disabled):visible`).each(function() {
            values.push($(this).val());
        });
        return values;
    }

    APP.search = function($form) {
        if ($form.length === 0) return;
        const action = $form.attr('action') || '';
        const params = [];

        $form.find('input, select, textarea').each(function() {
            const $el = $(this);
            const name = $el.attr('name');
            const value = $el.val();

            if (!name || value === null || value === undefined || value === '') return;

            params.push(`${encodeURIComponent(name)}=${encodeURIComponent(value)}`);
        });

        let newAction = action.split('?')[0];
        if (params.length > 0) {
            newAction += '?' + params.join('&');
        }

        window.location.href = newAction;
    };


    APP.validate = function($form, errors) {
        $form.find('.is-invalid').removeClass('is-invalid');
        $form.find('.invalid-feedback').remove();

        $.each(errors, function(field, messages) {
            let $input = $form.find('[name="' + field + '"]');

            if ($input.length) {
                $input.addClass('is-invalid');

                if ($input.hasClass('select2')) {
                    $input.next('.select2-container')
                        .after('<div class="invalid-feedback d-block">' + messages[0] + '</div>');
                } else {
                    $input.after('<div class="invalid-feedback">' + messages[0] + '</div>');
                }
            }
        });
    };

    APP.alertSuccess = function(message, container = '#msg') {
        let $container = $(container);
        if ($container.length === 0) {
            return;
        }
        let alertHtml = `
            <div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon" 
                id="alert-success" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="d-flex align-items-center me-3 me-md-0">
                    <i class="ti ti-info-circle fs-5 me-2 text-success"></i>
                    <span class="message-text">${message}</span>
                </div>
            </div>
        `;
        $container.html(alertHtml);
    };

    APP.alertDanger = function(message, container = '#msg') {
        let $container = $(container);
        if ($container.length === 0) {
            return;
        }
        let alertHtml = `
            <div class="alert customize-alert alert-dismissible alert-light-danger bg-danger-subtle text-danger fade show remove-close-icon" 
                id="alert-error" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="d-flex align-items-center me-3 me-md-0">
                    <i class="ti ti-info-circle fs-5 me-2 text-danger"></i>
                    <span class="message-text">${message}</span>
                </div>
            </div>
        `;
        $container.html(alertHtml);
    };

    APP.alertWarning = function(message, container = '#msg') {
        let $container = $(container);
        if ($container.length === 0) {
            return;
        }
        let alertHtml = `
            <div class="alert customize-alert alert-dismissible alert-light-warning bg-warning-subtle text-warning fade show remove-close-icon" 
                id="alert-warning" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="d-flex align-items-center me-3 me-md-0">
                    <i class="ti ti-alert-triangle fs-5 me-2 text-warning"></i>
                    <span class="message-text">${message}</span>
                </div>
            </div>
        `;
        $container.html(alertHtml);
    };

    APP.datepicker = function(selector = ".datepicker", format = "Y/m/d", options = {}) {
        const settings = Object.assign(
            { dateFormat: format, disableMobile: true }, 
            options
        );
        return flatpickr(selector, settings);
    };

    APP.popupConfirm = function(message, onConfirm, options = {}) {
        const {
            title = 'Xác nhận hành động',
            type = 'orange',
            theme = 'material',
            confirmText = 'Đồng ý',
            cancelText = 'Hủy',
            animation = 'scale',
        } = options;

        $.confirm({
            title,
            content: message,
            type,
            theme,
            animation,
            buttons: {
            ok: {
                text: confirmText,
                btnClass: `btn-${type}`,
                action: function () {
                if (typeof onConfirm === 'function') onConfirm();
                }
            },
            cancel: {
                text: cancelText,
                btnClass: 'btn-default'
            }
            }
        });
    }

    APP.popupAlert = function(message, options = {}) {
        const {
            title = 'Thông báo',
            type = 'blue',
            theme = 'material',
            okText = 'Đã hiểu',
            animation = 'scale',
        } = options;

        $.alert({
            title,
            content: message,
            type,
            theme,
            animation,
            buttons: {
                ok: {
                    text: okText,
                    btnClass: `btn-${type}`
                }
            }
        });
    };
})

$(document).ready(function(){
    APP.linkButton();
    APP.setupAjax();
    APP.select2();
    APP.showAlertMessage();
    if(APP.isLoading()){
        APP.loaded();
    }
})