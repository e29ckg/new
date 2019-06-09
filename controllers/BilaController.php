<?php

namespace app\controllers;

use Yii;
use app\models\Bila;
use app\models\SignBossName;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;
use kartik\mpdf\Pdf;
use yii\helpers\ArrayHelper;

/**
 * Web_linkController implements the CRUD actions for Bila model.
 */
class BilaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['admin','index'],
                'rules' => [
                    [
                        'actions' => ['admin','index'],
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

    
    public function actionIndex()
    {
        $models = Bila::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->orderBy([
                'date_create'=>SORT_DESC,
                'id' => SORT_DESC,
            ])->limit(100)->all();        
        
        $countAll = Bila::getCountAll();
        $countA = Bila::getCountA();
        $countB = Bila::getCountB();

        return $this->render('index', [
            'models' => $models,
            'countAll' => $countAll,
            'countA' => $countA,
            'countB' => $countB,
        ]);
    }

    public function actionAdmin()
    {
        $models = Bila::find()->orderBy([
            'date_create'=>SORT_DESC,
            'id' => SORT_DESC,
            ])->limit(100)->all();        
        
        $countAll = Bila::getCountAll();

        return $this->render('index_admin', [
            'models' => $models,
            'countAll' => $countAll,
        ]);
    }
    

    /**
     * Displays a single Bila model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bila model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate_a()
    {
        
        $model = new Bila();

        //Add This For Ajax Email Exist Validation 
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
          } 
     
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->user_id =  $_POST['Bila']['user_id'];
            $model->cat = 'ลาป่วย';
            $model->date_begin = $_POST['Bila']['date_begin'];
            $model->date_end = $_POST['Bila']['date_end'];
            $model->date_total = $_POST['Bila']['date_total'];
            $model->due = $_POST['Bila']['due'];
            $model->dateO_begin = $_POST['Bila']['dateO_begin'];
            $model->dateO_end = $_POST['Bila']['dateO_end'];
            $model->dateO_total = $_POST['Bila']['dateO_total'];
            $model->address = $_POST['Bila']['address'];
            $model->t1 = $_POST['Bila']['t1'];
            $model->t2 = $_POST['Bila']['date_total'];
            $model->t3 = $_POST['Bila']['date_total'] + $_POST['Bila']['t1'];
            $model->date_create = $_POST['Bila']['date_create'];
            if($model->save()){
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['index']);
            }   
        }
        // $model->tel = explode(',', $model->tel);
        $model_cat = Bila::find()
            ->where(['user_id' => Yii::$app->user->id,
                'cat'=>'ลาป่วย'
                ])
            ->orderBy([
                'date_create'=>SORT_DESC,
                'id' => SORT_DESC,
            ])->one(); 
        
        $model_sign = SignBossName::find()
            ->where(['status' => 4])
            ->orderBy([
                'date_create'=>SORT_DESC,
                'id' => SORT_DESC,
                ])
            ->limit(100)
            ->all();
        
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form_a',[
                    'model' => $model,
                    'model_cat' => $model_cat,
                    'model_sign' => $model_sign,                    
            ]);
        }else{
            return $this->render('_form_a',[
                'model' => $model,  
                'model_cat' => $model_cat, 
                'model_sign' => $model_sign,                  
            ]); 
        }
    }

    public function actionCreateb()
    {
        $model = new Bila();

        //Add This For Ajax Email Exist Validation 
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
          } 
     
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->user_id =  $_POST['Bila']['user_id'];
            $model->cat = 'ลาพักผ่อน';
            $model->date_begin = $_POST['Bila']['date_begin'];
            $model->date_end = $_POST['Bila']['date_end'];
            $model->date_total = $_POST['Bila']['date_total'];
            if($_POST['Bila']['p1'] == ""){
                $model->p1 = 0;
                $model->p2 = 10;
            }else{
                $model->p1 = $_POST['Bila']['p1'];
                $model->p2 = $_POST['Bila']['p1'] + 10;
            }                       
            $model->address = $_POST['Bila']['address'];
            $model->t1 = $_POST['Bila']['t1'];
            $model->t2 = $_POST['Bila']['date_total'];
            $model->t3 = $_POST['Bila']['t1'] + $_POST['Bila']['date_total'] ;
            $model->date_create = $_POST['Bila']['date_create'];
            if($model->save()){
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['index']);
            }   
        }
        // $model->tel = explode(',', $model->tel);
        $model_cat = Bila::find()
            ->where(['user_id' => Yii::$app->user->id,
                'cat'=>'ลาพักผ่อน'
                ])
            ->orderBy([
                'date_create'=>SORT_DESC,
                'id' => SORT_DESC,
            ])->one(); 
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form_b',[
                    'model' => $model,   
                    'model_cat' => $model_cat,                    
            ]);
        }else{
            return $this->render('_form_b',[
                'model' => $model,               
                'model_cat' => $model_cat,        
            ]); 
        }
    }
/**
     * Updates an existing Bila model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //Add This For Ajax Email Exist Validation 
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->cat == 'ลาป่วย'){
                $model->date_begin = $_POST['Bila']['date_begin'];
                $model->date_end = $_POST['Bila']['date_end'];
                $model->date_total = $_POST['Bila']['date_total'];
                $model->due = $_POST['Bila']['due'];
                $model->dateO_begin = $_POST['Bila']['dateO_begin'];
                $model->dateO_end = $_POST['Bila']['dateO_end'];
                $model->dateO_total = $_POST['Bila']['dateO_total'];
                $model->address = $_POST['Bila']['address'];
                $model->t1 = $_POST['Bila']['t1'];
                $model->t2 = $_POST['Bila']['date_total'];
                $model->t3 = $model->t1 + $model->t2;
                $model->date_create = $_POST['Bila']['date_create'];
            }
            if($model->cat == 'ลาพักผ่อน'){
                $model->date_begin = $_POST['Bila']['date_begin'];
                $model->date_end = $_POST['Bila']['date_end'];
                $model->date_total = $_POST['Bila']['date_total'];
            if($_POST['Bila']['p1'] == ""){
                $model->p1 = 0;
                $model->p2 = 10;
            }else{
                $model->p1 = $_POST['Bila']['p1'];
                $model->p2 = $_POST['Bila']['p1'] + 10;
            }              
                      
            $model->address = $_POST['Bila']['address'];
            $model->t1 = $_POST['Bila']['t1'];
            $model->t2 = $_POST['Bila']['date_total'];
            $model->t3 = $_POST['Bila']['t1'] + $_POST['Bila']['date_total'] ;
            $model->date_create = $_POST['Bila']['date_create'];
            }            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['index']);
            }   
        }

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('update',[
                    'model' => $model,                    
            ]);
        }else{
            return $this->render('update',[
                'model' => $model,                    
            ]); 
        }

        
    }

    /**
     * Deletes an existing Bila model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionShow($id=null){
        $mdBila = Bila::find()->where(['id' => $id])->one();

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('show',[
                    'model' => $mdBila,                    
            ]);
        }
        
        return $this->render('show',[
               'model' => $mdBila,                    
        ]);
    }

    /**
     * Finds the Bila model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bila the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bila::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionPrint1($id=null)
    {
        $model = $this->findModel($id);
        if($model->cat =='ลาป่วย'){
            $Pdf_print = '_pdf_A';
        }else if($model->cat =='ลาพักผ่อน'){
            $Pdf_print = '_pdf_B';
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'content' => $this->renderPartial($Pdf_print,[
                'model'=>$model,
            ]),
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
}
