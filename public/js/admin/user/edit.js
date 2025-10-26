const USER_EDIT = {}

$(function(){
    'use strict'

    USER_EDIT.init = function () {
        APP.datepicker('#birthday', 'Y/m/d', {maxDate: "today"});
        USER_EDIT.submit();
    }

    USER_EDIT.submit = function () {
        $('#btn-save').on('click', function () {
            APP.loading();
            let $form = $('#form-save');
            let url = $form.attr('action');
            let formData = APP.getFormData($form);
            APP.postAjax(url, formData, function(res){
                if(res.success){
                    APP.setCookie('message_success', res.message);
                    location.reload();
                }
                else{
                    APP.loaded();
                }
            }, function (err){
                if(err.status == 422){
                    APP.validate($form, err.responseJSON.errors);
                    APP.alertDanger('Có lỗi xảy ra, vui lòng kiểm tra lại thông tin nhập vào');
                    APP.loaded();
                }
                else{
                    APP.alertDanger('Có lỗi xảy ra, vui lòng thử lại sao');
                    APP.loaded();
                }
            })
        })
    }
})

$(document).ready(function(){
    USER_EDIT.init();
})