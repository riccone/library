<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $document
 * @property int $year
 * @property string $author
 * @property int $viewed
 * @property int $status
 * @property int $category_id
 * @property string $date_added
 *
 * @property CategoryBooks $category
 * @property BooksTags[] $booksTags
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['image', 'category_id', 'date_added'], 'required'],
            [['year', 'viewed', 'status', 'category_id'], 'integer'],
            [['date_added'], 'safe'],
            [['name', 'image', 'document', 'author'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryBooks::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'description' => 'Description',
            'image' => 'Image',
            'document' => 'Document',
            'year' => 'Year',
            'author' => 'Author',
            'viewed' => 'Viewed',
            'status' => 'Status',
            'category_id' => 'Category ID',
            'date_added' => 'Date Added',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CategoryBooks::className(), ['id' => 'category_id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tags::className(), ['id' => 'tag_id'])
            ->viaTable('books_tags', ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksTags()
    {
        return $this->hasMany(BooksTags::className(), ['book_id' => 'id']);
    }

    public function getImage(){
        if ($this->image){
            return '/../uploads/images/' .$this->image;
        }
        return '/no-image.png';
    }

    public function getDoc(){
        if ($this->document){
            return '/uploads/docs/' .$this->document;
        }
        return '/no-doc.pdf';
    }
}
