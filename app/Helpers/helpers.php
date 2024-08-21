<?php 
if (!function_exists('highlightWords')) {
    function highlightWords($text, $word)
    {
        if(!$word) return $text;
        
        $pattern = '/(' . preg_quote($word, '/') . ')/i';
        return preg_replace($pattern, '<span style="background-color: yellow;">$1</span>', $text);
    }
}