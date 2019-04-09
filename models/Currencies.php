<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currencies".
 *
 * @property int $id
 * @property int $code Цифр. код
 * @property string $letter_code Букв. код
 * @property double $unit Единиц
 * @property string $name Валюта
 * @property double $rate Курс
 */
class Currencies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currencies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'integer'],
            [['unit', 'rate'], 'number'],
            [['letter_code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Цифр. код',
            'letter_code' => 'Букв. код',
            'unit' => 'Единиц',
            'name' => 'Валюта',
            'rate' => 'Курс',
        ];
    }
}
