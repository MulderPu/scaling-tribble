<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

	//connect to second database
	protected $connection = 'mysql2';

	//connect to table RoadEvent
	protected $table = 'RoadEvent';

}
