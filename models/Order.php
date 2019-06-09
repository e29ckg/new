<?php

namespace app\models;


use Yii;
use app\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $order_code
 * @property string $id_user
 * @property int $status
 * @property string $create_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['order_code'], 'required'],
            [['status','id_user'], 'integer'],
            [['create_at'], 'safe'],
            [['order_code'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_code' => 'Code',
            'id_user' => 'Id User',
            'status' => 'Status',
            'create_at' => 'Create At',
        ];
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id_user']);
    }

    public function getProfileName(){
        $model = $this->profile;
        return $model ? $model->fname.$model->name.' '.$model->sname :'';
    }

    public function getCountAll()
    {        
        return Product::find()->count();           
    }

    public function getNameStatus(){
        return [       
        
            1 => 'นาย',
            2 => 'นางสาว',
            3 => 'นาง',
            4 => 'ยกเลิก'
          
          
      ];
    }
}
