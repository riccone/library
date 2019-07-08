<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $image
 * @property string $bio
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'bio'], 'required'],
            [['bio'], 'string'],
            [['firstname', 'lastname'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'image' => 'Image',
            'bio' => 'Bio',
        ];
    }

    public function saveImage($filename){
        $this->image = $filename;
        return $this->save(false);
    }

    public function getImage(){
        if ($this->image){
            $path = "/uploads/images/" .$this->image;
            return $path;
        }
        return '/no-image.png';
    }

    public function deleteImage(){
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        //$this->deleteDoc();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }
}
