<?php

namespace app\models;
use developeruz\behaviors\DateTimeBehavior;
use app\models\Orders;
use Yii;

/**
 * This is the model class for table "persons".
 *
 * @property integer $person_id
 * @property string $firstname
 * @property string $name
 * @property string $lastname
 * @property string $phone
 * @property string $address
 * @property string $document number
 * @property string $issued_from
 * @property string $issued_date
 * @property string $add_phone
 * @property string $store_id
 * @property string $birthday
 * @property string $city_born
 * @property string $dop_text
 */
class Clients extends \yii\db\ActiveRecord
{

	public $fullName;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persons';
    }
	
	public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['person_id' => 'person_id']);
    }
	
	public function getFullName() {
		return $this->firstname . ' ' . $this->name . ' ' . $this->lastname;
	}
	
	public function afterFind() {
		 $this->fullName = $this->firstname . ' ' . $this->name . ' ' . $this->lastname;
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'name'], 'required'],
            [['address', 'issued_from', 'dop_text'], 'string'],
            [['issued_date', 'birthday'], 'safe'],
			[['black'], 'integer'],
            [['firstname', 'name', 'lastname'], 'string', 'max' => 128],
            [['phone', 'document_number', 'add_phone'], 'string', 'max' => 32],
            [['store_id'], 'string', 'max' => 11],
            [['city_born'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'firstname' => 'Фамилия',
            'name' => 'Имя',
            'lastname' => 'Отчество',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'issued_from' => 'Issued From',
            'issued_date' => 'Issued Date',
            'add_phone' => 'Доп. телефон',
            'store_id' => 'Store ID',
            'birthday' => 'Дата рождения',
            'city_born' => 'Город рождения',
            'dop_text' => 'Заметка',
			'fullName'=> 'Полное имя',
			'black'=> 'Черный список',
        ];
		     
    }
	
	public function GetClientList()
	{
		//формируем список клиентов
		$listdata=Clients::find()
			->select(['person_id', 'firstname', 'name', 'lastname'])
			->asArray()
			->all();

		$arClients = Array();
		foreach( $listdata as $arClient ){
			$arClients[] = Array(
			'label' => implode(' ', Array($arClient['firstname'], $arClient['name'], $arClient['lastname'])),
			'value'	=> implode(' ', Array($arClient['firstname'], $arClient['name'], $arClient['lastname'])),
			'id'	=> $arClient['person_id']
			);
		}
			
		return $arClients;
	}
	
	public function behaviors()
	{
		
	}
}
