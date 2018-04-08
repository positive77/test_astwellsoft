<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ShopWorkday */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Shop Workdays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-workday-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
				'attribute' => 'shop_id',
				'label'=>'Shop name',
				'format' => 'raw',				
				'filter'=>false,
				'value' => function ($data) {                      
						return $data->shop->name;
				},
			],
            'date_start',
            'date_end',
        ],
    ]) ?>

</div>
