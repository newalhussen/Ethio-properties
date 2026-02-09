<?php

if (!function_exists('transField')) {
    function transField($field) {
        if ($field === null) return '';

        if (is_array($field)) {
            return $field[app()->getLocale()] ?? reset($field) ?? '';
        }

        if (is_string($field)) {
            $dec = @json_decode($field, true);
            if (is_array($dec)) {
                return $dec[app()->getLocale()] ?? reset($dec) ?? '';
            }
            return $field;
        }

        return (string) $field;
    }
}

if (!function_exists('getYouTubeId')) {
    function getYouTubeId($url) {
        if (!$url) return '';
        preg_match('/(?:youtube\.com\/(?:.*v=|embed\/|v\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url, $m);
        return $m[1] ?? '';
    }
}
