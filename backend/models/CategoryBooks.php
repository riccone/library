<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category_books".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property int $status
 * @property string $key_cat
 *
 * @property Books[] $books
 */
class CategoryBooks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'required'],
            [['parent_id', 'status'], 'integer'],
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
            'parent_id' => 'Родительская категория',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['category_id' => 'id']);
    }

    public function getName(){
        return $this->name;
    }
}
