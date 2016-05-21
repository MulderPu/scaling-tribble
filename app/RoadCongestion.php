<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RoadCongestion extends Model {

	//connect to second database
	protected $connection = 'mysql2';

	//connect to table RoadCongestion
	protected $table = 'RoadCongestion';


}
