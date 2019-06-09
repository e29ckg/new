<?php

namespace app\controllers;

use Yii;
use app\models\Receipt;
use app\models\ReceiptList;
use app\models\OrderList;
use app\models\Product;
use app\models\LogSt;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class SettingController extends Controller
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

    
    public function actionPrint($id = null)
    {
        $model = $this->findModel($id);
        $model_lists = LogSt::find()->where(['code'=> $model->receipt_code,'create_at'=>$model->create_at])->all();

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
    $pdf = new Pdf([
        'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
        'content' => $this->renderPartial('print',['model' => $model,'model_lists' =>$model_lists]),
        'cssFile' => 'css/pdf.css',
        'options' => [
            // any mpdf options you wish to set
        ],
        'methods' => [
            // 'SetTitle' => 'Privacy Policy - Krajee.com',
            // 'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
            // 'SetHeader' => ['Krajee Privacy Policy||Generated On: ' . date("r")],
            // 'SetFooter' => ['|Page {PAGENO}|'],
            // 'SetAuthor' => 'Kartik Visweswaran',
            // 'SetCreator' => 'Kartik Visweswaran',
            // 'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
        ]
    ]);
    return $pdf->render();
    }

    public function actionUp_receipt_to_logst()
    {
        $models = ReceiptList::find()->all();
        
        foreach ($models as $model):
            $modellst = LogSt::find()->where(['receipt_list_id' => $model->id])->one();
            if(!($modellst)){
            $modelLS = new LogSt(); 
                $modelLS->code = $model->receipt_code;
                $modelLS->product_code = $model->product_code;
                $modelLS->receipt_list_id = $model->id;
                $modelLS->unit_price = $model->unit_price;
                $modelLS->quantity = $model->quantity;
                $modelLS->create_at = $model->create_at;
            $modelLS->save();
        }
        endforeach; 
        Yii::$app->session->setFlash('success', 'receipt->Logst ข้อมูลเรียบร้อย');  
        return $this->redirect(['index']);
    }

    public function actionIndex()
    {
        $modelPs = Product::find()->all();

        $modelRLs = ReceiptList::find()->all();

        $modelLogs = LogSt::find()->all();
        
        // foreach ($modelPs as $modelP):
            
        
        // endforeach; 
        // Yii::$app->session->setFlash('success', 'receipt->Logst ข้อมูลเรียบร้อย');  
        return $this->render('index',[
            'modelPs' => $modelPs,
            'modelRLs' => $modelRLs,
            'modelLogs' =>$modelLogs ,
        ]); 
    }
}
