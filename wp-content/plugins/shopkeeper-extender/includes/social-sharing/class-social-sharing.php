<?php

if ( ! class_exists( 'SKSocialSharing' ) ) :

	/**
	 * SKSocialSharing class.
	 *
	 * @since 1.4.2
	*/
	class SKSocialSharing {

		/**
		 * The single instance of the class.
		 *
		 * @since 1.4.2
		 * @var SKSocialSharing
		*/
		protected static $_instance = null;

		/**
		 * SKSocialSharing constructor.
		 *
		 * @since 1.4.2
		*/
		public function __construct() {

			if( !get_option( 'sk_social_sharing_options_import', false ) ) {
				$done_import = $this->import_options();
				update_option( 'sk_social_sharing_options_import', true );
			}

			$this->enqueue_styles();
			$this->customizer_options();

			if ( get_option( 'sk_sharing_options', 'yes' ) == 'yes' ) {
				add_filter( 'getbowtied_woocommerce_before_single_product_summary_data_tabs', array( $this, 'getbowtied_single_share_product' ), 50 );
			}
		}

		/**
		 * Ensures only one instance of SKSocialSharing is loaded or can be loaded.
		 *
		 * @since 1.4.2
		 *
		 * @return SKSocialSharing
		*/
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Enqueue styles.
		 *
		 * @since 1.4.2
		 * @return void
		*/
		protected function enqueue_styles() {
			add_action( 'wp_enqueue_scripts', function() {
				wp_enqueue_style('sk-social-sharing-styles', plugins_url( 'assets/css/social-sharing.css', __FILE__ ), NULL );
			});
		}

		/**
		 * Imports social sharing options stored as theme mods into the options WP table.
		 *
		 * @since 1.4.2
		 * @return void
		 */
		private function import_options() {

			$sharing_option = get_theme_mod( 'sharing_options', true ) ? 'yes' : 'no';
			update_option( 'sk_sharing_options', $sharing_option );
		}

		/**
		 * Registers customizer options.
		 *
		 * @since 1.4.2
		 * @return void
		 */
		protected function customizer_options() {
			add_action( 'customize_register', array( $this, 'sk_social_sharing_customizer' ) );
		}

		/**
		 * Creates customizer options.
		 *
		 * @since 1.4.2
		 * @return void
		 */
		public function sk_social_sharing_customizer( $wp_customize ) {

			$wp_customize->add_setting( 'sk_sharing_options', array(
				'type'		 			=> 'option',
				'capability' 			=> 'manage_options',
				'sanitize_callback'    	=> 'sk_bool_to_string',
				'sanitize_js_callback' 	=> 'sk_string_to_bool',
				'default'	 			=> 'yes',
			) );

			$wp_customize->add_control( 
				new WP_SK_Customize_Toggle_Control(
					$wp_customize,
					'sk_sharing_options',
					array( 
						'label'       	=> esc_attr__( 'Social Sharing Options', 'shopkeeper-extender' ),
						'section'     	=> 'product',
						'priority'    	=> 20,
					)
				)
			);
		}

		public function getbowtied_single_share_product() {

		    global $post, $product;

			$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false, '');
			
			?>

		    <div class="product_socials_wrapper show-share-text-on-mobiles">

				<div class="share-product-text">
					<?php _e( 'Share this product', 'shopkeeper-extender'); ?>
				</div>

				<div class="product_socials_wrapper_inner">

					<a href="//www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" 
						target="_blank" 
						class="social_media social_media_facebook">
						<svg 
                    		xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
							width="16" height="16"
							viewBox="0 0 50 50">    
							<path d="M32,11h5c0.552,0,1-0.448,1-1V3.263c0-0.524-0.403-0.96-0.925-0.997C35.484,2.153,32.376,2,30.141,2C24,2,20,5.68,20,12.368 V19h-7c-0.552,0-1,0.448-1,1v7c0,0.552,0.448,1,1,1h7v19c0,0.552,0.448,1,1,1h7c0.552,0,1-0.448,1-1V28h7.222 c0.51,0,0.938-0.383,0.994-0.89l0.778-7C38.06,19.518,37.596,19,37,19h-8v-5C29,12.343,30.343,11,32,11z"></path>
						</svg>
					</a>

					<a href="//twitter.com/share?url=<?php the_permalink(); ?>" 
						target="_blank" 
						class="social_media social_media_twitter">
						<svg 
                    		xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
							width="16" height="16"
							viewBox="0 0 50 50">    
							<path d="M 50.0625 10.4375 C 48.214844 11.257813 46.234375 11.808594 44.152344 12.058594 C 46.277344 10.785156 47.910156 8.769531 48.675781 6.371094 C 46.691406 7.546875 44.484375 8.402344 42.144531 8.863281 C 40.269531 6.863281 37.597656 5.617188 34.640625 5.617188 C 28.960938 5.617188 24.355469 10.21875 24.355469 15.898438 C 24.355469 16.703125 24.449219 17.488281 24.625 18.242188 C 16.078125 17.8125 8.503906 13.71875 3.429688 7.496094 C 2.542969 9.019531 2.039063 10.785156 2.039063 12.667969 C 2.039063 16.234375 3.851563 19.382813 6.613281 21.230469 C 4.925781 21.175781 3.339844 20.710938 1.953125 19.941406 C 1.953125 19.984375 1.953125 20.027344 1.953125 20.070313 C 1.953125 25.054688 5.5 29.207031 10.199219 30.15625 C 9.339844 30.390625 8.429688 30.515625 7.492188 30.515625 C 6.828125 30.515625 6.183594 30.453125 5.554688 30.328125 C 6.867188 34.410156 10.664063 37.390625 15.160156 37.472656 C 11.644531 40.230469 7.210938 41.871094 2.390625 41.871094 C 1.558594 41.871094 0.742188 41.824219 -0.0585938 41.726563 C 4.488281 44.648438 9.894531 46.347656 15.703125 46.347656 C 34.617188 46.347656 44.960938 30.679688 44.960938 17.09375 C 44.960938 16.648438 44.949219 16.199219 44.933594 15.761719 C 46.941406 14.3125 48.683594 12.5 50.0625 10.4375 Z "></path>
						</svg>
					</a>

					<a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url($src[0]) ?>&amp;description=<?php echo urlencode(get_the_title()); ?>" 
						target="_blank" 
						class="social_media social_media_pinterest">
						<svg 
                    		xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
							width="16" height="16"
							viewBox="0 0 50 50">    
							<path d="M25,2C12.318,2,2,12.317,2,25s10.318,23,23,23s23-10.317,23-23S37.682,2,25,2z M27.542,32.719 c-3.297,0-4.516-2.138-4.516-2.138s-0.588,2.309-1.021,3.95s-0.507,1.665-0.927,2.591c-0.471,1.039-1.626,2.674-1.966,3.177 c-0.271,0.401-0.607,0.735-0.804,0.696c-0.197-0.038-0.197-0.245-0.245-0.678c-0.066-0.595-0.258-2.594-0.166-3.946 c0.06-0.88,0.367-2.371,0.367-2.371l2.225-9.108c-1.368-2.807-0.246-7.192,2.871-7.192c2.211,0,2.79,2.001,2.113,4.406 c-0.301,1.073-1.246,4.082-1.275,4.224c-0.029,0.142-0.099,0.442-0.083,0.738c0,0.878,0.671,2.672,2.995,2.672 c3.744,0,5.517-5.535,5.517-9.237c0-2.977-1.892-6.573-7.416-6.573c-5.628,0-8.732,4.283-8.732,8.214 c0,2.205,0.87,3.091,1.273,3.577c0.328,0.395,0.162,0.774,0.162,0.774l-0.355,1.425c-0.131,0.471-0.552,0.713-1.143,0.368 C15.824,27.948,13,26.752,13,21.649C13,16.42,17.926,11,25.571,11C31.64,11,37,14.817,37,21.001 C37,28.635,32.232,32.719,27.542,32.719z"></path>
						</svg>
					</a>

				</div>

			</div>

		<?php
		}
	}

endif;

$sk_social_sharing = new SKSocialSharing;