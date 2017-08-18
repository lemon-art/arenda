<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "storage_consist".
 *
 * @property integer $storage_id
 * @property integer $equipment_id
 * @property integer $presence
 * @property integer $leased
 * @property integer $total
 */
class StorageConsist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'storage_consist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['storage_id', 'equipment_id', 'presence', 'leased', 'total'], 'required'],
            [['storage_id', 'equipment_id', 'presence', 'leased', 'total'], 'integer'],
            [['storage_id', 'equipment_id'], 'unique', 'targetAttribute' => ['storage_id', 'equipment_id'], 'message' => 'The combination of Storage ID and Equipment ID has already been taken.'],
        ];
    }
	
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
	 
			$this->total = $this->presence + $this->leased;
	 
			return true;
		}
		return false;
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'storage_id' => 'Storage ID',
            'equipment_id' => 'Equipment ID',
            'presence' => 'В наличии',
            'leased' => 'На руках',
            'total' => 'Всего',
        ];
    }
}
