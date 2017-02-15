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
}
