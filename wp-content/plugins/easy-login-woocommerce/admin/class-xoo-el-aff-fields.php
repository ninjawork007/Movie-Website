<?php

if( class_exists( 'Xoo_Aff_fields' ) ){

	class Xoo_El_Aff_Fields extends Xoo_Aff_fields {


		public function __construct(){
			add_action( 'xoo_aff_on_field_page', array( $this, 'add_el_predefined_fields' ) );
		}

		public function add_el_predefined_fields(){
			$this->predefined_field_username();
			$this->predefined_field_useremail();
			$this->predefined_field_firstname();
			$this->predefined_field_lastname();
			$this->predefined_field_userpassword();
			$this->predefined_field_userpasswordagain();
			$this->predefined_field_terms();
		}


		public function predefined_field_username(){

			parent::add_type(
				'xoo_el_reg_username',
				'text',
				'User Name',
				array(
					'can_delete' => 'no',
					'is_selectable' => 'no'
				)
			);
				
			$settings = array(
				'xoo_el_reg_username' => array(
					'basic' => array(
						'active' => array(
							'value' => 'no'
						),
						'show_label',
						'label_text',
						'cols',
						'iconpicker' => array(
							'value' => 'fas fa-user-plus'
						),
						'placeholder' => array(
							'value' => 'Username',
						),
					),
					'advanced' => array(
						'unique_id' => array(
							'disabled' => 'disabled',
						),
						'class'
					)
				)
			);

			parent::use_default_field_settings( $settings );

			parent::add_predefined_field_value( 'xoo_el_reg_username', 'xoo_el_reg_username', array(
				'uniqueid' 	=> 'xoo_el_reg_username',
				'required' 	=> 'yes',
			) );

		}
		
		public function predefined_field_useremail(){

			parent::add_type(
				'xoo_el_reg_email',
				'email',
				'User Email',
				array(
					'can_delete' => 'no',
					'is_selectable' => 'no'
				)
			);

			$settings = array(
				'xoo_el_reg_email' => array(
					'basic' => array(
						'show_label',
						'label_text',
						'cols',
						'iconpicker' => array(
							'value' => 'fas fa-at'
						),
						'placeholder' => array(
							'value' => 'Email',
						),
					),
					'advanced' => array(
						'unique_id' => array(
							'disabled' => 'disabled',
						),
						'class'
					)
				)
			);

			parent::use_default_field_settings( $settings );

			parent::add_predefined_field_value( 'xoo_el_reg_email', 'xoo_el_reg_email', array(
				'active' 	=> 'yes',
				'required' 	=> 'yes',
				'uniqueid' => 'xoo_el_reg_email',
			) );

		}

		public function predefined_field_userpassword(){

			parent::add_type(
				'xoo_el_reg_pass',
				'password',
				'Password',
				array(
					'can_delete' => 'no',
					'is_selectable' => 'no'
				)
			);

			$settings = array(
				'xoo_el_reg_pass' => array(
					'basic' => array(
						'show_label',
						'label_text',
						'cols',
						'iconpicker' => array(
							'value' => 'fas fa-key'
						),
						'placeholder' => array(
							'value' => 'Password',
						),
					),
					'advanced'  => array(
						'unique_id' => array(
							'disabled' => 'disabled',
						),
						'class'
					)
				)
			);

			parent::use_default_field_settings( $settings );

			parent::add_predefined_field_value( 'xoo_el_reg_pass', 'xoo_el_reg_pass', array(
				'active' 	=> 'yes',
				'required' 	=> 'yes',
				'uniqueid' => 'xoo_el_reg_pass',
			) );

		}

		public function predefined_field_userpasswordagain(){

			parent::add_type(
				'xoo_el_reg_pass_again',
				'password',
				'Confirm Password',
				array(
					'can_delete' => 'no',
					'is_selectable' => 'no'
				)
			);

			$settings = array(
				'xoo_el_reg_pass_again' => array(
					'basic' => array(
						'active',
						'show_label',
						'label_text',
						'cols',
						'iconpicker' => array(
							'value' => 'fas fa-key'
						),
						'placeholder' => array(
							'value' => 'Confirm Password',
						),
					),
					'advanced'  => array(
						'unique_id' => array(	
							'disabled' => 'disabled',
						),
						'class'
					)
				)
			);

			parent::use_default_field_settings( $settings );

			parent::add_predefined_field_value( 'xoo_el_reg_pass_again', 'xoo_el_reg_pass_again', array(
				'required' 	=> 'yes',
				'uniqueid' => 'xoo_el_reg_pass_again',
			) );

		}


		public function predefined_field_firstname(){

			parent::add_type(
				'xoo_el_reg_fname',
				'text',
				'First Name',
				array(
					'can_delete' => 'no',
					'is_selectable' => 'no'
				)
			);

			$settings = array(
				'xoo_el_reg_fname' => array(
					'basic' => array(
						'active',
						'required' => array(				
							'value' => 'yes'
						),
						'show_label',
						'label_text',
						'cols' => array(
							'value' => 'onehalf'
						),
						'iconpicker' => array(
							'value' => 'far fa-user'
						),
						'placeholder' => array(
							'value' => 'First Name',
						),
						'min_char',
						'max_char'
					),
					'advanced'  => array(
						'unique_id' => array(
							'disabled' => 'disabled',
						),
						'class'
					)
				)
			);

			parent::use_default_field_settings( $settings );

			parent::add_predefined_field_value( 'xoo_el_reg_fname', 'xoo_el_reg_fname', array(
				'uniqueid' => 'xoo_el_reg_fname',
			) );

		}


		public function predefined_field_lastname(){

			parent::add_type(
				'xoo_el_reg_lname',
				'text',
				'Last Name',
				array(
					'can_delete' => 'no',
					'is_selectable' => 'no'
				)
			);

			$settings = array(
				'xoo_el_reg_lname' => array(
					'basic' => array(
						'active',
						'required' => array(
							'value' => 'yes'
						),
						'show_label',
						'label_text',
						'cols' => array(
							'value' => 'onehalf'
						),
						'iconpicker' => array(
							'value' => 'far fa-user'
						),
						'placeholder' => array(
							'value' => 'Last Name',
						),
						'min_char',
						'max_char'
					),
					'advanced'  => array(
						'unique_id' => array(
							'disabled' => 'disabled',
						),
						'class'
					)
				)
			);

			parent::use_default_field_settings( $settings );

			parent::add_predefined_field_value( 'xoo_el_reg_lname', 'xoo_el_reg_lname', array(
				'uniqueid' => 'xoo_el_reg_lname',
			) );

		}


		public function predefined_field_terms(){

			parent::add_type(
				'xoo_el_reg_terms',
				'checkbox_single',
				'Terms & Conditions',
				array(
					'can_delete' => 'no',
					'is_selectable' => 'no'
				)
			);

			$settings = array(
				'xoo_el_reg_terms' => array(
					'basic' => array(
						'active',
						'required' => array(
							'value' => 'yes'
						),
						'show_label',
						'label_text',
						'cols',
						'checkbox_single' => array(
							'value' 	=>array(
								'value' 	=> 'yes',
								'label' 	=> 'I accept the Terms of Service and Privacy Policy',
								'checked' 	=> false
							)
						),
					),
					'advanced'  => array(
						'unique_id' => array(
							'disabled' => 'disabled',
						),
						'class'
					)
				)
			);

			parent::use_default_field_settings( $settings );

			parent::add_predefined_field_value( 'xoo_el_reg_terms', 'xoo_el_reg_terms', array(
				'uniqueid' => 'xoo_el_reg_terms',
			) );

		}


	}

}

new Xoo_El_Aff_Fields();
?>