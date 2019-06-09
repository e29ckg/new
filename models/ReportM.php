<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report_m".
 *
 * @property int $id
 * @property string $month
 * @property string $detail
 * @property string $create_at
 */
class ReportM extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_m';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_at'], 'safe'],
            [['month', 'detail'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'month' => 'Month',
            'detail' => 'Detail',
            'create_at' => 'Create At',
        ];
    }
}
