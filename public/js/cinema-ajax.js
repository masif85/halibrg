	jQuery(".movie-language-filter").click(function(){
	var type=jQuery(this).attr("data-target");
		jQuery.ajax({
        url: "get_listing.php",
        type: "POST",
		data: {type:type},	
		dataType: "json",       
        success: function (data) {
jQuery("."+type).html(data);
         // alert(data);
        }
    });
	});
		
		
jQuery(document).ready(function(){
	var type="all";
		jQuery.ajax({
        url: "get_listing.php",
        type: "POST",
		data: {type:type},	
		dataType: "json",       
        success: function (data) {
jQuery("."+type).html(data);
         // alert(data);
        }
    });


	jQuery.ajax({
        url: "get_cinema.php",
        type: "POST",
		data: {type_cinema:type},	
		dataType: "json",       
        success: function (data_cinemas) {
			
jQuery(".cinemas").html(data_cinemas);
         // alert(data);
        }
    });
});



jQuery(".cinema-location-filter").click(function(){
	var type_cinema=jQuery(this).attr("data-target");
	
		jQuery.ajax({
        url: "get_cinema.php",
        type: "POST",
		data: {type_cinema:type_cinema},	
		dataType: "json",       
        success: function (data_cinema) {
				jQuery(".cinemas").html(data_cinema);
			jQuery( "."+type_cinema ).addClass( "active" );
         // alert(data);
        }
    });
	});
		
		