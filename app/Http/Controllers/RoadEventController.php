<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RoadEvent;
use App\Location;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class RoadEventController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Road Events Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "RoadEvent page" for the application.
	| Road Event information will be shown in a sortable table.
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
		$data['roadEvents'] = RoadEvent::all(); //allow access to all row information on table RoadEvent
		$data['locations'] = Location::all(); //allow access to all row in Location table

		//get the number of total road event & total of each types of event reported
		foreach($data['roadEvents'] as $roadevent){
			//report numbers by type
			$data['carcrash'] = $roadevent->where('type', 'carcrash')->count();
			$data['flood'] = $roadevent->where('type', 'flood')->count();
			$data['menwork'] = $roadevent->where('type', 'menwork')->count();
			$data['police'] = $roadevent->where('type', 'police')->count();
			$data['roadblock'] = $roadevent->where('type', 'roadblock')->count();
			$data['totalroadevent'] = $roadevent->count();

			//report numbers by day
			$data['totalMon'] = $roadevent->where('day_detected','Monday')->count();
			$data['totalTue'] = $roadevent->where('day_detected','Tuesday')->count();
			$data['totalWed'] = $roadevent->where('day_detected','Wednesday')->count();
			$data['totalThurs'] = $roadevent->where('day_detected','Thursday')->count();
			$data['totalFri'] = $roadevent->where('day_detected','Friday')->count();
			$data['totalSat'] = $roadevent->where('day_detected','Saturday')->count();
			$data['totalSun'] = $roadevent->where('day_detected','Sunday')->count();

			//report numbers by month
			//2015
			$data['JanCount15'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[01])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['FebCount15'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[02])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['MarCount15'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[03])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['AprCount15'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[04])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['MayCount15'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[05])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['JuneCount15'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[06])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['JulyCount15'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[07])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['AugCount15'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[08])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['SeptCount15'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[09])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['OctCount15'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[10])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['NovCount15'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[11])->whereRaw('YEAR(date_detected) = ?',[2015])->count();
			$data['DecCount15'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[12])->whereRaw('YEAR(date_detected) = ?',[2015])->count();

			//2016
			$data['JanCount16'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[01])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['FebCount16'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[02])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['MarCount16'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[03])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['AprCount16'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[04])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['MayCount16'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[05])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['JuneCount16'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[06])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['JulyCount16'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[07])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['AugCount16'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[08])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['SeptCount16'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[09])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['OctCount16'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[10])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['NovCount16'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[11])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
			$data['DecCount16'] = $roadevent->whereRaw('MONTH(date_detected) = ?',[12])->whereRaw('YEAR(date_detected) = ?',[2016])->count();
		}

		//calculation that convert number of each type of road event to percentage
		$data['carcrashpercent'] =  ($data['carcrash'] / $data['totalroadevent']) * 100;
		$data['floodpercent'] =  ($data['flood'] / $data['totalroadevent']) * 100;
		$data['menworkpercent'] =  ($data['menwork'] / $data['totalroadevent']) * 100;
		$data['policepercent'] =  ($data['police'] / $data['totalroadevent']) * 100;
		$data['roadblockpercent'] =  ($data['roadblock'] / $data['totalroadevent']) * 100;

		//Pie Chart init for Total Types of Road Events
		$events = \Lava::DataTable();

		$events->addStringColumn('Type')
		        ->addNumberColumn('Percent')
		        ->addRow(['Car Crash', $data['carcrashpercent']])
		        ->addRow(['Flood', $data['floodpercent']])
				->addRow(['Men At Work', $data['menworkpercent']])
		        ->addRow(['Police', $data['policepercent']])
		        ->addRow(['Road Block',$data['roadblockpercent']]);

		\Lava::PieChart('ROADEVENT', $events, [
		    'title'  => 'Percentage of Road Event Types Reported',
		    'is3D'   => true,
		    'slices' => [
		        ['offset' => 0.2],
		        ['offset' => 0.25],
		        ['offset' => 0.3]
		    ]
		]);

		//init column chart for Total Events Each day
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
		    'title' => 'Total Road Event Reported Each Day',
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
		return view('roadEvents.roadEvents_index', $data);
	}

}
