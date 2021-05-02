<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OBDMaster extends Model
{

    protected $table = 'obd-master';
    public $timestamps = true;


    protected $fillable = array(
        'EngineCoolantTemp', 'FuelPressure',  'EngineRpm', 'Speed', 'TimingAdvance',   'AmbientAirTemp',
        'AirFuelRatio', 'ThrottlePos', 'RelThottlePos', 'EngineRuntime', 'DistanceTravel', 'DistanceTraveledMilOn', 'DrivingDuration',
        'IdlingFuelConsumption', 'DrivingFuelConsumption', 'InsFuelConsumption' , 'FuelConsumptionRate', 'VehicleIdentificationNumber'
    );
}
