<?php

class Xoo_Aff_Fields{

	protected static $_instance = null;

	public static $types = array(), $sections = array(), $settings = array(),  $predefined_fields = array(), $default_field_settings = array();

	public static function get_instance(){
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct(){
		
		//Get default field settings
		if( empty( self::$default_field_settings ) ){
			self::$default_field_settings = include XOO_AFF_DIR.'/admin/templates/xoo-aff-fields-data.php';
		}
		$this->set_defaults();
		add_action( 'admin_footer', array( $this, 'release_variables' ) );
		add_action( 'admin_init', array( $this, 'save_predefined_fields' ) );
		add_action( 'wp_ajax_xoo_aff_save_settings', array( $this, 'save_settings') );
		add_action( 'wp_ajax_xoo_aff_reset_settings', array( $this, 'reset_settings') );
	}

	//Set defaults
	public function set_defaults(){

		//Field Types
		$this->set_default_field_types();
		//Field sections
		$this->set_default_field_sections();
		//Field settings
		$this->set_default_field_settings();

	}

	//Field type
	public static function add_type( $id, $type, $title, $args = array() ){
		self::$types[ $id ] = wp_parse_args(
			$args,
			array(
				'id' 			=> $id,
				'type' 			=> $type,
				'title' 		=> $title,
				'is_selectable' => 'yes',
				'can_delete' 	=> 'yes',
			)
		);
	}

	//Field Sections
	public static function add_section( $id, $title, $args = array() ){
		self::$sections[ $id ] = wp_parse_args(
			$args,
			array(
				'id' 	=> $id,
				'title' => $title,
			)
		);
	}

	//Field Settings
	public static function add_setting( $id, $type, $section, $field_type_id, $title, $args = array() ){

		if( !isset( self::$types[ $field_type_id ] ) || !isset( self::$sections[ $section ] ) ) return;

		self::$settings[ $field_type_id ][ $section ][ $id ] = wp_parse_args(
			$args,
			array(
				'id' 		=> $id,
				'title' 	=> $title,
				'type' 	 	=> $type,
				'section' 	=> $section,
				'value' 	=> '',
				'width' 	=> 'half',
				'disabled'  => '',
			)
		);
	}

	//Save settings
	public function save_settings(){
		
		$db_fields = json_decode( stripslashes( $_POST['xoo_aff_data'] ), true);

		$this->update_db_fields( $db_fields );

		wp_send_json( array(
			'success' => 1
		) );

		die();
	}

	//Reset settings
	public function reset_settings(){
		delete_option( 'xoo_aff_fields' ); //Delete frontend fields
		delete_option( 'xoo_aff_admin_fields' ); //Delete admin fields
		$this->save_predefined_fields();
		wp_send_json(array(
			'success' => 1
		));
	}


	//Verify fields before save
	public function verify_fields_before_saving( $user_data = array() ){

		if( empty( $user_data ) ) return;

		$updated_user_data = array();

		foreach ( $user_data as $field_id => $field_data ) {
			
			$type = $field_data['type'];

			if( !isset( self::$settings[ $type ] ) ){
				unset( $user_data[ $field_id ] );
				continue;
			}
			

			foreach ( self::$settings[ $type ] as $section => $settings ) {
				foreach ( $settings as $fs_id => $fs_data ) {
					if( !isset( $field_data['settings'][ $fs_id ] ) ){
						$user_data[ $field_id ][ 'settings' ][ $fs_id ] = $fs_data[ 'value' ];
					}

					//Sanitize
					$user_data[ $field_id ][ 'settings' ][ $fs_id ] = $user_data[ $field_id ][ 'settings' ][ $fs_id ];

					//Update unique ids
					if( $fs_id === 'uniqueid' ){
						$unique_id = $user_data[ $field_id ][ 'settings' ][ $fs_id ];
						//Check if the filed with same ID already exists
						if(  isset( $user_data[ $unique_id ] ) || strlen( $unique_id ) < 8 ) continue;
						$updated_id = $unique_id;
					}
				}
			}

			$updated_user_data[ isset($updated_id) ? $updated_id : $field_id ] = $user_data[ $field_id ];

		}

		return $updated_user_data;

	}

	//Save Default fields
	public function save_predefined_fields(){

		$db_fields = json_decode( $this->get_db_fields(), true );

		$predefined_fields = self::$predefined_fields;
		$types = self::$types;

		foreach( $predefined_fields as $field_id => $field_data ) {
			if( isset( $db_fields[ $field_id ] ) ){
				$db_fields[ $field_id ]['settings'] = array_merge( $db_fields[ $field_id ]['settings'], $predefined_fields[ $field_id ]['settings'] );
			}
			else{
				if( $types[ $predefined_fields[ $field_id ]['type'] ]['can_delete'] !== "yes" ){
					$db_fields[ $field_id ] = $predefined_fields[ $field_id ];
				}
			}
		}

		$this->update_db_fields( $db_fields );
		return true;
	}

	//Database saved fields
	public static function get_db_fields(){
		return get_option( 'xoo_aff_admin_fields' );
	}

	//Update db fields
	public function update_db_fields( $data ){

		if( is_array( $data ) ){
			$data = json_encode( $data );
		}
		else{
			json_decode( $data );
 			if( json_last_error() != JSON_ERROR_NONE ){
 				return;
 			}
		}

		$admin_fields = $this->verify_fields_before_saving( json_decode( $data, true ) );

		$frontend_fields = $this->frontend_db_fields( $admin_fields );

		update_option( 'xoo_aff_fields', json_encode( $frontend_fields ) ); //Save frontend fields
		update_option( 'xoo_aff_admin_fields', json_encode( $admin_fields ) ); //Save admin fields
	}


	//Organize fields for front end use
	public function frontend_db_fields( $fields = array() ){
		//Sanitize & reformat data for users
		foreach ( $fields as $field_id => $field_data ) {
			$type_id = $field_data['type'];
			$type = self::$types[ $type_id ]['type'];
			$fields[ $field_id ][ 'type' ] = $type;

			//Sanitize values
			foreach ( $field_data['settings'] as $setting_id => $setting_value ) {
				$fields[ $field_id ]['settings'][ $setting_id ] = $fields[ $field_id ]['settings'][ $setting_id ];
			}
		}
		return $fields;
	}

	//Print variables to javascript
	public function release_variables(){
		?>
		<script type="text/javascript">
			var xoo_aff_fields_layout 	= <?php echo json_encode( self::$settings ); ?>;
			var xoo_aff_field_types 	= <?php echo json_encode( self::$types ); ?>;
			var xoo_aff_field_sections 	= <?php echo json_encode( self::$sections ); ?>;

			<?php if( !empty( self::get_db_fields() ) ): ?>
				var xoo_aff_db_fields	= <?php echo self::get_db_fields(); ?>;
			<?php endif; ?>

		</script>
		<?php
	}

	public function set_default_field_settings(){

		$settings = array(
			'xoo_aff_text' => array(
				'basic' 	=> array( 'active', 'required', 'show_label', 'label_text', 'cols', 'default', 'iconpicker', 'placeholder', 'min_char', 'max_char'),
				'advanced'  => array( 'unique_id', 'class' )
			),
			'xoo_aff_number' => array(
				'basic' 	=> array( 'active', 'required', 'show_label', 'label_text', 'cols', 'default', 'iconpicker', 'placeholder', 'min_char', 'max_char'),
				'advanced'  => array( 'unique_id', 'class' )
			),
			'xoo_aff_date' 	=> array(
				'basic' 	=> array(
					'active',
					'required',
					'show_label',
					'label_text',
					'cols',
					'default' => array(
						'type' => 'date'
					), 
					'iconpicker',
					'placeholder', 
					'date_format'
				),
				'advanced'  => array( 'unique_id', 'class' )
			),
			'xoo_aff_checkbox_single' => array(
				'basic' 	=> array( 'active', 'show_label', 'cols', 'label_text', 'checkbox_single' ),
				'advanced'  => array( 'unique_id', 'class' )
			),
			'xoo_aff_checkbox_list' => array(
				'basic' 	=> array( 'active', 'show_label', 'cols', 'label_text', 'checkbox_list' ),
				'advanced'  => array( 'unique_id', 'class' )
			),

			'xoo_aff_radio' => array(
				'basic' 	=> array( 'active', 'show_label', 'cols', 'label_text', 'radio' ),
				'advanced'  => array( 'unique_id', 'class' )
			),

			'xoo_aff_select_list' => array(
				'basic' 	=> array( 'active', 'required', 'show_label',  'label_text', 'cols', 'iconpicker', 'placeholder', 'select_list' ),
				'advanced'  => array( 'unique_id', 'class' )
			),

			'xoo_aff_email' => array(
				'basic' 	=> array( 'active', 'required', 'show_label', 'label_text', 'cols', 'iconpicker', 'placeholder'),
				'advanced'  => array( 'unique_id', 'class' )
			),
			
		);

		$settings = apply_filters( 'xoo_aff_set_default_field_setting', $settings );

		self::use_default_field_settings( $settings );

	}


	//Add default field settings
	public static function use_default_field_settings( $get_settings = array() ){

		if( empty( $get_settings ) ) return;

		$default_settings = self::$default_field_settings;

		foreach ( $get_settings as $type_id => $settings_data ) {

			if( !isset( self::$types[ $type_id ] ) ) continue;

			foreach ( $settings_data as $section_id => $settings_id ) {
				if( !isset( self::$sections[ $section_id ] ) ) continue;

				foreach ( $settings_id as $setting_id => $setting ) {

					//Check if value is passed
					if( is_integer( $setting_id ) ){
						$setting_id = $setting;
						$setting = array();
					}
	
					if( !isset( $default_settings[ $setting_id ] ) ) continue;

					$setting = wp_parse_args(
						$setting,
						$default_settings[$setting_id]
					);

					self::add_setting( $setting['id'],  $setting['type'], $section_id, $type_id, $setting['title'], $setting );

				}
			}

		}

	}


	//Add default field types
	public function set_default_field_types(){
		$types = array(
			//array( 'id', 'type', Title', extra args = array() )
			array( 'xoo_aff_text', 'text', 'Text' ),
			array( 'xoo_aff_number', 'number', 'Number' ),
			array( 'xoo_aff_date', 'date', 'Date' ),
			array( 'xoo_aff_checkbox_single', 'checkbox_single', 'Checkbox' ),
			array( 'xoo_aff_checkbox_list', 'checkbox_list', 'Checkbox List' ),
			array( 'xoo_aff_radio', 'radio', 'Radio List' ),
			array( 'xoo_aff_select_list', 'select_list', 'Select' ),
			array( 'xoo_aff_email', 'email', 'Email' ),
		);

		foreach ( $types as $type ) {
			$args = isset( $type[3] ) ? $type[3] : array();
			self::add_type( $type[0], $type[1], $type[2], $args );
		}
	}

	//Set default field sections
	public function set_default_field_sections(){

		self::add_section( 'basic', 'Basic Settings', array(
			'priority' => 10
		) );
		self::add_section( 'advanced', 'Advanced Settings', array(
			'priority' => 20
		) );
	}

	//Add default fields
	public static function add_predefined_field_value( $field_id, $field_type, $settings  ){

		if( !isset( self::$types[ $field_type ] ) || empty( $settings ) ) return; // Return if field type doesn't exist

		self::$predefined_fields[ $field_id ] = array(
			'type' 		=> $field_type,
			'settings' 	=> $settings
		) ;

	}
}

function xoo_aff_fields(){
	return Xoo_Aff_Fields::get_instance();
}
?>