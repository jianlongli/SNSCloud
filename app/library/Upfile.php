<?php

class Upfile extends Phalcon\Mvc\User\Component
{

    function test() {
    	echo 'test';
    }
    
    function upload_files($path,$file){
       	$file_name=time();
    	$app_arr=explode(".",$file->getName());
    	$file_app=$app_arr[count($app_arr)-1];
    	$new_file = $file_name.".".$file_app;
    	$uploadfile = $path.$new_file;
    	move_uploaded_file($file->getTempName(),"../".$uploadfile);
    	return $uploadfile;
    }

}
?>