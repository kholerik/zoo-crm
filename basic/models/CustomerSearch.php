<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `app\models\Customer`.
 */
class CustomerSearch extends Customer
{

    public $category;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['id', 'category_id'], 'integer'],
            [['name', 'phone', 'pets', 'address', 'category'], 'safe'],
        ];
    }



    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Customer::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                        'name' => [
        'asc' => ['count' => SORT_ASC],
        'desc' => ['count' => SORT_DESC],
    ],
                        'phone' => [
        'asc' => ['count' => SORT_ASC],
        'desc' => ['count' => SORT_DESC],
    ],
                        'pets' => [
        'asc' => ['count' => SORT_ASC],
        'desc' => ['count' => SORT_DESC],
    ],
                        'address' => [
        'asc' => ['count' => SORT_ASC],
        'desc' => ['count' => SORT_DESC],
    ],

            ],
        ]);

        $this->load($params);

        $query->joinWith(['category']);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }



        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'pets', $this->pets])
            ->andFilterWhere(['like', 'address', $this->address]);

        $query->andFilterWhere(['like', 'category.name', $this->category]);

        return $dataProvider;
    }
}
