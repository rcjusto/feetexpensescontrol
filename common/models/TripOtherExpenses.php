<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "trip_other_expenses".
 *
 * @property integer $trip_id
 * @property integer $other_expenses_id
 * @property string $value
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Trip $trip
 * @property OtherExpenses $otherExpenses
 */
class TripOtherExpenses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trip_other_expenses';
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
            [['trip_id', 'other_expenses_id', 'created_at', 'updated_at'], 'required'],
            [['trip_id', 'other_expenses_id', 'created_at', 'updated_at'], 'integer'],
            [['value'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'trip_id' => 'Trip ID',
            'other_expenses_id' => 'Other Expenses ID',
            'value' => 'Value',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrip()
    {
        return $this->hasOne(Trip::className(), ['id' => 'trip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtherExpenses()
    {
        return $this->hasOne(OtherExpenses::className(), ['id' => 'other_expenses_id']);
    }
}
