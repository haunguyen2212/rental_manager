const LOGIN = {}

$(function(){
    'use strict'

    LOGIN.init = function () {
        LOGIN.submit();
    }

    LOGIN.submit = function () {
        $('#btn-submit').on('click', function() {
            APP.loading();
            let $form = $('#form-login');
            let url = $form.attr('action');
            let formData = APP.getFormData($form);
            APP.removeError($form)
            APP.postAjax(url, formData, function (res){
                if(res.success){
                    window.location.href = res.redirect;
                }
                else{
                    APP.alertDanger(res.message);
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
    LOGIN.init();
})