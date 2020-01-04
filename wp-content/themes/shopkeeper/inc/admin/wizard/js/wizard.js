jQuery(function($) {

	"use strict";


    function gbt_ajaxCall( data ) {
    	var thisBtn		= $(".wizard-demo-import .install:not(.done-ajax)");

		$.ajax({
			method:      'POST',
			url:         gbtStrings.ajaxurl,
			data:        data,
			contentType: false,
			processData: false,
			beforeSend:  function() {
				$( '.js-ocdi-ajax-loader' ).show();
			}
		})
		.done( function( response ) {
			if ( 'undefined' !== typeof response.status && 'newAJAX' === response.status ) {
				gbt_ajaxCall( data );
			}
			else if ( 'undefined' !== typeof response.status && 'customizerAJAX' === response.status ) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append( 'action', 'ocdi_import_customizer_data' );
				newData.append( 'security', gbtStrings.ajax_nonce );

				gbt_ajaxCall( newData );
			}
			else if ( 'undefined' !== typeof response.status && 'afterAllImportAJAX' === response.status ) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append( 'action', 'ocdi_after_import_data' );
				newData.append( 'security', gbtStrings.ajax_nonce );
				gbt_ajaxCall( newData );
			}
			else if ( 'undefined' !== typeof response.message ) {
				// $( '.js-ocdi-ajax-response' ).append( '<p>' + response.message + '</p>' );
				$( '.js-ocdi-ajax-loader' ).hide();

				thisBtn.removeClass("doing-ajax").addClass("done-ajax").html("Done!");
				var next =thisBtn.attr("href");
				window.location.href=next;

				// Trigger custom event, when OCDI import is complete.
				$( document ).trigger( 'ocdiImportComplete' );
			}
			else {
				$( '.js-ocdi-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>' + response + '</p></div>' );
				$( '.js-ocdi-ajax-loader' ).hide();
				thisBtn.removeClass("doing-ajax").addClass("failed-ajax").html("Try again?");
			}
		})
		.fail( function( error ) {
			$( '.js-ocdi-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>Error: ' + error.statusText + ' (' + error.status + ')' + '</p></div>' );
			$( '.js-ocdi-ajax-loader' ).hide();
			thisBtn.removeClass("doing-ajax").addClass("failed-ajax").html("Try again?");
		});
    }

	/**
	 * Demo import
	 *
	 *
	 */
	$(".wizard-demo-import").on("click", " .install:not(.done-ajax)", function(e) {

		var thisBtn = $(this);
		thisBtn.removeClass("failed-ajax").addClass("doing-ajax").html("Installing...");

		// Prepare data for the AJAX call
		var data = new FormData();
		data.append( 'action', 'ocdi_import_demo_data' );
		data.append( 'security', gbtStrings.ajax_nonce );
		data.append( 'selected', $( '#ocdi__demo-import-files' ).val() );

		// AJAX call to import everything (content, widgets, before/after setup)
		gbt_ajaxCall( data );

		e.preventDefault();
	});


	/**
	 * Plugin install
	 *
	 * 
	 */
	var status = true;

	function parse_plugins( activateFlag = false ) {

		var pluginContainer = $(".plugins .plugin:not(.parsed):first");

		if ( pluginContainer.length > 0 && ( pluginContainer.find("input.checkbox").prop("checked") == true ) ) {

			var pluginBtn = $(pluginContainer).find(".button.ajax-request");

			if (pluginBtn.length > 0) {
				
				pluginContainer.find(".plugin-status").empty().html("<span class=\"state state-loading\"></span>");
				pluginContainer.addClass("loading");

				var url = pluginBtn.attr("href");
				var pluginSlug = pluginBtn.attr("data-plugin");
				var ajaxUrl = pluginBtn.attr("data-verify");
				var action = pluginBtn.attr("data-action");
				var self = pluginBtn;

				var doAction = jQuery.ajax({
					url: url,
			        type: "get"
				});

				let installStatus = '';
				let activationStatus = '';

				doAction.complete(function(e, xhr){ 
					/* Check status after installation */
					$.post(ajaxUrl,
					{
						action	  : "gbt_get_wizard_plugins",
						gbt_plugin: pluginSlug
					},
					function ( rsp ) { 
						/* Was it already installed and just needed activation? */

						pluginContainer.addClass("parsed still-parsing"); // Either way we parsed It

						if ( rsp === true ) {
							status = status && true;
							pluginContainer.removeClass("still-parsing").find(".plugin-status").empty().html("<span class=\"state state-success\"></span>");
							pluginContainer.removeClass("loading");
							parse_plugins(); // recursivity
						} else 	if ( rsp === 'activate' ) {
							/* Is it installed and needs activation? */
							let activateUrl = pluginBtn.attr("data-activateurl");
							let activatePlugin = jQuery.ajax({
								url: activateUrl,
								type: "get"
							});
							/* Try to activate it */
							activatePlugin.complete(function(e, xhr) {
								/* Check if it still needs activation */
								$.post(ajaxUrl,
								{
									action	  : "gbt_get_wizard_plugins",
									gbt_plugin: pluginSlug
								},
								function ( rsp ) { 
									/* It doesn't need activation */
									if ( rsp === true ) {
										// The action was done correctly
										status = status && true;
										pluginContainer.removeClass("still-parsing").find(".plugin-status").empty().html("<span class=\"state state-success\"></span>");
										pluginContainer.removeClass("loading");
									/* It still needs acivation */
									} else {
										status = status && false;
										pluginContainer.addClass("failed-parsing").removeClass('still-parsing').find(".plugin-status").empty().html("<span class=\"state state-error\"></span>");
										pluginContainer.removeClass("loading");

									}
									parse_plugins(); // recursivity
								});
							});
						} else {
							/* It did not install */
							status = status && false;
							pluginContainer.addClass("failed-parsing").removeClass('still-parsing').find(".plugin-status").empty().html("<span class=\"state state-error\"></span>");
							pluginContainer.removeClass("loading");
							parse_plugins(); // recursivity
						}
					});
				});
			} else {
				pluginContainer.addClass("parsed");
				pluginContainer.find(".plugin-status").empty().html("<span class=\"state state-success\"></span>");
				parse_plugins(); // recursivity
			}

		} else {
			if( pluginContainer.find("input.checkbox").prop("checked") == false ) {
				pluginContainer.addClass("parsed");
				parse_plugins(); // recursivity
				return false;
			}

			if ( status === true ) {
					$(".wizard-plugins .install").removeClass("doing-ajax").removeClass("failed-ajax").addClass("done-ajax").html("Done!");
					var next = $(".wizard-plugins .install").attr("href");
					window.location.href=next;
			} else {
				$(".plugins .plugin.failed-parsing").removeClass("parsed").removeClass("failed-parsing");
				$(".wizard-plugins .install").removeClass("doing-ajax").addClass("failed-ajax").html("Try again?");
			}
			return false;
		}
	}

	if( $('div').hasClass('wizard-plugins') ) {
		if (window.performance && window.performance.navigation.type == window.performance.navigation.TYPE_BACK_FORWARD) {
	        location.reload();
	    }
	}

	$(".wizard-plugins").on("click", " .install:not(.done-ajax)", function(e) {
			e.preventDefault();
			$(this).removeClass("failed-ajax").addClass("doing-ajax").html("Installing...");
			status = true;
			parse_plugins();
	});

});
