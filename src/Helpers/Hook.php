<?php

use Huasituo\Hook\Hook;
/**
 * hook
 *
 */

if ( ! function_exists('hst_hook'))
{
    function hst_hook($hook_name, $data = [], $result = false)
    {
        if($result) {
            return Hooks::call_hook($hook_name, $data, $result);
        }
        Hooks::call_hook($hook_name, $data, false);
    }
}