<?php
namespace FileUpload\Model\Behavior;

use Cake\Controller\Controller;
use Cake\Network\Request;
use Cake\ORM\Behavior;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;


class FileUploadBehavior extends Behavior
{
    public function removeFile($file_name, $file_path = '', $thumbsDir = []){

        $tableAlias = $this->_table->getAlias();
        $tableObj = TableRegistry::get($tableAlias);
        $file_path = $file_path ? $file_path : $tableObj->uploadDir;
        $thumbsDir = (!$thumbsDir && isset($tableObj->defaultThumb)) ? $tableObj->defaultThumb : $thumbsDir;

        if(file_exists($file_path . $file_name)){
            @unlink($file_path . $file_name);
        }

        foreach ($thumbsDir as $thumb=>$dimensions){
            if(file_exists($file_path.'thumb' .DS. $thumb .DS. $file_name)){
                @unlink($file_path.'thumb' . DS . $thumb . DS . $file_name);
            }
        }
        return true;
    }
}