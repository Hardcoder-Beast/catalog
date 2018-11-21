<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Модель автора книги
 *
 * @property int    $author_id
 * @property string $author_name
 */
class Author extends \yii\db\ActiveRecord {
	/**
	 * @var array $booksAuthorList св-во для хранение списка идентификаторов связанных записей моделей Book
	 */
	public $authorBooksList = [];


	/**
	 * {@inheritdoc}
	 */
	public static function tableName() {
		return 'author';
	}


	/**
	 * {@inheritdoc}
	 */
	public function rules() {
		return [
			  [ [ 'author_id' ], 'integer' ],
			  [ [ 'author_name' ], 'required' ],
			  [ [ 'author_books' ], 'safe' ],
			  [ [ 'author_desc' ], 'safe' ],
			  [ [ 'author_name' ], 'string', 'max' => 255 ],
		];
	}


	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			  'author_id'    => 'УН',
			  'author_desc'  => 'Примечание',
			  'author_name'  => 'Полное имя автора',
			  'author_books' => 'Книги автора',
		];
	}


	public function getBooks() {
		return $this->hasMany( Book::className(), [ 'book_id' => 'book_id' ] )
		            ->viaTable( 'author_book', [ 'author_id' => 'author_id' ] );
	}


	public function getAuthorBooks() {
		return $this->hasMany( AuthorBook::className(), [ 'author_id' => 'author_id' ] );
	}


	public function getBooksDataSelected() {
		$books = $this->getBooks()->all();
		$result = [];

		if( $books ) {
			foreach( $books as $book ){
				$result[ $book->book_id ] = [ 'selected' => 'selected' ];
			}
		}

		return $result;
	}


	public function getMainData() {
		$result = '<ol>';
		$books = $this->getBooks();
		$booksData = $books->all();

		if( !empty( $booksData ) ) {
			foreach( $booksData as $book ){
				if( !empty( $book ) && $book !== null && isset( $book->book_name ) ) {
					$result .= "<li>$book->book_name;</li>";
				}
			}
		}
		$result .= '</ol>';

		return $result;
	}


	public function getBookQty() {
		$result = 0;
		$books = $this->getBooks();
		$booksData = $books->all();

		if( !empty( $booksData ) ) {
			foreach( $booksData as $book ){
				if( !empty( $book ) && $book !== null && isset( $book->book_name ) ) {
					$result ++;
				}
			}
		}

		return $result;
	}


	public function __get($name) {
		if( $name === 'author_books' ) {
			$list = $this->getAuthorBooksList();
			$value = ArrayHelper::getValue( $list, 'author_books', [] );
		} else {
			$value = parent::__get( $name );
		}

		return $value;
	}


	public function __set($name, $value) {
		if( $name === 'author_books' ) {
			$this->setAuthorBooksList( ArrayHelper::getValue( $value, 'author_books', $value ) );
		} else {
			parent::__set( $name, $value );
		}
	}


	public function afterSave($insert, $changedAttributes) {
		$oldAuthorsBook = $this->getAuthorBooks()->all();

		/** @var ActiveRecord $record */
		foreach( $oldAuthorsBook as $record ){
			$record->delete();
		}

		$this->updateLinkingRecords( '\app\models\AuthorBook',
			  [ 'pk' => 'author_id', 'value' => $this->author_id ],
			  [ 'fk' => 'book_id', 'value' => $this->getAuthorBooksList() ]
		);

		parent::afterSave( $insert, $changedAttributes );
	}


	public function afterDelete() {
		parent::afterDelete();

		$oldAuthorsBook = $this->getAuthorBooks()->all();

		/** @var ActiveRecord $record */
		foreach( $oldAuthorsBook as $record ){
			$record->delete();
		}
	}


	/**
	 * @param string $linkModelName дополнительная модель для связи (TODO: пример)
	 * @param array  $primaryData данные первичного ключа
	 * @param array  $foreignData данные связанных таблиц
	 */
	public function updateLinkingRecords($linkModelName, array $primaryData, array $foreignData) {
		if( $primaryData && $foreignData && class_exists( $linkModelName ) ) {
			$primaryName = ArrayHelper::getValue( $primaryData, 'pk' );
			$primaryValue = ArrayHelper::getValue( $primaryData, 'value' );
			$foreignName = ArrayHelper::getValue( $foreignData, 'fk' );
			$foreignValue = (array)ArrayHelper::getValue( $foreignData, 'value', [] );

			if( !empty( $foreignValue ) ) {
				foreach( $foreignValue as $fk ){
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
	public function getAuthorBooksList() {
		return $this->authorBooksList;
	}


	/**
	 * @param array $authorBooksList
	 */
	public function setAuthorBooksList($authorBooksList) {
		$this->authorBooksList = $authorBooksList;
	}

}
