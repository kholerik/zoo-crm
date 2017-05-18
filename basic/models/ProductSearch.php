<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{

    public $vendor;
    public $manufacturer;
    public $category;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vendor_id', 'manufacturer_id', 'category_id', 'price_id', 'count', 'status_check', 'update_date'], 'integer'],
            [['name', 'vendor', 'manufacturer', 'category'], 'safe'],
            [['price'], 'number'],
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
        $query = Product::find();

        // add conditions that should always apply here
        $query->joinWith(['vendor', 'manufacturer', 'category']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /**
         * Настройка параметров сортировки
         * Важно: должна быть выполнена раньше $this->load($params)
         * statement below
         */
        $dataProvider->setSort([
            'attributes' => [
                'manufacturer' => [
                    'asc' => ['manufacturer.name' => SORT_ASC],
                    'desc' => ['manufacturer.name' => SORT_DESC],
                ],
                'vendor' => [
                    'asc' => ['vendor.name' => SORT_ASC],
                    'desc' => ['vendor.name' => SORT_DESC],
                ],
                'category' => [
                    'asc' => ['category.name' => SORT_ASC],
                    'desc' => ['category.name' => SORT_DESC],
                ],
                'name' => [
                    'asc' => ['name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC],
                ],
                'price' => [
                    'asc' => ['price' => SORT_ASC],
                    'desc' => ['price' => SORT_DESC],
                ],
                'count' => [
                    'asc' => ['count' => SORT_ASC],
                    'desc' => ['count' => SORT_DESC],
                ],
            ],
        ]);



        $this->load($params);


        $query->joinWith(['vendor', 'manufacturer', 'category']);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        $this->addCondition($query, 'vendor_id');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'vendor_id' => $this->vendor_id,
            'manufacturer_id' => $this->manufacturer_id,
            'category_id' => $this->category_id,
            'price_id' => $this->price_id,
            'count' => $this->count,
            'status_check' => $this->status_check,
            'price' => $this->price,
            'update_date' => $this->update_date,
        ]);

        /* Настроим правила фильтрации */

        // фильтр по имени
//        $query->joinWith(['vendor' => function ($q) {
//            $q->where('vendor.name LIKE "%' . $this->vendorName . '%"');
//        }]);

        $query->andFilterWhere(['like', 'name', $this->name]);


        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'vendor.name', $this->vendor]);
        $query->andFilterWhere(['like', 'manufacturer.name', $this->manufacturer]);
        $query->andFilterWhere(['like', 'category.name', $this->category]);

        return $dataProvider;
//        return $dataProvider;
    }




}
