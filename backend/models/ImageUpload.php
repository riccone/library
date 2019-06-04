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

class ImageUpload extends Model
{

    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg, png']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentimage)
    {

        $this->image = $file;

        if ($this->validate()) {
            $this->deleteCurrentImage($currentimage);
            return $this->saveImage();
        }
    }

    private function getFolder(){
        //return Yii::getAlias('@web') . 'uploads/images/';
		//echo Yii::getAlias('@web');
        return 'uploads/images/';
    }

    private function genereteFilename(){
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    public function deleteCurrentImage($currentimage){
        if (!empty($currentimage) && file_exists($this->getFolder() . $currentimage)) {
            unlink($this->getFolder(). $currentimage);
        }
    }

    private function saveImage(){
        $filename = $this->genereteFilename();
        $this->image->saveAs($this->getFolder() . $filename);
        return $filename;
    }
}