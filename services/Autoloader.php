<?php
namespace app\services;

class Autoloader
{
    //const ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];

    public function loadClass($className)
    {
        //$filename = str_replace(["app\\", "\\"], [self::ROOT_DIR, "/"], "{$className}.php");
        $filename = str_replace('\\', '/', str_replace('app\\', $_SERVER['DOCUMENT_ROOT'].'/', "{$className}.php"));
        if(file_exists($filename)){
            include $filename;
        }
    }

    public function forceLoad($className)
    {

    }
}