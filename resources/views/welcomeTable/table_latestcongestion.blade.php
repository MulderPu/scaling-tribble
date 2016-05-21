<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading">Latest Congestion</div>
  <div class="panel-body">
      <p> This table shows the latest congestion detected from users. </p>
  </div>

  <!-- latest road congestions detected table show here -->
  <div class="table-responsive">
      <table class="table table-striped">
          <thead>
              <tr>
                  <th>Speed (Km/h)</th>
                  <th>Day</th>
                  <th>Time</th>
                  <th>Date</th>
                  <th>Location</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
              </tr>
          </thead>
          <tbody>
                @foreach($latestCongestions as $latestCongestion)
                <tr>
          			<td>{{ $latestCongestion->averageSpeed }}</td>
          			<td>{{ $latestCongestion->day_detected }}</td>
          			<td>{{ $latestCongestion->time_detected }}</td>
          			<td>{{ $latestCongestion->date_detected }}</td>
                    @foreach($locations as $location)
                        @if( $latestCongestion->location_id == $location->location_id)
                            <td>{{ $location -> add_line }}</td>
                            <td>{{ $location -> city }}</td>
                            <td>{{ $location -> state }}</td>
                            <td>{{ $location -> country }}</td>
                        @endif
                    @endforeach
                </tr>
                @endforeach
          </tbody>
      </table>
  </div>
</div>
<!-- end of panel info -->
