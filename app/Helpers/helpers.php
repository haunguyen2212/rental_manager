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
}