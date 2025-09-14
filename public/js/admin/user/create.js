const USER_CREATE = {}

$(function(){
    'use strict'

    USER_CREATE.init = function () {
        USER_CREATE.submit();
    }

    USER_CREATE.submit = function () {
        $('#btn-save').on('click', function () {
            let $form = $('#form-save');
            let url = $form.attr('action');
            let formData = APP.getFormData($form);
            APP.ajax(url, 'post', formData, function(res){
                if(res.success){
                    APP.setCookie('message_success', res.message);
                    if(res.url_redirect){
                        window.location.href = res.url_redirect;
                    }
                    else{
                        location.reload();
                    }
                }
            }, function (err){
                if(err.status = 422){
                    APP.validate($form, err.responseJSON.errors);
                }
                else{
                    APP.alertDanger(err.responseJSON.message)
                }
            })
        })
    }
})

$(document).ready(function(){
    USER_CREATE.init();
})