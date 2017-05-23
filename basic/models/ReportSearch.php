<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;
use yii\data\ArrayDataProvider;
use yii\db\ActiveQuery;
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
            [['id', 'vendor_id', 'manufacturer_id', 'category_id', 'price_id', 'status_check'], 'integer'],
            [['name', 'createdFrom', 'createdTo', 'update_date'], 'safe'],
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

//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);




         $createdFrom =  Yii::$app->date->convertDate($this->createdFrom)->toTimestamp();
         $createdTo =  Yii::$app->date->convertDate($this->createdTo)->toTimestamp();
        /**** Варианты использования ****/
        //Yii::$app->date->convertDate($this->update_date)->toDate();
        //Yii::$app->date->convertDate($this->update_date)->toDateWithZero();


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'vendor_id' => $this->vendor_id,
            'manufacturer_id' => $this->manufacturer_id,
            'category_id' => $this->category_id,
            'price_id' => $this->price_id,
//            'count' => $this->count,
            'status_check' => $this->status_check,
            'price' => $this->price,
//            'update_date' => $this->updateDate,
//            'rating' => new Expression('price as rating'),
        ]);



        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['>=', 'update_date', $createdFrom]);
        $query->andFilterWhere(['<=', 'update_date', $createdTo]);


        $data = ArrayHelper::toArray($query->all(), [
            'app\models\Product' => [
                'id',
                'name',
//                'vendor_id' => function ($item) {
//                    return $item->vendor->name;
//                },
                'vendor',
                'manufacturer',
                'category',
                'price_id',
                'count',
                'price',
                'update_date',
                'countOrders',

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
