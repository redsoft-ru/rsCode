<?php
/**
 * Created by PhpStorm.
 * User: mitrich
 * Date: 13.08.2015
 * Time: 14:04
 */
if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $tube_url, $id)) {
    $values = $id[1];
} else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $tube_url, $id)) {
    $values = $id[1];
} else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $tube_url, $id)) {
    $values = $id[1];
} else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $tube_url, $id)) {
    $values = $id[1];
}
else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $tube_url, $id)) {
    $values = $id[1];
} else {
    $values = '';
}