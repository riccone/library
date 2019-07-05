<?php
/**
 * Created by PhpStorm.
 * User: 17A10_SJE_1
 * Date: 29.04.2019
 * Time: 17:18
 */

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class DocUpload extends Model
{

    public $document;

    public function rules()
    {
        return [
            [['document'], 'required'],
            [['document'], 'file', 'extensions' => 'pdf, mp3, wav']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentdoc)
    {

        $this->document = $file;

        if ($this->validate()) {
            $this->deleteCurrentDoc($currentdoc);
            return $this->saveDoc();
        }
    }

    private function getFolder(){
        //return Yii::getAlias('@web') . 'uploads/docs/';
        return 'uploads/docs/';
    }

    private function genereteFilename(){
        //var_dump(strtolower(md5(uniqid($this->document->baseName)) . '.' . $this->document->extension));die();
        return strtolower(md5(uniqid($this->document->baseName)) . '.' . $this->document->extension);
    }

    public function deleteCurrentDoc($currentdoc){
        if (!empty($currentdoc) && file_exists($this->getFolder() . $currentdoc)) {
            unlink($this->getFolder(). $currentdoc);
        }
    }

    private function saveDoc(){
        $filename = $this->genereteFilename();
        $this->document->saveAs($this->getFolder() . $filename);
        return $filename;
    }
}