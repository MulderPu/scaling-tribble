$(document).ready(function(){
    $('#myTable').dataTable().columnFilter(
        {
            aoColumns: [
                        { type: "text" },
                        { type: "select", values: [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']  },
                        { type: "text" },
                        { type: "text" },
                        { type: "text" },
                        null,
                        null,
                        null
                ]
        }
    );

    //init table
	var myTable = $('#myTable').DataTable();

	//Day checkbox
	$('.categoryFilter_Day').click(function(){
		myTable.draw();
		});

    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        myTable.draw();
    } );

    //button listener to clear filter
    $('#clearFilter').click(function() {
        myTable.search('').draw();
        $('#min, #max').val('');
    });
});

/*filter day with checkbox in category*/
$.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var categoryFilter,categoryCol,categoryArray,found;

            //creates selected checkbox array
        categoryFilter = $('.categoryFilter_Day:checked').map(function () {
              return this.value;
            }).get();

        if(categoryFilter.length){

            categoryCol = data[1]; //filter column

            categoryArray =  $.map( categoryCol.split(','), $.trim); // splites comma seprated string into array

            // finding array intersection
            found = $(categoryArray).not($(categoryArray).not(categoryFilter)).length;

            if(found == 0){
                return false;
            }
            else{
                return true;
            }
        }
        // default no filter
        return true;
    }
);

/* Custom filtering function which will search data in column one between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var speed = parseFloat( data[0] ) || 0; // use data for the speed column

        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && speed <= max ) ||
             ( min <= speed && isNaN( max ) ) ||
             ( min <= speed && speed <= max ) )
        {
            return true;
        }
        return false;
    }
);
