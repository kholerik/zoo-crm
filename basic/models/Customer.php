<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property integer $category_id
 * @property string $pets
 * @property string $address
 *
 * @property CustomerCategory $id0
 */
class Customer extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['name', 'phone', 'pets', 'address'], 'string', 'max' => 255],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerCategory::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'phone' => 'Телефон',
            'category_id' => 'Категория',
            'pets' => 'Животные',
            'address' => 'Адрес',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(CustomerCategory::className(), ['id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(CustomerCategory::className(), ['id' => 'category_id']);
    }

    function getCountOrders() // метод будет извлекать некоторое поле связанной модели
    {
        return Order::find()->where(['customer_id' => $this->id])->count(); // возвращаем поле указанной модели
    }

    function getSumOrders() // метод будет извлекать некоторое поле связанной модели
    {
        return Order::find()->where(['customer_id' => $this->id])->sum('sum'); // возвращаем поле указанной модели
    }

    function getDateOrders() // метод будет извлекать некоторое поле связанной модели
    {
        return $this->hasOne(Order::className(), ['id' => 'customer_id'])
//            ->where('subtotal > :threshold', [':threshold' => $threshold])
            ->orderBy('id');
        return Order::find()->where(['customer_id' => $this->id]); // возвращаем поле указанной модели
//        $customers = Customer::findBySql($sql, [':status' => Customer::STATUS_INACTIVE])->all();
//        return Order::find()->where(['customer_id' => $this->id])->sum('sum'); // возвращаем поле указанной модели
    }

}
