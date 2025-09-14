const USER_INDEX = {}

$(function(){
    'use strict'

    USER_INDEX.init = function () {
        APP.checkAllCheckbox('.check-all');
        USER_INDEX.delete();
        USER_INDEX.multiDelete();
    }

    USER_INDEX.delete = function () {
        $('.btn-delete').on('click', function() {
            let id = $(this).data('id');
            let url = $(this).data('url');
            let formData = new FormData();
            formData.append('_method', 'delete');
            formData.append('id', id);
            APP.ajax(url, 'post', formData, function(res) {
                if(res.success){
                    APP.setCookie('message_success', res.message);
                    location.reload();
                }
            }, function(err){
                APP.alertDanger(err.responseJSON.message);
            })
        })
    }

    USER_INDEX.multiDelete = function () {
        $('#btn-multi-delete').on('click', function() {
            let ids = APP.getCheckedValues('id');
            let url = $(this).data('url');
            let formData = new FormData();
            formData.append('_method', 'delete');
            formData.append('id', ids);
            APP.ajax(url, 'post', formData, function(res) {
                if(res.success){
                    APP.setCookie('message_success', res.message);
                    location.reload();
                }
            }, function(err){
                APP.alertDanger(err.responseJSON.message);
            })
        })
    }
})

$(document).ready(function(){
    USER_INDEX.init();
})