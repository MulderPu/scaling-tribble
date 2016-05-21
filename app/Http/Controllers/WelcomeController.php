<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Address;
use App\Path;
use App\RoadCongestion;
use App\RoadEvent;
use App\Location;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "home page" for the application.
	| Map will be show in this page to show the user traffic info happening now
	| Latest traffic events will be show in the tables
	| Total number of events happening today will also be shown.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$roadevents = RoadEvent::all(); //allow access of all row in RoadEvent table

		$data = [];
		$data['address'] = Address::all(); //allow access of all information in RoadEvent table
		$data['paths'] = Path::all(); //allow access of all information in Path table
		$data['congestionDates'] = RoadCongestion::all(); //allow access of all information in RoadCongestion table
		$data['locations'] = Location::all(); //allow access to all row in Location table
		$data['timeNow'] = Carbon::now('Asia/Singapore')->toTimeString(); //get time in string format
		$data['dateNow'] = Carbon::now('Asia/Singapore')->toDateString(); //get date in string format
		$data['latestCongestions'] = RoadCongestion::orderBy('date_detected', 'desc')->take(5)->get();
		$data['latestEvents'] = RoadEvent::orderBy('date_detected', 'desc')->take(5)->get();

		foreach($roadevents as $roadevent){
			//get total number of today event reported
			$data['todayEvent'] = $roadevent->where('date_detected',$data['dateNow'])->count();
		}

		foreach($data['congestionDates'] as $congestion){
			//get total number of today congestion detected
			$data['todayCongestion'] = $congestion->where('date_detected',$data['dateNow'])->count();
		}


		//send to view
		return view('welcome', $data);

	}

}
