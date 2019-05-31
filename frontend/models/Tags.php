<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string $name
 *
 * @property BooksTags[] $booksTags
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
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksTags()
    {
        return $this->hasMany(BooksTags::className(), ['tag_id' => 'id']);
    }

    public static function getAll(){
        return Tags::find()->all();
    }
	
	public static function getTen(){
        return Tags::find()->limit(10)->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['id' => 'book_id'])
            ->viaTable('books_tags', ['tag_id' => 'id']);
    }
}
