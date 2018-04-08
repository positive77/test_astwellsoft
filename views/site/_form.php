<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Shop;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ShopWorkday */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-workday-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
       $items = ArrayHelper::map(Shop::find()->all(), 'id', 'name');	
	   echo $form->field($model, 'shop_id')->dropDownList(
            $items,['prompt'=>'-select shop-']); ?>
    
	<?= $form->field($model, 'date_start')->widget(DateTimePicker::className(), [
    'model' => $model,								
	'attribute' => 'date_start',    
    'clientOptions' => [
		'autoclose' => true,
		'format' => 'yyyy-mm-dd hh:ii:ss',
		'todayBtn' => true,									
		]
	]);?>

    <?= $form->field($model, 'date_end')->widget(DateTimePicker::className(), [
    'model' => $model,								
	'attribute' => 'date_end',    
    'clientOptions' => [
		'autoclose' => true,
		'format' => 'yyyy-mm-dd hh:ii:ss',
		'todayBtn' => true,									
		]
	]);?> 

	

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
