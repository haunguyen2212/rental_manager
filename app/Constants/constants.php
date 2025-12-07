<?php

defined('USER_STATUS') or define('USER_STATUS', [
    1 => 'Hoạt động',
    2 => 'Bị khóa'
]);

defined('USER_STATUS_ACTIVE') or define('USER_STATUS_ACTIVE', 1);
defined('USER_STATUS_INACTIVE') or define('USER_STATUS_INACTIVE', 2);

defined('USER_STATUS_BADGE') or define('USER_STATUS_BADGE', [
    1 => 'bg-success-subtle text-success',
    2 => 'bg-danger-subtle text-danger'
]);

defined('PAGINATION') or define('PAGINATION', 10);

defined('VERSION') or define('VERSION', date('YmdHis'));

defined('DATE_FORMAT_SQL') or define('DATE_FORMAT_SQL', 'Y-m-d');
defined('DATE_FORMAT_VIEW') or define('DATE_FORMAT_VIEW', 'd/m/Y');
defined('DATETIME_FORMAT_VIEW') or define('DATETIME_FORMAT_VIEW', 'd/m/Y H:i:s');

defined('EXPORT_ALL') or define('EXPORT_ALL', 1);
defined('EXPORT_BY_IDS') or define('EXPORT_BY_IDS', 2);

defined('ACTIVITY') or define('ACTIVITY', [
        'create' => [
            'action' => 'create',
            'action_text' => 'Tạo mới',
            'icon' => 'ti ti-plus',
            'color' => 'primary',
        ],
        'update' => [
            'action' => 'update',
            'action_text' => 'Cập nhật',
            'icon' => 'ti ti-edit',
            'color' => 'warning',
        ],
        'delete' => [
            'action' => 'delete',
            'action_text' => 'Xóa',
            'icon' => 'ti ti-trash',
            'color' => 'danger',
        ],
        'import' => [
            'action' => 'import',
            'action_text' => 'Nhập dữ liệu',
            'icon' => 'ti ti-file-import',
            'color' => 'secondary',
        ],
        'export' => [
            'action' => 'export',
            'action_text' => 'Xuất dữ liệu',
            'icon' => 'ti ti-file-export',
            'color' => 'success',
        ],
        'reset_password' => [
            'action' => 'reset_password',
            'action_text' => 'Đổi mật khẩu',
            'icon' => 'ti ti-key',
            'color' => 'dark',
        ],
]);

defined('MAX_RECENT_ACTIVITIES') or define('MAX_RECENT_ACTIVITIES', 50);

defined('SUPER_ADMIN') or define('SUPER_ADMIN', 1);
defined('ADMIN') or define('ADMIN', 2);