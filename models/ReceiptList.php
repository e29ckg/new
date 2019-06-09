<?php

namespace app\models;
use app\models\Product;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "receipt_list".
 *
 * @property int $id
 * @property string $receipt_code
 * @property string $product_code
 * @property int $product_unit_id
 * @property double $unit_price
 * @property int $quantity
 * @property string $create_at
 */
class ReceiptList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity', 'unit_price','product_code'], 'required'],
            [['quantity'], 'integer'],
            // [['unit_price'], 'number'],
            [['create_at'], 'safe'],
            [['receipt_code'], 'string', 'max' => 32],
            [['product_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receipt_code' => 'Receipt Code',
            'product_code' => 'ชื่อวัสดุ',
            'unit_price' => 'ราคาต่อหน่วย',
            'quantity' => 'จำนวน',
            'create_at' => 'Create At',
        ];
    }

    public function getCountAll()
    {        
        return ReceiptList::find()->count();           
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['code' => 'product_code']);
    }

    public function getProductName(){
        $model = $this->product;
        return $model ? $model->product_name:'';
    }

    public function getProductPrice(){
        $model = $this->product;
        return $model ? $model->price:'';
    }

    public function getProductImg(){
        $model = $this->product;
        return $model ? $model->img:'';
    }

    public function getProductList(){
        $model = Product::find()->select('code, product_name')->orderBy(['product_name' => 'ASC'])->all();
        return ArrayHelper::map($model,'code','product_name');
    }

    public function getProductUnit()
    {
        return $this->hasOne(ProductUnit::className(), ['id' => 'product_unit_id']);
    }

    public function getProductUnitName(){
        $model = $this->productUnit;
        return $model ? $model->name_unit:'';
    }

}
