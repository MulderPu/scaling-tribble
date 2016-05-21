$(document).ready(function(){
    $('#myTable').dataTable().columnFilter(
        {
			aoColumns: [
                        { type: "select", values: [ 'carcrash', 'flood', 'menwork', 'police', 'roadblock']  },
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

	//Type checkbox
    $('.categoryFilter_Type').click(function(){
    	myTable.draw();
    	});

	//Day checkbox
	$('.categoryFilter_Day').click(function(){
		myTable.draw();
		});
});

/*filter type with checkbox in category*/
$.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var categoryFilter,categoryCol,categoryArray,found;

            //creates selected checkbox array
        categoryFilter = $('.categoryFilter_Type:checked').map(function () {
              return this.value;
            }).get();

        if(categoryFilter.length){

            categoryCol = data[0]; //filter column

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
