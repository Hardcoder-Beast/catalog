<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 *  Модель поиска книг.
 */
class BookSearch extends Book
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id'], 'integer'],
            [['book_name', 'book_desc'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }


	/**
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = Book::find();

		$dataProvider = new ActiveDataProvider( [
			  'query' => $query,
		] );

		$this->load( $params );

		if( !$this->validate() ) {
			return $dataProvider;
		}

		$query->andFilterWhere( [
			  'book_id' => $this->book_id
		] );

		$query->andFilterWhere( [ 'like', 'book_name', $this->book_name ] )
		      ->andFilterWhere( [ 'like', 'book_desc', $this->book_desc ] );

		return $dataProvider;
	}
}
