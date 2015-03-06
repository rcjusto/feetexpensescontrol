<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "def_values".
 *
 * @property integer $id
 * @property string $fieldname
 * @property integer $destination_id
 * @property string $value
 * @property integer $company_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Companies $company
 * @property Destinations $destination
 */
class DefValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'def_values';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fieldname', 'company_id', 'created_at', 'updated_at'], 'required'],
            [['destination_id', 'company_id', 'created_at', 'updated_at'], 'integer'],
            [['fieldname'], 'string', 'max' => 128],
            [['value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fieldname' => 'Fieldname',
            'destination_id' => 'Destination ID',
            'value' => 'Value',
            'company_id' => 'Company ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestination()
    {
        return $this->hasOne(Destinations::className(), ['id' => 'destination_id']);
    }
}
