<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "drivers".
 *
 * @property integer $id
 * @property string $name
 * @property integer $company_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Companies $company
 * @property Trip[] $trips
 */
class Drivers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'drivers';
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
            [['name', 'company_id', 'created_at', 'updated_at'], 'required'],
            [['company_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
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
    public function getTrips()
    {
        return $this->hasMany(Trip::className(), ['driver2' => 'id']);
    }
}
