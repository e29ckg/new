<?php

namespace app\controllers;

use Yii;
use app\models\LogSt;
use app\models\ReceiptList;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Order_listController implements the CRUD actions for OrderList model.
 */
class Log_stController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OrderList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $models = LogSt::find()->all();
        
        return $this->render('index', [
            'models' => $models,
        ]);
    }

        protected function findModel($id)
    {
        if (($model = OrderList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUp_receipt_list_id()
    {
        $models = LogSt::find()->all();
        
        foreach ($models as $model):
            // if($model->receipt_list_id == ''){
                $modelRLs = ReceiptList::find()->where([
                    'receipt_code'=>$model->code,
                    'product_code'=>$model->product_code,
                    'unit_price'=>$model->unit_price])->all();
                foreach ($modelRLs as $modelRL):
                    $model->receipt_list_id = $modelRL->id; 
                    $model->save();
                endforeach;                    
            // }
        endforeach; 
        Yii::$app->session->setFlash('success', 'ปรับ Logst->Receipt_list_id ข้อมูลเรียบร้อย');  
        return $this->redirect(['index']);
    }
}
