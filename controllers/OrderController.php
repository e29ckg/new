<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use app\models\OrderList;
use app\models\ReceiptList;
use app\models\LogSt;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update'],
                'rules' => [
                    [
                        'actions' => ['index','create','update'],
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
        ]);
        $model = Order::find()->orderBy([
            'create_at'=>SORT_ASC,
            'id' => SORT_DESC,
            ])->limit(200)->all();
        
            $countAll = Order::getCountAll();
        
        return $this->render('index',[
            'models' => $model,
            'countAll' => $countAll,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model_lists = OrderList::find()->where(['order_code'=> $model->order_code])->all();
        
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('view',[
                'model' => $model,
                'model_lists' => $model_lists,                  
            ]);
        }
        return $this->render('view', [
            'model' => $model,
            'model_lists' => $model_lists,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->create_at = date("Y-m-d H:i:s");
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('create',[
                    'model' => $model,                    
            ]);
        }else{
            return $this->render('create',[
                'model' => $model,                    
            ]); 
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrint($id = null)
    {
        $this->layout = 'cart_shop';   
        $user_id = Yii::$app->user->id;
        $model = $this->findModel($id);
        $user_id = Yii::$app->user->id;
        $model_lists = OrderList::find()->where(['order_code'=> $model->order_code])->all();
    
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

    protected function findModel_rl($id)
    {
        if (($model = ReceiptList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCancel($id)
    {  
        $user_id = Yii::$app->user->id;
        $modelOD = $this->findModel($id);

        $model_order_lists = OrderList::find()->where(['order_code'=> $modelOD->order_code])->all();
            
        foreach ($model_order_lists as $model_order_list): 
            if(!($model_order_list->receipt_list_id == null)){     

                $QTY = $model_order_list->quantity;
                if($QTY <> 0){
                    $model_receipt_lists = $this->findModel_rl($model_order_list->receipt_list_id);
                    $model_receipt_lists->quantity = $model_receipt_lists->quantity + $QTY;
                    $model_receipt_lists->create_at = date("Y-m-d H:i:s");
                  
                    $modelP = Product::find()->where(['code'=> $model_order_list->product_code])->one();
                    $modelP->instoke = $modelP->instoke + $QTY;

                    $model_order_list->quantity = 0;

                    if($model_receipt_lists->save() and $model_order_list->save() and $modelP->save()){
                        $modelLST = new LogSt();
                        $modelLST->code = $modelOD->order_code;
                        $modelLST->product_code = $model_order_list->product_code;
                        $modelLST->unit_price = $model_order_list->unit_price; 
                        $modelLST->receipt_list_id = $model_order_list->receipt_list_id; 
                        $modelLST->quantity = $QTY;
                        $modelLST->note = 'ยกเลิก Order';
                        $modelLST->create_at = date("Y-m-d H:i:s");
                        $modelLST->save();
                    }  
                }                  
            }
        endforeach;
        $modelOD->sumtotal = 0;
        $modelOD->status = 4;
        $modelOD->save();
        Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
        return $this->redirect(['index']);
    }
    
}
