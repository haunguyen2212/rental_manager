<?php

return [
    'required' => 'Vui lòng nhập :attribute.',
    'email'      => 'Vui lòng nhập đúng định dạng cho :attribute.',
    'string'     => 'Vui lòng nhập :attribute dạng chuỗi ký tự.',
    'numeric'    => 'Vui lòng nhập :attribute dạng số.',
    'boolean'    => 'Vui lòng chọn giá trị hợp lệ cho :attribute.',
    'date'       => 'Vui lòng nhập :attribute là ngày hợp lệ.',
    'url'        => 'Vui lòng nhập đúng định dạng URL cho :attribute.',
    'min' => [
        'string'  => 'Vui lòng nhập :attribute có ít nhất :min ký tự.',
        'numeric' => 'Vui lòng nhập :attribute có giá trị lớn hơn hoặc bằng :min.',
        'file'    => 'Vui lòng tải lên :attribute có dung lượng tối thiểu :min KB.',
    ],
    'max' => [
        'string'  => 'Vui lòng nhập :attribute không vượt quá :max ký tự.',
        'numeric' => 'Vui lòng nhập :attribute không lớn hơn :max.',
        'file'    => 'Vui lòng tải lên :attribute không vượt quá :max KB.',
    ],
    'between' => [
        'string'  => 'Vui lòng nhập :attribute có độ dài từ :min đến :max ký tự.',
        'numeric' => 'Vui lòng nhập :attribute có giá trị trong khoảng :min đến :max.',
        'file'    => 'Vui lòng tải lên :attribute có dung lượng từ :min đến :max KB.',
    ],
    'size' => [
        'string'  => 'Vui lòng nhập :attribute có đúng :size ký tự.',
        'numeric' => 'Vui lòng nhập :attribute có giá trị bằng :size.',
        'file'    => 'Vui lòng tải lên :attribute có dung lượng đúng :size KB.',
    ],
    'confirmed' => 'Vui lòng nhập xác nhận :attribute khớp với giá trị đã nhập.',
    'same'      => 'Vui lòng đảm bảo :attribute và :other giống nhau.',
    'different' => 'Vui lòng đảm bảo :attribute và :other khác nhau.',
    'unique'    => 'Vui lòng nhập :attribute khác, :attribute này đã tồn tại.',
    'file'      => 'Vui lòng chọn :attribute là một tập tin.',
    'image'     => 'Vui lòng chọn :attribute là hình ảnh.',
    'mimes'     => 'Vui lòng chọn :attribute có định dạng: :values.',
    'mimetypes' => 'Vui lòng chọn :attribute có định dạng hợp lệ: :values.',
    'date_format' => 'Vui lòng nhập :attribute theo định dạng :format.',
    'before_or_equal' => 'Vui lòng nhập :attribute có ngày nhỏ hơn hoặc bằng :date.',
];