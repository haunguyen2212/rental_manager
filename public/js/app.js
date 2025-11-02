const APP = {}

$(function(){
    'use strict'

    // =========================================================
    // VOID FUNCTIONS (No return value)
    // =========================================================

    /**
     * Displays the loading screen (e.g., during AJAX requests or page loading).
     */
    APP.loading = function () {
        $('#loader-wrapper').show();
    }

    /**
     * Hides the loading screen after processing or data loading is complete.
     */
    APP.loaded = function () {
        $('#loader-wrapper').hide();
    }

    /**
     * Attaches click event handlers to buttons with the 'link' class.
     * When clicked, the page will redirect to the URL specified in the 'data-url' attribute.
     */
    APP.linkButton = function () {
        $('button.link').on('click', function(){
            APP.loading();
            let url = $(this).attr('data-url');
            if(url){
                window.location.href = url;
            }
        });
    }

    /**
     * Initializes all elements with the "select2" class using the Select2 plugin.
     */
    APP.select2 = function () {
        $('.select2').each(function () {
            const $parentModal = $(this).closest('.modal');
            
            $(this).select2({
                theme: 'bootstrap-5',
                allowClear: false,
                width: '100%',
                dropdownParent: $parentModal.length ? $parentModal : $(document.body)
            });
        });
    };

    /**
     * Initialize Bootstrap tooltips across the page.
     */
    APP.tooltip = function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    /**
     * Configures global AJAX settings for jQuery.
     */
    APP.setupAjax = function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    /**
     * Performs an AJAX post request with standardized settings and error handling.
     *
     * @param {string} url - The endpoint URL for the AJAX request.
     * @param {object|FormData} data - The data to send with the request.
     * @param {function} [successCallback] - Callback executed on successful response.
     * @param {function} [errorCallback] - Optional callback executed when an error occurs.
     */
    APP.postAjax = function (url, data, successCallback, errorCallback) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            processData: !(data instanceof FormData),
            contentType: (data instanceof FormData) ? false : 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function (res) {
                if (typeof successCallback === 'function') {
                    successCallback(res);
                }
            },
            error: function (xhr) {
                if (typeof errorCallback === 'function') {
                    errorCallback(xhr);
                } else {
                    APP.alertDanger(xhr.responseJSON?.message ?? 'Có lỗi xảy ra, vui lòng thử lại sao');
                    if(APP.isLoading()){
                        APP.loaded();
                    }
                }
            }
        });
    }

    /**
     * Performs an AJAX get request with standardized settings and error handling.
     *
     * @param {string} url - The endpoint URL for the AJAX request.
     * @param {object|FormData} data - The data to send with the request.
     * @param {function} [successCallback] - Callback executed on successful response.
     * @param {function} [errorCallback] - Optional callback executed when an error occurs.
     */
    APP.getAjax = function (url, data, successCallback, errorCallback) {
        $.ajax({
            url: url,
            type: 'GET',
            data: data,
            success: function (res) {
                if (typeof successCallback === 'function') {
                    successCallback(res);
                }
            },
            error: function (xhr) {
                if (typeof errorCallback === 'function') {
                    errorCallback(xhr);
                } else {
                    APP.alertDanger(xhr.responseJSON?.message ?? 'Có lỗi xảy ra, vui lòng thử lại sau');
                    if (APP.isLoading()) {
                        APP.loaded();
                    }
                }
            }
        });
    };

    /**
     * Displays validation error messages for form inputs.
     *
     * @param {jQuery} $form - The form element to validate.
     * @param {Object} errors - An object where keys are input names and values are arrays of error messages.
     */
    APP.validate = function($form, errors) {
        $form.find('.is-invalid').removeClass('is-invalid');
        $form.find('.invalid-feedback').remove();

        $.each(errors, function(field, messages) {
            let $input = $form.find('[name="' + field + '"]');

            if ($input.length) {
                $input.addClass('is-invalid');

                if ($input.hasClass('select2')) {
                    $input.next('.select2-container')
                        .after('<div class="invalid-feedback d-block">' + messages[0] + '</div>');
                } else {
                    $input.after('<div class="invalid-feedback">' + messages[0] + '</div>');
                }
            }
        });
    };

    /**
     * Sets a cookie with a given name, value, and optional expiration time.
     *
     * @param {string} name - The name of the cookie.
     * @param {string} value - The value to store in the cookie.
     * @param {number} [days=7] - Number of days before the cookie expires (default: 7 days).
     */
    APP.setCookie = function (name, value, days = 7) {
        let expires = "";
        if(days) {
            let date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/";
    }

    /**
     * Deletes a cookie by setting its expiration date to a past time.
     *
     * @param {string} name - The name of the cookie to delete.
     */
    APP.deleteCookie = function (name) {
        document.cookie = name + "=; Max-Age=-99999999; path=/";
    }

    /**
     * Displays a success alert message stored in a cookie.
     */
    APP.showAlertMessage = function () {
        let message_success = APP.getCookie('message_success');
        if(message_success){
            $('#alert-success').removeClass('d-none');
            $('#alert-success').find('.message-text').html(message_success);
            APP.deleteCookie('message_success');
        }
    }

    /**
     * Enables "Check All" functionality for tables.
     * 
     * @param {string} check_all_selector - The selector for the master "check all" checkbox.
     */
    APP.checkAllCheckbox = function (check_all_selector) {
        $('body').on('change', check_all_selector, function(){
            let isChecked = $(this).is(':checked');
            $(this).closest('table').find('.check-item:not(:disabled):visible').prop('checked', isChecked);
        })

        $('body').on('change', '.check-item', function(){
            let $table = $(this).closest('table');
            let $checkAll = $table.find(check_all_selector);
            let $checkboxes = $table.find('.check-item:not(:disabled):visible');
            let allChecked = $checkboxes.length && $checkboxes.filter(':checked').length === $checkboxes.length;
            $checkAll.prop('checked', allChecked);
        });
    }

    /**
     * Submits a search form by building a query string from its input fields,
     * then redirects the page to the resulting URL.
     *
     * @param {jQuery} $form - The jQuery form element to process.
     */
    APP.search = function($form) {
        if ($form.length === 0) return;
        const action = $form.attr('action') || '';
        const params = [];

        $form.find('input, select, textarea').each(function() {
            const $el = $(this);
            const name = $el.attr('name');
            const value = $el.val();

            if (!name || value === null || value === undefined || value === '') return;

            params.push(`${encodeURIComponent(name)}=${encodeURIComponent(value)}`);
        });

        let newAction = action.split('?')[0];
        if (params.length > 0) {
            newAction += '?' + params.join('&');
        }

        window.location.href = newAction;
    };

    /**
     * Displays a success alert message inside a specified container.
     *
     * @param {string} message - The success message text to display.
     * @param {string} [container='#msg'] - The selector of the container element to insert the alert into.
     */
    APP.alertSuccess = function(message, container = '#msg') {
        let $container = $(container);
        if ($container.length === 0) {
            return;
        }
        let alertHtml = `
            <div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon" 
                id="alert-success" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="d-flex align-items-center me-3 me-md-0">
                    <i class="ti ti-info-circle fs-5 me-2 text-success"></i>
                    <span class="message-text">${message}</span>
                </div>
            </div>
        `;
        $container.html(alertHtml);
    };

    /**
     * Displays an error (danger) alert message inside a specified container.
     *
     * @param {string} message - The error message text to display.
     * @param {string} [container='#msg'] - The selector of the container element to insert the alert into.
     */
    APP.alertDanger = function(message, container = '#msg') {
        let $container = $(container);
        if ($container.length === 0) {
            return;
        }
        let alertHtml = `
            <div class="alert customize-alert alert-dismissible alert-light-danger bg-danger-subtle text-danger fade show remove-close-icon" 
                id="alert-error" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="d-flex align-items-center me-3 me-md-0">
                    <i class="ti ti-info-circle fs-5 me-2 text-danger"></i>
                    <span class="message-text">${message}</span>
                </div>
            </div>
        `;
        $container.html(alertHtml);
    };

    /**
     * Displays a warning alert message inside a specified container.
     *
     * @param {string} message - The warning message text to display.
     * @param {string} [container='#msg'] - The selector of the container element to insert the alert into.
     */
    APP.alertWarning = function(message, container = '#msg') {
        let $container = $(container);
        if ($container.length === 0) {
            return;
        }
        let alertHtml = `
            <div class="alert customize-alert alert-dismissible alert-light-warning bg-warning-subtle text-warning fade show remove-close-icon" 
                id="alert-warning" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="d-flex align-items-center me-3 me-md-0">
                    <i class="ti ti-alert-triangle fs-5 me-2 text-warning"></i>
                    <span class="message-text">${message}</span>
                </div>
            </div>
        `;
        $container.html(alertHtml);
    };

    /**
     * Initializes Flatpickr datepickers on the specified selector.
     *
     * @param {string} [selector=".datepicker"] - The selector for input elements to apply the datepicker to.
     * @param {string} [format="Y/m/d"] - The display format of the date.
     * @param {object} [options={}] - Additional Flatpickr configuration options.
     * @returns {FlatpickrInstance[]} The initialized Flatpickr instances.
     */
    APP.datepicker = function(selector = ".datepicker", format = "Y/m/d", options = {}) {
        const settings = Object.assign(
            { dateFormat: format, disableMobile: true }, 
            options
        );
        return flatpickr(selector, settings);
    };

    /**
     * Displays a confirmation popup using jQuery Confirm.
     *
     * @param {string} message - The confirmation message to display.
     * @param {function} onConfirm - Callback function executed when the user confirms the action.
     * @param {object} [options={}] - Optional configuration for customizing the popup.
     */
    APP.popupConfirm = function(message, onConfirm, options = {}) {
        const {
            title = 'Xác nhận hành động',
            type = 'orange',
            theme = 'material',
            confirmText = 'Đồng ý',
            cancelText = 'Hủy',
            animation = 'scale',
        } = options;

        $.confirm({
            title,
            content: message,
            type,
            theme,
            animation,
            buttons: {
            ok: {
                text: confirmText,
                btnClass: `btn-${type}`,
                action: function () {
                if (typeof onConfirm === 'function') onConfirm();
                }
            },
            cancel: {
                text: cancelText,
                btnClass: 'btn-default'
            }
            }
        });
    }

    /**
     * Displays an alert popup using jQuery Confirm (simple notification).
     *
     * @param {string} message - The alert message to display.
     * @param {object} [options={}] - Optional configuration for customizing the alert.
     */
    APP.popupAlert = function(message, options = {}) {
        const {
            title = 'Thông báo',
            type = 'blue',
            theme = 'material',
            okText = 'Đã hiểu',
            animation = 'scale',
        } = options;

        $.alert({
            title,
            content: message,
            type,
            theme,
            animation,
            buttons: {
                ok: {
                    text: okText,
                    btnClass: `btn-${type}`
                }
            }
        });
    };

    /**
     * Enables column sorting functionality for tables with sortable headers.
     *
     * Usage:
     * 1. Add the class `.sortable` to any `<th>` element that should be clickable for sorting.
     * 2. Add a `data-sort="field_name"` attribute to specify the sort field.
     * 3. Optionally, use a container class (e.g. `.table`) for targeting a specific table.
     *
     * @param {string} [tableSelector='.table'] - The selector for the table(s) to apply sorting to.
     */
    APP.sort = function(tableSelector = '.table') {
        const $table = $(tableSelector);
        if ($table.length === 0) return;

        const urlParams = new URLSearchParams(window.location.search);
        const sortField = urlParams.get('sort_field');
        const sortType = urlParams.get('sort_type') || 'asc';

        $table.find('th.sortable').each(function(){
            const $th = $(this);
            const field = $th.data('sort');

            $th.find('i.sort-icon').remove();

            if(sortField && field === sortField){
                const iconClass = sortType === 'asc' ? 'ti ti-chevron-up' : 'ti ti-chevron-down';
                $th.append(` <i class="sort-icon ${iconClass}"></i>`);
                $th.data('dir', sortType);
            }
        });

        $table.find('th.sortable').off('click').on('click', function(){
            APP.loading();
            const $th = $(this);
            const field = $th.data('sort');
            const currentDir = $th.data('dir') || 'asc';
            const newDir = currentDir === 'asc' ? 'desc' : 'asc';
            $th.data('dir', newDir);
            urlParams.set('sort_field', field);
            urlParams.set('sort_type', newDir);
            window.location.search = urlParams.toString();
        });
    };

    // =========================================================
    // RETURNABLE FUNCTIONS (Functions that return values)
    // =========================================================

    /**
     * Checks whether the loading screen is currently visible.
     * @returns {boolean}
     */
    APP.isLoading = function () {
        return $('#loader-wrapper').is(':visible');
    };

    /**
     * Converts form fields and file inputs into a FormData object.
     * 
     * @param {jQuery} $form - The jQuery form element to extract data from.
     * @returns {FormData}
     */
    APP.getFormData = function ($form) {
        let formData = new FormData();
        let arr = $form.serializeArray();
        for(let i = 0; i < arr.length; i++){
            formData.append(arr[i].name, arr[i].value);
        }
        $form.find('input[type="file"]').each(function () {
            if (this.files.length > 0) {
                formData.append(this.name, this.files[0]);
            }
        });
        return formData;
    }

    /**
     * Retrieves the value of a cookie by its name.
     *
     * @param {string} name - The name of the cookie to retrieve.
     * @returns {string|null} The cookie value if found, otherwise null.
     */
    APP.getCookie = function (name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i].trim();
            if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length));
        }
        return null;
    }

    /**
     * Retrieves the values of all checked (and visible, enabled) checkbox inputs that share the same base name.
     *
     * @param {string} inputName - The base name of the checkbox inputs (e.g., "items" for inputs like name="items[0]").
     * @returns {Array<string>} An array containing the values of all checked checkboxes.
     */
    APP.getCheckedValues = function(inputName) {
        let values = [];
        $(`input[name^="${inputName}["]:checked:not(:disabled):visible`).each(function() {
            values.push($(this).val());
        });
        return values;
    }

    /**
    * Converts a Vietnamese text string into a URL-friendly slug.
    * 
    * @param {string} text
    * @returns {string}
    */
    APP.convertToSlug = function (text) {
        var slug = text.toLowerCase();
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        // Delete special characters
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Replace spaces with hyphens
        slug = slug.replace(/ /gi, "-");
        //Replace multiple consecutive hyphens with a single one
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Remove leading and trailing hyphens
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        return slug;
    };
})

$(document).ready(function(){
    APP.linkButton();
    APP.setupAjax();
    APP.select2();
    APP.tooltip();
    APP.showAlertMessage();
    if(APP.isLoading()){
        APP.loaded();
    }
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            APP.loaded();
        }
    });
})