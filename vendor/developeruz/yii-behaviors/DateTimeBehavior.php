<?php
namespace developeruz\behaviors;

/**
 * DateTimeBehavior for Yii2
 *
 * @author Elle <elleuz@gmail.com>
 * @version 0.1
 * @package Behaviors for Yii2
 *
 */

use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord; 


class DateTimeBehavior extends AttributeBehavior
{
    public $dateTimeFields = Array();
    public $format = 'd-m-Y H:i:s';

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'convertDate',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'convertDateToDB',
        ];
    }

    public function convertDate()
    {
		foreach ( $this->dateTimeFields as $atr){
			$this->owner->{$atr} = date($this->format, strtotime($this->owner->{$atr}));
		}
    }

    public function convertDateToDB()
    {
		foreach ( $this->dateTimeFields as $atr){
			$this->owner->{$atr} = $this->owner->{$atr};
		}
        /*

        $this->owner->{$this->dateTimeFields} = date_create_from_format(
            $this->format,
            $this->owner->{$this->dateTimeFields}
        )->format('Y-m-d H:i:s');
		*/
    }
}