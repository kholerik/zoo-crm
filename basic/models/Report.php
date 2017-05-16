<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property integer $vendor_id
 * @property integer $manufacturer_id
 * @property integer $category_id
 * @property integer $price_id
 * @property integer $count
 * @property integer $status_check
 *
 * @property Vendor $vendor
 * @property Manufacturer $manufacturer
 * @property ProductCategory $category
 * @property Price $price
 */
class Report extends Model
{
    public $var1;
    public $var2;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['var1', 'var2'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'var1' => 'var1',
            'var2' => 'var2',
        ];
    }



}
