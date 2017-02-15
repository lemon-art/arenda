<?php

namespace app\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;

class Category extends \yii\db\ActiveRecord
{
	public $parent_id;
 
	public function behaviors()
	{
		return array(
			'nestedSetBehavior'=>array(
				'class'=>'application.components.NestedSetBehavior',
				'leftAttribute'=>'lft',
				'rightAttribute'=>'rgt',
				'levelAttribute'=>'level',
			),
		);
	}
 
	public static function tableName()
    {
        return 'categories';
    }
 


 
	public function relations()
	{		
		return array();
	}
 
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
			'name' => 'Name',
			'parent' => 'parent'
		);
	}
 
	public function search()
	{
		$criteria=new CDbCriteria;
 
		$criteria->compare('id',$this->id);
		// и т.д.
 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
 
	/**
	 * Создает корневую категорию либо возвращает уже имеющуюся
	 * @param Category $model
	 * @return mixed
	 */
	public static function getRoot(Category $model){
		$root = $model->roots()->find();
		if (! $root){
			$model->name = 'Категории';
			$model->alias = 'Root';
			$model->title = 'Категории';
			$model->meta_k = 'Категории';
			$model->meta_d = 'Категории';
			$model->txt = 'Категории';
			$model->saveNode();
			$root = $model->roots()->find();
		}
		return $root;
	}
}
