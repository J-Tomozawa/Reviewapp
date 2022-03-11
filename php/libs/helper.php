<?php

function get_param($key, $default_val, $is_post = true) {

    $arry = $is_post ? $_POST : $_GET;
    return $arry[$key] ?? $default_val;

}

function redirect($path)
{

    if ($path === GO_HOME) {

        $path = get_url('');
    } else if ($path === GO_REFERER) {

        $path = $_SERVER['HTTP_REFERER'];
    } else {

        $path = get_url($path);
    }

    header("Location: {$path}");

    die();
}

function get_url($path)
{

    return BASE_CONTEXT_PATH . trim($path, '/');
}


function home() {
    $api = new pahooRakuten;
    $array = [];

    $api->searchBooks('', '', $array, 'sales');

    return $array;
}

function detailContent($comicTitle) {
    $api = new pahooRakuten;
    $array = [];

    $api->searchBooks($comicTitle, '', $array);

    return $array;


}

function escape($data)
{
    if (is_array($data)) {

        foreach ($data as $prop => $val) {
            $data[$prop] = escape($val);
        }

        return $data;
    } elseif (is_object($data)) {
        
        foreach ($data as $prop => $val) {
            $data->$prop = escape($val);
        }

        return $data;
    } elseif($data === null) {

        return $data;
        
    } else {

        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        
    }
}