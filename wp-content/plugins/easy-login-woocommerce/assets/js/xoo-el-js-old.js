jQuery(document).ready(function($){

	$(document).on('submit','.xoo-el-action-form',function(e){
		console.log(this);
		e.preventDefault();
		alert('WTF');
	})
	
	var $popup_container = $('.xoo-el-container');
	if($popup_container.length  === 0){
		return;
	}

	var spinner = '<i class="fa fa-circle-o-notch spinner fa-spin" aria-hidden="true"></i>',
		el_notice = $('.xoo-el-notice'),
		action_btn = $('.xoo-el-action-btn');


	var class_notice = 'xoo-el-notice',
		class_active = 'xoo-el-active';


	//Switch forms
	function switch_form_to(name){
		var section;
		switch (name){
			case 'login':
				section = 'xoo-el-section-login';
				break;

			case 'register':
				section = 'xoo-el-section-register';
				break;

			case 'lost-password':
				section = 'xoo-el-section-lostpw';
				break;

			default:
				section = 'xoo-el-section-login';
				break;
		}
		
		$('.xoo-el-section').removeClass('xoo-el-active');
		$('.'+section).addClass(class_active);
		open_popup();
		clear_notice();
	}

	//Switch to login
	$(document).on('click','.xoo-el-login-tgr',function(){
		switch_form_to('login');
	})

	//Switch to register
	$(document).on('click','.xoo-el-reg-tgr',function(){
		switch_form_to('register');
	})

	//Switch to password
	$(document).on('click','.xoo-el-lostpw-tgr',function(){
		switch_form_to('lost-password');
	})



	//Login button clicked
	$(document).on('click','.xoo-el-login-btn',function($){

	});

	/*//Ajax Registration / Login
	$('.xoo-el-action-btn').on('click',function(e){
		e.preventDefault();

		clear_notice();

		var _this = $(this),
			$form = _this.parents('form'),
			errors;
		
		//Login Validation
		if(_this.hasClass('xoo-el-login-btn')){
			errors = login_validation();
		}
		
		else if(_this.hasClass('xoo-el-register-btn')){
			errors = registration_validation();
		}

		else if(_this.hasClass('xoo-el-lostpw-btn')){
			errors = lost_password_validation();
		}


		if(errors.length !== 0){
			show_notice(errors,'error');
			return;
		}

		var form_data = $form.serialize()+'&action=xoo_el_form_action';

		action_ajax_request(form_data,_this);
		
		
	});*/


	function login_validation(){
		var error = [];
		//Login Validation
		if($('#xoo-el-username').val().trim().length === 0 || $('#xoo-el-password').val().trim().length === 0){
			error.push('Please fill both the fields.');
		}
		return error;
	}

	function registration_validation(){

		var error = [];

		if(/\S+@\S+\.\S+/.test($('#xoo-el-reg-email').val()) === false){
			error.push('Enter valid email address.');
		}

		if($('#xoo-el-reg-password').val().length < 6){
			error.push('Password must be minimum 6 characters.');
		}else{
			if($('#xoo-el-reg-password').val() != $('#xoo-el-reg-confirm-password').val()){
				error.push("Passwords don't match");
			}
		}

		if($('#xoo-el-reg-fname').length != 0){
			if($('#xoo-el-reg-fname').val().trim().length < 3){
				error.push('First name must be minimum 3 characters.');
			}
			if($('#xoo-el-reg-lname').val().trim().length < 3){
				error.push('Last name must be minimum 3 characters.');
			}
		}

		/*if(/^\d{10}$/.test($('#reg_username',form).val()) === false){
			error.push('Mobile number must be 10 digits.');
		}*/


		return error;
	}

	function lost_password_validation(){
		var error = [];
		if($('#xoo-el-lostpw-email').val().trim().length === 0){
			error.push('Please enter valid Email');
		}
		return error;
	}



	//Send request to sever on form action
	function action_ajax_request(form_data,button){

		var old_btn_txt = button.text(); 
		button.html(spinner).addClass('xoo-el-processing');

		$.ajax({
			url: xoo_el_localize.adminurl,
			type: 'POST',
			data: form_data,
			success: function(response){
				button.removeClass('xoo-el-processing').html(old_btn_txt);

				if(response.error == 1){ //has errors
					show_notice(response.notice,'error');
				}
				else{
					if(button.hasClass('xoo-el-lostpw-btn')){
						button.parents('.xoo-el-action-form').hide();
						button.parents('.xoo-el-fields').append(response.notice);
					}
					else{
						show_notice(response.notice,'success');
						setTimeout(function(){
							window.location = response.redirect;
						},300)
					}
				}
			}
		})
	}


	//Show notice
	function show_notice(notice,notice_type){
		var notice_string = typeof notice == 'object' ? '<span>'+notice.join('<br>')+'</span>' : '<span>'+notice+'</span>';
		var notice_class  = notice_type == 'error' ? 'xoo-el-notice-error' : 'xoo-el-notice-success';
		el_notice.html(notice_string)
			.addClass(notice_class)
			.addClass(class_active);
	}

	//reset notice class
	function clear_notice(){
		el_notice.attr('class',class_notice).html('');
		$('.xoo-el-lostpw-success').remove();
		$('form.xoo-el-action-form').show();
	}

	//Close popup
	function close_popup(e){
		$.each(e.target.classList,function(key,value){
			if(value == 'xoo-el-modal' || value == 'xoo-el-close'){
				$('body , .xoo-el-container').removeClass('xoo-el-popup-active');
				clear_notice();
				return false;
			}
		})
	}

	//open popup
	function open_popup(){
		$('body , .xoo-el-container').addClass('xoo-el-popup-active');
	}


	$('.xoo-el-modal').click(function(e){
		close_popup(e);
	})


})

