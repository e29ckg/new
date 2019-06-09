<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receipt".
 *
 * @property int $id
 * @property string $receipt_code
 * @property int $user_id
 * @property string $receipt_from
 * @property double $sumtotal
 * @property int $status
 * @property string $create_at
 */
class Receipt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['receipt_code'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['sumtotal'], 'number'],
            [['create_at'], 'safe'],
            [['receipt_code'], 'string', 'max' => 32],
            [['receipt_from'], 'string', 'max' => 255],
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
            'user_id' => 'User ID',
            'receipt_from' => 'Receipt From',
            'sumtotal' => 'Sumtotal',
            'status' => 'Status',
            'create_at' => 'Create At',
        ];
    }

    public function getCountAll()
    {        
        return Receipt::find()->count();           
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }

    public function getProfileName(){
        $model = $this->profile;
        return $model ? $model->fname.$model->name.' '.$model->sname:'';
    }
}
