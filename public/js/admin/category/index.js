const CATEGORY_INDEX = {}

$(function(){
    'use strict'

    CATEGORY_INDEX.init = function () {
        APP.checkAllCheckbox('.check-all');
        APP.sort($('#table-student'));
        CATEGORY_INDEX.delete();
        CATEGORY_INDEX.multiDelete();
        CATEGORY_INDEX.search();
    }

    CATEGORY_INDEX.delete = function () {
        $('.btn-delete').on('click', function() {
            let id = $(this).data('id');
            let url = $(this).data('url');
            APP.popupConfirm(`Bạn có chắc muốn danh mục này không?`, function(){
                APP.loading();
                let formData = new FormData();
                formData.append('_method', 'delete');
                formData.append('id', id);
                APP.postAjax(url, formData, function(res) {
                    if(res.success){
                        APP.setCookie('message_success', res.message);
                        location.reload();
                    }
                    else{
                        APP.loaded();
                    }
                })
            }, {type: 'red'})
        })
    }

    CATEGORY_INDEX.multiDelete = function () {
        $('#btn-multi-delete').on('click', function() {
            let ids = APP.getCheckedValues('id');
            let totalUser = ids.length;
            let url = $(this).data('url');
            if(totalUser == 0){
                APP.popupAlert('Vui lòng danh mục muốn xóa');
                return;
            }
            APP.popupConfirm(`Bạn có chắc muốn xóa ${totalUser} danh mục đã chọn không?`, function(){
                APP.loading()
                let formData = new FormData();
                formData.append('_method', 'delete');
                formData.append('id', ids);
                APP.postAjax(url, formData, function(res) {
                    if(res.success){
                        APP.setCookie('message_success', res.message);
                        location.reload();
                    }
                    else{
                        APP.loaded();
                    }
                })
            }, {type: 'red'})
        })
    }

    CATEGORY_INDEX.search = function () {
        $('#btn-search').on('click', function() {
            $('#modal-search').modal('show');
        })

        $('#btn-search-submit').on('click', function() {
            APP.loading();
            let $form = $('#form-search');
            let url = $form.attr('action');
            let formData = APP.getFormData($form);
            APP.postAjax(url, formData, function(res){
                if(res.success){
                    $form.attr('action', CATEGORY_URL);
                    APP.search($form);
                }
                else{
                    APP.loaded();
                }
            }, function (err){
                if(err.status == 422){
                    APP.validate($form, err.responseJSON.errors);
                    APP.alertDanger('Có lỗi xảy ra, vui lòng kiểm tra lại thông tin nhập vào', '#msg-search');
                    APP.loaded();
                }
                else{
                    APP.alertDanger('Có lỗi xảy ra, vui lòng thử lại sao', '#msg-search');
                    APP.loaded();
                }
            })
        })
    }
})

$(document).ready(function(){
    CATEGORY_INDEX.init();
})