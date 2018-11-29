<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 *   Модель поиска авторов.
 */
class AuthorSearch extends Author
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['author_name', 'author_desc'], 'safe'],
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
    public function search($params)
    {
        $query = Author::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

	    $query->andFilterWhere([
		      'author_id' => $this->author_id
	    ]);

        $query->andFilterWhere(['like', 'author_name', $this->author_name])
              ->andFilterWhere(['like', 'author_desc', $this->author_desc]);

        return $dataProvider;
    }

}
