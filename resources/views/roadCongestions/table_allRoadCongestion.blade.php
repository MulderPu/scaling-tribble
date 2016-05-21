<table id="myTable" class="table table-striped table-bordered dt-responsive nowrap hover order-column" cellspacing="0" width="100%">
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
        @foreach($roadCongestions as $roadCongestion)
        <tr>
            <td>{{ $roadCongestion -> averageSpeed }}</td>
            <td>{{ $roadCongestion -> day_detected }}</td>
            <td>{{ $roadCongestion -> time_detected }}</td>
            <td>{{ $roadCongestion -> date_detected }}</td>
            @foreach($locations as $location)
                @if( $location->location_id == $roadCongestion->location_id)
                    <td>{{ $location -> add_line }}</td>
                    <td>{{ $location -> city }}</td>
                    <td>{{ $location -> state }}</td>
                    <td>{{ $location -> country }}</td>
                @endif
            @endforeach
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
          <th>(Km/h)</th>
          <th>Day</th>
          <th>Time</th>
          <th>Date</th>
          <th>Location</th>
          <th>City</th>
          <th>State</th>
          <th>Country</th>
        </tr>
    </tfoot>
</table>
