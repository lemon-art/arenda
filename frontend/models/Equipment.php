<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "equipment".
 *
 * @property integer $equipment_id
 * @property string $name
 * @property integer $type
 * @property integer $arenda
 * @property integer $price
 * @property integer $section
 */
class Equipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipment';
    }
	
	//формирует структуру разделов
	function get_tree($tree, $pid, $level = 0)
	{

		$arSections = Array();
		
		foreach ($tree as $row)
		{
			if ($row['type'] == $pid)
			{
				$row['level'] = $level;
				$arSections[] = $row;
				$arSections = array_merge($arSections, $this->get_tree($tree, $row['equipment_id'], $level+1));
			}
		}
	 
		return $arSections;
	}
	
	//формирует структуру разделов для выпадающего списка
	public function GetDropdownSections()
	{
		$arSections = Equipment::find()->asArray()->where(['section' => 1])->all(); 
		$arSections = $this -> get_tree( $arSections, 0 );
		$arDropList = Array();
		$arDropList[0] = "..";
		foreach ( $arSections as $val){
			$str = "";
			for ($i=0; $i<$val['level']; $i++){
				$str .= "..";
			}
			$arDropList[$val['equipment_id']] = $str.$val['name'];
		}
		return $arDropList;
	}
	

	
	

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'section'], 'required'],
            [['type', 'arenda', 'price', 'section'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'equipment_id' => 'Equipment ID',
            'name' => 'Название',
            'type' => 'Раздел',
            'arenda' => 'Стоимость аренды в сутки',
            'price' => 'Стоимость товара',
            'section' => '',
        ];
    }
}


