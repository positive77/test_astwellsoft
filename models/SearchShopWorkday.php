<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ShopWorkday;

/**
 * SearchShopWorkday represents the model behind the search form of `app\models\ShopWorkday`.
 */
class SearchShopWorkday extends ShopWorkday
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shop_id'], 'integer'],
            [['date_start', 'date_end', 'date_start_timestamp', 'date_end_timestamp'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ShopWorkday::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'shop_id' => $this->shop_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'date_start_timestamp' => $this->date_start_timestamp,
            'date_end_timestamp' => $this->date_end_timestamp,
        ]);

        return $dataProvider;
    }
	
	/**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchByDay($params)
    {
		//var_dump($params);die();       
		$dateStr = empty($params["SearchShopWorkday"]['date_start'])?date("Y-m-d H:i:s"):date("Y-m-d H:i:s",strtotime($params["SearchShopWorkday"]['date_start']));
		$query = ShopWorkday::find()
		->where(
		  "'".$dateStr."' >= date_start AND '".$dateStr."' < date_end"
		 )
		->groupBy(['shop_id']);
		

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);		

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
		
        return $dataProvider;
    }
	

}
