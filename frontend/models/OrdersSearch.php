<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;


/**
 * OrdersSearch represents the model behind the search form about `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
	public $clients; 
	public $storage;
	 
    public function rules()
    {
        return [
            [['order_id', 'person_id', 'closed'], 'integer'],
            [['data_update', 'data_start', 'data_start_from', 'data_start_to', 'data_finish_from', 'data_finish_to', 'data_finish', 'clients', 'storage'], 'safe'],
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
        $query = Orders::find();
		//$query->joinWith('clients');
		//$query = Orders::find()->with('clients')->all();
        // add conditions that should always apply here
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            //$query->joinWith('clients', 'storage'); 
            return $dataProvider;
        }
		//$query->joinWith('storage');
        // grid filtering conditions
        $query->andFilterWhere([
            'order_id' => $this->order_id,
            'data_update' => $this->data_update,
            'data_start' => $this->data_start,
            'data_finish' => $this->data_finish,
            'person_id' => $this->person_id,
			'storage_id' => $this->storage->name,
			'client_name' => $this->clients->name,
            'closed' => $this->closed,
        ]);
		
		$query->addOrderBy('order_id DESC');
		
		if ( $this ->data_start_from && $this ->data_start_to){
			$query->andFilterWhere(['between', 'data_start', date("Y-m-d",strtotime($this ->data_start_from)), date("Y-m-d",strtotime($this ->data_start_to))]);
		}
		elseif ( $this ->data_start_from ){
			$query->andFilterWhere(['>=', 'data_start', date("Y-m-d",strtotime($this ->data_start_from))]);
		}
		elseif ( $this ->data_start_to ){
			$query->andFilterWhere(['<=', 'data_start', date("Y-m-d",strtotime($this ->data_start_to))]);
		}
		
		if ( $this ->data_finish_from && $this ->data_finish_to){
			$query->andFilterWhere(['between', 'data_finish', date("Y-m-d",strtotime($this ->data_finish_from)), date("Y-m-d",strtotime($this ->data_finish_to))]);
		}
		elseif ( $this ->data_finish_from ){
			$query->andFilterWhere(['>=', 'data_finish', date("Y-m-d",strtotime($this ->data_finish_from))]);
		}
		elseif ( $this ->data_finish_to ){
			$query->andFilterWhere(['<=', 'data_finish', date("Y-m-d",strtotime($this ->data_finish_to))]);
		}
		

        return $dataProvider;
    }
}
