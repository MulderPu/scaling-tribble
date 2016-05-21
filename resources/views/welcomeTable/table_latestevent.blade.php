<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading">Latest Event</div>
  <div class="panel-body">
      <p> This table shows the latest report from users. </p>
  </div>

  <!-- latest of road events reported table show here -->
  <div class="table-responsive">
      <table class="table table-striped">
          <thead>
              <tr>
                  <th>Type</th>
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
              @foreach($latestEvents as $latestEvent)
              <tr>
                  <td>{{ $latestEvent->type }}</td>
                  <td>{{ $latestEvent->day_detected }}</td>
                  <td>{{ $latestEvent->time_detected }}</td>
                  <td>{{ $latestEvent->date_detected }}</td>
                  @foreach($locations as $location)
                      @if( $latestEvent->location_id == $location->location_id)
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
