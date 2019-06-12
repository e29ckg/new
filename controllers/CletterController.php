<?php

namespace app\controllers;

use Yii;
use app\models\CLetter;
use app\models\Log;
use KS\Line\LineNotify;
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
use yii\db\Query;

/**
 * CletterController implements the CRUD actions for CLetter model.
 */
class CletterController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','show','all'],
                'rules' => [
                    [
                        'actions' => ['index','create','show','all'],
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
     * Lists all CLetter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = CLetter::find()->orderBy([
            // 'created_at'=>SORT_ASC,
            'id' => SORT_DESC,
            ])->limit(10)->all();
        
            $countAll = CLetter::getCountAll();
        
        return $this->render('index',[
            'models' => $model,
            'countAll' => $countAll,
        ]);

    }

    public function actionAll()
    {
        $model = CLetter::find()->orderBy([
            // 'created_at'=>SORT_ASC,
            'id' => SORT_DESC,
            ])
            // ->limit(10)
            ->all();
        
            $countAll = CLetter::getCountAll();
        
        return $this->render('index',[
            'models' => $model,
            'countAll' => $countAll,
        ]);

    }

    /**
     * Displays a single CLetter model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('view',[
                    'model' => $this->findModel($id),                   
            ]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CLetter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CLetter();

        //Add This For Ajax Email Exist Validation 
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
          } 
     
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $f = UploadedFile::getInstance($model, 'file');
            if(!empty($f)){
                $dir = Url::to('@webroot/uploads/cletter/');
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }
                $fileName = md5($f->baseName . time()) . '.' . $f->extension;
                if($f->saveAs($dir . $fileName)){
                    $model->file = $fileName;
                }               
            } 
            $model->name = $_POST['CLetter']['name'];
            $model->created_at = date("Y-m-d H:i:s");
            $model->updated_at = date("Y-m-d H:i:s");
            if($model->save()){
                $message = $model->name.' ดูรายละเอียดที่เว็บภายใน. http://10.37.64.01/cletter.php?ref='.$fileName;
                $res = $this->notify_message($message);
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย'.$res->message);                
                return $this->redirect(['index']);
            }   
        }

        // $model->tel = explode(',', $model->tel);
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
     * Updates an existing CLetter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $filename = $model->file;

        //Add This For Ajax Email Exist Validation 
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
          } 

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $f = UploadedFile::getInstance($model, 'file');

            if(!empty($f)){
                
                $dir = Url::to('@webroot/uploads/cletter/');
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }                
                if($filename && is_file($dir.$filename)){
                    unlink($dir.$filename);// ลบ รูปเดิม;                    
                    
                }
                $fileName = md5($f->baseName . time()) . '.' . $f->extension;
                if($f->saveAs($dir . $fileName)){
                    $model->file = $fileName;
                }
                $model->save();   
                return $this->redirect(['index', 'id' => $filename]);                            
            }
            $model->file = $filename;
            if($model->save()){
                $message = Cletter::getProfileName(Yii::$app->user->identity->id) .' แก้ไข '.$model->name;
            $modelLog = new Log();
            $modelLog->user_id = Yii::$app->user->identity->id;
            $modelLog->manager = 'Cletter_Update';
            $modelLog->detail =  'แกไข '.$model->name;
            $modelLog->create_at = date("Y-m-d H:i:s");
            $modelLog->ip = Yii::$app->getRequest()->getUserIP();
            if($modelLog->save()){
                $res = $this->notify_message_admin($message);
            }
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
            };          
            return $this->redirect(['index', 'id' => $filename]);
        }

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('update',[
                    'model' => $model,                    
            ]);
        }
        
        return $this->render('update',[
               'model' => $model,                    
        ]); 
    }

    /**
     * Deletes an existing CLetter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $filename = $model->file;
        $dir = Url::to('@webroot/uploads/cletter/');
        
        if($filename && is_file($dir.$filename)){
            unlink($dir.$filename);// ลบ รูปเดิม;                    
        }
        
        if($model->delete()){
            $message = Cletter::getProfileName(Yii::$app->user->identity->id) .' ลบ '.$model->name;
            $modelLog = new Log();
            $modelLog->user_id = Yii::$app->user->identity->id;
            $modelLog->manager = 'Cletter_delete';
            $modelLog->detail =  'ลบ '.$model->name;
            $modelLog->create_at = date("Y-m-d H:i:s");
            $modelLog->ip = Yii::$app->getRequest()->getUserIP();
            if($modelLog->save()){
                $res = $this->notify_message_admin($message);            
            }
        }        

        return $this->redirect(['index']);
    }

    public function actionShow($file=null,$name=null) {

        // $model = $this->findModel($id);
        // if($name=null){
            $modelF = Cletter::find()->where(['file' => $file])->one();   
            $name = $modelF ? $modelF->name : $file;          
        // } else{
        //     $modelF = Cletter::find()->where(['file' => $file])->one();  
        // }
        
        // This will need to be the path relative to the root of your app.
        $filePath = '/web/uploads/cletter';
        // Might need to change '@app' for another alias
        $completePath = Yii::getAlias('@app'.$filePath.'/'.$file);
        if(is_file($completePath)){
            
            $message = Cletter::getProfileName(Yii::$app->user->identity->id) .' เปิดอ่าน '.$name;

            $modelLog = new Log();
            $modelLog->user_id = Yii::$app->user->identity->id;
            $modelLog->manager = 'Cletter_Read';
            $modelLog->detail =  'เปิดอ่าน '.$name;
            $modelLog->create_at = date("Y-m-d H:i:s");
            $modelLog->ip = Yii::$app->getRequest()->getUserIP();
            if($modelLog->save()){
                $res = $this->notify_message_admin($message);            
                return Yii::$app->response->sendFile($completePath, $file, ['inline'=>true]);
            }
            
        }else{
            Yii::$app->session->setFlash('error', 'ไม่พบ File... ');
            return $this->redirect(['site/main']);;
        }
    }

    /**
     * Finds the CLetter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CLetter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CLetter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLine_alert($id) {
        $model = $this->findModel($id);
        $message = $model->name .' ดูรายละเอียดเพิ่มเติมได้ที่ เว็บภายใน http://10.37.64.01/cletter.php?ref='.$model->file;
        $res = $this->notify_message($message);
        if($res->status == 200){
            Yii::$app->session->setFlash('success', 'Line Notify '.$res->message);
        }else{
            Yii::$app->session->setFlash('error', 'Line Notify '.$res->message);
        }
        
        return $this->redirect(['index', 'ses' => $res]);
        // $token = 'FVJfvOHD7nkd9mSTxN5573tVSpVuiK8JTEAIgSAOYZx';
        // $ln = new KS\Line\LineNotify($token);

        // $text = 'Hello Line Notify';
        // $ln->send($text);
    }


     //ส่งข้อความผ่าน line Notify
     public function notify_message_admin($message)
    {
        
        // $message = 'test send photo';    //text max 1,000 charecter
        
        $line_api = 'https://notify-api.line.me/api/notify';
        $line_token = 'ZdybtZEIVc4hBMBirpvTOFf8fBP4n3EIOFxgWhSFDwi'; //ส่วนตัว
        // $line_token = '4A51UznK0WDNjN1W7JIOMyvcsUl9mu7oTHJ1G1u8ToK';
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData,'','&');
        $headerOptions = array(
            'http'=>array(
                'method'=>'POST',
                'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                    ."Authorization: Bearer ".$line_token."\r\n"
                    ."Content-Length: ".strlen($queryData)."\r\n",
                'content' => $queryData
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents($line_api, FALSE, $context);
        $res = json_decode($result);
        
        return $res;
    
    }

    public function notify_message($message)
    {
        
        // $message = 'test send photo';    //text max 1,000 charecter
        
        $line_api = 'https://notify-api.line.me/api/notify';
        // $line_token = 'FVJfvOHD7nkd9mSTxN5573tVSpVuiK8JTEAIgSAOYZx'; //แบบแซบ
        $line_token = '4A51UznK0WDNjN1W7JIOMyvcsUl9mu7oTHJ1G1u8ToK';
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData,'','&');
        $headerOptions = array(
            'http'=>array(
                'method'=>'POST',
                'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                    ."Authorization: Bearer ".$line_token."\r\n"
                    ."Content-Length: ".strlen($queryData)."\r\n",
                'content' => $queryData
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents($line_api, FALSE, $context);
        $res = json_decode($result);
        
        return $res;
    
    }

    public function send_notify_message($line_api, $access_token, $message_data){
        $headers = array('Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer '.$access_token );
     
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $line_api);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        // Check Error
        if(curl_error($ch))
        {
           $return_array = array( 'status' => '000: send fail', 'message' => curl_error($ch) ); 
        }
        else
        {
           $return_array = json_decode($result, true);
        }
        curl_close($ch);
     return $return_array;
     }
}
