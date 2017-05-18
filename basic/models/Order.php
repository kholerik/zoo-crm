<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $customer_id
 * @property string $sum
 * @property string $address
 * @property string $at_date
 * @property string $delivery_date
 * @property integer $count
 * @property integer $status_id
 *
 * @property OrderStatus $status
 * @property Customer $customer
 * @property Product $product
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'customer_id', 'count', 'status_id'], 'integer'],
            [['sum'], 'number'],
            [['at_date', 'delivery_date'], 'safe'],
            [['address'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
//            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Товар',
            'customer_id' => 'Покупатель',
            'sum' => 'Сумма',
            'address' => 'Адрес',
            'at_date' => 'Дата заказа',
            'delivery_date' => 'Дата доставки',
            'count' => 'Кол-во',
            'status_id' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(OrderStatus::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getProduct()
//    {
//        return $this->hasOne(Product::className(), ['id' => 'product_id']);
//    }

    public function getProductOrderMns()
    {
//        return $this->hasOne(Product::className(), ['id' => 'product_id']);
        return $this->hasMany(ProductOrderMn::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('product_order_mn', ['order_id' => 'id']);
    }

    public function getProduct()
    {
        return $this->hasMany(ProductOrderMn::className(), ['order_id' => 'id']);
    }
}