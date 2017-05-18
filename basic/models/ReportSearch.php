<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;
use yii\data\ArrayDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * ReportSearch represents the model behind the search form about `app\models\Product`.
 */
class ReportSearch extends Product
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
            [['id', 'vendor_id', 'manufacturer_id', 'category_id', 'price_id', 'count', 'status_check', 'update_date'], 'integer'],
            [['name', 'createdFrom', 'createdTo'], 'safe'],
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


    public function attributeLabels()
    {
        return [
            'createdFrom' => 'Дата начала',
            'createdTo' => 'Дата окончания',
            'manufacturer_id' => 'Производитель',
            'category_id' => 'Категория',
        ];
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
        // my section
        $data = ArrayHelper::toArray($query, [
            'app\models\Product' => [
                'id',
                'vendor_id',
                'manufacturer_id',
                'category_id',
                'price_id',
                'count',
                'price',
                'update_date',
//              'createTime' => 'created_at',
//                // the key name in array result => anonymous function
//                'length' => function ($post) {
//                    return strlen($post->content);
//                },
            ],
        ]);


        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => ['id', 'vendor_id', 'manufacturer_id', 'category_id', 'count'],
            ],
        ]);

        // my section
//        print_r($query);
//        die();

        // add conditions that should always apply here


//        $dataProvider = new ArrayDataProvider([
//
//
//       ]);
        //$dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        $query = static::find()->select([
//            'id',
//            'vendor_id',
//            new Expression('IF(rating_count==0, 0, rating_sum/rating_count) as rating')
//        ])
//            ->orderBy([
//                'rating'=>SORT_ASC
//            ]);



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
//            'rating' => new Expression('price as rating'),
        ]);



        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['>=', 'update_date', $this->createdFrom]);
        $query->andFilterWhere(['<=', 'update_date', $this->createdTo]);

        return $dataProvider;
    }
}
