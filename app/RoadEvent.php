<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RoadEvent extends Model {

	//connect to second database
	protected $connection = 'mysql2';

	//connect to table RoadEvent
	protected $table = 'RoadEvent';

}
