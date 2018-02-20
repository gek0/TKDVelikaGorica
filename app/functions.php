<?php

/**
 * link with active route state
 */
HTML::macro('smartRoute_link', function($route, $text, $icon = '') {
    if(Request::is($route) || Request::is($route.'/*')) {
        $active = " class='active'";
    }
    else {
        $active = "";
    }
    return '<li'.$active.'><a href="'.url($route).'">'.$icon.' '.$text.'</a></li>';
});

/**
 * link with active route state - another design
 */
HTML::macro('smartRoute_link_v2', function($route, $text, $icon = '') {
    if(Request::is($route) || Request::is($route.'/*')) {
        $active = " class='active-prim'";
    }
    else {
        $active = "";
    }
    return '<li'.$active.'><a href="'.url($route).'">'.$icon.' '.$text.'</a></li>';
});

/**
 * @param $string
 * @return string
 * safe name, no croatian letters
 */
function safe_name($string) {
    $string = preg_replace('/&[sS]caron;+/', 's', $string);   // 'š' and 'Š' letter fix
    $string = preg_replace('/&quot;+/', '', $string);   // '"' double quote fix
    $string = preg_replace('/&#039;+/', '', $string);   // ''' single quote fix
    $string = preg_replace('/Ä+/', 'c', $string);   // 'č' char fix
    $string = preg_replace('/Å¾+/', 'z', $string);   // 'ž' char fix
    $string = preg_replace('/\/+/', '', $string);   // '/' char fix

    $trans = ["š" => "s", "ć" => "c", "č" => "c", "đ" => "d", "ž" => "z", " " => "_", ">" => "", "<" => "", "." => "", "," => "", "&gt;" => "", "&lt;" => "", ":" => "", "-" => "", "|" => "", "!" => ""];

    return strtr(mb_strtolower($string, "UTF-8"), $trans);
}

/**
 * @param $string
 * @return string
 * name with croatian names, broken chars
 */
function cro_name_strings($string) {
    $string = preg_replace('/&scaron;+/', 'š', $string);   // 'š' letter fix
    $string = preg_replace('/&Scaron;+/', 'Š', $string);   // 'Š' letter fix
    $string = preg_replace('/&quot;+/', '', $string);   // '"' double quote fix
    $string = preg_replace('/&#039;+/', '', $string);   // ''' single quote fix
    $string = preg_replace('/Ä+/', 'č', $string);   // 'č' char fix
    $string = preg_replace('/Å¾+/', 'ž', $string);   // 'ž' char fix

    return $string;
}

/**
 * @param $string
 * @return string
 * string like slug URL, uses @safe_name() function
 */
function string_like_slug($string){
    $trans = ["_" => "-"];

    return strtr(safe_name($string), $trans);
}

/**
 * @param $image_name
 * @return string
 * return image name without extension for alt attribute of HTML <img> tag
 */
function imageAlt($image_name){
    return substr($image_name, 0, -4);
}

/**
 * @param $string
 * @return string
 * place BBcode parsed text to <p> HTML tags
 */
function nl2p($string) {
    $arr = explode('\n', $string);
    $out = '';
    $arr_len = count($arr);

    for($i = 0; $i < $arr_len; $i++){
        if(strlen(trim($arr[$i])) > 0) {
            $out .= '<p>'.trim($arr[$i]).'</p>';
        }
    }

    return $out;
}

/**
 * @param $content
 * @return mixed
 * remove empty <p> HTML tags left after BBcode parser
 */
function removeEmptyP($content) {
    $content = preg_replace(array(
        '#<p>\s*<(div|aside|section|article|header|footer)#',
        '#</(div|aside|section|article|header|footer)>\s*</p>#',
        '#</(div|aside|section|article|header|footer)>\s*<br ?/?>#',
        '#<(div|aside|section|article|header|footer)(.*?)>\s*</p>#',
        '#<p>\s*</(div|aside|section|article|header|footer)#',
    ),
        array(
            '<$1',
            '</$1>',
            '</$1>',
            '<$1$2>',
            '</$1',
        ), $content );

    return preg_replace('#<p>(\s|&nbsp;)*+(<br\s*/*>)*(\s|&nbsp;)*</p>#i', '', $content);
}