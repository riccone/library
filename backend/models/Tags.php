<?php

namespace backend\models;

use Yii;
use yii\base\InvalidConfigException;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string $name
 *
 * @property BooksTags[] $booksTags
 * @property Books[] $books
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
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
            'name' => 'Наименование',
        ];
    }

    public function getBooks(){
        try {
            return $this->hasMany(Books::className(), ['id' => 'book_id'])->viaTable('books_tags', ['tag_id' => 'id']);
        } catch (InvalidConfigException $e) {
        }
    }
}
