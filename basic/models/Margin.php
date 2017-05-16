<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "margin".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 *
 * @property CustomerCategory[] $customerCategories
 */
class Margin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'margin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наценка',
            'value' => 'Значение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCategories()
    {
        return $this->hasMany(CustomerCategory::className(), ['margin_id' => 'id']);
    }
}
