<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop`.
 */
class m180407_103845_create_shop_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop', [
            'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
        ]);
		
		for ($i=1;$i<101;$i++){			
			 $this->insert('shop', [
				'name' => 'Shop #'.$i,				
			]);
		}
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop');
    }
}
