jQuery(document).ready(function($){



	(function(){
		//initialize datepicker
		if( xoo_aff_localize.datepicker_data ){
			var data = JSON.parse( xoo_aff_localize.datepicker_data );
			if( $.isEmptyObject( data ) ) return;
			$.each( data, function( index, field ){
				$( 'input[name='+field.id+']' ).datepicker(field.args);
			} )
		}

	}());


	
})