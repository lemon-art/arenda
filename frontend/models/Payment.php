<?php

namespace app\models;
use developeruz\behaviors\DateTimeBehavior;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property integer $id
 * @property string $data
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $summ
 * @property string $type
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }
	
	public function getOrders()
    {
        return $this->hasOne(Orders::className(),['order_id'=>'order_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data', 'order_id', 'user_id', 'summ', 'type'], 'required'],
            [['data'], 'safe'],
            [['order_id', 'user_id', 'summ'], 'integer'],
            [['type'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Дата оплаты',
			'data_formated' => 'Дата оплаты',
            'order_id' => 'Номер заказа',
            'user_id' => 'Менеджер',
            'summ' => 'Сумма',
            'type' => 'Тип',
        ];
    }
	
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
	 
			$this->data  = date("Y-m-d",strtotime($this->data));

   
			return true;
		}
		return false;
	}
	
	public function behaviors()
	{
		return  [
			'dateTimeStampBehavior' => [
				'class' => DateTimeBehavior::className(),
				'dateTimeFields' => ['data'], //атрибут модели, который будем менять
				'format'         => 'd.m.Y',   //формат вывода даты для пользователя
			]
		];
	}
}
