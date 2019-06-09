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
<h1>ใบลาป่วย</h1>
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
                            'options' => [
                                'placeholder' => 'ถึงวันที่',
                                // 'value' => '2019-02-01'
                            ],
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
				<!-- <section class="col col-2">
					<label class="input">                                                        
						<input type="text" placeholder="มีกำหนด(วัน)" data-cip-id="cIPJQ342845641">
					</label>
				</section> -->
            </div>
            <div>
				<!-- <section >
					<label class="input">
						<input type="text" placeholder="เนื่องจาก" data-cip-id="cIPJQ342845642">
					</label>
				</section>	 -->
                <?= $form->field($model, 'due', [
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('due')
                            ],
                            'template' => '<section ><label class="input">{label}</label> <label class="input">{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('due').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
                        ]);
                    ?>											
            </div>
        </fieldset>
        <fieldset>    
            <div class="row">
				<section class="col col-5">
					<label class="input">
                    <?php if(!empty($model_cat->date_begin)){
                        $date_begin = $model_cat->date_begin;
                     }else{
                        $date_begin = '';
                     } ?>
                        <?= $form->field($model, 'dateO_begin')->widget(DatePicker::classname(), [
                            'options' => [
                                'placeholder' => 'ลาครั้งสุดท้าย ตั้งแต่วันที่',
                                'value' => $date_begin,
                            ],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd'
                            ]]);
                        ?>
                    </label>
				</section>
			    <section class="col col-5">
					<label class="input">
                    <?php if(!empty($model_cat->date_end)){
                        $date_end = $model_cat->date_end;
                     }else{
                        $date_end = null;
                     } ?>
                        <?= $form->field($model, 'dateO_end')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'ถึงวันที่',
                            'value' => $date_end,
                        ],
                            
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd'
                            ]]);
                        ?>
                    </label>
				</section>
                <?php if(!empty($model_cat->date_total)){
                        $date_total = $model_cat->date_total;
                     }else{
                        $date_total = '';
                     } ?>
                <?= $form->field($model, 'dateO_total', [
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('dateO_total'),
                                'value' => $date_total,
                            ],
                            'template' => '<section class="col col-2"><label class="input">{label}</label> <label class="input">{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('dateO_total').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
                        ]);
                    ?>
                

			</div>
                                        
			
         
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
                            'template' => '<section class="col col-2"><label class="input">{label}</label> <label class="input">{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('t1').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
                        ]);
                    ?>

                
            <?php 
                echo $form->field($model, 'address', [
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('address'),
                                'value' => User::getProfileAddressById(Yii::$app->user->identity->id)
                            ],
                            'template' => '<section class="col col-5"><label class="input">{label}</label> <label class="input">{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('address').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
                        ]);
                    echo $form->field($model, 'comment', [
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('comment'),
                            ],
                            'template' => '<section class="col col-5"><label class="input">{label}</label> <label class="input">{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('comment').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
                        ]);
            ?>
			
            </div> 
            </fieldset>
        <fieldset> 
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