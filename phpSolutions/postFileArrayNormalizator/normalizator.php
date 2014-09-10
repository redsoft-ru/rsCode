<?php
/**
 * Created by PhpStorm.
 * User: mitrich
 * Date: 10.09.14
 * Time: 16:12
 */

var_dump($_FILES['gal']);

$normalize_file_arr = array();
$keys = array_keys($_FILES['gal']);
foreach($_FILES['gal']['name'] as $k => $v)
{
    if($v)
    {
        $tmp = array();
        foreach($keys as $key)
        {
            $tmp[$key] = $_FILES['gal'][$key][$k];
        }
        $normalize_file_arr[] = $tmp;
    }
}

var_dump($normalize_file_arr);