<?php

//http://code.tutsplus.com/tutorials/how-to-create-custom-wordpress-writemeta-boxes--wp-20336



// CREATE

add_action( 'add_meta_boxes', 'product_options_meta_box_add' );

function product_options_meta_box_add()
{
    add_meta_box( 'product_options_meta_box', esc_html__("Product Options","shopkeeper"), 'product_options_meta_box_content', 'product', 'side', 'high' );
}

function product_options_meta_box_content()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    $page_product_layout = isset($values['page_product_layout']) ? esc_attr( $values['page_product_layout'][0]) : '';
    $page_product_youtube = isset($values['page_product_youtube']) ? esc_attr( $values['page_product_youtube'][0]) : '';
    $check = isset($values['product_full_screen_description_meta_box_check']) ? esc_attr($values['product_full_screen_description_meta_box_check'][0]) : 'off';
    ?>

    <p><strong>Layout</strong></p>

    <p>
        <select name="page_product_layout" id="page_product_layout" style="width:100%">
            <option value="inherit" <?php selected( $page_product_layout, 'inherit' ); ?>>Inherit</option>
            <option value="default" <?php selected( $page_product_layout, 'default' ); ?>>Default</option>
            <option value="style_2" <?php selected( $page_product_layout, 'style_2' ); ?>>Style 2</option>
            <option value="style_3" <?php selected( $page_product_layout, 'style_3' ); ?>>Style 3</option>
            <option value="style_4" <?php selected( $page_product_layout, 'style_4' ); ?>>Style 4</option>
        </select>
    </p>

    <p><strong>Youtube Video</strong></p>

    <p>
        <input type="text" id="page_product_youtube" name="page_product_youtube" value="<?php echo esc_attr( $page_product_youtube ); ?>" style="width:100%">
    </p>
         
    <p>
        <input type="checkbox" id="product_full_screen_description_meta_box_check" name="product_full_screen_description_meta_box_check" <?php checked( $check, 'on' ); ?> />
        <label for="product_full_screen_description_meta_box_check"><?php esc_html_e("Fullscreen Description", "shopkeeper"); ?></label>
    </p>
    
    <?php
	
	// We'll use this nonce field later on when saving.
    wp_nonce_field( 'product_options_meta_box', 'product_options_meta_box_nonce' );
}




// SAVE

add_action( 'save_post', 'product_options_meta_box_save' );

function product_options_meta_box_save($post_id)
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['product_options_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['product_options_meta_box_nonce'], 'product_options_meta_box' ) ) return;
     
    // if our current user can't edit this post, bail
    if ( !current_user_can( 'edit_post', $post_id ) ) return;

    if( isset( $_POST['page_product_layout'] ) )
    update_post_meta( $post_id, 'page_product_layout', esc_attr( $_POST['page_product_layout'] ) );

    if( isset( $_POST['page_product_youtube'] ) )
    update_post_meta( $post_id, 'page_product_youtube', esc_attr( $_POST['page_product_youtube'] ) );

    $chk = isset($_POST['product_full_screen_description_meta_box_check']) ? 'on' : 'off';
    update_post_meta( $post_id, 'product_full_screen_description_meta_box_check', $chk );
}