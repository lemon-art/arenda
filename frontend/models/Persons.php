<?php

namespace app\models;

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
class Persons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'name', 'lastname', 'phone', 'address', 'document_number', 'issued_from', 'issued_date', 'add_phone', 'store_id', 'birthday', 'city_born', 'dop_text'], 'required'],
            [['address', 'issued_from', 'dop_text'], 'string'],
            [['issued_date', 'birthday'], 'safe'],
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
            'firstname' => 'Firstname',
            'name' => 'Name',
            'lastname' => 'Lastname',
            'phone' => 'Phone',
            'address' => 'Address',
            'document number' => 'Document Number',
            'issued_from' => 'Issued From',
            'issued_date' => 'Issued Date',
            'add_phone' => 'Add Phone',
            'store_id' => 'Store ID',
            'birthday' => 'Birthday',
            'city_born' => 'City Born',
            'dop_text' => 'Dop Text',
        ];
    }
}
