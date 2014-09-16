<?php
/**
 * Created by PhpStorm.
 * User: mitrich
 * Date: 16.09.14
 * Time: 14:42
 */
class rsClass
{
    public static function mover($src, $dst){
        $handle = opendir($src);
        if (!is_dir($dst)) mkdir($dst);
        while ($file = readdir($handle)){
            if (($file!=".") and ($file!="..")){
                $srcm = $src."/".$file;
                $dstm = $dst."/".$file;
                if (is_dir($srcm)){
                    rsClass::mover($srcm,$dstm);
                }
                else {
                    copy ($srcm, $dstm);
                    unlink($srcm);
                }
            }
        }
        closedir($handle);
        rmdir($src);
    }
}