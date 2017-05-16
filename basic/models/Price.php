<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property integer $id
 * @property integer $value
 * @property string $update_date
 *
 * @property Product[] $products
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'integer'],
            [['update_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Цена',
            'update_date' => 'Дата изменения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['price_id' => 'id']);
    }
}
