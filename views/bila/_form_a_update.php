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
<?= $form->field($model, 'user_id')->hiddenInput(['readonly' => true])->label(false) ?>
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
            <div>
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
                        <?= $form->field($model, 'dateO_begin')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'ลาครั้งสุดท้าย ตั้งแต่วันที่'],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd'
                            ]]);
                        ?>
                    </label>
				</section>
			    <section class="col col-5">
					<label class="input">
                        <?= $form->field($model, 'dateO_end')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'ถึงวันที่'],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd'
                            ]]);
                        ?>
                    </label>
				</section>
                <?= $form->field($model, 'dateO_total', [
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('date_total')
                            ],
                            'template' => '<section class="col col-2"><label class="input">{label}</label> <label class="input">{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('date_total').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
                        ]);
                ?>
                
			</div>
                                        
			<div class="row">
            <?= $form->field($model, 't1', [
                    'inputOptions' => [
                        'placeholder' => $model->getAttributeLabel('t1')
                    ],
                    'template' => '<section class="col col-2"><label class="input">{label}</label> <label class="input">{input}<b class="tooltip tooltip-top-right">'.$model->getAttributeLabel('t1').'</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
                ]);
            ?>
            
            <?php 
                echo $form->field($model, 'address', [
                            'inputOptions' => [
                                'placeholder' => $model->getAttributeLabel('address'),
                                // 'value' => User::getProfileAddressById(Yii::$app->user->identity->id)
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
