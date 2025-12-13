let IMAGE_UPLOAD = {};

$(function () {
    'use strict';

    IMAGE_UPLOAD.ImageUploader = function (options) {

        let settings = $.extend({
            fileInput: null,
            uploadArea: null,
            previewContainer: null,
            previewImage: null,
            btnChange: null,
            btnDelete: null,
            maxSize: 5 * 1024 * 1024,
            multiple: false,
            previewGrid: null,
            addMoreArea: null
        }, options);

        let uploadedImages = [];

        // ----------- Single upload -----------
        function initSingle() {
            settings.uploadArea.on('click', () => settings.fileInput.click());

            settings.uploadArea.on('dragover', function (e) {
                e.preventDefault();
                $(this).addClass('drag-over');
            }).on('dragleave', function () {
                $(this).removeClass('drag-over');
            }).on('drop', function (e) {
                e.preventDefault();
                $(this).removeClass('drag-over');
                const files = e.originalEvent.dataTransfer.files;
                if (files.length) handleSingle(files[0]);
            });

            settings.fileInput.on('change', function (e) {
                const file = e.target.files[0];
                if (file) handleSingle(file);
            });

            settings.btnChange?.on('click', () => settings.fileInput.click());

            settings.btnDelete?.on('click', function () {
                settings.fileInput.val('');
                settings.previewImage.attr('src', '');
                settings.previewContainer.addClass('d-none');
                settings.uploadArea.removeClass('d-none');
            });
        }

        function handleSingle(file) {
            if (!validate(file)) return;

            let reader = new FileReader();
            reader.onload = function (e) {
                settings.previewImage.attr('src', e.target.result);
                settings.uploadArea.addClass('d-none');
                settings.previewContainer.removeClass('d-none');
            };
            reader.readAsDataURL(file);
        }

        // ----------- Multiple upload -----------
        function initMultiple() {
            settings.uploadArea.on('click', () => settings.fileInput.click());
            settings.addMoreArea.on('click', () => settings.fileInput.click());

            dragDrop(settings.uploadArea);
            dragDrop(settings.addMoreArea);

            settings.fileInput.on('change', function (e) {
                handleMultiple(Array.from(e.target.files));
            });
        }

        function handleMultiple(files) {
            let validFiles = [];
            files.forEach(file => {
                if (!validate(file)) return;
                validFiles.push(file);
            });

            if (!validFiles.length) return;

            let loaded = 0;
            validFiles.forEach(file => {
                let reader = new FileReader();
                reader.onload = function (e) {
                    uploadedImages.push({ file, preview: e.target.result });
                    addItem(e.target.result, uploadedImages.length - 1);
                    loaded++;
                    if (loaded === validFiles.length) {
                        refreshInput();
                    }
                };
                reader.readAsDataURL(file);
            });
        }

        function addItem(src, index) {
            let col = $(`
                <div class="col-12 col-md-4 mt-0">
                    <div class="multiple-image-preview-item">
                        <img src="${src}" />
                        <div class="multiple-image-preview-overlay">
                            <button class="btn btn-sm btn-danger btn-remove" data-index="${index}">
                                <iconify-icon icon="solar:trash-bin-minimalistic-bold"></iconify-icon> Xóa
                            </button>
                        </div>
                    </div>
                </div>
            `);

            col.find('.btn-remove').on('click', function () {
                let idx = $(this).data('index');
                uploadedImages.splice(idx, 1);
                rebuild();
                refreshInput();
            });

            settings.previewGrid.append(col);

            if (uploadedImages.length === 1) {
                settings.uploadArea.addClass('d-none');
                settings.previewContainer.removeClass('d-none');
            }
        }

        function rebuild() {
            settings.previewGrid.empty();
            uploadedImages.forEach((img, i) => addItem(img.preview, i));

            if (uploadedImages.length === 0) {
                settings.previewContainer.addClass('d-none');
                settings.uploadArea.removeClass('d-none');
            }
        }

        function refreshInput() {
            let dt = new DataTransfer();
            uploadedImages.forEach(i => dt.items.add(i.file));
            settings.fileInput[0].files = dt.files;
        }

        // ----------- Common helpers -----------
        function dragDrop(element) {
            element.on('dragover', function (e) {
                e.preventDefault();
                $(this).addClass('drag-over');
            }).on('dragleave', function () {
                $(this).removeClass('drag-over');
            }).on('drop', function (e) {
                e.preventDefault();
                $(this).removeClass('drag-over');
                handleMultiple(Array.from(e.originalEvent.dataTransfer.files));
            });
        }

        function validate(file) {
            if (!file.type.match('image.*')) {
                APP.popupAlert('File phải là JPG, PNG, GIF', {type: 'red'});
                return false;
            }
            if (file.size > settings.maxSize) {
                APP.popupAlert('File vượt quá 5MB', {type: 'red'});
                return false;
            }
            return true;
        }

        // ----------- Public method -----------
        this.init = function () {
            if (settings.multiple) initMultiple();
            else initSingle();
        };
    };

});
