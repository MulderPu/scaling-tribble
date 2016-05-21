<table id="myTable" class="table table-striped table-bordered dt-responsive nowrap hover order-column" cellspacing="0" width="100%">
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
        @foreach($roadEvents as $roadEvent)
            <tr>
                <td>{{ $roadEvent -> type }}</td>
                <td>{{ $roadEvent -> day_detected }}</td>
                <td>{{ $roadEvent -> time_detected }}</td>
                <td>{{ $roadEvent -> date_detected }}</td>
            @foreach($locations as $location)
                @if( $location->location_id == $roadEvent->location_id)
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
            <th>Type</th>
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
