<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

	//connect to second database
	protected $connection = 'mysql2';

	//connect to table Location
	protected $table = 'Location';

}
