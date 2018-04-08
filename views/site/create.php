<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ShopWorkday */

$this->title = 'Create Shop Workday';
$this->params['breadcrumbs'][] = ['label' => 'Shop Workdays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-workday-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
