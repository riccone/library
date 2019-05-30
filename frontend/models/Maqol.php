<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "maqol".
 *
 * @property int $id
 * @property string $name
 */
class Maqol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maqol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public static function getAll(){
        return Maqol::find()->all();
    }
}
