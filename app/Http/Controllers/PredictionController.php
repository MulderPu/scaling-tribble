<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RoadEvent;
use App\RoadCongestion;
use App\Location;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PredictionController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Road Prediction Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "RoadPrediction page" for the application.
	| Road Prediction results will be shown in a sortable table.
	| User is able to filter all the specific data they need.
	|
	*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(){

		$data = [];
		$data['roadevents'] = RoadEvent::all(); //allow access to all row information on table RoadEvent
		$data['locations'] = Location::all(); //allow access to all row in Location table
		$data['roadCongestions'] = RoadCongestion::all();
		$data['timeNow'] = Carbon::now('Asia/Singapore')->toTimeString(); //get time in string format
		$data['dateNow'] = Carbon::now('Asia/Singapore')->toDateString(); //get date in string format


		foreach($data['roadevents'] as $roadevent){
			$data['latestType'] = $roadevent->orderBy('date_detected', 'desc')->first()->type;
			$data['latestDay'] = $roadevent->orderBy('date_detected', 'desc')->first()->day_detected;
			$data['latestTime'] = $roadevent->orderBy('date_detected', 'desc')->first()->time_detected;
			$data['latestDate'] = $roadevent->orderBy('date_detected', 'desc')->first()->date_detected;
			$data['latestId'] = $roadevent->orderBy('date_detected', 'desc')->first()->location_id;
		}

		return view('predictions.prediction', $data);
	}


}
