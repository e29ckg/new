<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\User;
use app\models\Bila;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;


?>
<h1>ใบลาพักผ่อน</h1>
<div class="widget-body no-padding">
    <?php 
    $form = ActiveForm::begin([
		'id' => 'weblink-form',
		'options' => [
            'class' => 'smart-form',
            'novalidate'=>'novalidate',
            'enctype' => 'multipart/form-data'
        ],
        //'layout' => 'horizontal',
        'fieldConfig' => [
            //'template' => "{label}{input}{error}",
            'labelOptions' => ['class' => 'label'],
        ],
        'enableAjaxValidation' => true,
	]);  ?>
<?= $form->field($model, 'user_id')->hiddenInput(['readonly' => true, 'value' => Yii::$app->user->identity->id])->label(false) ?>
<?= $form->field($model, 'date_create')->hiddenInput(['readonly' => true, 'value' => date("Y-m-d")])->label(false) ?>


    <fieldset>
    
            <div class="row">
            <?php if(!empty($model_cat->p1)){
                        $p1 = $model_cat->p1;
                     }else{
                        $p1 = '';
                     } ?>
            <?= $form->field($model, 'p1', [
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('p1'),
                                'value' => $p1
                            ],
                            'template' => '<section class="col col-3"><label class="input">{label}</label> <label class="input">{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('p1').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
                        ]);
                    ?>

				
            </div>	
    
			<div class="row">
				<section class="col col-5">
					<label class="input">
                        <?= $form->field($model, 'date_begin')->widget(DatePicker::classname(), [
                                'options' => ['placeholder' => 'ลาตั้งแต่วันที่'],
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'yyyy-mm-dd'
                                ]]);
                        ?>
					</label>
				</section>
				<section class="col col-5">
					<label class="input">
                        <?= $form->field($model, 'date_end')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'ถึงวันที่'],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd'
                            ]]);
                        ?>
					</label>
				</section>
                    <?= $form->field($model, 'date_total', [
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('date_total')
                            ],
                            'template' => '<section class="col col-2"><label class="input">{label}</label> <label class="input">{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('date_total').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
                        ]);
                    ?>
				
            </div>
           
        </fieldset>
        <fieldset>                                  
			<div class="row">
            <?php if(!empty($model_cat->t3)){
                        $t3 = $model_cat->t3;
                     }else{
                        $t3 = '';
                     } ?>
            <?= $form->field($model, 't1', [
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('t1'),
                                'value'=> $t3,
                            ],
                            'template' => '<section class="col col-3"><label class="input">{label}</label> <label class="input">{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('t1').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
                        ]);
                    ?>
				<!-- <section class="col col-3">
					<label class="input">
						<input type="text" placeholder="เคยลามาแล้วรวม" data-cip-id="cIPJQ342845645">
					</label>
				</section> -->
            </div>
        </fieldset>
        <fieldset>   
        <div class="row">
            <?php 
                echo $form->field($model, 'address', [
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('address'),
                                'value' => User::getProfileAddressById(Yii::$app->user->identity->id)
                            ],
                            'template' => '<section class="col col-6"><label class="input">{label}</label> <label class="input">{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('address').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
                        ]);
                    echo $form->field($model, 'comment', [
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('comment'),
                            ],
                            'template' => '<section class="col col-6"><label class="input">{label}</label> <label class="input">{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('comment').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
                        ]);
            ?>
			<!-- <section>
				<label class="input">
					<input type="text" placeholder="ระหว่างลาติดต่อได้ที่.." data-cip-id="cIPJQ342845654">
				</label>
			</section> -->
            </div> 
        <div class="row">
            <section class="col col-6">
				<label class="input">
                    <?php 
                        echo $form->field($model, 'po')->widget(Select2::classname(), [
                                'data' => Bila::getSignList(),
                                'language' => 'th',
                                'options' => ['placeholder' => ' เลือก ผอ.'],
                                'pluginOptions' => [
                                'allowClear' => true
                                ],
                            ]);
                    ?>
                </label>
			</section>
            <section class="col col-6">
				<label class="input">
                    <?php 
                        echo $form->field($model, 'bigboss')->widget(Select2::classname(), [
                            'data' => Bila::getSignList(),
                            'language' => 'th',
                            'options' => ['placeholder' => ' เลือก หัวหน้าศาลฯ'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                    ?>
                </label>
			</section>
        </div>
		</fieldset>

 
<fieldset class="text-right"> 
    <?= Html::resetButton('Reset', ['class' => 'btn btn-warning btn-lg']) ?> <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-lg']) ?>
</fieldset>

    <?php ActiveForm::end(); ?>

</div>
