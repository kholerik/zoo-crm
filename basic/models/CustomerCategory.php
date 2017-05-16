<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $margin_id
 *
 * @property Customer $customer
 * @property Margin $margin
 */
class CustomerCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['margin_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['margin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Margin::className(), 'targetAttribute' => ['margin_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Категория',
            'margin_id' => 'Наценка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMargin()
    {
        return $this->hasOne(Margin::className(), ['id' => 'margin_id']);
    }
}
