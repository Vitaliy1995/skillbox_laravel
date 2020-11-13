<?php

if (!function_exists('flash')) {
    /**
     * @param $message
     * @param string $type
     */
    function flash($message, $type = 'success') {
        session()->flash('flash_message', $message);
        session()->flash('flash_message_type', $type);
    }
}
