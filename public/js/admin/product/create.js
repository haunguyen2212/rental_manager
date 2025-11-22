const PRODUCT_CREATE = {}

$(function(){
    'use strict'

    PRODUCT_CREATE.init = function () {
        PRODUCT_CREATE.handleProductType();
        PRODUCT_CREATE.initFirstGroupUploader();
        PRODUCT_CREATE.addGroup();
        PRODUCT_CREATE.removeGroup();
        PRODUCT_CREATE.handleVariantAttributes();
    }

    // ======================================================================
    // 1. HANDLE PRODUCT TYPE
    // ======================================================================
    PRODUCT_CREATE.handleProductType = function () {
        let groupIndex = 0;
        const groupsContainer = $('#product-variant-groups');
        const productTypeRadios = $('input[name="product_type"]');

        function updateProductType(isSimple) {
            if (isSimple) {
                $('#btn-add-variant-group').addClass('d-none');
                groupsContainer.addClass('product-simple-mode');
                groupsContainer.find('.group-input-variant').addClass('p-0');
                groupsContainer.removeClass('d-none'); // Show for simple products

                const extraGroups = $('.product-variant-group').not(':first');
                if (extraGroups.length > 0) {
                    // Remove immediately to prevent form submission
                    extraGroups.remove();
                    // Update group numbers after removing
                    PRODUCT_CREATE.updateGroupNumbers();
                } else {
                    // Update group numbers even if no extra groups to remove
                    PRODUCT_CREATE.updateGroupNumbers();
                }

                groupIndex = 0;

                const firstGroup = $('.product-variant-group').first();
                
                // Remove variant selectors for simple products
                $('.product-variant-group').each(function() {
                    $(this).find('.variant-selectors-row').empty();
                });
                
                firstGroup.find('input, textarea, select').each(function() {
                    const $this = $(this);
                    const name = $this.attr('name');
                    if (name && name.includes('[')) {
                        const newName = name.replace(/\[0\]/g, '').replace(/\[\]$/, '');
                        $this.attr('name', newName);
                    }
                });
                
                // Hide display_flg wrapper for simple products
                $('.display-flg-wrapper').addClass('d-none');
                
                // Remove name attribute from display_flg inputs to prevent form submission
                $('.display-flg-wrapper input[type="radio"]').each(function() {
                    $(this).removeAttr('name');
                });
                
                // Reset all variant attribute selects to empty when switching to simple product
                $('.variant-attribute-select').val('');

            } else {
                groupsContainer.removeClass('product-simple-mode');
                groupsContainer.find('.group-input-variant').removeClass('p-0');
                
                // Remove all blocks except the first one when switching to variable product
                const extraGroups = $('.product-variant-group').not(':first');
                if (extraGroups.length > 0) {
                    extraGroups.remove(); // Remove immediately, don't fade out
                }
                
                // Clear variant selectors when switching to variable product
                $('.product-variant-group').each(function() {
                    $(this).find('.variant-selectors-row').empty();
                });

                const firstGroup = $('.product-variant-group').first();
                if (firstGroup.length > 0) {
                    firstGroup.find('input, textarea, select').each(function() {
                        const $this = $(this);
                        const name = $this.attr('name');

                        if (name && !name.includes('[')) {
                            let newName = name;

                            if (name === 'product_image') newName = 'product_image[0]';
                            else if (name === 'other_image') newName = 'other_image[0][]';
                            else if (name === 'price') newName = 'price[0]';
                            else if (name === 'sale_price') newName = 'sale_price[0]';
                            else if (name === 'stock_quantity') newName = 'stock_quantity[0]';
                            else if (name === 'sku') newName = 'sku[0]';
                            else if (name === 'display_flg') newName = 'display_flg[0]';

                            $this.attr('name', newName);
                        }
                    });
                    
                    // Show display_flg wrapper for variable products
                    $('.display-flg-wrapper').removeClass('d-none');
                    
                    // Restore name attribute for display_flg inputs
                    $('.display-flg-wrapper input[type="radio"]').each(function() {
                        const $this = $(this);
                        const id = $this.attr('id');
                        if (id) {
                            // Extract the base name from id (e.g., display_flg_visible_0 -> display_flg[0])
                            if (id.includes('display_flg_visible')) {
                                $this.attr('name', 'display_flg[0]');
                            } else if (id.includes('display_flg_hidden')) {
                                $this.attr('name', 'display_flg[0]');
                            }
                        }
                    });
                    
                    // Reset first group to index 0
                    firstGroup.attr('data-group-index', 0);
                    firstGroup.find('.variant-number').text('#1');
                }
                
                // Reset variant attributes section to initial state
                // Remove all variant attribute items except the first one
                $('.variant-attribute-item').not(':first').fadeOut(300, function() {
                    $(this).remove();
                });
                
                // Reset first variant attribute item to initial state
                const firstAttributeItem = $('.variant-attribute-item').first();
                if (firstAttributeItem.length > 0) {
                    firstAttributeItem.find('.variant-attribute-select').val('');
                    firstAttributeItem.find('.btn-remove-attribute').addClass('d-none');
                }
                
                // Hide variant groups initially (will show when attributes are selected)
                groupsContainer.addClass('d-none');
                
                // Hide button and reset groupIndex when resetting (no attributes selected after reset)
                $('#btn-add-variant-group').addClass('d-none');
                PRODUCT_CREATE.groupIndex = 0;
                
                // Update group numbers to ensure consistency
                PRODUCT_CREATE.updateGroupNumbers();
            }
        }

        productTypeRadios.on('change', function() {
            const isSimple = $(this).val() === 'simple';
            updateProductType(isSimple);
            // Show/hide variant attributes section
            if (isSimple) {
                $('#variant-attributes-section').addClass('d-none');
            } else {
                $('#variant-attributes-section').removeClass('d-none');
            }
            
            // Update button visibility
            if (typeof PRODUCT_CREATE.updateAddVariantGroupButton === 'function') {
                PRODUCT_CREATE.updateAddVariantGroupButton();
            }
        });

        const initialType = productTypeRadios.filter(':checked').val();
        if (initialType === 'simple') {
            updateProductType(true);
            $('#variant-attributes-section').addClass('d-none');
        } else {
            updateProductType(false);
            $('#variant-attributes-section').removeClass('d-none');
            // Update button visibility on initial load
            setTimeout(function() {
                if (typeof PRODUCT_CREATE.updateAddVariantGroupButton === 'function') {
                    PRODUCT_CREATE.updateAddVariantGroupButton();
                }
            }, 100);
        }

        PRODUCT_CREATE.updateProductType = updateProductType;
        PRODUCT_CREATE.groupIndex = groupIndex;
    }

    // ======================================================================
    // 2. INIT IMAGE UPLOADERS FOR A GROUP
    // ======================================================================
    PRODUCT_CREATE.initImageUploaders = function (groupElement) {
        const groupIndex = groupElement.data('group-index');

        // Single
        const singleFileInput = groupElement.find('.product-image-input');
        const singleUploadArea = groupElement.find('.product-image-upload-area');
        const singlePreviewContainer = groupElement.find('.image-preview-container');
        const singlePreviewImage = groupElement.find('.image-preview-container .image-preview');
        const btnChangeImage = groupElement.find('.btn-change-image');
        const btnDeleteImage = groupElement.find('.btn-delete-image');

        if (singleFileInput.length && typeof IMAGE_UPLOAD !== 'undefined') {
            let single = new IMAGE_UPLOAD.ImageUploader({
                fileInput: singleFileInput,
                uploadArea: singleUploadArea,
                previewContainer: singlePreviewContainer,
                previewImage: singlePreviewImage,
                btnChange: btnChangeImage,
                btnDelete: btnDeleteImage,
                multiple: false
            });
            single.init();
        }

        // Multiple
        const multiFileInput = groupElement.find('.other-image-input');
        const multiUploadArea = groupElement.find('.multiple-image-upload-area');
        const multiPreviewContainer = groupElement.find('.multiple-image-preview-container');
        const multiPreviewGrid = groupElement.find('.image-preview-grid');
        const addMoreArea = groupElement.find('.add-more-image-area');

        if (multiFileInput.length && typeof IMAGE_UPLOAD !== 'undefined') {
            let multi = new IMAGE_UPLOAD.ImageUploader({
                fileInput: multiFileInput,
                uploadArea: multiUploadArea,
                previewContainer: multiPreviewContainer,
                previewGrid: multiPreviewGrid,
                addMoreArea: addMoreArea,
                multiple: true
            });
            multi.init();
        }
    };

    PRODUCT_CREATE.initFirstGroupUploader = function () {
        PRODUCT_CREATE.initImageUploaders($('.product-variant-group').first());
    };

    // ======================================================================
    // 3. ADD NEW GROUP
    // ======================================================================
    PRODUCT_CREATE.addGroup = function () {
        $('#btn-add-variant-group').on('click', function() {
            const groupsContainer = $('#product-variant-groups');
            const existingGroups = $('.product-variant-group');
            // Calculate groupIndex based on current number of groups
            const groupIndex = existingGroups.length;
            
            // Update PRODUCT_CREATE.groupIndex to match
            PRODUCT_CREATE.groupIndex = groupIndex;

            const firstGroup = $('.product-variant-group').first();
            const newGroup = firstGroup.clone(false, true);

            newGroup.attr('data-group-index', groupIndex);
            newGroup.find('.variant-number').text('#' + (groupIndex + 1));

            newGroup.find('input, textarea, select, label').each(function() {
                const $this = $(this);
                const name = $this.attr('name');
                const id = $this.attr('id');
                const forAttr = $this.attr('for');

                if (name) {
                    $this.attr('name', name.replace(/\[(\d+)\]/g, '[' + groupIndex + ']'));
                }
                if (id) {
                    $this.attr('id', id.replace(/\d+/, groupIndex));
                }
                if (forAttr) {
                    $this.attr('for', forAttr.replace(/\d+/, groupIndex));
                }

                if ($this.is('input[type="text"], input[type="number"], textarea')) {
                    $this.val('');
                } else if ($this.is('input[type="file"]')) {
                    $this.val('');
                } else if ($this.is('input[type="radio"]')) {
                    // Reset radio buttons: uncheck all first
                    $this.prop('checked', false);
                }
            });
            
            // Reset radio buttons: check the first one (value="1" - Hiện) in display_flg group
            const isVisibleRadios = newGroup.find('input[type="radio"][name*="display_flg"]');
            if (isVisibleRadios.length > 0) {
                // Find the radio with value="1" (Hiện) and check it
                const visibleRadio = isVisibleRadios.filter('[value="1"]').first();
                if (visibleRadio.length > 0) {
                    visibleRadio.prop('checked', true);
                }
            }

            newGroup.find('.image-upload-area').removeClass('d-none');
            newGroup.find('.image-preview-container, .multiple-image-preview-container').addClass('d-none');
            newGroup.find('.image-preview').attr('src', '');
            newGroup.find('.image-preview-grid').empty();

            newGroup.find('.btn-remove-group').removeClass('d-none');
            
            // Clear variant selectors row - sẽ được tạo lại bởi updateVariantSelectors
            newGroup.find('.variant-selectors-row').empty();

            groupsContainer.append(newGroup);

            PRODUCT_CREATE.initImageUploaders(newGroup);
            
            // Update variant selectors for all groups (including the new one)
            if (typeof PRODUCT_CREATE.updateVariantSelectors === 'function') {
                PRODUCT_CREATE.updateVariantSelectors();
            }

            $('html, body').animate({
                scrollTop: newGroup.offset().top - 100
            }, 300);
        });
    }

    // ======================================================================
    // 4. REMOVE GROUP
    // ======================================================================
    PRODUCT_CREATE.removeGroup = function () {
        $(document).on('click', '.btn-remove-group', function() {
            const group = $(this).closest('.product-variant-group');
            // Remove immediately to prevent form submission
            group.remove();
            // Update group numbers after removing
            PRODUCT_CREATE.updateGroupNumbers();
            // Update groupIndex based on current number of groups
            const remainingGroups = $('.product-variant-group').length;
            PRODUCT_CREATE.groupIndex = remainingGroups > 0 ? remainingGroups - 1 : 0;
        });
    };

    PRODUCT_CREATE.updateGroupNumbers = function () {
        $('.product-variant-group').each(function(index) {
            const groupElement = $(this);
            // Update variant number display
            groupElement.find('.variant-number').text('#' + (index + 1));
            // Update data-group-index
            groupElement.attr('data-group-index', index);
            // Update input names with new index (only the first [number] which is group index)
            groupElement.find('input, textarea, select').not('.variant-value-select').each(function() {
                const $this = $(this);
                const name = $this.attr('name');
                if (name && name.includes('[')) {
                    // Replace only the first occurrence of [number] with new group index
                    const newName = name.replace(/\[(\d+)\]/, '[' + index + ']');
                    $this.attr('name', newName);
                }
            });
            // Update variant value select names (variant_value[groupIndex][attrIndex])
            groupElement.find('.variant-value-select').each(function() {
                const $this = $(this);
                const name = $this.attr('name');
                if (name && name.startsWith('variant_value[')) {
                    // Replace group index in variant_value[groupIndex][attrIndex]
                    const newName = name.replace(/variant_value\[(\d+)\]/, 'variant_value[' + index + ']');
                    $this.attr('name', newName);
                }
            });
        });
    };

    // ======================================================================
    // 5. HANDLE VARIANT ATTRIBUTES
    // ======================================================================
    PRODUCT_CREATE.handleVariantAttributes = function () {
        let attributeIndex = 0;
        const attributesList = $('#variant-attributes-list');
        const groupsContainer = $('#product-variant-groups');

        // Function to update variant selectors in input blocks
        function updateVariantSelectors() {
            const selectedAttributes = [];
            $('.variant-attribute-item').each(function(index) {
                const selectedValue = $(this).find('.variant-attribute-select').val();
                if (selectedValue) {
                    selectedAttributes.push({
                        value: selectedValue,
                        index: index // Lưu index thực tế trong DOM
                    });
                }
            });

            // Update variant selectors in all groups
            $('.product-variant-group').each(function() {
                const groupElement = $(this);
                const groupIndex = groupElement.data('group-index');
                const variantSelectorsRow = groupElement.find('.variant-selectors-row');
                variantSelectorsRow.empty();

                if (selectedAttributes.length > 0) {
                    selectedAttributes.forEach(function(attrObj, arrayIndex) {
                        const col = $('<div>').addClass('col-12 col-md-6 mb-3');
                        const label = $('<label>').addClass('form-label').text('Biến thể');
                        // Sử dụng arrayIndex (tuần tự 0, 1, 2...) cho name attribute trong mỗi block
                        // attrObj.index chỉ dùng để map với pulldown gốc, không dùng cho name
                        const select = $('<select>').addClass('form-select variant-value-select').attr('name', 'variant_value[' + groupIndex + '][' + arrayIndex + ']');
                        const attr = attrObj.value;
                        
                        // Get attribute label
                        const attributeLabel = $('.variant-attribute-select option[value="' + attr + '"]').first().text();
                        select.append($('<option>').val('').text('-- Chọn ' + attributeLabel + ' --'));
                        
                        // Add options based on attribute type (you can customize this)
                        if (attr === 'color') {
                            select.append($('<option>').val('red').text('Đỏ'));
                            select.append($('<option>').val('blue').text('Xanh'));
                            select.append($('<option>').val('yellow').text('Vàng'));
                            select.append($('<option>').val('green').text('Xanh lá'));
                            select.append($('<option>').val('black').text('Đen'));
                            select.append($('<option>').val('white').text('Trắng'));
                        } else if (attr === 'size') {
                            select.append($('<option>').val('s').text('S'));
                            select.append($('<option>').val('m').text('M'));
                            select.append($('<option>').val('l').text('L'));
                            select.append($('<option>').val('xl').text('XL'));
                            select.append($('<option>').val('xxl').text('XXL'));
                        } else if (attr === 'material') {
                            select.append($('<option>').val('cotton').text('Cotton'));
                            select.append($('<option>').val('polyester').text('Polyester'));
                            select.append($('<option>').val('silk').text('Lụa'));
                            select.append($('<option>').val('leather').text('Da'));
                        } else if (attr === 'style') {
                            select.append($('<option>').val('casual').text('Thể thao'));
                            select.append($('<option>').val('formal').text('Công sở'));
                            select.append($('<option>').val('sport').text('Thể thao'));
                        } else if (attr === 'capacity') {
                            select.append($('<option>').val('500ml').text('500ml'));
                            select.append($('<option>').val('1l').text('1L'));
                            select.append($('<option>').val('1.5l').text('1.5L'));
                            select.append($('<option>').val('2l').text('2L'));
                        }

                        col.append(label).append(select);
                        variantSelectorsRow.append(col);
                    });
                }
            });
        }
        
        // Expose function for use in other modules
        PRODUCT_CREATE.updateVariantSelectors = updateVariantSelectors;
        
        // Function to reset blocks to initial state
        function resetBlocksToInitialState() {
            // Hide variant groups
            groupsContainer.addClass('d-none');
            
            // Remove all blocks except the first one and reset first block
            const allGroups = $('.product-variant-group');
            const firstGroup = allGroups.first();
            
            // Remove extra groups immediately to prevent form submission
            const extraGroups = allGroups.not(':first');
            if (extraGroups.length > 0) {
                extraGroups.remove();
                // Update group numbers after removing
                PRODUCT_CREATE.updateGroupNumbers();
            }
            
            // Reset first group to initial state
            if (firstGroup.length > 0) {
                // Clear variant selectors
                firstGroup.find('.variant-selectors-row').empty();
                
                // Reset input values
                firstGroup.find('input, textarea, select').not('.variant-value-select').each(function() {
                    const $this = $(this);
                    if ($this.is('input[type="text"], input[type="number"], textarea')) {
                        $this.val('');
                    } else if ($this.is('input[type="file"]')) {
                        $this.val('');
                    } else if ($this.is('input[type="radio"]')) {
                        // Reset radio buttons: uncheck all first
                        $this.prop('checked', false);
                    }
                });
                
                // Reset radio buttons: check the first one (value="1" - Hiện) in display_flg group
                const isVisibleRadios = firstGroup.find('input[type="radio"][name*="display_flg"]');
                if (isVisibleRadios.length > 0) {
                    // Find the radio with value="1" (Hiện) and check it
                    const visibleRadio = isVisibleRadios.filter('[value="1"]').first();
                    if (visibleRadio.length > 0) {
                        visibleRadio.prop('checked', true);
                    }
                }
                
                // Reset image upload areas
                firstGroup.find('.image-upload-area').removeClass('d-none');
                firstGroup.find('.image-preview-container, .multiple-image-preview-container').addClass('d-none');
                firstGroup.find('.image-preview').attr('src', '');
                firstGroup.find('.image-preview-grid').empty();
                
                // Reset groupIndex
                PRODUCT_CREATE.groupIndex = 0;
                
                // Update group numbers (will update first group to #1 and data-group-index to 0)
                if (extraGroups.length === 0) {
                    PRODUCT_CREATE.updateGroupNumbers();
                }
            }
        }
        
        // Function to update button visibility based on selected attributes
        function updateAddVariantGroupButton() {
            // Only check attributes if variant-attributes-section is visible
            const variantSection = $('#variant-attributes-section');
            let hasSelectedAttributes = false;
            
            if (!variantSection.hasClass('d-none')) {
                hasSelectedAttributes = $('.variant-attribute-select').filter(function() {
                    return $(this).val() !== '';
                }).length > 0;
            }
            
            // Only show button if product type is variable and has selected attributes
            const isVariableProduct = $('input[name="product_type"]:checked').val() === 'variable';
            
            if (isVariableProduct && hasSelectedAttributes) {
                $('#btn-add-variant-group').removeClass('d-none');
            } else {
                $('#btn-add-variant-group').addClass('d-none');
            }
        }
        
        // Expose function for use in other modules
        PRODUCT_CREATE.updateAddVariantGroupButton = updateAddVariantGroupButton;

        // Listen to variant attribute select changes
        $(document).on('change', '.variant-attribute-select', function() {
            const hasSelectedAttributes = $('.variant-attribute-select').filter(function() {
                return $(this).val() !== '';
            }).length > 0;

            if (hasSelectedAttributes) {
                // Show variant groups
                groupsContainer.removeClass('d-none');
                // Update variant selectors
                updateVariantSelectors();
            } else {
                // No attributes selected, reset to initial state
                resetBlocksToInitialState();
            }
            
            // Update button visibility
            updateAddVariantGroupButton();
        });


        // Add new attribute dropdown
        $('#btn-add-attribute').on('click', function() {
            attributeIndex++;
            const firstAttribute = $('.variant-attribute-item').first();
            const newAttribute = firstAttribute.clone(false, true);

            newAttribute.attr('data-attribute-index', attributeIndex);
            newAttribute.find('.variant-attribute-select').val('');
            newAttribute.find('.btn-remove-attribute').removeClass('d-none');

            attributesList.append(newAttribute);
            
            // Update variant selectors after adding
            setTimeout(function() {
                updateVariantSelectors();
                updateAddVariantGroupButton();
            }, 100);
        });

        // Remove attribute dropdown
        $(document).on('click', '.btn-remove-attribute', function() {
            const attributeItem = $(this).closest('.variant-attribute-item');
            const totalAttributes = $('.variant-attribute-item').length;
            
            if (totalAttributes > 1) {
                attributeItem.fadeOut(300, function() {
                    $(this).remove();
                    
                    // Check if there are any selected attributes after removal
                    const hasSelectedAttributes = $('.variant-attribute-select').filter(function() {
                        return $(this).val() !== '';
                    }).length > 0;
                    
                    if (hasSelectedAttributes) {
                        // Update variant selectors after removing
                        updateVariantSelectors();
                    } else {
                        // No attributes selected, reset to initial state
                        resetBlocksToInitialState();
                    }
                    
                    updateAddVariantGroupButton();
                });
            }
        });
        
        // Initialize button visibility
        updateAddVariantGroupButton();
    };

});

$(document).ready(function(){
    PRODUCT_CREATE.init();
})
