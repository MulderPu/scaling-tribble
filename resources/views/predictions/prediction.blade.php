@extends('app')

@section('content')

    <div class="congestion">
        <?php

			class CongestionClass{

				//var
				private $speed, $day, $dateDetected, $time, $locate, $city, $state, $country, $endTime;

				//contructor
				public function __construct($speed, $day, $dateDetected, $time, $endTime, $locate, $city, $state, $country){
					$this->speed = $speed;
					$this->day = $day;
					$this->dateDetected = $dateDetected;
					$this->time = $time;
					$this->endTime = $endTime;
					$this->locate = $locate;
					$this->city = $city;
					$this->state = $state;
					$this->country = $country;
				}

				//set speed
				public function setSpeed($speed){
					$this->speed = $speed;
				}

				//return speed
				public function getSpeed(){
					return $this->speed;
				}

				//set day
				public function setDay($day){
					$this->day = $day;
				}

				//return day
				public function getDay(){
					return $this->day;
				}

				// set date
				public function setDate($dateDetected) {
					$this->dateDetected = $dateDetected;
				}

				// return date
				public function getDate() {
					return $this->dateDetected;
				}

				//set start time
				public function setTime($time){
					$this->time = $time;
				}

				//return start time
				public function getTime(){
					return $this->time;
				}

				//set location
				public function setLocate($locate){
					$this->locate = $locate;
				}

				//return location
				public function getLocate(){
					return $this->locate;
				}

				//set city
				public function setCity($city){
					$this->city = $city;
				}

				//return city
				public function getCity(){
					return $this->city;
				}

				//set state
				public function setState($state){
					$this->state = $state;
				}

				//return state
				public function getState(){
					return $this->state;
				}

				//set country
				public function setCountry($country){
					$this->country = $country;
				}

				//return country
				public function getCountry(){
					return $this->country;
				}

				//set end time
				public function setEndTime($endTime){
					$this->endTime = $endTime;
				}

				//return end time
				public function getEndTime(){
					return $this->endTime;
				}
			}

			class OverlapCongestion {

                //init var
				private $speed, $day, $time, $dateDetected, $endTime, $locate, $city, $state, $country, $containedCongestion = array(), $confidence;

                //contructor
				public function __construct($speed, $day, $dateDetected, $time, $endTime, $locate, $city, $state, $country) {
					$this->speed = $speed;
					$this->day = $day;
					$this->time = $time;
					$this->dateDetected = $dateDetected;
					$this->endTime = $endTime;
					$this->locate = $locate;
					$this->city = $city;
					$this->state = $state;
					$this->country = $country;
				}

                //add congestion into array
				public function addCongestion($congestion) {
					$this->containedCongestion[] = $congestion;
				}

                //get contained congestion data
				public function getContainedCongestion() {
					return $this->containedCongestion;
				}

                //check if there is duplicate congestion, return result
				public function hasDuplicate($congestion) {
					for ($i = 0; $i < sizeof($this->containedCongestion); $i++) {
						if ($this->containedCongestion[$i] == $congestion) {
							return true;
						}
					}
					return false;
				}

                //check if there is same data, return result
				public function hasSameDate($congestion) {
					for ($i = 0; $i < sizeof($this->containedCongestion); $i++) {
						if ($this->containedCongestion[$i]->getDate() == $congestion->getDate() and $this->containedCongestion[$i] != $congestion) {
							return true;
						}
					}
					return false;
				}

                //return the number of congestion
				public function getNumberOfCongestion() {
					return sizeof($this->containedCongestion);
				}

                //set confidence for road congestion
				public function setConfidence($confidence) {
					$this->confidence = $confidence;
				}

                //return confidence of road congestion
				public function getConfidence() {
					return $this->confidence;
				}

				//set speed
				public function setSpeed($speed){
					$this->speed = $speed;
				}

				//return speed
				public function getSpeed(){
					return $this->speed;
				}

				//set day
				public function setDay($day){
					$this->day = $day;
				}

				//return day
				public function getDay(){
					return $this->day;
				}

				// set date
				public function setDate($dateDetected) {
					$this->dateDetected = $dateDetected;
				}

				// return date
				public function getDate() {
					return $this->dateDetected;
				}

				//set start time
				public function setTime($time){
					$this->time = $time;
				}

				//return start time
				public function getTime(){
					return $this->time;
				}

				//set location
				public function setLocate($locate){
					$this->locate = $locate;
				}

				//return location
				public function getLocate(){
					return $this->locate;
				}

				//set city
				public function setCity($city){
					$this->city = $city;
				}

				//get city
				public function getCity(){
					return $this->city;
				}

				//set state
				public function setState($state){
					$this->state = $state;
				}

				//get state
				public function getState(){
					return $this->state;
				}

				//set country
				public function setCountry($country){
					$this->country = $country;
				}

				//get country
				public function getCountry(){
					return $this->country;
				}

				//set end time
				public function setEndTime($endTime){
					$this->endTime = $endTime;
				}

				//get end time
				public function getEndTime(){
					return $this->endTime;
				}
			}

            //create array to store congestion data
            $arrayBeforeCheck = array();
            $arrayAfterCheck = array();
			$totalNumberDays = array();

            //store each congestion into an object from db
            foreach($roadCongestions as $roadCongestion){
                $var_speed = $roadCongestion->averageSpeed;
                $var_day = $roadCongestion->day_detected;
				$var_dateDetected = $roadCongestion->date_detected;
                $var_time = $roadCongestion->time_detected;
                foreach($locations as $location){
                    if($location->location_id == $roadCongestion->location_id){
                        $var_loc = $location->add_line;
                        $var_city = $location->city;
                        $var_state = $location->state;
                        $var_country = $location->country;
                    }
                }

                //convert time to sting
				$time1 = strtotime($var_time);
				$var_startTime = date("H:i:s", strtotime('+0 minutes', $time1));
				$var_endTime = date("H:i:s", strtotime('+20 minutes', $time1));

                //create obj can store all var into and push to array
                $congestion = new CongestionClass($var_speed, $var_day, $var_dateDetected, $var_startTime, $var_endTime, $var_loc, $var_city, $var_state, $var_country);
                array_push($arrayBeforeCheck, $congestion);
            }


            //loop arrayBeforeCheck
            for($x = 0; $x < sizeof($arrayBeforeCheck); $x++){

                //calculate end time for each congestion
				$startTime1 = $arrayBeforeCheck[$x]->getTime();
				$endTime1 = $arrayBeforeCheck[$x]->getEndTime();

				$arrayOverLap = array();


                //if array2 is empty, add in one congestion
                if(sizeof($arrayAfterCheck) == 0){
                    array_push($arrayAfterCheck, $arrayBeforeCheck[$x]);
                }
                else{
                    //loop arrayAfterCheck
                    for($y = 0; $y < sizeof($arrayAfterCheck); $y++){

                        //if both array had the same day
                        if( $arrayBeforeCheck[$x]->getDate() == $arrayAfterCheck[$y]->getDate()  and
						   	$arrayBeforeCheck[$x]->getLocate() == $arrayAfterCheck[$y]->getLocate()) {

                            //calculate the end time for 2nd array of each congestion
							$startTime2 = $arrayAfterCheck[$y]->getTime();
							$endTime2 = $arrayAfterCheck[$y]->getEndTime();

                            //check overlap time within both congestion
                            if ($startTime1 < $startTime2 and $endTime1 > $startTime2) {
                                //set start time and end time to the obj
                                $arrayAfterCheck[$y]->setTime($startTime1);
                                $arrayAfterCheck[$y]->setEndTime($endTime2);

                                //calculate the average speed for both congestion
                                $speed1 = $arrayBeforeCheck[$x]->getSpeed();
                                $speed2 = $arrayAfterCheck[$y]->getSpeed();
                                $result = ($speed1 + $speed2) /2;
                                $arrayAfterCheck[$y]->setSpeed($result);

                                array_push($arrayOverLap, $arrayAfterCheck[$y]); //push obj from array2 to array3
                                unset($arrayAfterCheck[$y]); //remove obj in array by index
                            } elseif ($startTime2 < $startTime1 and $endTime2 > $startTime1) {
                                //set start time and end time to the obj
                                $arrayAfterCheck[$y]->setTime($startTime2);
                                $arrayAfterCheck[$y]->setEndTime($endTime1);

                                //calculate the average speed for both congestion
                                $speed1 = $arrayBeforeCheck[$x]->getSpeed();
                                $speed2 = $arrayAfterCheck[$y]->getSpeed();
                                $result = ($speed1 + $speed2) /2;
                                $arrayAfterCheck[$y]->setSpeed($result);

                                array_push($arrayOverLap, $arrayAfterCheck[$y]);
                                unset($arrayAfterCheck[$y]); //remove obj from array using index
                            }
                        }
                    }

					$arrayAfterCheck = array_values($arrayAfterCheck); //reorganize index

					if (sizeof($arrayOverLap) != 0) {
						for ($indexOverlap = 0; $indexOverlap < sizeof($arrayOverLap); $indexOverlap++) {

							$hasOverLap = false;

							if (sizeof($arrayAfterCheck) == 0) {
								array_push($arrayAfterCheck, $arrayOverLap[$indexOverlap]);
							} else {

								$startTime1 = $arrayOverLap[$indexOverlap]->getTime();
								$endTime1 = $arrayOverLap[$indexOverlap]->getEndTime();

								for ($indexCongestion = 0; $indexCongestion < sizeof($arrayAfterCheck); $indexCongestion++) {

									if( $arrayOverLap[$indexOverlap]->getDate() == $arrayAfterCheck[$indexCongestion]->getDate()  and
						   				$arrayOverLap[$indexOverlap]->getLocate() == $arrayAfterCheck[$indexCongestion]->getLocate()) {

										$startTime2 = $arrayAfterCheck[$indexCongestion]->getTime();
										$endTime2 = $arrayAfterCheck[$indexCongestion]->getEndTime();

										if ($startTime1 < $startTime2 and $endTime1 > $startTime2) {

											$hasOverLap = true;

											$arrayAfterCheck[$indexCongestion]->setTime($startTime1);
											$arrayAfterCheck[$indexCongestion]->setEndTime($endTime2);

											$speed1 = $arrayOverLap[$indexOverLap]->getSpeed();
											$speed2 = $arrayAfterCheck[$indexCongestion]->getSpeed();
											$result = ($speed1 + $speed2) / 2;

											$arrayAfterCheck[$indexCongestion]->setSpeed($result);
										} elseif ($startTime2 < $startTime1 and $endTime2 > startTime1) {

											$hasOverLap = true;

											$arrayAfterCheck[$indexCongestion]->setTime($startTime2);
											$arrayAfterCheck[$indexCongestion]->setEndTime($endTime1);

											$speed1 = $arrayOverLap[$indexOverLap]->getSpeed();
											$speed2 = $arrayAfterCheck[$indexCongestion]->getSpeed();
											$result = ($speed1 + $speed2) / 2;

											$arrayAfterCheck[$indexCongestion]->setSpeed($result);
										}
									}
								}
							}

							if ($hasOverLap  == false) {
								array_push($arrayAfterCheck, $arrayOverLap[$indexOverlap]);
							}
						}
					} else {
						//push obj from array1 to array2
                    	array_push($arrayAfterCheck, $arrayBeforeCheck[$x]);
					}
                }
            }

			$arrayAfterCheck = predictCongestion($arrayAfterCheck, '', '');

			$totalNumberDays = getTotalNumberDays(getFirstDate($arrayBeforeCheck), date("Y-m-d"));

			for ($index = 0; $index < sizeof($arrayAfterCheck); $index++) {
				$arrayAfterCheck[$index]->setConfidence(getConfidence($arrayAfterCheck[$index], $totalNumberDays));
			}

			function getConfidence($overlappedCongestion, $totalNumberDays) {
				$daysArray = array('Monday' => 0, 'Tuesday' => 1, 'Wednesday' => 2, 'Thursday' => 3, 'Friday' => 4, 'Saturday' => 5, 'Sunday' => 6);

				$congestionDay = $overlappedCongestion->getDay();
				$congestionDayIndex = $daysArray[$congestionDay];

				$totalDayOnCongestion = $totalNumberDays[$congestionDayIndex];

				$confidencePercentage = ($overlappedCongestion->getNumberOfCongestion() / $totalDayOnCongestion) * 100;

				return number_format((float) $confidencePercentage, 2, '.', '');
			}

			function predictCongestion($arrayToPredict, $day, $location) {

				$arrayInitial = $arrayToPredict;

				if ($day != '') {
					$arrayInitial = filterDay($arrayInitial, $day);
				}

				if ($location != '') {
					$arrayInitial = filterLocation($arrayInitial, $location);
				}

				$arrayToStoreOverlapped = array();

				if (sizeof($arrayInitial) <= 1) {
					return $arrayInitial;
				}

				$arrayOverlap = array();

				for ($i = 0; $i < sizeof($arrayInitial) - 1; $i++) {

					$startTime1 = $arrayInitial[$i]->getTime();
					$endTime1 = $arrayInitial[$i]->getEndTime();

					for ($x = $i + 1; $x < sizeof($arrayInitial); $x++) {

						$startTime2 = $arrayInitial[$x]->getTime();
						$endTime2 = $arrayInitial[$x]->getEndTime();

						if ($arrayInitial[$i]->getLocate() == $arrayInitial[$x]->getLocate() and $arrayInitial[$i]->getDay() == $arrayInitial[$x]->getDay()) {
							if ($startTime1 < $startTime2 and $endTime1 > $startTime2) {

								$overlapStartTime = $startTime2;
								$overlapEndTime = $endTime1;

								$speed1 = $arrayInitial[$i]->getSpeed();
								$speed2 = $arrayInitial[$x]->getSpeed();
								$result = ($speed1 + $speed2) / 2;

								$overlapped = new OverlapCongestion($result,
																	$arrayInitial[$i]->getDay(),
																	$arrayInitial[$i]->getDate(),
																	$overlapStartTime,
																	$overlapEndTime,
																	$arrayInitial[$i]->getLocate(),
																	$arrayInitial[$i]->getCity(),
																	$arrayInitial[$i]->getState(),
																	$arrayInitial[$i]->getCountry());

								$overlapped->addCongestion($arrayInitial[$i]);
								$overlapped->addCongestion($arrayInitial[$x]);

								array_push($arrayOverlap, $overlapped);

							} elseif ($startTime2 < $startTime1 and $endTime2 > $startTime1) {

								$overlapStartTime = $startTime1;
								$overlapEndTime = $endTime2;

								$speed1 = $arrayInitial[$i]->getSpeed();
								$speed2 = $arrayInitial[$x]->getSpeed();
								$result = ($speed1 + $speed2) / 2;

								$overlapped = new OverlapCongestion($result,
																	$arrayInitial[$i]->getDay(),
																	$arrayInitial[$i]->getDate(),
																	$overlapStartTime,
																	$overlapEndTime,
																	$arrayInitial[$i]->getLocate(),
																	$arrayInitial[$i]->getCity(),
																	$arrayInitial[$i]->getState(),
																	$arrayInitial[$i]->getCountry());

								$overlapped->addCongestion($arrayInitial[$i]);
								$overlapped->addCongestion($arrayInitial[$x]);

								array_push($arrayOverlap, $overlapped);
							}
						}
					}
				}


				if (sizeof($arrayOverlap) > 0) {

					foreach ($arrayOverlap as $overlap) {
						array_push($arrayToStoreOverlapped, $overlap);
					}

					while (sizeof($arrayOverlap) > 1) {
						$arrayInitial = $arrayOverlap;
						$arrayOverlap = array();

						for ($i = 0; $i < sizeof($arrayInitial) - 1; $i++) {

							$startTime1 = $arrayInitial[$i]->getTime();
							$endTime1 = $arrayInitial[$i]->getEndTime();

							for ($x = 1; $x < sizeof($arrayInitial); $x++) {

								$startTime2 = $arrayInitial[$x]->getTime();
								$endTime2 = $arrayInitial[$x]->getEndTime();

								if ($arrayInitial[$i]->getLocate() == $arrayInitial[$x]->getLocate() and $arrayInitial[$i]->getDay() == $arrayInitial[$x]->getDay()) {
									if ($startTime1 < $startTime2 and $endTime1 > $startTime2) {
										if (checkHasSameDate($arrayInitial[$i], $arrayInitial[$x]) == false) {

											$mergedOverlap = mergeOverlap($arrayInitial[$i], $arrayInitial[$x]);
											array_push($arrayOverlap, $mergedOverlap);

										}
									} elseif ($startTime2 < $startTime1 and $endTime2 > $startTime1) {
										if (checkHasSameDate($arrayInitial[$i], $arrayInitial[$x]) == false) {

											$mergedOverlap = mergeOverlap($arrayInitial[$i], $arrayInitial[$x]);
											array_push($arrayOverlap, $mergedOverlap);
										}
									}
								}
							}
						}

						foreach ($arrayOverlap as $overlap) {
							array_push($arrayToStoreOverlapped, $overlap);
						}
					}
				}
				return $arrayToStoreOverlapped;
			}

            //get the total number of days
			function getTotalNumberDays($firstDate, $lastDate) {

				// Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday
				$totalNumberDays = array();

				for ($i = 0; $i < 7; $i++) {
					$dayNumber = array();

					$dateArray = getDateForSpecificDayBetweenDates($firstDate, $lastDate, $i);

					array_push($totalNumberDays, sizeof($dateArray));
				}

				return $totalNumberDays;
			}

            //look for the first date
			function getFirstDate($congestionArray) {

				$firstDate = date("Y-m-d");

				for ($i = 0; $i < sizeof($congestionArray); $i++) {
					if ($congestionArray[$i]->getDate() < $firstDate) {
						$firstDate = $congestionArray[$i]->getDate();
					}
				}

				return $firstDate;
			}

            //get the date just for the specific day between the dates
			function getDateForSpecificDayBetweenDates($startDate, $endDate, $day_number) {
				$startDate = strtotime($startDate);
				$endDate = strtotime($endDate);
				$days=array(0=>'Monday',1 => 'Tuesday',2 => 'Wednesday', 3=>'Thursday', 4=>'Friday', 5=> 'Saturday',6=>'Sunday');

				for($i = strtotime($days[$day_number], $startDate); $i <= $endDate; $i = strtotime('+1 week', $i)) {
					$date_array[] = date('Y-m-d', $i);
				}

				return $date_array;
			}

            //merge overlap road congestion together
			function mergeOverlap($overlap1, $overlap2) {

				$secondOverlapCongestion = $overlap2->getContainedCongestion();

				for ($i = 0; $i < sizeof($secondOverlapCongestion); $i++) {
					if ($overlap1->hasDuplicate($secondOverlapCongestion[$i]) == false) {
						$overlap1->addCongestion($secondOverlapCongestion[$i]);
					}
				}

				$startTime1 = $overlap1->getTime();
				$endTime1 = $overlap1->getEndTime();

				$startTime2 = $overlap2->getTime();
				$endTime2 = $overlap2->getEndTime();

				if ($startTime1 < $startTime2 and $endTime1 > $startTime2) {
					$overlap1->setTime($startTime2);
					$overlap1->setEndTime($endTime1);
				} elseif ($startTime2 < $startTime1 and $endTime2 > $startTime1) {
					$overlap1->setTime($startTime1);
					$overlap1->setEndTime($endTime2);
				}

				return $overlap1;
			}

            //check if there is same date
			function checkHasSameDate($overlap1, $overlap2) {
				$secondOverlapCongestion = $overlap2->getContainedCongestion();

				for ($i = 0; $i < sizeof($secondOverlapCongestion); $i++) {
					if ($overlap1->hasSameDate($overlap2[$secondOverlapCongestion])) {
						return true;
					}
				}

				return false;
			}

            //check duplicated or same day
			function hasDuplicateOrSameDay($overlap1, $overlap2) {

				$secondOverlapCongestion = $overlap2->getContainedCongestion();

				for ($i = 0; $i < sizeof($secondOverlapCongestion); $i++) {
					if ($overlap1->hasDuplicate($overlap2[$secondOverlapCongestion]) or $overlap1->hasSameDate($overlap2[$secondOverlapCongestion])) {
						return true;
					}
				}

				return false;
			}

            //filter the location
      		function filterLocation($congestionArray, $location) {
				// Create new array to store filtered results
				$locationFilteredArray = array();

				for ($index = 0; $index < sizeof($congestionArray); $index++) {
					if ($congestionArray[$index]->getLocate() == $location) {
						array_push($locationFilteredArray, $congestionArray[$index]);
					}
				}

				return $locationFilteredArray;
			}

            //filter the day
            function filterDay($congestionArray, $day) {
				// Create new array to store filtered results
				$dayFilteredArray = array();

                for ($index = 0; $index < sizeof($congestionArray); $index++) {
					if ($congestionArray[$index]->getDay() == $day) {
						array_push($dayFilteredArray, $congestionArray[$index]);
					}
				}

				return $dayFilteredArray;
            }
        ?>
    </div>

    <div class="container-fluid">
        <div class = "page-header">
            <h2>Road Predictions</h2>
        </div>

        <div class="panel panel-info">
            <!-- Default panel contents -->
            <div class="panel-heading"> Predictions of Road Congestion</div>
            <div class="panel-body">
                <p> This table shows the predictions of road congestion may occurred. </p>
            </div>

            <!-- Filter by category -->
            <div id="Filters" class="well">
                <h2>Filter by Category</h2>
                <!-- text field -->
                <h4>Km/h : </h4>
                <ul class="list-inline">
                    <li><label for="">Min:</label>  <input id="min" name="min" type="text"> </li>
                    <li><label for="">Max: </label>  <input id="max" name="max" type="text"> </li>
                    <button type="button" class="btn btn-default" id="clearFilter"><i class="fa fa-eraser" aria-hidden="true"> Clear Filters</i></button>
                </ul>

                <!-- checkboxes -->
               <h4>Day : </h4>
                  <ul class="list-inline">
                       <li><label for="">Monday</label>  <input type="checkbox" value="Monday" class="categoryFilter_Day" name="categoryFilter"> </li>
                       <li><label for="">Tuesday</label>  <input type="checkbox" value="Tuesday" class="categoryFilter_Day" name="categoryFilter"> </li>
                       <li><label for="">Wednesday</label>  <input type="checkbox" value="Wednesday" class="categoryFilter_Day" name="categoryFilter"> </li>
                       <li><label for="">Thursday</label>  <input type="checkbox" value="Thursday" class="categoryFilter_Day" name="categoryFilter"> </li>
                       <li><label for="">Friday</label>  <input type="checkbox" value="Friday" class="categoryFilter_Day" name="categoryFilter"> </li>
                       <li><label for="">Saturday</label>  <input type="checkbox" value="Saturday" class="categoryFilter_Day" name="categoryFilter"> </li>
                       <li><label for="">Sunday</label>  <input type="checkbox" value="Sunday" class="categoryFilter_Day" name="categoryFilter"> </li>
                  </ul>
            </div>
            <!-- End filter by category -->

            <div class="table_container">
                <!-- prediction table show here -->
                @include('predictions.table_prediction')
            </div>
        </div>
        <!-- end of panel -->
    </div>

    <!-- javascript here -->
    <script src="{{ asset('js/congestionDataTable.js') }}"></script>
    <script src="{{ asset('js/reload.js') }}"></script>
@endsection
