<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book_reviews".
 *
 * @property integer $id
 * @property string $book_title
 * @property string $author
 * @property string $amazon_url
 * @property string $review
 */
class BookReviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_title', 'author', 'amazon_url', 'review'], 'required'],
            [['review'], 'string'],
            [['book_title', 'author', 'amazon_url'], 'string', 'max' => 255],
            ['book_title', 'unique'],
            ['amazon_url', 'url', 'defaultScheme' => 'http']
            //['amazon_url', 'boolean']
            //['amazon_url', 'compare', 'compareValue' => 30, 'operator' => '>=', 'message' => 'you cannot be serious :v']
            //['amazon_url', 'date', 'format' => 'php:d-m-Y']
            //['amazon_url', 'default', 'value' => 'qwertyui']
            /*['amazon_url', 'filter', 'filter' => function ($value) {
                $value = str_replace(' ', '', $value);
                return $value;
            }],*/

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_title' => 'Book Title',
            'author' => 'Author',
            'amazon_url' => 'Amazon Url',
            'review' => 'Your Review',
        ];
    }
}
