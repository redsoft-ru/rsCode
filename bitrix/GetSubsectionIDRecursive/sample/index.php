<?php
/**
 * Created by PhpStorm.
 * User: mitrich
 * Date: 23.07.14
 * Time: 13:46
 */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require('getSubsectionIDRecursive.php');

$iblock_id  = 5;
$section_id = 2;


$sections = getSubsectionRecursive($iblock_id, $section_id);