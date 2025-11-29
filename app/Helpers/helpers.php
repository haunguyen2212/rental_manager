<?php

if (!function_exists('describe_array')) {
    /**
     * Convert an associative array [key => value] into a formatted string "(key: value, key: value)".
     *
     * @param array $array
     * @param string $separator
     * @return string
     */
    function describe_array(array $array, string $separator = ', '): string
    {
        if (empty($array)) {
            return '';
        }

        $parts = [];
        foreach ($array as $key => $value) {
            $parts[] = "{$key}: {$value}";
        }

        return '(' . implode($separator, $parts) . ')';
    }

    /**
     * Write activity log
     *
     * @param string $actionKey
     * @param string $description
     * @return bool
     */
    function write_activity_log($actionKey, $description = '')
    {
        $action = ACTIVITY[$actionKey] ?? null;

        if (!$action) {
            return false;
        }

        return app(\App\Repositories\ActivityLogRepository::class)->create([
            'user_id'     => auth()->id() ?? null,
            'user_name'   => auth()->user()->username ?? null,
            'action'      => $action['action'],
            'action_text' => $action['action_text'],
            'description' => $description,
            'ip_address'  => request()->ip(),
        ]);
    }
}