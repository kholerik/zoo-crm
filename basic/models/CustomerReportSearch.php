<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Customer;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/**
 * CustomerReportSearch represents the model behind the search form about `app\models\Customer`.
 */
class CustomerReportSearch extends Customer
{

    /**
     * @var string
     */
    public $createdFrom;

    /**
     * @var string
     */
    public $createdTo;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['name', 'phone', 'pets', 'address'], 'safe'],
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


    public function attributeLabels()
    {
        return [
            'name' => 'sssssssssssssssss начала',
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
//    public function search($params)
//    {
//        $query = Customer::find();
//
//        // add conditions that should always apply here
//
//        $data = ArrayHelper::toArray($query->all(), [
//            'app\models\Product' => [
//                'id',
//                'name' => function ($item) {
//                    return $item->name;
//                },
//                'phone' => function ($item) {
//                    return $item->phone;
//                },
//                'category' => function ($item) {
//                    return $item->category;
//                },
//                'pets' => function ($item) {
//                    return $item->pets;
//                },
//                'address' => function ($item) {
//                    return $item->address;
//                },
//                'countOrders',
//            ],
//        ]);
//
//        $dataProvider = new ArrayDataProvider([
//            'key' => 'id',
//            'allModels' => $data,
//            'sort' => [
//                'attributes' => ['name', 'vendor', 'manufacturer', 'category','price', 'count', 'update_date','countOrders'],
//            ],
//        ]);
//
//        $this->load($params);
//
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }
//
//        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'category_id' => $this->category_id,
//        ]);
//
//        $query->andFilterWhere(['like', 'name', $this->name])
//            ->andFilterWhere(['like', 'phone', $this->phone])
//            ->andFilterWhere(['like', 'pets', $this->pets])
//            ->andFilterWhere(['like', 'address', $this->address]);
//
//        return $dataProvider;
//    }


    public function search($params)
    {
        $query = Customer::find();


        $createdFrom =  Yii::$app->date->convertDate($this->createdFrom)->toTimestamp();
        $createdTo =  Yii::$app->date->convertDate($this->createdTo)->toTimestamp();

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'pets' => $this->pets,
        ]);

        $orderData = Customer::find()->one();


//        $query->joinWith(['orderData']);
        $query->andFilterWhere(['like', 'name', $this->name]);
//        $query->andFilterWhere(['>=', 'dateOrders', $createdFrom]);
//        $query->andFilterWhere(['<=', 'order.dateOrders', $createdTo]);
//        $query->andFilterWhere(['like', 'orderData.name', $createdTo]);

        $data = ArrayHelper::toArray($query->all(), [
            'app\models\Customer' => [
                'id',
                'name',
                'phone',
                'pets',
                'category',
                'countOrders',
                'sumOrders',
                'dateOrders',
            ],
        ]);

        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $data,
            'sort' => [
//                'attributes' => ['name', 'vendor', 'manufacturer', 'category', 'price', 'count', 'countOrders'],
            ],
        ]);




        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

}
