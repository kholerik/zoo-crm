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


    function beforeValidate()
    {
//        print_r( $this->createdTo );


//        $str='04 May 2017';

//        Yii::$app->formatter->locale = 'ru-RU';
//        echo $str = Yii::$app->formatter->asDate('2017 Май 17', 'timestamp');
//         echo Yii::$app->formatter->asDate('now', 'yyyy LLLL dd');
//        echo (new \IntlDateFormatter('ru_RU', null, null, null, null, 'yyyy LLLL'))
//            ->format(new \DateTime('2017 May'));


//        echo $str,'<br/>';
//        $datastamp=strtotime($str);
//        echo $datastamp,'<br/>';
//        $date = 1418372345; // исходное дата и время 12.12.2014 11:19:05
//        $date_mas = getdate($date);
//        echo $date_mas['mday'] . ' . ' . $date_mas['month'] . ' . ' . $date_mas['year'];
//        echo gmdate('D, d M Y H:i:s T', $datastamp);



//        die();
        return parent::beforeValidate();
    }



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
        // my section
//        print_r($query);
//        die();

        // add conditions that should always apply here

        $dataProvider = new ArrayDataProvider([
            'query' => $data,
       ]);
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
