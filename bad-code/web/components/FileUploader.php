<?php
/**
 * Created by PhpStorm.
 * User: c
 * Date: 10/01/17
 * Time: 20:29
 */

namespace BYOG\Components;

$MAX_FILE_SIZE = 50000;

class FileUploader
{

    //TODO make file upload based on user
    private static function getFileUploadDir()
    {
        return __DIR__ . "/../uploads/"; //TODO make this less than chmod 777
    }

    private static function isImage()
    {
        return getimagesize($_FILES["file-to-upload"]["tmp_name"]) !== false;
    }

    public static function upload()
    {
        $target_file = self::getFileUploadDir() . basename($_FILES["file-to-upload"]["name"]);
        move_uploaded_file($_FILES["file-to-upload"]["tmp_name"], $target_file);
    }
}