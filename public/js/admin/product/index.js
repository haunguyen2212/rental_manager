const PRODUCT_INDEX = {}

$(function(){
    'use strict'

    PRODUCT_INDEX.init = function () {
        APP.checkAllCheckbox('.check-all');
        APP.sort($('#table-product'));
        PRODUCT_INDEX.search();
        PRODUCT_INDEX.copy();
        PRODUCT_INDEX.delete();
        PRODUCT_INDEX.multiDelete();
    }

    PRODUCT_INDEX.search = function () {
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
                    $form.attr('action', PRODUCT_URL);
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

    PRODUCT_INDEX.copy = function () {
        $(document).on('click', '.btn-copy', function() {
            let id = $(this).data('id');
            let url = PRODUCT_URL + '/' + id + '/copy';
            APP.popupConfirm(`Bạn có chắc muốn sao chép sản phẩm này không?`, function(){
                APP.loading();
                let formData = new FormData();
                formData.append('_method', 'POST');
                APP.postAjax(url, formData, function(res) {
                    if(res.success){
                        APP.setCookie('message_success', res.message);
                        if(res.url_redirect){
                            window.location.href = res.url_redirect;
                        }
                        else{
                            location.reload();
                        }
                    }
                    else{
                        APP.loaded();
                    }
                })
            }, {type: 'blue'})
        })
    }

    PRODUCT_INDEX.delete = function () {
        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            let url = $(this).data('url');
            APP.popupConfirm(`Bạn có chắc muốn xóa sản phẩm này không?`, function(){
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

    PRODUCT_INDEX.multiDelete = function () {
        $('#btn-multi-delete').on('click', function() {
            let ids = APP.getCheckedValues('id');
            let totalProduct = ids.length;
            let url = $(this).data('url');
            if(totalProduct == 0){
                APP.popupAlert('Vui lòng chọn sản phẩm muốn xóa');
                return;
            }
            APP.popupConfirm(`Bạn có chắc muốn xóa ${totalProduct} sản phẩm đã chọn không?`, function(){
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
})

$(document).ready(function(){
    PRODUCT_INDEX.init();
})

