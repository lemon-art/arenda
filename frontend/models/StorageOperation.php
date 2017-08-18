<?php

namespace app\models;
use developeruz\behaviors\DateTimeBehavior;
use Yii;

/**
 * This is the model class for table "storage_operation".
 *
 * @property integer $storage_id
 * @property string $operation_id
 * @property string $operation_type
 * @property string $contractor_type
 * @property integer $contractor_id
 * @property integer $equipment_id
 * @property integer $count
 * @property integer $user_id
 * @property string $operation_date
 */
class StorageOperation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'storage_operation';
    }
	
	public function getOrders()
    {
        return $this->hasOne(Orders::className(),['order_id'=>'order_id']);
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
            [['storage_id', 'operation_type', 'equipment_id', 'count', 'user_id'], 'required'],
            [['storage_id', 'contractor_id', 'equipment_id', 'count', 'user_id'], 'integer'],
            [['operation_type', 'contractor_type'], 'string'],
            [['operation_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'storage_id' => 'Storage ID',
            'operation_id' => 'Operation ID',
            'operation_type' => 'Operation Type',
            'contractor_type' => 'Contractor Type',
            'contractor_id' => 'Contractor ID',
            'equipment_id' => 'Equipment ID',
            'count' => 'Count',
            'user_id' => 'User ID',
            'operation_date' => 'Operation Date',
        ];
    }
	
	public function behaviors()
	{
		return  [
			'dateTimeStampBehavior' => [
				'class' => DateTimeBehavior::className(),
				'dateTimeFields' => Array('operation_date'), //атрибут модели, который будем менять
				'format'         => 'd.m.Y',   //формат вывода даты для пользователя
			],

		];

		
	}
}
