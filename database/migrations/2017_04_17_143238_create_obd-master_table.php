<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOBDMasterTable extends Migration {

	public function up()
	{
		Schema::create('obd-master', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();

			$table->string('EngineCoolantTemp');
			$table->string('FuelPressure');
			$table->string('EngineRpm');
			$table->integer('Speed');
			$table->string('TimingAdvance');
			$table->string('AmbientAirTemp');
			$table->string('AirFuelRatio');
			$table->string('ThrottlePos');
			$table->string('RelThottlePos');
			$table->string('EngineRuntime');
			$table->float('DistanceTravel');
			$table->string('DistanceTraveledMilOn');
			$table->float('DrivingDuration');
			$table->float('IdlingFuelConsumption');
			$table->float('DrivingFuelConsumption');
			$table->float('InsFuelConsumption');
			$table->string('FuelConsumptionRate');
			$table->string('VehicleIdentificationNumber');
		});
	}

	public function down()
	{
		Schema::drop('obd-master');
	}
}