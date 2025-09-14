<?php

defined('USER_STATUS') or define('USER_STATUS', [
    1 => 'Hoạt động',
    2 => 'Bị khóa'
]);

defined('USER_STATUS_BADGE') or define('USER_STATUS_BADGE', [
    1 => 'bg-success-subtle text-success',
    2 => 'bg-danger-subtle text-danger'
]);

defined('PAGINATION') or define('PAGINATION', 10);

defined('VERSION') or define('VERSION', date('YmdHis'));