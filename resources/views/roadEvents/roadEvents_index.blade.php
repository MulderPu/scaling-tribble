@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="content">
            <div class="col-sm-9">
                <div class = "page-header">
                    <h1>Road Events</h1>
                </div>

                <div class="panel panel-info">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Road Events Table</div>
                    <div class="panel-body">
                        <p> Road events reported by the users. </p>
                    </div><br>

                    <!-- Filter by category -->
                    <div id="Filters" class="well">
                        <h2>Filter by Category</h2>
                        <h4>Type : </h4>
                       <ul class="list-inline">
                           <li><label for="">Car Crash</label>  <input type="checkbox" value="carcrash" class="categoryFilter_Type" name="categoryFilter"> </li>
                            <li><label for="">Flood</label>  <input type="checkbox" value="flood" class="categoryFilter_Type" name="categoryFilter"> </li>
                            <li><label for="">Men at Work</label>  <input type="checkbox" value="menwork" class="categoryFilter_Type" name="categoryFilter"> </li>
                            <li><label for="">Police</label>  <input type="checkbox" value="police" class="categoryFilter_Type" name="categoryFilter"> </li>
                            <li><label for="">Road Block</label>  <input type="checkbox" value="roadblock" class="categoryFilter_Type" name="categoryFilter"> </li>
                       </ul>

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

                    <div class="sortable_table">
                        <!-- Table of road events show here -->
                        @include('roadEvents.table_allRoadEvent')
                    </div><br><hr>

                    <div class = "page-header">
                        <h1>Road Events Historical Record</h1>
                    </div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">Road Events Record in 2015</div>
                                <div class="panel-body">
                                    <p> This show the total number of users reported event in a month at year 2015. </p>
                                </div><br>

                                <!-- chart show here -->
                                <div id="event15_div"></div><br>
                                <?= Lava::render('BarChart', 'Bar15', 'event15_div') ?>

                                <!-- Table of road events by month show here -->
                                @include('partials.table_event2015')
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">Road Events Record in 2016</div>
                                <div class="panel-body">
                                    <p> This show the total number of users reported event in a month at year 2016. </p>
                                </div><br>

                                <!-- chart show here -->
                                <div id="event16_div"></div><br>
                                <?= Lava::render('BarChart', 'Bar16', 'event16_div') ?>

                                <!-- Table of road events by month show here -->
                                @include('partials.table_event2016')
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end panel info -->
            </div>
            <!-- end col sm 9 -->

            <!-- sidebar -->
            <div class="col-sm-3 sidenav">
                <div class="side_container">
                    <div class = "page-header">
                        <h1>Road Events Statistic</h1>
                    </div>

                    <h4>Total Road Event</h4>
                    <!-- Table of total number of road events show here -->
                    @include('partials.table_roadEvents')
                    <br>

                    <h4>Total Types of Road Events</h4>
                    <div class="pie">
                        <!-- Pie chart show here -->
                        <div id="chart-div"></div><br>
                        <?= Lava::render('PieChart', 'ROADEVENT', 'chart-div') ?>
                    </div>

                    <!-- Table of total number of each report based on type show here -->
                    @include('partials.table_totalTypeRoadEvents')

                    <h4>Total Events Each day</h4>
                    <div class="column">
                        <!-- Column chart show here -->
                        <div id="column-div"></div><br>
                        <?= Lava::render('ColumnChart', 'Week', 'column-div') ?>
                    </div>

                    <!-- Total of road events reported by each day table show here -->
                    <div class="table_container">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Total Number of Events</th>
                                </tr>
                            </thead>
                            <!-- table body -->
                            @include('partials.table_totalDay')
                        </table>
                    </div>

                </div>
                <!-- end side container -->
            </div>
            <!-- endsidebar -->
        </div>
    </div>

    <!-- javascript here -->
    <script src="{{ asset('js/table.js') }}"></script>
    <script src="{{ asset('js/eventDataTable.js') }}"></script>
    <script src="{{ asset('js/reload.js') }}"></script>
@endsection
