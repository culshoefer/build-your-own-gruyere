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
    private static function getFileUploadDir() {
        return __DIR__ . "/../uploads/"; //TODO make this less than chmod 777
    }

    private static function isImage() {
        return getimagesize($_FILES["file-to-upload"]["tmp_name"]) !== false;
    }

    public static function upload() {
        $target_file = self::getFileUploadDir() . basename($_FILES["file-to-upload"]["name"]);
        $uploadOk = 1;
        //$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if(isset($_POST["submit-file-upload"])) {
            if(/*!self::isImage()  ||*/ file_exists($target_file)) {
                $uploadOk = 0;
            }
            /*if($_FILES["fileToUpload"]["size"] > $MAX_FILE_SIZE) {
                $uploadOk = 0;
            }*/
            /*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $uploadOk = 0;
            }*/
        }
        if($uploadOk == 1) {
            move_uploaded_file($_FILES["file-to-upload"]["tmp_name"], $target_file);
        }

    }
}