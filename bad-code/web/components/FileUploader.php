<?php
/**
 * Created by PhpStorm.
 * User: c
 * Date: 10/01/17
 * Time: 20:29
 */

namespace BYOG\Components;


class FileUploader
{

    private static function isImage() {
        return getimagesize($_FILES["file-to-upload"]["tmp_name"]) !== false;
    }

    public static function upload() {
        $target_file = App::getFileUploadDir() . basename($_FILES["file-to-upload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if(isset($_POST["submit-file-upload"])) {
            if(!self::isImage()  || file_exists($target_file)) {
                $uploadOk = 0;
            }
            /*if($_FILES["fileToUpload"]["size"] > 500000) {
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