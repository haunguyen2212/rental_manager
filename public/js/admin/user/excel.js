const USER_EXCEL = {}

$(function(){
    'use strict'

    USER_EXCEL.init = function () {
        USER_EXCEL.import();
    }

     USER_EXCEL.import = function () {
        $('#btn-import').on('click', function() {
            $('#file-import').trigger('click');
        });

        $('#file-import').on('change', function(){
            APP.loading();
            let form = $('#form-import');
            let formData = APP.getFormData(form);
            let url = form.attr('action');
            APP.ajax(url, 'post', formData, function(res){
                if(res.success){
                    APP.setCookie('message_success', res.message);
                    location.reload();
                }
                else{
                    APP.loaded();
                    if (res.errors && res.errors.length > 0) {
                        let html = res.message;
                        html += '<ul>';
                        res.errors.forEach(failure => {
                            const row = failure.row;
                            const msgs = failure.errors.join(', ');
                            html += `<li>Dòng ${row}: ${msgs}</li>`;
                        });
                        html += '</ul>';
                        APP.alertWarning(html);
                    }
                }
                $('#file-import').val('');
            })
        })
     }

})

$(document).ready(function(){
    USER_EXCEL.init();
})