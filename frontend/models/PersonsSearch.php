<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Persons;

/**
 * PersonsSearch represents the model behind the search form about `app\models\Persons`.
 */
class PersonsSearch extends Persons
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id'], 'integer'],
            [['firstname', 'name', 'lastname', 'phone', 'address', 'document number', 'issued_from', 'issued_date', 'add_phone', 'store_id', 'birthday', 'city_born', 'dop_text'], 'safe'],
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
        $query = Persons::find();

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
            'person_id' => $this->person_id,
            'issued_date' => $this->issued_date,
            'birthday' => $this->birthday,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'document number', $this->document number])
            ->andFilterWhere(['like', 'issued_from', $this->issued_from])
            ->andFilterWhere(['like', 'add_phone', $this->add_phone])
            ->andFilterWhere(['like', 'store_id', $this->store_id])
            ->andFilterWhere(['like', 'city_born', $this->city_born])
            ->andFilterWhere(['like', 'dop_text', $this->dop_text]);

        return $dataProvider;
    }
}
