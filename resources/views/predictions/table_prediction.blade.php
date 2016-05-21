<table id="myTable" class="table table-striped table-bordered dt-responsive nowrap hover order-column" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Speed (Km/h)</th>
        <th>Day</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Location</th>
        <th>City</th>
        <th>State</th>
        <th>Country</th>
		<th>Confidence (%)</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($arrayAfterCheck as $row) : ?>
            <tr>
                <td><?php echo $row->getSpeed() ?></td>
                <td><?php echo $row->getDay() ?></td>
                <td><?php echo $row->getTime() ?></td>
                <td><?php echo $row->getEndTime() ?></td>
                <td><?php echo $row->getLocate() ?></td>
                <td><?php echo $row->getCity() ?></td>
                <td><?php echo $row->getState() ?></td>
                <td><?php echo $row->getCountry() ?></td>
				<td><?php echo $row->getConfidence() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>(Km/h)</th>
            <th>Day</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Location</th>
            <th>City</th>
            <th>State</th>
            <th>Country</th>
			<th>Confidence (%)</th>
        </tr>
    </tfoot>
</table>
