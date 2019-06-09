<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class UserController extends Controller{

    public function actionIndex(){
        $this->layout = 'main';

        $sql = "SELECT id, name, sname FROM profile ";

       
        $data = Yii::$app->db->createCommand($sql)->queryAll();
       
        return $this->render('index',[
            'models' => $data
        ]);
    }

    public function actionProfile($id=NULL){
       
        return $this->render('profile');
    }
}