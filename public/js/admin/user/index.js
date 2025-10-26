const USER_INDEX = {}

$(function(){
    'use strict'

    USER_INDEX.init = function () {
        APP.datepicker('#search-birthday', 'Y/m/d', {maxDate: "today"});
        APP.checkAllCheckbox('.check-all');
        APP.sort($('#table-student'));
        USER_INDEX.search();
        USER_INDEX.delete();
        USER_INDEX.multiDelete();
        USER_INDEX.export();
    }

    USER_INDEX.search = function () {
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
                    $form.attr('action', USER_URL);
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

    USER_INDEX.delete = function () {
        $('.btn-delete').on('click', function() {
            let id = $(this).data('id');
            let url = $(this).data('url');
            APP.popupConfirm(`Bạn có chắc muốn xóa tài khoản này không?`, function(){
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

    USER_INDEX.multiDelete = function () {
        $('#btn-multi-delete').on('click', function() {
            let ids = APP.getCheckedValues('id');
            let totalUser = ids.length;
            let url = $(this).data('url');
            if(totalUser == 0){
                APP.popupAlert('Vui lòng chọn tài khoản dùng muốn xóa');
                return;
            }
            APP.popupConfirm(`Bạn có chắc muốn xóa ${totalUser} tài khoản đã chọn không?`, function(){
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

    USER_INDEX.export = function () {
        $('#btn-export').on('click', function() {
            let url = $(this).data('url');
            let ids = APP.getCheckedValues('id');
            let totalUser = ids.length;
            if(totalUser == 0){
                APP.popupConfirm('Bạn có chắc muốn export tất cả các dữ liệu trong kết quả tìm kiếm không?', function(){
                    let exportUrl = url + window.location.search;
                    window.location.href = exportUrl;
                }, {type: 'blue'});
            }
            else{
                APP.popupConfirm(`Bạn có chắc muốn export ${totalUser} tài khoản đã chọn không?`, function(){
                    let exportUrl = url + '?ids=' + ids.join(',');
                    window.location.href = exportUrl;
                }, {type: 'blue'});
            }
        })
    }
})

$(document).ready(function(){
    USER_INDEX.init();
})