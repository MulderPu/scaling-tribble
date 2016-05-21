<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Path extends Model {

	//connect to second database
	protected $connection = 'mysql2';

	//connect to table Path
	protected $table = 'Path';

}
