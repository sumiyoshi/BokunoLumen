<?php

if (!function_exists('asset')) {

    function asset($path)
    {
        $public_path = base_path() . '/public';

        if (file_exists($public_path . $path)) {
            return $path . '?' . filemtime($public_path . $path);
        }

        return $path;
    }
}