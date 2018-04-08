<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datetimepicker\DateTimePicker;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Jeka Morozov</h1>

        <p class="lead">Test task for Astwellsoft</p>        
    </div>

    <div class="body-content">

        <div class="row">
		<p>
			<?= Html::a('Create Shop Workday', ['create'], ['class' => 'btn btn-success']) ?>
		</p>
            <?
			 if (empty($searchModel->date_start)){
				 $searchModel->date_start = date("Y-m-d H:i:s");		 
			 }
			 echo GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'filterPosition' => \yii\grid\GridView::FILTER_POS_HEADER,
				'layout' => '{items}			  
							 {summary}
							 {pager}',					 
				'columns' => [                            			
					[
						'attribute' => 'shop_id',
						'label'=>'Shop name',
						'format' => 'raw',				
						'filter'=>false,
						'value' => function ($data) {                      
								return $data->shop->name;
						},
					],
					[
						'attribute' => 'date_start',
						'enableSorting' => false,
						'format' => 'raw',	
						'label'=>'Worktime details',				
						'filter' =>  DateTimePicker::widget([
										'model' => $searchModel,								
										'attribute' => 'date_start',
										'value'=>date('Y-m-d H:i:s'),								
										'clientOptions' => [
											'autoclose' => true,
											'format' => 'yyyy-mm-dd hh:ii:ss',
											'todayBtn' => true,									
										]
									]),
											
						'value' => function ($data) {                      
								return 'Start workday: '.$data->date_start.'<br>End workday: '.$data->date_end;
						},
					],
					['class' => 'yii\grid\ActionColumn'],
				],
			]); ?>
        </div>

    </div>
</div>
