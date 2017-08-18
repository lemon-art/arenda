<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "client_storage".
 *
 * @property integer $client_id
 * @property string $client_type
 * @property integer $storage_id
 * @property integer $equipment_id
 * @property integer $count
 * @property string $date
 * @property integer $order_id
 */
class ClientStorage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_storage';
    }
	
	public function getOrders()
    {
        return $this->hasOne(Clients::className(),['order_id'=>'order_id']);
    }
	
	public function getEquipment()
    {
        return $this->hasOne(Equipment::className(),['equipment_id'=>'equipment_id']);
    }
	

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'client_type', 'storage_id', 'equipment_id', 'count', 'order_id'], 'required'],
            [['client_id', 'storage_id', 'equipment_id', 'count', 'order_id', 'returned'], 'integer'],
            [['client_type'], 'string'],
            [['date'], 'safe'],
        ];
    }
	
	public function findModel($order_id, $equipment_id, $storage_id)
	{
		$model = ClientStorage::findOne(['order_id' => $order_id, 'equipment_id' => $equipment_id, 'storage_id' => $storage_id]);
		
        
		if($model===null)
			return false;
		else
			return $model;
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client_id' => 'Client ID',
            'client_type' => 'Client Type',
            'storage_id' => 'Storage ID',
            'equipment_id' => 'Equipment ID',
            'count' => 'Count',
            'date' => 'Date',
            'order_id' => 'Order ID',
        ];
    }
}
