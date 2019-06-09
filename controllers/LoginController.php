<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class LoginController extends Controller{

    public function actionIndex(){
        $this->layout = 'blank';
        if(!empty(Yii::$app->session['user'])){
            return $this->redirect(['/site/index']);
        }
        if(!empty($_POST)){
            $username =$_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT id, username, password, email, role FROM user WHERE username=:username AND password=:password";

            $params = [
                ':username' => $username,
                ':password' => $password
            ];
            $data = Yii::$app->db->createCommand($sql, $params)->queryOne();
            if(!empty($data)){
                Yii::$app->session['user'] = $data;
                Yii::$app->session['sms'] = [
                    'title'=>'เข้าสู่ระบบได้แล้ว เย้!..',
                    'content' => 'ยินกีต้อนรับ '.Yii::$app->session['user']['username'],
                    'iconsm' => 'fa fa-check fa-2x fadeInRight animated'
                    ];
               

                return $this->redirect(['site/index']);
            }else{
                $sms = 'กรุณาตรวจสอบ username หรือ password';
                return $this->render('index',[
                    'sms' =>$sms
                ]);
            }
        }
        return $this->render('index');
    }

    public function actionLogout(){
        
        $session = Yii::$app->session['user'];
        if(!empty($session)){
            unset (Yii::$app->session['user']);
            return $this->redirect(['login/index']);
        }
        return $this->redirect(['login/index']);

    }

}