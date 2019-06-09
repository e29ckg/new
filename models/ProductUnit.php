<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_unit".
 *
 * @property int $id
 * @property string $name_unit
 * @property string $detail_unit
 */
class ProductUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_unit'], 'required'],
            [['name_unit', 'detail_unit'], 'string', 'max' => 255],
            [['name_unit'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_unit' => 'ชื่อหน่วยนับ',
            'detail_unit' => 'รายละเอียด',
        ];
    }

    public function getCountAll()
    {        
        return ProductUnit::find()->count();           
    }
}
