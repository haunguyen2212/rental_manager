const RESET_PASSWORD = {}

$(function(){
    'use strict'

    RESET_PASSWORD.init = function () {
        RESET_PASSWORD.submit();
    }

    RESET_PASSWORD.submit = function () {
        $('#btn-submit').on('click', function() {
            APP.loading();
            let $form = $('#form-reset-password');
            let url = $form.attr('action');
            let formData = APP.getFormData($form);
            APP.removeError($form)
            
            let password = $('#password').val();
            let passwordConfirmation = $('#password_confirmation').val();
            
            if (password !== passwordConfirmation) {
                $form.find('[name="password_confirmation"]').addClass('is-invalid').after('<div class="invalid-feedback">Mật khẩu xác nhận không khớp</div>')
                APP.loaded();
                return;
            }
            
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
                else{
                    APP.alertDanger('Có lỗi xảy ra, vui lòng thử lại sau');
                    APP.loaded();
                }
            })
        })
    }
})

$(document).ready(function(){
    RESET_PASSWORD.init();
})
