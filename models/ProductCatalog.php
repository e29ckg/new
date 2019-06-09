<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_catalog".
 *
 * @property int $id
 * @property string $name_catalog
 * @property string $order
 * @property string $detail_catalog
 */
class ProductCatalog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_catalog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_catalog', 'order'], 'required'],
            [['name_catalog'], 'unique'],
            [['name_catalog', 'detail_catalog'], 'string', 'max' => 255],            
            [['order'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_catalog' => 'ชื่อประเภทวัสดุ',
            'order' => 'ลำดับ',
            'detail_catalog' => 'รายละเอียด',
        ];
    }

    public function getCountAll()
    {        
        return ProductCatalog::find()->count();           
    }
}
