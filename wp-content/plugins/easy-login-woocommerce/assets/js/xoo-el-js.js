jQuery(document).ready(function($){

	//Return if form is not available in the DOM
	var popup_container = $('.xoo-el-container');
	if(popup_container.length  === 0){
		return false;
	}


	var spinner = '<i class="fa fa-circle-o-notch spinner fa-spin" aria-hidden="true"></i>',
		el_notice = $('.xoo-el-notice');


	//Opens popup
	var open_popup = function(){
		$('html, body , .xoo-el-container').addClass('xoo-el-popup-active');
	}

	//Close popup
	var close_popup = function(e){
		$.each(e.target.classList,function(key,value){
			if(value == 'xoo-el-modal' || value == 'xoo-el-close'){
				$('html, body , .xoo-el-container').removeClass('xoo-el-popup-active');
				clear_notice();
				return false;
			}
		})
	}

	$('.xoo-el-modal').on('click',close_popup);

	//Show notice
	var show_notice = function( notice, notice_type, $context ){
		notice_type = !notice_type ? 'success' : notice_type;
		$context 	= !$context ? $('body') : $context;
		var notice_string = typeof notice == 'object' ? '<span>'+notice.join('<br>')+'</span>' : '<span>'+notice+'</span>';
		var notice_class  = notice_type == 'error' ? 'xoo-el-notice-error' : 'xoo-el-notice-success';
		$context.find('.xoo-el-notice').html(notice_string)
			.addClass(notice_class);
	}

	var clear_notice = function(){
		if( el_notice.hasClass('xoo-el-lla-notice') ){
			return;
		}
		el_notice.attr('class','xoo-el-notice').html('');
		$('.xoo-el-lostpw-success').remove();
		$('form.xoo-el-action-form').show();
	}


	/* 
		Handles form interaction
	*/

	var formHandler = {

		init: function(){

			this.switch_form_to = this.switch_form_to.bind(this);
			this.submit_form 	= this.submit_form.bind(this);

			//Switch form
			$(document).on('click','.xoo-el-login-tgr , .xoo-el-reg-tgr , .xoo-el-lostpw-tgr',this.switch_form_to);
			//Submit form
			$(document).on('submit','.xoo-el-action-form',this.submit_form);

			formHandler.validation.init();

		},


		$formCont: function($target){
			if( $target.parents('.xoo-el-form-inline').length > 0 ){
				return $target.parents('.xoo-el-form-inline');
			}
			else{
				return $('.xoo-el-form-popup');
			}
		},

		//Navigate to different parts of form Login/Register/Lost Password
		switch_form_to: function(eventObj){

			var $target = $(eventObj.currentTarget),
				$formCont 	= formHandler.$formCont( $target ),
				activeForm;

			if(!$target || $target.is('.xoo-el-login-tgr')){
				activeForm = 'xoo-el-login-ph';
			}

			else if($target.is('.xoo-el-reg-tgr')){
				activeForm = 'xoo-el-register-ph';
			}

			else if($target.is('.xoo-el-lostpw-tgr')){
				activeForm = 'xoo-el-lostpw-ph';
			}

			$.each( ['xoo-el-login-ph','xoo-el-register-ph','xoo-el-lostpw-ph'], function(index,class_name){
				$formCont.find('.'+class_name).removeClass('xoo-el-active');
			} )
			$formCont.find('.'+activeForm).addClass('xoo-el-active');

			if( $formCont.hasClass('xoo-el-form-popup') ){
				open_popup();
			}
			clear_notice();
		},


		submit_form: function(eventObj){

			eventObj.preventDefault();
			clear_notice();

			var $target 	= $(eventObj.currentTarget),
				$formCont 	= formHandler.$formCont( $target ),
				$form 		= $target,
				form_type 	= $form.find('input[name=_xoo_el_form]').val();


			if( !form_type ) return;

			var errors = formHandler.validation.validate( $form, form_type );

			if(errors.length !== 0){
				show_notice(errors,'error', $formCont);
				return;
			}

			this.perform_action($form)

		},

		perform_action: function($form){

			var $button 	= $form.find('.xoo-el-action-btn'),
				old_btn_txt = $button.text(),
				$section 	= $form.parents('.xoo-el-section'),
				$notice_el	= $form.parents('.xoo-el-fields').find('.xoo-el-notice');

			$button.html(spinner).addClass('xoo-el-processing');

			var form_data = $form.serialize()+'&action=xoo_el_form_action';

			$.ajax({
				url: xoo_el_localize.adminurl,
				type: 'POST',
				data: form_data,
				success: function(response){
				
					$button.removeClass('xoo-el-processing').html(old_btn_txt);
					if(response.notice){
						$notice_el.html(response.notice).show();
					}else{
						console.log(response);
					}

					if(response.error == 1){ //has errors

						if(response.error_code){
							if( response.error_code === 'xoo-uv-verify-notice-first'){
								$form.hide().trigger('reset');
							}							
						}	
	

					}else{
						var redirect = true;
						if($button.hasClass('xoo-el-lostpw-btn')){
							$form.hide();
							redirect = false;
						}
						
						if(redirect){
							//Redirect
							setTimeout(function(){
								window.location = response.redirect;
							},300);
						}	
					}
				}
			})
		},


		validation: {

			errors: [],

			init: function(){

			},

			validate: function( $form, validate_type){

				if(typeof this[ validate_type] !== 'function'){
					console.log(validate_type + ' is not a valid input form type.');
					return;
				}
				this[validate_type]( $form );
				return this.getErrors();
			},


			setError: function(error){
				this.errors.push(error);
			},


			getErrors: function(){
				var saveErrors = this.errors;
				this.errors = []; //clear
				return saveErrors;
			},


			checkLength: function(input_el,length){
				return length > input_el.val().trim().length;
			},


			login: function($form){

				var username = $form.find('#xoo-el-username'),
					password = $form.find('#xoo-el-password');

				//Both fields empty
				if(this.checkLength(username,1) || this.checkLength(password,1)){
					this.setError(xoo_el_localize.strings.errors.login.empty);
				}
			},


			register: function($form){

				var password 		= $form.find('#xoo_el_reg_pass'),
					password_again 	= $form.find('#xoo_el_reg_pass_again'),
					strings 		= xoo_el_localize.strings.errors.register;


				//Password must be minimum 6 characters.
				if(this.checkLength(password,6)){
					this.setError(strings.min_password);
				}
				else{//Passwords don't match
					if( password_again.length > 0 && password.val() !== password_again.val()){
						this.setError(strings.match_password);
					}
				}
			},

			lostPassword: function($form){

				var email_user = $form.find('#xoo-el-lostpw-email');

				if(this.checkLength(email_user,1)){
					this.setError(xoo_el_localize.strings.errors.register.valid_email);
				}
				
			},
		}
	}



	//Initialize form handler
	formHandler.init();

});
