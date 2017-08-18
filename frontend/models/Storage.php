<?
namespace app\models;

use Yii;

/**
 * This is the model class for table "storage".
 *
 * @property integer $storage_id
 * @property string $name
 */
class Storage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'storage';
    }
	
	public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['person_id' => 'person_id']);
    }
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'storage_id' => 'Storage ID',
            'name' => 'Название',
			'Update' => 'Редактирование'
        ];
    }
	
	//формирует массив для меню
	public static function GetStorageList()
	{
		$arStorage = Storage::find()->asArray()->all(); 

		$arDropList = Array();
		foreach ( $arStorage as $val){
			$arDropList[] = Array(
				'label' => $val['name'], 
				'url' 	=> '/equipment/storage?id='.$val['storage_id'],
				'options' => Array('class' => 'nav-item'),
				'linkOptions' => Array('class' => 'nav-link')
			);	
		}
		
		//['label' => 'Товары', 'url' => ['/equipment/'], 'options' => ['class' => 'nav-item'], 'linkOptions' => ['class' => 'nav-link']]
		
		return $arDropList;
	}
	
	//формирует массив складов
	public static function GetStorages()
	{
		$arStorage = Storage::find()->asArray()->all(); 

		$arDropList = Array();
		foreach ( $arStorage as $val){
			$arDropList[$val['storage_id']] = $val['name'];	
		}
		
		return $arDropList;
	}
}
