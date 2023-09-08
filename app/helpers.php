<?php

use App\Models\Settings;
use Illuminate\Support\Facades\Storage;

if (!function_exists('formatString')) {
    function formatString($inputString) {
        $words = explode('_', $inputString);
        $capitalizedWords = array_map('ucfirst', $words);
        return implode(' ', $capitalizedWords);
    }
}