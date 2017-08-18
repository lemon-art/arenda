<?php

namespace app\models;
use developeruz\behaviors\DateTimeBehavior;
use yii\db\ActiveRecord;
use app\models\Clients;
use app\models\Storage;
use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $order_id
 * @property string $data_update
 * @property string $data_start
 * @property string $data_finish
 * @property integer $person_id
 * @property integer $closed
 */
class Orders extends \yii\db\ActiveRecord
{
    public $client_name;
	public $storage;
	public $data_start_from;
	public $data_start_to;
	public $data_finish_from;
	public $data_finish_to;
	
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }
	
	public function getStorage()
    {
        return $this->hasOne(Storage::className(),['storage_id'=>'storage_id']);
    }
	
	public function getClients()
    {
        return $this->hasOne(Clients::className(),['person_id'=>'person_id']);
    }
	
	public function getStorageoperation()
    {
        return $this->hasMany(StorageOperation::className(),['order_id'=>'order_id']);
    }
	
	public function getPayment()
    {
        return $this->hasMany(Payment::className(),['order_id'=>'order_id']);
    }
	
	public function getClientStorage()
    {
        return $this->hasMany(ClientStorage::className(),['order_id'=>'order_id']);
    }
	
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
	 
			$this->data_start  = date("Y-m-d",strtotime($this->data_start));
			$this->data_finish = date("Y-m-d",strtotime($this->data_finish));
			$this->storage_id  = $_POST['Orders']['storage_id'];
   
			return true;
		}
		return false;
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_start', 'data_finish', 'person_id'], 'required'],
            [['data_update', 'data_start', 'data_finish', 'storage'], 'safe'],
            [['person_id', 'closed', 'summ', 'user_price'], 'integer'],
			[['user_price', 'closed'], 'default', 'value' => '0'],
        ];
    }
	
	public function GetProgressData( $start, $finish)
    {
	
		$diff  = strtotime($finish) - strtotime($start);
		$diff2 = strtotime($finish) - strtotime(date("d.m.y"));
		if ( $diff2 < 0 ){
			$proc = 100;
		}
		else {
			$proc = 50;
		}
		
		
		return $proc;
	}
	
	public function GetOrdersCount( $data, $storage_id = 0)
    {
		if ( !$storage_id ){
			$orders = Orders::find()->where(['data_start' => $data])->all();
		}
		else {
			$orders = Orders::find()->where(['data_start' => $data])->andwhere(['storage_id' => $storage_id])->all();
		}
		
		
		return count($orders);
	}
	
	

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [ 
            'order_id' => '№',
            'data_update' => 'Data Update',
            'data_start' => 'Начало аренды',
            'data_finish' => 'Конец аренды',
            'person_id' => 'Клиент',
			'clients' => 'Клиент',
			'storage_id' => 'Склад',
			'storage'	=> 'Склад',
			'summ'		=> 'Стоимость (руб.)',
            'closed' => 'Закрыт',
			'client_name' => 'Клиент',
			'user_price' => 'Установить стоимость заказа вручную'
        ];
    }
	
	
	public function loadModel($id)
	{
		$model=Orders::model()->findByPk($id);
		
        
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function behaviors()
	{
		return  [
			'dateTimeStampBehavior' => [
				'class' => DateTimeBehavior::className(),
				'dateTimeFields' => Array('data_start', 'data_finish'), //атрибут модели, который будем менять
				'format'         => 'd.m.Y',   //формат вывода даты для пользователя
			],

		];

		
	}
}
