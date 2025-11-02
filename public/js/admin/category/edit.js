const CATEGORY_EDIT = {}

$(function(){
    'use strict'

    CATEGORY_EDIT.init = function () {
        CATEGORY_EDIT.submit();
        CATEGORY_EDIT.generateSlug();
    }

    CATEGORY_EDIT.submit = function () {
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

    CATEGORY_EDIT.generateSlug = function () {
        $('#name').on('input', function (){
            let val = $(this).val();
            let slug = APP.convertToSlug(val);
            $('#slug').val(slug);
        })
    }
})

$(document).ready(function(){
    CATEGORY_EDIT.init();
})