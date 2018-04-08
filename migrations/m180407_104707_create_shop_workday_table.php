<?php

use yii\db\Migration;
use app\models\Shop;

/**
 * Handles the creation of table `shop_workday`.
 */
class m180407_104707_create_shop_workday_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_workday', [
            'id' => $this->primaryKey(),
			'shop_id'=>$this->integer(),
			'date_start' => $this->dateTime(),
			'date_end' => $this->dateTime(),
			'date_start_timestamp' => $this->timestamp(),
			'date_end_timestamp' => $this->timestamp(),
        ]);
		
		$this->addForeignKey(
            'fk-shop-id',
            'shop_workday',
            'shop_id',
            'shop',
            'id',
            'CASCADE'
        );
		
		$shops = Shop::find()->all();
		foreach ($shops as $shop){
			for ($i = 1;$i < 60;$i++){
				$date = strtotime(-31+$i.' days');			
                $this->insert('shop_workday', [				
					'shop_id' => $shop->id,
					'date_start' => date('Y:m:d 08:00:00',$date),
					'date_end' => date('Y:m:d 19:00:00',$date),
                    'date_start_timestamp' => date('Y:m:d 08:00:00',$date),
					'date_end_timestamp' => date('Y:m:d 19:00:00',$date),					
				]);				
			}
		}
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop_workday');
    }
}
