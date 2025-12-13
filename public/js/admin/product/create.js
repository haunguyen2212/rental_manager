const PRODUCT_CREATE = {}
const SINGLE_PRODUCT = 1;
const VARIANT_PRODUCT = 2;

$(function(){
    'use strict'

    PRODUCT_CREATE.init = function () {
        PRODUCT_CREATE.generateSlug();
        PRODUCT_CREATE.submit();
        PRODUCT_CREATE.handleProductType();
        PRODUCT_CREATE.handleVariantGroups();
        PRODUCT_CREATE.initMainImageUploaders();
        PRODUCT_CREATE.initImageUploaders();
    }

    PRODUCT_CREATE.generateSlug = function () {
        $('#name').on('input', function (){
            let val = $(this).val();
            let slug = APP.convertToSlug(val);
            $('#slug').val(slug);
        })
    }

    PRODUCT_CREATE.submit = function () {
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
                        window.location.href = window.location.pathname;
                    }
                }else{
                    APP.loaded();
                }
            }, function (err){
                if(err.status == 422){
                    APP.validate($form, err.responseJSON.errors);
                    APP.alertDanger('Có lỗi xảy ra, vui lòng kiểm tra lại thông tin nhập vào');
                    APP.scrollTop();
                    APP.loaded();
                }
                else{
                    APP.alertDanger('Có lỗi xảy ra, vui lòng thử lại sao');
                    APP.loaded();
                }
            })
        })
    }

    PRODUCT_CREATE.handleProductType = function () {
        // Handle product type change
        $('input[name="product_type"]').on('change', function () {
            PRODUCT_CREATE.toggleVariantMode($(this).val());
        });
        
        // Handle initial state
        let initialProductType = $('input[name="product_type"]:checked').val();
        PRODUCT_CREATE.toggleVariantMode(initialProductType);
    }

    PRODUCT_CREATE.toggleVariantMode = function (productType) {
        let $addBtn = $('#btn-add-variant-group');
        let $variantGroups = $('.variant-group-item');
        
        if (productType == VARIANT_PRODUCT) {
            // Variant product - show add and remove buttons (if more than 1 group)
            $addBtn.removeClass('d-none');
            if ($variantGroups.length > 1) {
                $('.btn-remove-variant-group').removeClass('d-none');
            }
            // Show variant header, variant name input, variant image and display flag
            $('.variant-header').removeClass('d-none');
            $('.variant-name-wrapper').removeClass('d-none');
            $('.variant-image-wrapper').removeClass('d-none');
            $('.display-flg-wrapper').removeClass('d-none');
            // Show SKU in variant wrapper, hide SKU simple wrapper
            $('.sku-in-variant-wrapper').removeClass('d-none');
            $('.sku-simple-wrapper').addClass('d-none');
            // Add border and padding for variant groups
            $variantGroups.addClass('border p-3 rounded mb-4').removeClass('mb-0');
            // Convert names to array format if currently in simple format
            PRODUCT_CREATE.convertNamesToArrayFormat();
        } else {
            // Simple product - hide add button and keep only 1 group
            $addBtn.addClass('d-none');
            $('.btn-remove-variant-group').addClass('d-none');
            
            // Hide variant header, variant name input, variant image and display flag
            $('.variant-header').addClass('d-none');
            $('.variant-name-wrapper').addClass('d-none');
            $('.variant-image-wrapper').addClass('d-none');
            $('.display-flg-wrapper').addClass('d-none');
            // Hide SKU in variant wrapper, show SKU simple wrapper
            $('.sku-in-variant-wrapper').addClass('d-none');
            $('.sku-simple-wrapper').removeClass('d-none');
            
            // Remove border and padding for simple product
            $variantGroups.removeClass('border p-3 rounded mb-4').addClass('mb-0');
            
            // Remove extra groups, keep only the first group
            $variantGroups.slice(1).remove();
            PRODUCT_CREATE.updateVariantNumbers();
            // Convert names to simple format (without [])
            PRODUCT_CREATE.convertNamesToSimpleFormat();
        }
    }

    PRODUCT_CREATE.handleVariantGroups = function () {
        // Add new group
        $('#btn-add-variant-group').on('click', function () {
            let $firstGroup = $('.variant-group-item').first();
            // Clone without event handlers to avoid conflicts with ImageUploader
            let $newGroup = $firstGroup.clone(false, true);
            let newIndex = PRODUCT_CREATE.getNextVariantIndex();
            
            // Reset values
            $newGroup.find('input[type="text"], input[type="number"]').val('');
            $newGroup.find('input[type="file"]').val('');
            $newGroup.find('.variant-image-wrapper .image-preview-container').addClass('d-none');
            $newGroup.find('.variant-image-wrapper .image-preview').attr('src', '');
            $newGroup.find('.variant-image-upload-area').removeClass('d-none');
            // Remove uploader initialization flag to allow re-initialization
            $newGroup.find('.variant-image-input').removeData('uploader-initialized');
            // Show variant header, variant name input and variant image (only visible in variant mode)
            $newGroup.find('.variant-header').removeClass('d-none');
            $newGroup.find('.variant-name-wrapper').removeClass('d-none');
            $newGroup.find('.variant-image-wrapper').removeClass('d-none');
            $newGroup.find('.display-flg-wrapper').removeClass('d-none');
            // Show SKU in variant wrapper, hide SKU simple wrapper
            $newGroup.find('.sku-in-variant-wrapper').removeClass('d-none');
            $newGroup.find('.sku-simple-wrapper').addClass('d-none');
            // Ensure border and padding are applied for variant groups
            $newGroup.addClass('border p-3 rounded mb-4').removeClass('mb-0');
            // Reset radio buttons - handle both name formats
            $newGroup.find('input[type="radio"][name^="display_flg"], input[type="radio"][name="display_flg"]').each(function() {
                if ($(this).val() == '1') {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });
            
            // Update index and attributes
            PRODUCT_CREATE.updateGroupIndex($newGroup, newIndex);
            $newGroup.attr('data-index', newIndex);
            
            // Append to container
            $('.variant-groups-container').append($newGroup);
            PRODUCT_CREATE.updateVariantNumbers();
            
            // Initialize image uploaders for new group
            PRODUCT_CREATE.initImageUploaderForGroup($newGroup);
            
            // Show remove button if more than 1 group
            if ($('.variant-group-item').length > 1) {
                $('.btn-remove-variant-group').removeClass('d-none');
            }
        });

        // Remove group
        $(document).on('click', '.btn-remove-variant-group', function () {
            let $group = $(this).closest('.variant-group-item');
            $group.remove();
            // Reindex all remaining groups
            PRODUCT_CREATE.reindexAllGroups();
            PRODUCT_CREATE.updateVariantNumbers();
            
            // If only 1 group remains, hide remove button
            if ($('.variant-group-item').length <= 1) {
                $('.btn-remove-variant-group').addClass('d-none');
            }
        });
    }

    PRODUCT_CREATE.getNextVariantIndex = function () {
        let maxIndex = -1;
        $('.variant-group-item').each(function () {
            let index = parseInt($(this).attr('data-index')) || 0;
            if (index > maxIndex) {
                maxIndex = index;
            }
        });
        return maxIndex + 1;
    }

    PRODUCT_CREATE.updateGroupIndex = function ($group, newIndex) {
        // Update name attributes - handle both cases with [] and without []
        $group.find('input[name^="variant_name["], input[name="variant_name"]').attr('name', 'variant_name[' + newIndex + ']');
        $group.find('input[name^="variant_image["], input[name="variant_image"]').attr('name', 'variant_image[' + newIndex + ']');
        // Update SKU in both variant and simple wrappers
        $group.find('.sku-in-variant-wrapper input[name^="sku["], .sku-in-variant-wrapper input[name="sku"]').attr('name', 'sku[' + newIndex + ']');
        $group.find('.sku-simple-wrapper input[name^="sku["], .sku-simple-wrapper input[name="sku"]').attr('name', 'sku[' + newIndex + ']');
        $group.find('input[name^="price["], input[name="price"]').attr('name', 'price[' + newIndex + ']');
        $group.find('input[name^="sale_price["], input[name="sale_price"]').attr('name', 'sale_price[' + newIndex + ']');
        $group.find('input[name^="stock_quantity["], input[name="stock_quantity"]').attr('name', 'stock_quantity[' + newIndex + ']');
        
        // Update display_flg radio buttons - handle both cases with [] and without []
        $group.find('input[name^="display_flg["], input[name="display_flg"]').each(function () {
            let value = $(this).val();
            $(this).attr('name', 'display_flg[' + newIndex + ']');
            
            if (value == '1') {
                $(this).attr('id', 'display_flg_visible_' + newIndex);
                $(this).next('label').attr('for', 'display_flg_visible_' + newIndex);
            } else {
                $(this).attr('id', 'display_flg_hidden_' + newIndex);
                $(this).next('label').attr('for', 'display_flg_hidden_' + newIndex);
            }
        });
    }

    PRODUCT_CREATE.updateVariantNumbers = function () {
        $('.variant-group-item').each(function (index) {
            $(this).find('.variant-number').text(index + 1);
        });
    }

    PRODUCT_CREATE.reindexAllGroups = function () {
        let productType = $('input[name="product_type"]:checked').val();
        
        $('.variant-group-item').each(function (index) {
            let $group = $(this);
            $group.attr('data-index', index);
            
            if (productType == VARIANT_PRODUCT) {
                // Reindex with array format []
                PRODUCT_CREATE.updateGroupIndex($group, index);
            } else {
                // Reindex with simple format (no [])
                PRODUCT_CREATE.updateGroupIndexSimple($group);
            }
        });
    }

    PRODUCT_CREATE.convertNamesToSimpleFormat = function () {
        let $group = $('.variant-group-item').first();
        PRODUCT_CREATE.updateGroupIndexSimple($group);
    }

    PRODUCT_CREATE.convertNamesToArrayFormat = function () {
        $('.variant-group-item').each(function (index) {
            let $group = $(this);
            $group.attr('data-index', index);
            PRODUCT_CREATE.updateGroupIndex($group, index);
        });
    }

    PRODUCT_CREATE.updateGroupIndexSimple = function ($group) {
        // Update name attributes without []
        // Note: variant_name and variant_image are not used in simple product, but we keep them for consistency
        $group.find('input[name^="variant_name["], input[name="variant_name"]').attr('name', 'variant_name');
        $group.find('input[name^="variant_image["], input[name="variant_image"]').attr('name', 'variant_image');
        // Update SKU in both variant and simple wrappers
        $group.find('.sku-in-variant-wrapper input[name^="sku["], .sku-in-variant-wrapper input[name="sku"]').attr('name', 'sku');
        $group.find('.sku-simple-wrapper input[name^="sku["], .sku-simple-wrapper input[name="sku"]').attr('name', 'sku');
        $group.find('input[name^="price["], input[name="price"]').attr('name', 'price');
        $group.find('input[name^="sale_price["], input[name="sale_price"]').attr('name', 'sale_price');
        $group.find('input[name^="stock_quantity["], input[name="stock_quantity"]').attr('name', 'stock_quantity');
        
        // Update display_flg radio buttons
        $group.find('input[name^="display_flg["], input[name="display_flg"]').each(function () {
            let value = $(this).val();
            $(this).attr('name', 'display_flg');
            
            if (value == '1') {
                $(this).attr('id', 'display_flg_visible');
                $(this).next('label').attr('for', 'display_flg_visible');
            } else {
                $(this).attr('id', 'display_flg_hidden');
                $(this).next('label').attr('for', 'display_flg_hidden');
            }
        });
    }

    PRODUCT_CREATE.initImageUploaders = function () {
        $('.variant-group-item').each(function () {
            PRODUCT_CREATE.initImageUploaderForGroup($(this));
        });
    }

    PRODUCT_CREATE.initMainImageUploaders = function () {
        // Initialize main product image uploader (single upload) - outside variant groups
        let $productImageInput = $('input.product-image-input').not('.variant-image-input');
        if ($productImageInput.length && !$productImageInput.data('uploader-initialized')) {
            let $wrapper = $productImageInput.closest('.image-upload-wrapper');
            let productImageUploader = new IMAGE_UPLOAD.ImageUploader({
                fileInput: $productImageInput,
                uploadArea: $wrapper.find('.product-image-upload-area'),
                previewContainer: $wrapper.find('.image-preview-container'),
                previewImage: $wrapper.find('.image-preview'),
                btnChange: $wrapper.find('.btn-change-image'),
                btnDelete: $wrapper.find('.btn-delete-image'),
                multiple: false
            });
            productImageUploader.init();
            $productImageInput.data('uploader-initialized', true);
        }

        // Initialize other images uploader (multiple upload) - outside variant groups
        let $otherImageInput = $('input.other-image-input');
        if ($otherImageInput.length && !$otherImageInput.data('uploader-initialized')) {
            let $wrapper = $otherImageInput.closest('.multiple-image-upload-wrapper');
            let otherImageUploader = new IMAGE_UPLOAD.ImageUploader({
                fileInput: $otherImageInput,
                uploadArea: $wrapper.find('.multiple-image-upload-area'),
                previewContainer: $wrapper.find('.multiple-image-preview-container'),
                previewGrid: $wrapper.find('.image-preview-grid'),
                addMoreArea: $wrapper.find('.add-more-image-area'),
                multiple: true
            });
            otherImageUploader.init();
            $otherImageInput.data('uploader-initialized', true);
        }
    }

    PRODUCT_CREATE.initImageUploaderForGroup = function ($group) {
        // Initialize variant image uploader (single upload) - inside variant group
        let $variantImageInput = $group.find('.variant-image-input');
        if ($variantImageInput.length && !$variantImageInput.data('uploader-initialized')) {
            let $wrapper = $variantImageInput.closest('.image-upload-wrapper');
            let variantImageUploader = new IMAGE_UPLOAD.ImageUploader({
                fileInput: $variantImageInput,
                uploadArea: $wrapper.find('.variant-image-upload-area'),
                previewContainer: $wrapper.find('.image-preview-container'),
                previewImage: $wrapper.find('.image-preview'),
                btnChange: $wrapper.find('.btn-change-image'),
                btnDelete: $wrapper.find('.btn-delete-image'),
                multiple: false
            });
            variantImageUploader.init();
            $variantImageInput.data('uploader-initialized', true);
        }
    }

});

$(document).ready(function(){
    PRODUCT_CREATE.init();
})
