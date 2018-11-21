<?php

namespace app\models;

use Yii;

/**
 *  Таблица связей многие ко многим
 *
 * @property int $book_author_id
 * @property int $book_id
 * @property int $author_id
 */
class AuthorBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author_book';
    }

	public static function className()
	{
		return get_called_class();
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'author_id'], 'required'],
            [['book_id', 'author_id'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'book_author_id' => 'УН тааблицы связей книг с авторами',
            'book_id' => 'УН книга',
            'author_id' => 'УН автора',
        ];
    }
}
