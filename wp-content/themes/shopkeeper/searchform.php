<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">    
    <label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'shopkeeper' ); ?></label>
    <input type="search" class="search-field" placeholder="<?php esc_html_e( 'Search &hellip;', 'shopkeeper' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
    <input type="submit" class="search-submit" value="<?php esc_html_e( 'Search', 'shopkeeper' ); ?>">
</form>