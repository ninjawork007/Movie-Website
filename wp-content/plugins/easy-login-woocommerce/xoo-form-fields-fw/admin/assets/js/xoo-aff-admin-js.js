jQuery(document).ready(function($){

	//Global variables
	var _types 			= window.xoo_aff_field_types,
		_sections		= window.xoo_aff_field_sections,
		_fieldsLayout 	= window.xoo_aff_fields_layout;
	window._userFields 	= window.xoo_aff_db_fields || {};

	var $selectable 	= $( '.xoo-aff-select-fields-type' ),
		$fieldsDisplay 	= $( '.xoo-aff-main' ),
		$fieldSettings 	= $( '.xoo-aff-field-settings-container' ),
		$fieldSelector 	= $( '.xoo-aff-field-selector' );


	function generate_field_settings( id_or_type ){

		var field_id = type = new_field = false;

		//Already a field
		if( _userFields[ id_or_type ] ){
			field_id 	= id_or_type;
			type 		= _userFields[ field_id ]['type'];
		}
		else{
			type 		= id_or_type;
			new_field 	= true;
			field_id 	= type + '_' + random_id();

			//Placeholder for field settings
			_userFields[ field_id ] = {
				type: type,
				settings: {},
			}
		}

		if( _fieldsLayout[ type ] === undefined ) return;

		var sections = JSON.parse( JSON.stringify ( _fieldsLayout[ type ] ) );

		var section_html = '';

		$.each( sections, function( section_id, settings ){

			var fields_html  = '',
				section_data = _sections[ section_id ];

			//Creating settings HTML
			$.each( settings, function( fs_id ,fs_data){

				//Get value
				if( new_field ){
					_userFields[ field_id ]['settings'][fs_id] = fs_data['value'];
				}
				else{
					fs_data.value =  _userFields[ field_id ]['settings'][fs_id];
				}

				var field_setting_template = wp.template('xoo-aff-field-settings');
				fields_html += field_setting_template(fs_data);
			});

			//Creating Section template
			var section_template = wp.template('xoo-aff-field-section');
			var section_template_data = JSON.parse( JSON.stringify ( section_data ) );
				section_template_data["html"] = fields_html;
			section_html += section_template( section_template_data );

		} )


		//Generate field settings Container & Push fields HTML to container
		var fields_settings_container = wp.template('xoo-aff-field-settings-container');
		var fields_settings_container_data = {
			field_id: field_id,
			type_data: _types[type],
			fields_html: section_html
		}
		$fieldSettings.html( fields_settings_container( fields_settings_container_data ) );

		//Generate Field display HTML
		display_field( field_id );

		$(document).trigger( 'xoo_aff_setting_generated', [field_id] );
	}

	//Display field row
	function display_field(field_id){
		//If already displayed or Id not found
		if( $fieldsDisplay.find('#'+field_id).length || !_userFields[ field_id ] ) return;
		var type = _userFields[ field_id ].type;
		var field_display_data = {
			field_id: field_id,
			type_data: _types[type]
		};
		var field_display_template = wp.template('xoo-aff-field-display');
		$fieldsDisplay.append( field_display_template( field_display_data ) );
	}

	//Set Label
	function set_label(field_id){
		var $label = $('#'+field_id + ' .xoo-aff-label span:last-of-type');
		var label = null;
		if( _userFields[field_id]['settings']['label_text']){

			label = _userFields[field_id]['settings']['label_text'];
		}
		else if( _userFields[field_id]['settings']['placeholder'] ){
			label = _userFields[field_id]['settings']['placeholder'];
		}
		
		$label.html( label === null ? '' :  '- '+ label );
		
	}

	$(document).on('xoo_aff_setting_generated',function(event,field_id){

		//Focus on generated field
		$('body '+'.xoo-aff-fs-display').removeClass('active');
		$('body '+'#'+field_id).addClass('active');

		//Initialize datepicker
		if( $( '.xoo-aff-field-settings#'+field_id ).find('.xoo-aff-datepicker').length ){
			init_datepicker();
		}

		$('ul.xoo-aff-options-list').sortable({
			stop: function( event, ui ){
				$(this).find('.xoo-aff-trigger-change').trigger('change');
			}
		});

		//Set field id
		$('#xoo_aff_uniqueid').val(field_id);

		set_label(field_id);
		$fieldSettings.show();
		$fieldsDisplay.show();
		$fieldSelector.hide();

	})

	$('.xoo-aff-add-field').click(function(){
		$('body '+'.xoo-aff-fs-display').removeClass('active');
		$fieldSettings.hide();
		$fieldSelector.show();
	})


	//Initialize Selectable
	$selectable.selectable();

	//Switch fields
	$('body').on('click','.xoo-aff-fs-display',function(){
		var container_id = $(this).attr('id');
		generate_field_settings(container_id);
	
	});

	//Reset fields
	$('body').on('click','.xoo-aff-reset-field',function(e){
		e.preventDefault();
		if( !confirm("Are you sure.This will remove your custom fields & take you back to default fields settings?") ) return;
		add_notice( 'Resetting.. Please wait...','info' );

		//Ajax reset
		$.ajax({
			url: xoo_aff_localize.ajax_url,
			type: 'POST',
			data: {
				action: 'xoo_aff_reset_settings',
			},
			success: function(response){
				console.log(response);
				if( response.success && response.success == 1){
					add_notice('Reset successfully. Refreshing page...','success');
					window.location.reload();
				}
				else{
					add_notice('Please contact support team','error');
				}
			}
		})

	});


	//Delete fields
	$('body').on('click','.xoo-aff-fsd-cta-del',function(e){

		e.stopPropagation();

		if( !confirm("Are you sure?") ) return;

		var field 		= $(this).parents('.xoo-aff-fs-display'),
			field_id  	= field.attr('id');

		delete window._userFields[field_id];

		//Set focus on next element
		if( field.hasClass('active') &&  $fieldsDisplay.find('.xoo-aff-fs-display').length > 1 ){
			var switch_to_field = field.next().length ? field.next() : field.prev();
			switch_to_field.trigger('click');
		}

		//Remove field
		$('body #'+ field_id).remove();

		//Check if there is any field
		if( $fieldsDisplay.find('.xoo-aff-fs-display').length === 0 ){
			$fieldsDisplay.hide();
			$fieldSelector.show();
		}
	})

	function random_id(){
		return Math.random().toString(36).substr(2, 5);
	}


	//Initialize datepicker
	function init_datepicker(){
		$('.xoo-aff-datepicker').datepicker({
			altFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			yearRange: 'c-100:c+10',
		})
	}

	//Verify uniqueness
	function is_id_unique(input_id){

		//check for length
		if( input_id.length <= 8 ){
			add_notice( 'Uniqued ID must be minimum 8 characters', 'error', 6000 );
			return false;
		}

		//Check for uniqueness
		var unique_id = true;
		$.each( window._userFields, function( field_id, field_data ){
			if( field_id === input_id ){
				add_notice( 'Field with the same ID already exists. Please keep it unique', 'error', 6000 );
				unique_id = false;
				return false;
			}
		} )

		return unique_id; //Exit 
		
	}

	//Update unique id
	function update_uniqueid( old_value, new_value ){
		var updated = false,
			updated_userFields = {};
		$.each( _userFields, function( field_id, field_data ){
			if( field_id === old_value ){
				$('.xoo-aff-field-settings#'+field_id+',.xoo-aff-fs-display#'+field_id).attr( 'id', new_value );
				field_id = new_value;
				field_data['settings']['uniqueid'] = new_value;
				updated = true;
			}
			updated_userFields[ field_id ] = field_data;
		} )

		window._userFields = JSON.parse( JSON.stringify ( updated_userFields ) );
		return updated;
	}


	//Save values on input change
	$fieldSettings.on( 'change', 'input, select', function(){

		var _t 				= $(this),
		 	container 		= _t.parents('.xoo-aff-field-settings'),
			field_id 		= container.attr('id'),
			input_id 		= _t.attr('id'),
			value 			= _t.val();

		if( input_id === 'xoo_aff_uniqueid' ){
			if( !is_id_unique( value ) ) return;
			field_id = update_uniqueid( field_id, value ) ? value : field_id;
		}

		if( _t.attr('type') === 'checkbox' && !_t.is(":checked") ){
			value = '';
		}

		//If multiple checkboxes
		if( _t.parents('.xoo-aff-opt').length ){

			var $ul_cont 	= _t.parents('ul'),
				input_id 	= $ul_cont.parents('.xoo-aff-multiple-options').attr('id'),
				ul_values 	= [];
			
			$ul_cont.find('li').each( function( index, li){
				var $li_el  	= $(li),
					li_checked  = $li_el.find('.option-check').is(":checked") ? 'checked' : false,
					li_label 	= $li_el.find('.mcb-label').val(),
					li_value 	= $li_el.find('.mcb-value').val();

				if( !li_label || !li_value  ) return true;

				var checkbox_data = {
					checked: li_checked,
					label:  li_label,
					value: li_value
				};

				if( input_id === "xoo_aff_checkbox_single" ){
					ul_values = checkbox_data;
				}
				else{
					ul_values.push( checkbox_data );
				}

			} );

			value = ul_values;
			
		}

		var setting_key = input_id.replace('xoo_aff_', '')
		window._userFields[field_id]["settings"][setting_key] = value;
		set_label( field_id );

	})

	//Add checkbox in multiplecheckbox
	$('body').on('click','.xoo-add-option',function(){
		var ul = $(this).parents('.xoo-aff-multiple-options').find('ul');
		ul.find('li:last-of-type').clone().appendTo(ul).find('.xoo-aff-trigger-change').trigger('change');
	});

	//Delete checkbox
	$('body').on('click','.mcb-del',function(){
		var li = $(this).parents('li'),
			ul = li.parents('ul');
		if( li.index() === 0 ) return; //cannot delete first one.
		li.remove();
		ul.find('li').eq(0).find('.xoo-aff-trigger-change').trigger('change');
	});


	$('#xoo-aff-save').on('click',function(){

		add_notice('Saving fields, Please wait....','info');

		//Sort data as per user display fields
		/** Make changes to data before sort_fields */
		var data_to_save = sort_fields();
		/*Any changes to data from here won't be reflected */

		//Ajax Save
		$.ajax({
			url: xoo_aff_localize.ajax_url,
			type: 'POST',
			data: {
				action: 'xoo_aff_save_settings',
				xoo_aff_data: JSON.stringify(data_to_save)
			},
			success: function(response){
				console.log(response);
				if( response.success && response.success == 1){
					add_notice('Saved successfully.','success');
				}
				else{
					add_notice('Please contact support team','error');
				}
			}
		})

	})

	//Sort fields
	function sort_fields(){

		var sorted_fields = {};

		$fieldsDisplay.find('li').each(function( index, li ){
			var $li 	 = $( li ),
				field_id = $li.attr('id');
			if( !window._userFields[ field_id ] ) return true;

			sorted_fields[ field_id ] = window._userFields[ field_id ];
		});

		return sorted_fields;

	}

	//Notice
	function add_notice(notice,notice_type,duration=5000){
		clear_notice();
		var data = {
			text: notice,
			type: notice_type
		}
		var template = wp.template('xoo-aff-notice');
		$('.xoo-aff-notice-holder').html( template(data) );

		//Hide notice after 5 seconds
		setTimeout(function(){
			clear_notice();
		},duration);
	}

	function clear_notice(){
		$('.xoo-aff-notice-holder').html('');
	}

	//Font Awesome IconPicker
	$('body').on('focus', '.xoo-aff-iconpicker', function(){
		$(this).iconpicker({
			hideOnSelect: true,
		});
	} )

	$('body').on('iconpickerSelected','.xoo-aff-iconpicker',function(){
		$(this).trigger('change');
	})


	//Generate user fields on page load
	$(function(){
		console.log(xoo_aff_db_fields);
		//Check if there are saved fields in database
		if( !_userFields || $.isEmptyObject( _userFields )) return;

		$fieldSettings.addClass('loading');
		add_notice('Loading fields, Please wait....','info',10000);

		$.each( _userFields, function( field_id, field_data ){
			generate_field_settings( field_id );
		} )

		$fieldSettings.removeClass('loading');
		clear_notice();
		$fieldsDisplay.find('.xoo-aff-fs-display:first-of-type').trigger('click');

	}());


	//Field display sort
	$fieldsDisplay.sortable();
})