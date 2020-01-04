<label for="xoo_aff_{{data.id}}">{{data.title}}
	<# if ( data.info ) { #>
	<div class="xoo-aff-info">
		<span class="xoo-aff-info-icon fas fa-info-circle"></span>
		<span class="xoo-aff-infotext">{{data.info}}</span>
	</div>
	<# } #>
</label>

<# if ( "text" === data.type ) { #>
	<input type="text" id="xoo_aff_{{data.id}}" placeholder="{{data.placeholder}}" value="{{data.value}}" class="{{data.class}}" {{data.disabled}}>
<# } #>

<# if ( "checkbox" === data.type ) { #>
	<label for="xoo_aff_{{data.id}}" class="xoo-aff-switch">
	  <input type="checkbox" id="xoo_aff_{{data.id}}"  value="yes" {{data.disabled}} {{{ ( data.value === 'yes' ) ? 'checked' : '' }}} >
	  <span class="xoo-aff-slider"></span>
	</label>
<# } #>

<# if ( "number" === data.type ) { #>
	<input type="number" id="xoo_aff_{{data.id}}" min="{{data.min_char}}" placeholder="{{data.placeholder}}" class="{{data.class}}" value="{{data.value}}">
<# } #>


<# if ( "iconpicker" === data.type ) { #>
	<input type="text" class="xoo-aff-iconpicker" id="xoo_aff_{{data.id}}" placeholder="{{data.placeholder}}" class="{{data.class}}" value="{{data.value}}" autocomplete="off">
<# } #>

<# if ( "date" === data.type ) { #>
	<input type="text" class="xoo-aff-datepicker" id="xoo_aff_{{data.id}}" placeholder="{{data.placeholder}}" class="{{data.class}}" value="{{data.value}}" autocomplete="off">
<# } #>

<# if ( "select" === data.type ) { #>
	<select id="xoo_aff_{{data.id}}" class="{{data.class}}">
		<# _.each( data.options , function(option_title, option_value) { #>
			<option value="{{option_value}}" {{{ ( data.value === option_value ) ? 'selected="selected"' : '' }}} >{{option_title}}</option>
		<# }) #>
	</select>
<# } #>

<# if ( "checkbox_list" === data.type || "radio" === data.type || "select_list" === data.type) { #>
	<div class="xoo-aff-multiple-options" id="xoo_aff_{{data.id}}">
		<button class="xoo-add-option"><span class="fas fa-plus-circle"></span></button>
		<ul class="xoo-aff-options-list">
			<# _.each( data.value , function(option, index) { #>
				<li class="xoo-aff-opt">
					<span class="fas fa-bars"></span>

					<# if ( "checkbox_list" === data.type) { #>
						<input type="checkbox" {{option.checked}} class="option-check">
					<# } #>

					<# if ( "radio" === data.type || "select_list" === data.type ) { #>
						<input type="radio" name="xoo_aff_radio_single" {{option.checked}} class="option-check">
					<# } #>

					<input type="text" value="{{option.label}}" class="mcb-label" placeholder="Label">
					<input type="text" value="{{option.value}}" class="mcb-value" placeholder="Value">
					<input type="hidden" class="xoo-aff-trigger-change">
					<span class="mcb-del fas fa-minus-circle"></span>
				</li>
			<# }) #>
		</ul>
	</div>
<# } #>



<# if ( "checkbox_single" === data.type) { #>
	<div class="xoo-aff-multiple-options" id="xoo_aff_{{data.id}}">
		<ul class="xoo-aff-options-list">
			<li class="xoo-aff-opt">
				<input type="checkbox" {{data.value.checked}} class="option-check">
				<input type="text" value="{{data.value.label}}" class="mcb-label" placeholder="Label">
				<input type="text" value="{{data.value.value}}" class="mcb-value" placeholder="Value">
				<input type="hidden" class="xoo-aff-trigger-change">
			</li>
		</ul>
	</div>
<# } #>