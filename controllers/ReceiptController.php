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
class ReceiptController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','Add_list','add'],
                'rules' => [
                    [
                        'actions' => ['index','Add_list','add'],
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
        $model = Receipt::find()->orderBy([
            //  'create_at'=>SORT_DESC, //SORT_ASC,
            'id' => SORT_DESC,
            ])->limit(200)->all();
        
            $countAll = Receipt::getCountAll();
        
        return $this->render('index',[
            'models' => $model,
            'countAll' => $countAll,
            //'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdd()
    {
        // $model = ReceiptList::find()->orderBy([
        //     'create_at'=>SORT_ASC,
        //     'id' => SORT_DESC,
        //     ])->limit(200)->all();
        
        //     $countAll = Receipt::getCountAll();
        
        return $this->render('add',[
            // 'models' => $model,
            // 'countAll' => $countAll,
            //'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdd_list()
    {
        $model = new ReceiptList();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->create_at = date("Y-m-d H:i:s");

        if (!isset($_SESSION['inLineR'])){
            $_SESSION['inLineR'] = 0;
            $_SESSION['strProductCodeR'][0] = $model->product_code; 
            $_SESSION['strProductUnitPriceR'][0] = $model->unit_price; 
            $_SESSION['strQtyR'][0] = $model->quantity;
            
        } else {
            
                $_SESSION['inLineR'] = $_SESSION['inLineR'] + 1;
                $inNewLine =  $_SESSION['inLineR'];
                $_SESSION['strProductCodeR'][$inNewLine ] = $model->product_code; 
                $_SESSION['strProductUnitPriceR'][$inNewLine] = $model->unit_price; 
                $_SESSION['strQtyR'][$inNewLine ] = $model->quantity;
            }
        
            return $this->redirect(['add', 'id' => $model->id]);
        }

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form_list',[
                    'model' => $model,                    
            ]);
        }else{
            return $this->render('_form_list',[
                'model' => $model,                    
            ]); 
        }
    }

    public function actionDelete_list($id = null) {
            $_SESSION['strProductCodeR'][$id] = ""; 
            $_SESSION['strProductUnitPriceR'][$id] = ""; 
            $_SESSION['strQtyR'][$id] = "";
        // return $this->render('add'); 
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('add');
        }else{
            return $this->render('add'); 
        }
    }

    public function actionAdd_conform() {

        // $code = date("YmdHis").Yii::$app->security->generateRandomString(4);
        $code = 'R'.date("YmdHis");
        $create_at = date("Y-m-d H:i:s");
        try {            

            $Total = 0 ;
            $sumTotal = 0;
							
			if(isset($_SESSION['inLineR'])){
				for($i=0;$i<=(int)$_SESSION['inLineR'];$i++){
					if($_SESSION['strProductCodeR'][$i] != ""){
                        $codeProduct = $_SESSION['strProductCodeR'][$i];
                        $UnitPrice = $_SESSION['strProductUnitPriceR'][$i];            			 
               					// $ss['strProductCodeR'][$i] =  $_SESSION['iRnLine'][$i];
						$Total = $_SESSION['strQtyR'][$i] * $UnitPrice;
                        $sumTotal = $sumTotal + $Total;
                        $strQtyR = $_SESSION['strQtyR'][$i];                        

                        Yii::$app->db->createCommand()->insert('receipt_list', [
                            'receipt_code' => $code,
                            'product_code' => $codeProduct,
                            'unit_price' => $UnitPrice,
                            'quantity' => $strQtyR,
                            'create_at' => $create_at,
                        ])->execute();

                        $modelRL = ReceiptList::find()->where(['receipt_code' => $code])
                                    ->orderBy(['id' => SORT_DESC])
                                    ->one();

                        Yii::$app->db->createCommand()->insert('log_st', [
                            'code' => $code,
                            'product_code' => $codeProduct,
                            'receipt_list_id' => $modelRL->id,
                            'unit_price' => $UnitPrice,
                            'quantity' => $strQtyR,
                            'note' => 'IN',
                            'create_at' => $create_at,
                        ])->execute();

                        $model = Product::find()->where(['code'=> $codeProduct])->one();
                        $model->instoke =  $model->instoke + $strQtyR;
                        $model->save();
                        
                    }
                }

                Yii::$app->db->createCommand()->insert('receipt', [
                    'receipt_code' => $code,
                    'user_id' => Yii::$app->user->identity->id,
                    'sumtotal' => $sumTotal,
                    'status' => 1,
                    'create_at' => $create_at,
                ])->execute();

            }            

            unset($_SESSION['inLineR']);	
            unset($_SESSION['strProductCodeR']);	            
            unset($_SESSION['strProductUnitPriceR']);	
            unset($_SESSION['strQtyR']);

            

		} catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }			
        return $this->redirect(['index']);
        // return $this->renderAjax('checkout');
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
        // $model_lists = LogSt::find()->where(['code'=> $model->receipt_code,'create_at'=>$model->create_at])->all();
        $model_lists = LogSt::find()->where(['code'=> $model->receipt_code])->all();
        
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
        $models = $this->findModel($id);
        $modelRLs = ReceiptList::find()->where(['receipt_code' => $models->receipt_code])
        ->orderBy(['id' => SORT_ASC])
        ->all();
        return $this->render('update', [
            'models' => $models,
            'modelRLs' => $modelRLs,
        ]);
    }

    public function actionUpdate_list_cancel($id)
    {
        $models = $this->findModel($id);
        $modelRLs = ReceiptList::find()->where(['receipt_code' => $models->receipt_code])->all();

        $create_at = date("Y-m-d H:i:s");

        $x = FALSE;
        $y = ':';
        foreach ($modelRLs as $modelRL):
            $modelOLs = OrderList::find()->where(['receipt_list_id' => $modelRL->id])->all();
            foreach ($modelOLs as $modelOL):
              if($modelOL->quantity <> 0){
                  $x = TRUE;
                  $y .= $modelOL->order_code.',';
              }  
            endforeach;        
        endforeach;

        if($x){
            Yii::$app->session->setFlash('error', 'ไม่สามารยกเลิกได้ เนื่องจากมีการเบิก'.$y);
        }else{
            foreach ($modelRLs as $modelRL):
                if($modelRL->quantity <> 0){

                $modelP = Product::find()->where(['code' => $modelRL->product])->one();
                $modelP->instoke = $modelP->instoke - $modelRL->quantity;

                $modelLST = new LogSt();
                $modelLST->code = $modelRL->receipt_code;
                $modelLST->product_code = $modelRL->product_code;
                $modelLST->unit_price = $modelRL->unit_price; 
                $modelLST->receipt_list_id = $modelRL->id; 
                $modelLST->quantity = '-'.$modelRL->quantity;
                $modelLST->note = 'OUT';
                $modelLST->create_at = $create_at;
                
                $modelRL->product_code = $modelRL->product_code;
                $modelRL->unit_price = 0;
                $modelRL->quantity = 0;
                $modelRL->create_at = $create_at;

                if($modelRL->save() and $modelLST->save() and $modelP->save()){

                }
            }
            endforeach;
            $models->status = 4;
            $models->sumtotal = 0;
            $models->create_at = $create_at;
            $models->save();
        }
        // Yii::$app->session->setFlash('error', $x);
        return $this->redirect(['index']);
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
        if (($model = Receipt::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelRL($id)
    {
        if (($model = ReceiptList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
}
