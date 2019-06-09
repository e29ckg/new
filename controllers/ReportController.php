<?php

namespace app\controllers;

use Yii;
use app\models\Receipt;
use app\models\ReceiptList;
use app\models\OrderList;
use app\models\Product;
use app\models\LogSt;
use app\models\ReportM;
use app\models\ReportML;
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
class ReportController extends Controller
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

    public function actionView()
    {

        $start = "2018-12-01";
        $end = "2018-12-30";        
        $month = "2018-12";
        $monthB = "2018-11";
        $create_at = date("Y-m-d H:i:s");

        $rRMLs = ReportML::find()->where(['month' => $month])->all();
        foreach ($rRMLs as $rRML):
            $rRML->delete();
        endforeach;

        $mPs = Product::find()->where(['status' => 1])
            ->orderBy(['category' => SORT_ASC])
            ->all();

        // $modelLSts = LogSt::find()->where(['between','create_at',"2018-10-01" ,$end])->all();
        foreach ($mPs as $mP):
            if($mP->create_at <= $end){
            // $product_code = "P20181217225643";
            $product_code = $mP->code;

            $mRLs = ReceiptList::find()
                // ->where(['between','create_at',$start,$end])
                ->where(['<=','create_at',$end])
                ->andWhere(['product_code'=> $product_code])
                // ->orderBy(['unit_price' => SORT_ASC])
                ->all();

            foreach ($mRLs as $mRL):    

                $mRML = ReportML::find()
                    ->where(['month' => $month,'product_code'=>$mP->code,'unit_price'=> $mRL->unit_price])
                    ->one();
                    if($mRML){
                        $mML->create_at = $create_at;
                        $mML->unit_price = $mRL->unit_price;
                        $mML->save();
                    }else{
                        $mML = new ReportML();
                            $mML->month = $month;
                            // $mML->product_name ->getProductName();
                            $mML->product_code = $mP->code;
                            $mML->product_unit = $mP->getUnitName();
                            // $mML->kb = $Log_KB_Qty_sum;
                            // $mML->r = $Log_R_Qty_sum;
                            // $mML->o = $Order_Qty_sum;
                            // $mML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                            $mML->unit_price = $mRL->unit_price;
                            // $mML->total_price ->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                            $mML->create_at = $create_at;
                            $mML->save();  
                    }

                $mOLs = OrderList::find()
                        ->where(['between','create_at',$start,$end])
                        ->andWhere(['product_code'=> $product_code])
                        ->all();

                $Order_Qty = 0 ;
                $Order_Qty_sum = 0;

                foreach ($mOLs as $mOL):
                    // $Order_Qty = $mOL->quantity;	      
                    // $Order_Qty_sum = $Order_Qty_sum + $Order_Qty;	
                    
                    $mRML = ReportML::find()->where(['month' => $month,'product_code'=>$mP->code,'unit_price' => $mRL->unit_price])->one();
                    if($mRML){
                        $mML->o = $mOL->quantity;
                        $mML->create_at = $create_at;
                        $mML->save();
                    }else{
                        $mML = new ReportML();
                                    $mML->month = $month;
                                    // $mML->product_name ->getProductName();
                                    $mML->product_code = $mP->code;
                                    $mML->product_unit = $mP->getUnitName();
                                    // $mML->kb = $Log_KB_Qty_sum;
                                    // $mML->r = $Log_R_Qty_sum;
                                    $mML->o = $mOL->quantity;
                                    // $mML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                                    $mML->unit_price ->unit_price;
                                    // $mML->total_price ->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                                    $mML->create_at = $create_at;
                                    $mML->save();  
                    }
                endforeach;  
                

                $modelLSt_KB_RML = ReportML::find()
                    ->where(['month' => $monthB,'product_code'=> $product_code,'unit_price'=>$mRL->unit_price])
                    // ->andWhere(['product_code'=> $product_code])
                    ->one();
                    if($modelLSt_KB_RML['month'] == $monthB){
                        $mML->kb = $modelLSt_KB_RML->kb;
                        $mML->save();
                    }else{            

                $modelLSt_KBs = LogSt::find()
                    ->where(['<','create_at',$start])
                    ->andWhere(['product_code'=> $product_code,'unit_price' => $mRL->unit_price])
                    ->all();
                        $Log_KB_Qty = 0 ;
                        $Log_KB_Qty_sum = 0;
                    foreach ($modelLSt_KBs as $modelLSt_KB):
                        $Log_KB_Qty = $modelLSt_KB->quantity;	      
                        $Log_KB_Qty_sum = $Log_KB_Qty_sum + $Log_KB_Qty;

                        $mRML = ReportML::find()
                        ->where(['month' => $month,'product_code'=>$mP->code,'unit_price' => $mRL->unit_price])
                        ->one();
                        
                    if($mRML){
                        $mML->kb = $Log_KB_Qty_sum;
                        $mML->save();
                    }else{
                        $mML = new ReportML();
                                $mML->month = $month;
                                // $mML->product_name ->getProductName();
                                $mML->product_code = $mP->code;
                                $mML->product_unit = $mP->getUnitName();
                                $mML->kb = $Log_KB_Qty_sum;
                                // $mML->r = $Log_R_Qty_sum;
                                // $mML->o = $Order_Qty_sum;
                                // $mML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                                // $mML->k = $Log_All_Qty_sum;
                                // $mML->unit_price ->unit_price;
                                // $mML->total_price ->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                                $mML->create_at = $create_at;
                                $mML->save();  
                    } 
                    endforeach;
                } 

                $modelLSts = LogSt::find()
                    ->where(['between','create_at',$start,$end])
                    ->andWhere(['product_code'=> $product_code,'unit_price'=>$mRL->unit_price])
                    ->all();
                        $Log_R_Qty = 0 ;
                        $Log_R_Qty_sum = 0;
                    foreach ($modelLSts as $modelLSt):
                        $Log_R_Qty = $modelLSt->quantity;	      
                        $Log_R_Qty_sum = $Log_R_Qty_sum + $Log_R_Qty;	
                        
                        if($modelLSt->quantity > 0){
                        
                        $mRML = ReportML::find()
                            ->where(['month' => $month,'product_code'=>$mP->code,'unit_price'=>$mRL->unit_price])
                            ->one();
                            
                        if($mRML){
                            $mML->r = $mML->k + $Log_R_Qty_sum;
                            $mML->save();
                        }else{
                            $mML = new ReportML();
                                    $mML->month = $month;
                                    // $mML->product_name ->getProductName();
                                    $mML->product_code = $mP->code;
                                    $mML->product_unit = $mP->getUnitName();
                                    // $mML->kb = $Log_KB_Qty_sum;
                                    $mML->r = $Log_R_Qty_sum;
                                    // $mML->o = $Order_Qty_sum;
                                    // $mML->k = $Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum;
                                    // $mML->k = $Log_All_Qty_sum;
                                    // $mML->unit_price ->unit_price;
                                    // $mML->total_price ->unit_price * ($Log_KB_Qty_sum + $Log_R_Qty_sum - $Log_O_Qty_sum);
                                    $mML->create_at = $create_at;
                                    $mML->save(); 
                        }
                    }   

                    endforeach;

            endforeach;

        }

        endforeach;

            $rRMLs = ReportML::find()->where(['month' => $month])->all();
            foreach ($rRMLs as $rRML):
                $rRML->k = $rRML->kb + $rRML->r -$rRML->o;
                $rRML->save();
            endforeach;

        return $this->render('view',[
            'month' => $month,
            'start' => $start,
            'end' => $end,
            'rRMLs' => $rRMLs, 
        ]);
    }

    public function actionReport_add()
    {
        $model = new ReportM();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->create_at = date("Y-m-d H:i:s");
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('form_report',[
                    'model' => $model,                    
            ]);
        }else{
            return $this->render('form_report',[
                'model' => $model,                    
            ]); 
        }
    }
 
}
