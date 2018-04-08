<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_workday".
 *
 * @property int $id
 * @property int $shop_id
 * @property string $date_start
 * @property string $date_end
 *
 * @property Shop $shop
 */
class ShopWorkday extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_workday';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id'], 'integer'],
			[['shop_id','date_start', 'date_end'], 'required'],
			[['date_start','date_end'], 'validDate'],
            [['date_start', 'date_end'], 'safe'],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['shop_id' => 'id']],
        ];
    }
	
	public function validDate($attribute, $params)
    {
		$dayStart = date("Y-m-d",strtotime($this->date_start));
		$dayEnd = date("Y-m-d",strtotime($this->date_end));
		if ($dayStart != $dayEnd){
			$this->addError($attribute, 'The beginning and end of the working day should be in one day');
		} elseif (empty($this->id)) {
		   $model = self::find()->where(
		     'date_start > "'.$dayStart.' 00:00:00" AND date_end < "'.$dayStart.' 23:59:59" AND shop_id = '.$this->shop_id
			 )->one();
			 if ($model != null){
				$this->addError($attribute, 'For this day already exists the schedule'); 
			 }
		}
        		
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_id' => 'Shop ID',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id'])->inverseOf('shopWorkdays');
    }
}
