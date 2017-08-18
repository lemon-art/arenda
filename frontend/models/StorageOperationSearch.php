<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StorageOperation;

/**
 * StorageOperationSearch represents the model behind the search form about `app\models\StorageOperation`.
 */
class StorageOperationSearch extends StorageOperation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['storage_id', 'operation_id', 'contractor_id', 'equipment_id', 'count', 'user_id'], 'integer'],
            [['operation_type', 'contractor_type', 'operation_date'], 'safe'],
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
        $query = StorageOperation::find();

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
            'storage_id' => $this->storage_id,
            'operation_id' => $this->operation_id,
            'contractor_id' => $this->contractor_id,
            'equipment_id' => $this->equipment_id,
            'count' => $this->count,
            'user_id' => $this->user_id,
            'operation_date' => $this->operation_date,
        ]);

        $query->andFilterWhere(['like', 'operation_type', $this->operation_type])
            ->andFilterWhere(['like', 'contractor_type', $this->contractor_type]);

        return $dataProvider;
    }
}
