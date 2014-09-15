<?php
/**
 * Created by PhpStorm.
 * User: mitrich
 * Date: 15.09.14
 * Time: 17:50
 */

function makeDirPath($path)
{
    preg_match_all('#([a-zA-Z0-9-_]+)#',$path,$matchsnaya);

    for($i=0;$i<count($matchsnaya[0]);$i++)
    {
        $fl_patharr = array_slice($matchsnaya[0],0,$i+1);
        $tmp_path = $_SERVER['DOCUMENT_ROOT'].'/'.implode('/',$fl_patharr).'/';
        if(!is_dir($tmp_path))
        {
            mkdir($tmp_path,0755,true);
        }
    }
}