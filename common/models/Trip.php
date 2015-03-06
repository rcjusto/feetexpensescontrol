<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "trip".
 *
 * @property integer $id
 * @property string $number
 * @property integer $driver1
 * @property integer $driver2
 * @property string $departure
 * @property string $arrival
 * @property string $tractor
 * @property string $trailer
 * @property integer $destination_id
 * @property string $tractor_odometer_start
 * @property string $tractor_odometer_end
 * @property string $penske_mile_cost
 * @property string $penske_lease_cost
 * @property string $diesel_prior_departure
 * @property string $diesel_prior_cost
 * @property string $diesel_en_route
 * @property string $def_prior_departure
 * @property string $def_prior_cost
 * @property string $reefer_prior_departure
 * @property string $reefer_en_route
 * @property string $reefer_hours_start
 * @property string $reefer_hours_end
 * @property string $other_expenses_total
 * @property string $revenue_outbound
 * @property string $revenue_backhaul
 * @property integer $company_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Companies $company
 * @property Drivers $driver10
 * @property Drivers $driver20
 * @property Tractors $tractor0
 * @property Trailers $trailer0
 * @property Destinations $destination
 * @property TripOtherExpenses[] $tripOtherExpenses
 * @property OtherExpenses[] $otherExpenses
 */
class Trip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trip';
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
            [['number', 'driver1', 'departure', 'arrival', 'tractor', 'destination_id', 'company_id', 'created_at', 'updated_at'], 'required'],
            [['driver1', 'driver2', 'destination_id', 'company_id', 'created_at', 'updated_at'], 'integer'],
            [['departure', 'arrival'], 'safe'],
            [['tractor_odometer_start', 'tractor_odometer_end', 'penske_mile_cost', 'penske_lease_cost', 'diesel_prior_departure', 'diesel_prior_cost', 'diesel_en_route', 'def_prior_departure', 'def_prior_cost', 'reefer_prior_departure', 'reefer_en_route', 'reefer_hours_start', 'reefer_hours_end', 'other_expenses_total', 'revenue_outbound', 'revenue_backhaul'], 'number'],
            [['number'], 'string', 'max' => 512],
            [['tractor', 'trailer'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'driver1' => 'Driver1',
            'driver2' => 'Driver2',
            'departure' => 'Departure',
            'arrival' => 'Arrival',
            'tractor' => 'Tractor',
            'trailer' => 'Trailer',
            'destination_id' => 'Destination ID',
            'tractor_odometer_start' => 'Tractor Odometer Start',
            'tractor_odometer_end' => 'Tractor Odometer End',
            'penske_mile_cost' => 'Penske Mile Cost',
            'penske_lease_cost' => 'Penske Lease Cost',
            'diesel_prior_departure' => 'Diesel Prior Departure',
            'diesel_prior_cost' => 'Diesel Prior Cost',
            'diesel_en_route' => 'Diesel En Route',
            'def_prior_departure' => 'Def Prior Departure',
            'def_prior_cost' => 'Def Prior Cost',
            'reefer_prior_departure' => 'Reefer Prior Departure',
            'reefer_en_route' => 'Reefer En Route',
            'reefer_hours_start' => 'Reefer Hours Start',
            'reefer_hours_end' => 'Reefer Hours End',
            'other_expenses_total' => 'Other Expenses Total',
            'revenue_outbound' => 'Revenue Outbound',
            'revenue_backhaul' => 'Revenue Backhaul',
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
    public function getDriver10()
    {
        return $this->hasOne(Drivers::className(), ['id' => 'driver1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver20()
    {
        return $this->hasOne(Drivers::className(), ['id' => 'driver2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTractor0()
    {
        return $this->hasOne(Tractors::className(), ['id' => 'tractor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrailer0()
    {
        return $this->hasOne(Trailers::className(), ['id' => 'trailer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestination()
    {
        return $this->hasOne(Destinations::className(), ['id' => 'destination_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTripOtherExpenses()
    {
        return $this->hasMany(TripOtherExpenses::className(), ['trip_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtherExpenses()
    {
        return $this->hasMany(OtherExpenses::className(), ['id' => 'other_expenses_id'])->viaTable('trip_other_expenses', ['trip_id' => 'id']);
    }
}
