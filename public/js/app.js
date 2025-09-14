const APP = {}

$(function(){
    'use strict'

    APP.getFormData = function ($form) {
        let formData = new FormData();
        let arr = $form.serializeArray();
        for(let i = 0; i < arr.length; i++){
            formData.append(arr[i].name, arr[i].value);
        }
        return formData;
    }

    APP.linkButton = function () {
        $('button.link').on('click', function(){
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
                    console.error('Ajax Error:', xhr);
                }
            }
        });
    }

    APP.select2 = function () {
        $('.select2').select2({
            theme: 'bootstrap-5',
            allowClear: false,
            width: '100%'
        });
    }

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

    APP.alertDanger = function (message) {
        $('#alert-error').removeClass('d-none');
        $('#alert-error').find('.message-text').html(message || 'Có lỗi xảy ra, thử lại sau');
    }
})

$(document).ready(function(){
    APP.linkButton();
    APP.setupAjax();
    APP.select2();
    APP.showAlertMessage();
})