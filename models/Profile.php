<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $user_id
 * @property string $id_card
 * @property string $fullname
 * @property string $name
 * @property string $sname
 * @property string $img
 * @property string $birthday
 * @property string $bloodtype
 * @property int $idc
 * @property string $dep
 * @property string $address
 * @property string $postcode
 * @property string $phone
 * @property string $create_at
 * @property string $updated_at
 * @property int $st
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'fullname', 'name'], 'required'],
            [['birthday', 'create_at', 'updated_at'], 'safe'],
            [['idc', 'st'], 'integer'],
            [['user_id', 'id_card', 'fullname', 'img', 'dep', 'address', 'phone'], 'string', 'max' => 255],
            [['name', 'sname', 'bloodtype'], 'string', 'max' => 50],
            [['postcode'], 'string', 'max' => 5],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'id_card' => 'Id Card',
            'fullname' => 'Fullname',
            'name' => 'Name',
            'sname' => 'Sname',
            'img' => 'Img',
            'birthday' => 'Birthday',
            'bloodtype' => 'Bloodtype',
            'idc' => 'Idc',
            'dep' => 'Dep',
            'address' => 'Address',
            'postcode' => 'Postcode',
            'phone' => 'Phone',
            'create_at' => 'Create At',
            'updated_at' => 'Updated At',
            'st' => 'St',
        ];
    }

    public function getFullName()
    {
        $model = Profile::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
        return $model->fname.$model->name.' '.$model->sname;
    }

    public function getImg()
    {
        $model = Profile::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
        return $model->img ? 'http://'.$_SERVER['HTTP_HOST'].'/new/web/uploads/user/'.$model->img : 'http://'.$_SERVER['HTTP_HOST'].'/new/web/img/avatars/male.png';
    }

    public function getDep()
    {
        $model = Profile::findOne(['user_id'=>Yii::$app->user->identity->id]);
        return $model->dep;
    }

    public function getPhone()
    {
        $model = Profile::findOne(['user_id'=>Yii::$app->user->identity->id]);
        return $model->phone;
    }
}
