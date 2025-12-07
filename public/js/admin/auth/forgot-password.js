const FORGOT_PASSWORD = {}

$(function(){
    'use strict'

    FORGOT_PASSWORD.init = function () {
        FORGOT_PASSWORD.submit();
    }

    FORGOT_PASSWORD.submit = function () {
        $('#btn-submit').on('click', function() {
            APP.loading();
            let $form = $('#form-forgot-password');
            let url = $form.attr('action');
            let formData = APP.getFormData($form);
            APP.removeError($form)
            
            APP.postAjax(url, formData, function (res){
                if(res.success){
                    if(res.redirect){
                        window.location.href = res.redirect;
                    }
                    else{
                        APP.alertSuccess(res.message);
                        APP.loaded();
                        setTimeout(function(){
                            window.location.href = '/admin/login';
                        }, 2000);
                    }
                }
                else{
                    APP.alertDanger(res.message);
                    APP.loaded();
                }
            }, function (err){
                if(err.status == 422){
                    APP.validate($form, err.responseJSON.errors);
                    APP.loaded();
                }
                else if(err.status == 400){
                    APP.alertDanger(err.responseJSON.message || 'Có lỗi xảy ra, vui lòng thử lại sau');
                    APP.loaded();
                }
                else{
                    APP.alertDanger('Có lỗi xảy ra, vui lòng thử lại sau');
                    APP.loaded();
                }
            })
        })
    }
})

$(document).ready(function(){
    FORGOT_PASSWORD.init();
})
