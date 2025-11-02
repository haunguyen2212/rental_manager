const CATEGORY_CREATE = {}

$(function(){
    'use strict'

    CATEGORY_CREATE.init = function () {
        CATEGORY_CREATE.submit();
        CATEGORY_CREATE.generateSlug();
    }

    CATEGORY_CREATE.submit = function () {
        $('#btn-save').on('click', function () {
            APP.loading();
            let $form = $('#form-save');
            let url = $form.attr('action');
            let formData = APP.getFormData($form);
            APP.postAjax(url, formData, function(res){
                if(res.success){
                    APP.setCookie('message_success', res.message);
                    if(res.url_redirect){
                        window.location.href = res.url_redirect;
                    }
                    else{
                        location.reload();
                    }
                }else{
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

    CATEGORY_CREATE.generateSlug = function () {
        $('#name').on('input', function (){
            let val = $(this).val();
            let slug = APP.convertToSlug(val);
            $('#slug').val(slug);
        })
    }
})

$(document).ready(function(){
    CATEGORY_CREATE.init();
})