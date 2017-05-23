<?php

namespace app\models;

use Yii;

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
 * @property string $price
 * @property integer $update_date
 *
 * @property Order[] $orders
 * @property Vendor $vendor
 * @property Manufacturer $manufacturer
 * @property ProductCategory $category
 */
class Product extends \yii\db\ActiveRecord
{


    function afterSave($insert, $changedAttributes)
    {
            $oldPrice = Price::find()->where([
                'product_id' => $this->id,
                'value' => $this->price
            ]);

//        $oldModel = Price::find();
        if (!$oldPrice->exists()) {
            $model = new Price();
            $model->product_id = $this->id;
            $model->value = $this->price;
            $model->create_date = time();
            $model->save();
        }

        if (isset($model) AND $model->getErrors()) {
            print_r( $model ); die();
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vendor_id', 'manufacturer_id', 'category_id', 'price_id', 'count', 'status_check', 'update_date'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['vendor_id' => 'id']],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::className(), 'targetAttribute' => ['manufacturer_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'vendor_id' => 'Поставщик',
            'manufacturer_id' => 'Производитель',
            'category_id' => 'Категория',
            'price_id' => 'Цена',
            'count' => 'Кол-во',
            'status_check' => 'Архив',
            'price' => 'Цена',
            'update_date' => 'Дата изменения',
            'vendor1' => 'Поставщик',
            'manufacturer' => 'Производитель',
            'category' => 'Категория',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendorGet()
    {
        return $this->hasOne(Vendor::className(), ['id' => 'vendor_id']);
    }

    public function getVendor()
    {
        return $this->hasOne(Vendor::className(), ['id' => 'vendor_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'manufacturer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryGet()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }


    function getCountOrders() // метод будет извлекать некоторое поле связанной модели
    {
        return Order::find()->where(['product_id' => $this->id])->count(); // возвращаем поле указанной модели
    }


}
