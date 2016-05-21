@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="content">
            <div class="col-sm-9">
                <div class = "page-header">
                    <h1>Road Congestions</h1>
                </div>

                <div class="panel panel-info">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Road Congestions Table</div>
                    <div class="panel-body">
                        <p> Road congestion detected automatically by the system using Random Forest Algorithm.</p>
                    </div><br>

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

                    <div class="sortable_table">
                        <!-- Table of road congestion show here -->
                        @include('roadCongestions.table_allRoadCongestion')
                    </div><br><hr>

                    <div class = "page-header">
                        <h1>Road Congestions Historical Record</h1>
                    </div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">Road Congestions Record in 2015</div>
                                <div class="panel-body">
                                    <p> This show the total number of users detected congestion in a month at year 2015. </p>
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
                                <div class="panel-heading">Road Congestions Record in 2016</div>
                                <div class="panel-body">
                                    <p> This show the total number of users detected congestion in a month at year 2016. </p>
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
            </div>
            <div class="col-sm-3 sidenav">
                <div class="side_container">
                    <div class = "page-header">
                        <h1>Road Congestions Statistic</h1>
                    </div>

                    <h4>Total Congestions</h4>
                    <!-- Table of the total number of road congestion detected show here -->
                    @include('partials.table_roadCongestion')

                    <h4>Total Congestions Each day</h4>
                    <!-- Column Chart show here -->
                    <div id="chart_div"></div><br>
                    <?= Lava::render('ColumnChart', 'Week', 'chart_div') ?>

                    <!-- Total of road congestion detected by each day table show here -->
                    <div class="table_container">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Total Number of Congestion</th>
                                </tr>
                            </thead>
                            <!-- table body -->
                            @include('partials.table_totalDay')
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- javascript here -->
    <script src="{{ asset('js/table.js') }}"></script>
    <script src="{{ asset('js/congestionDataTable.js') }}"></script>
    <script src="{{ asset('js/reload.js') }}"></script>
@stop
