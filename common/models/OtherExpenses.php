<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "other_expenses".
 *
 * @property integer $id
 * @property string $name
 * @property integer $position
 * @property integer $company_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Companies $company
 * @property TripOtherExpenses[] $tripOtherExpenses
 * @property Trip[] $trips
 */
class OtherExpenses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'other_expenses';
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
            [['position', 'company_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255]
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
            'position' => 'Position',
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
    public function getTripOtherExpenses()
    {
        return $this->hasMany(TripOtherExpenses::className(), ['other_expenses_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(Trip::className(), ['id' => 'trip_id'])->viaTable('trip_other_expenses', ['other_expenses_id' => 'id']);
    }
}
