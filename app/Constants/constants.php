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

defined('EXPORT_ALL') or define('EXPORT_ALL', 1);
defined('EXPORT_BY_IDS') or define('EXPORT_BY_IDS', 2);