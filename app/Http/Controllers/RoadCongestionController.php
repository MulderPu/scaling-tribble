<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RoadCongestion;
use App\Location;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class RoadCongestionController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Road Congestion Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "RoadCongestion page" for the application.
	| Road Congestion information will be shown in a sortable table.
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
		$data['roadCongestions'] = RoadCongestion::all(); //access all row info of the table RoadCongestion
		$data['locations'] = Location::all(); //allow access to all row in Location table

		//get the total number of congestion detected
		foreach($data['roadCongestions'] as $congestion){
			//total row
			$data['totalcongestion'] = $congestion->count();

			//total number each day
			$data['totalMon'] = $congestion->where('day_detected','Monday')->count();
			$data['totalTue'] = $congestion->where('day_detected','Tuesday')->count();
			$data['totalWed'] = $congestion->where('day_detected','Wednesday')->count();
			$data['totalThurs'] = $congestion->where('day_detected','Thursday')->count();
			$data['totalFri'] = $congestion->where('day_detected','Friday')->count();
			$data['totalSat'] = $congestion->where('day_detected','Saturday')->count();
			$data['totalSun'] = $congestion->where('day_detected','Sunday')->count();

			//detected numbers by month
			//2015
			$data['JanCount15'] = $congestion->whereRaw('MONTH(date_detected) = ?',[01])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['FebCount15'] = $congestion->whereRaw('MONTH(date_detected) = ?',[02])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['MarCount15'] = $congestion->whereRaw('MONTH(date_detected) = ?',[03])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['AprCount15'] = $congestion->whereRaw('MONTH(date_detected) = ?',[04])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['MayCount15'] = $congestion->whereRaw('MONTH(date_detected) = ?',[05])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['JuneCount15'] = $congestion->whereRaw('MONTH(date_detected) = ?',[06])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['JulyCount15'] = $congestion->whereRaw('MONTH(date_detected) = ?',[07])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['AugCount15'] = $congestion->whereRaw('MONTH(date_detected) = ?',[08])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['SeptCount15'] = $congestion->whereRaw('MONTH(date_detected) = ?',[09])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['OctCount15'] = $congestion->whereRaw('MONTH(date_detected) = ?',[10])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['NovCount15'] = $congestion->whereRaw('MONTH(date_detected) = ?',[11])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['DecCount15'] = $congestion->whereRaw('MONTH(date_detected) = ?',[12])->whereRaw('YEAR(date_detected) = ?',[2015])->count();

			//2016
			$data['JanCount16'] = $congestion->whereRaw('MONTH(date_detected) = ?',[01])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['FebCount16'] = $congestion->whereRaw('MONTH(date_detected) = ?',[02])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['MarCount16'] = $congestion->whereRaw('MONTH(date_detected) = ?',[03])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['AprCount16'] = $congestion->whereRaw('MONTH(date_detected) = ?',[04])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['MayCount16'] = $congestion->whereRaw('MONTH(date_detected) = ?',[05])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['JuneCount16'] = $congestion->whereRaw('MONTH(date_detected) = ?',[06])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['JulyCount16'] = $congestion->whereRaw('MONTH(date_detected) = ?',[07])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['AugCount16'] = $congestion->whereRaw('MONTH(date_detected) = ?',[08])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['SeptCount16'] = $congestion->whereRaw('MONTH(date_detected) = ?',[09])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['OctCount16'] = $congestion->whereRaw('MONTH(date_detected) = ?',[10])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['NovCount16'] = $congestion->whereRaw('MONTH(date_detected) = ?',[11])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['DecCount16'] = $congestion->whereRaw('MONTH(date_detected) = ?',[12])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
		}

		//init column chart
		$week = \Lava::DataTable();

		$week->addStringColumn('Day')
		         ->addNumberColumn('Total')
		         ->addRow(['Monday', $data['totalMon']])
		         ->addRow(['Tuesday', $data['totalTue']])
		         ->addRow(['Wednesday', $data['totalWed']])
				 ->addRow(['Thursday', $data['totalThurs']])
				 ->addRow(['Friday', $data['totalFri']])
				 ->addRow(['Saturday', $data['totalSat']])
		         ->addRow(['Sunday', $data['totalSun']]);

		\Lava::ColumnChart('Week', $week, [
		    'title' => 'Total Congestion Detected Each Day',
		    'titleTextStyle' => [
		        'color'    => '#eb6b2c',
		        'fontSize' => 14
		    ]
		]);

		//init for event 2015
		$year15 = \Lava::DataTable();
		$year15->addStringColumn('Month')
		      ->addNumberColumn('Total')
		      ->addRow(array('January', $data['JanCount15']))
			  ->addRow(array('February', $data['FebCount15']))
			  ->addRow(array('March', $data['MarCount15']))
			  ->addRow(array('April', $data['AprCount15']))
			  ->addRow(array('May', $data['MayCount15']))
			  ->addRow(array('June', $data['JuneCount15']))
			  ->addRow(array('July', $data['JulyCount15']))
			  ->addRow(array('August', $data['AugCount15']))
			  ->addRow(array('September', $data['SeptCount15']))
			  ->addRow(array('October', $data['OctCount15']))
			  ->addRow(array('November', $data['NovCount15']))
			  ->addRow(array('December', $data['DecCount15']));

		\Lava::BarChart('Bar15', $year15,['title' => 'Records in 2015']);

		//init for event 2016
		$year16 = \Lava::DataTable();
		$year16->addStringColumn('Month')
		      ->addNumberColumn('Total')
		      ->addRow(array('January', $data['JanCount16']))
			  ->addRow(array('February', $data['FebCount16']))
			  ->addRow(array('March', $data['MarCount16']))
			  ->addRow(array('April', $data['AprCount16']))
			  ->addRow(array('May', $data['MayCount16']))
			  ->addRow(array('June', $data['JuneCount16']))
			  ->addRow(array('July', $data['JulyCount16']))
			  ->addRow(array('August', $data['AugCount16']))
			  ->addRow(array('September', $data['SeptCount16']))
			  ->addRow(array('October', $data['OctCount16']))
			  ->addRow(array('November', $data['NovCount16']))
			  ->addRow(array('December', $data['DecCount16']));

		\Lava::BarChart('Bar16', $year16,['title' => 'Records in 2016']);

		//send to view
		return view('roadCongestions.roadCongestions_index', $data);
	}

}
