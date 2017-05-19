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

    public $vendor1;
    public $vendor11;
    public $manufacturer;
    public $category1;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vendor_id', 'manufacturer_id', 'category_id', 'price_id', 'count', 'status_check', 'update_date'], 'integer'],
            [['name', 'vendor1', 'manufacturer', 'category1'], 'safe'],
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
        $query->joinWith(['vendorGet', 'manufacturer', 'categoryGet']); // Здесь вродь не нужно

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
                'vendor1' => [
                    'asc' => ['vendor.name' => SORT_ASC],
                    'desc' => ['vendor.name' => SORT_DESC],
                ],
                // Important: here is how we set up the sorting
                // The key is the attribute name on our "ProductSearch" instance
                'category1' => [
                    // The tables are the ones our relation are configured to
                    // in my case they are prefixed with "tbl_"
//                    'asc' => ['productCategory.name' => SORT_ASC],   //['tbl_city.name' => SORT_ASC],
                    'asc' => ['product-category.name' => SORT_ASC],   //['tbl_city.name' => SORT_ASC],
//                    'desc' => ['productCategory.name' => SORT_DESC],   //['tbl_city.name' => SORT_ASC],
                    'desc' => ['product-category.name' => SORT_DESC],   //['tbl_city.name' => SORT_ASC],
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

//            $query->joinWith(['vendorGet', 'manufacturer', 'category']); // relations!!

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        $this->addCondition($query, 'vendor_id');

        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
            'vendor_id' => $this->vendor_id,
            'manufacturer_id' => $this->manufacturer_id,
//            'category_id' => $this->category_id,
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



        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // Here we search the attributes of our relations using our previously configured
        // ones in "ProductSearch"
        $query->andFilterWhere(['like', 'vendor.name', $this->vendor1]);
        $query->andFilterWhere(['like', 'manufacturer.name', $this->manufacturer]);
        $query->andFilterWhere(['like', 'category.name', $this->category1]);
        $query->andFilterWhere(['like', 'product.name', $this->name]);


        return $dataProvider;
//        return $dataProvider;
    }




}
