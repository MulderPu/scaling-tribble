//Start of the data table
$(document).ready( function () {
  var table = $('#myTable').DataTable({
	"dom": '<"toolbar">frtip'
});

$("div.toolbar").html('<i class="fa fa-calendar" aria-hidden="true">'
        + ' Date range: '
        + '</i>'
        +'<input id="date_range" type="text">'
        + '<br>'
        + '( Note: Press clear to return the table to default. )');

//END of the data table

// Date range script - Start of the script
$("#date_range").daterangepicker({
	autoUpdateInput: false,
	locale: {
		"cancelLabel": "Clear",
        }
});

$("#date_range").on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
	  table.draw();
});

$("#date_range").on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
	  table.draw();
});
// Date range script - END of the script

$.fn.dataTableExt.afnFiltering.push(
function( oSettings, aData, iDataIndex ) {

	var grab_daterange = $("#date_range").val();
	var give_results_daterange = grab_daterange.split(" to ");
    var filterstart = give_results_daterange[0];
    var filterend = give_results_daterange[1];
    var iStartDateCol = 3; //using column 4 in this instance
    var iEndDateCol = 3;
    var tabledatestart = aData[iStartDateCol];
    var tabledateend= aData[iEndDateCol];

    if ( !filterstart && !filterend )
    {
        return true;
    }
    else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && filterend === "")
    {
        return true;
    }
    else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isAfter(tabledatestart)) && filterstart === "")
    {
        return true;
    }
    else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && (moment(filterend).isSame(tabledateend) || moment(filterend).isAfter(tabledateend)))
    {
        return true;
    }
    return false;
}
);

//End of the datable
 });
