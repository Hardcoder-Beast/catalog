<?php

namespace app\models;

use Yii;
use yii\base\ModelEvent;
use yii\db\ActiveRecord;
use app\models\AuthorBook;
use yii\db\ActiveRecordInterface;
use yii\helpers\ArrayHelper;

/**
 * Модель книги
 *
 * @property int $book_id
 * @property string $book_name
 * @property string $book_desc
 */
class Book extends ActiveRecord {

	/**
	 * @var array $booksAuthorList св-во для хранение списка идентификаторов связанных записей моделей Author
	 */
	public $booksAuthorList = [];


	/**
	 * {@inheritdoc}
	 */
	public static function tableName() {
		return 'book';
	}


	/**
	 * {@inheritdoc}
	 */
	public function rules() {
		return [
			  [['book_id'], 'integer'],
			  [ [ 'book_name' ], 'required' ],
			  [ [ 'books_author' ], 'safe' ],
			  [ [ 'book_desc' ], 'safe' ],
			  [ [ 'book_name' ], 'string', 'max' => 250 ],
		];
	}


	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			  'book_id'      => 'УН',
			  'book_name'    => 'Название книги',
			  'books_author' => 'Автора книги',
			  'book_desc'    => 'Описание',
		];
	}


	public function getAuthors() {
		return $this->hasMany( Author::className(), [ 'author_id' => 'author_id' ] )
		            ->viaTable( 'author_book', [ 'book_id' => 'book_id' ] );
	}


	public function getBookAuthors() {
			return $this->hasMany( AuthorBook::className(), [ 'book_id' => 'book_id']);
	}


	public function getAuthorsData() {
		$authors = $this->getAuthors()->all();
		$result = [];

		if( $authors ) {
			foreach( $authors as $author ){
				$result[ $author->author_id ] = [ 'selected' => 'selected' ];
			}
		}

		return $result;
	}


	public function getMainData() {
		$result = [];
		$authors = $this->getAuthors();
		$authorsData = $authors->all();

		if( !empty( $authorsData ) ) {
			foreach( $authorsData as $author ){
				if( !empty( $author ) && $author !== null && isset( $author->author_name ) ) {
					$result[] = $author->author_name;
				}
			}
		}

		if( count( $result ) ) {
			$result = implode( ', ', $result );
		}

		return $result ? : '';
	}


	/**
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name) {
		if( $name === 'books_author' ) {
			$list = $this->getBooksAuthorList();
			$value = ArrayHelper::getValue( $list, 'books_author', [] );
		} else {
			$value = parent::__get( $name );
		}

		return $value;
	}


	/**
	 * @param string $name
	 * @param mixed  $value
	 */
	public function __set($name, $value) {
		if( $name === 'books_author' ) {
			$this->setBooksAuthorList( ArrayHelper::getValue( $value, 'books_author', $value ) );
		} else {
			parent::__set( $name, $value );
		}
	}


	/**
	 * @param $insert
	 * @param $changedAttributes
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function afterSave($insert, $changedAttributes)
	{
		$oldBookAuthors = $this->getBookAuthors()->all();

		/** @var ActiveRecord $record */
		foreach ( $oldBookAuthors as $record ) {
			$record->delete();
		}

		$this->updateLinkingRecords( '\app\models\AuthorBook',
			  [ 'pk' => 'book_id', 'value' => $this->book_id ],
			  [ 'fk' => 'author_id', 'value' => $this->getBooksAuthorList() ]
		);

		parent::afterSave( $insert, $changedAttributes );
	}

	public function afterDelete()
	{
		parent::afterDelete();

		$oldBookAuthors = $this->getBookAuthors()->all();

		/** @var ActiveRecord $record */
		foreach ( $oldBookAuthors as $record ) {
			$record->delete();
		}
	}

	/**
	 * @param string $linkModelName дополнительная модель для связи (TODO: пример)
	 * @param array $primaryData данные первичного ключа
	 * @param array $foreignData данные связанных таблиц
	 */
	public function updateLinkingRecords($linkModelName, array $primaryData, array $foreignData)
	{
		if( $primaryData && $foreignData && class_exists( $linkModelName ) )
		{
			$primaryName = ArrayHelper::getValue( $primaryData, 'pk' );
			$primaryValue = ArrayHelper::getValue( $primaryData, 'value' );
			$foreignName = ArrayHelper::getValue( $foreignData, 'fk' );
			$foreignValue = (array) ArrayHelper::getValue( $foreignData, 'value', [] );

			if( !empty( $foreignValue ) ) {
				foreach( $foreignValue as $fk ) {
					/** @var ActiveRecord $relation */
					$relation = new $linkModelName();
					$relation->$primaryName = $primaryValue;
					$relation->$foreignName = $fk;
					$relation->save();
				}
			}
		}
	}

	/**
	 * @return array
	 */
	public function getBooksAuthorList() {
		return $this->booksAuthorList;
	}


	/**
	 * @param array $booksAuthorList
	 */
	public function setBooksAuthorList($booksAuthorList) {
		$this->booksAuthorList = $booksAuthorList;
	}

}