<?php
if ( post_password_required() )
	return;
?>

<div class="comments_section">

<div class="row">

    <div class="xlarge-6 large-8 xlarge-centered large-centered columns without-sidebar">

        <div id="comments" class="comments-area">

            <?php if ( have_comments() ) : ?>
                <h2 class="comments-title">
                    <?php
                        printf( _n( 'One reply on “%2$s“', '%1$s replies on “%2$s“', get_comments_number(), 'shopkeeper' ),
                            number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
                    ?>
                </h2>

                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
                    <nav id="comment-nav-above" class="comment-navigation" role="navigation">
                        <h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'shopkeeper' ); ?></h1>
                        <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'shopkeeper' ) ); ?></div>
                        <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'shopkeeper' ) ); ?></div>
                    </nav>
                <?php endif; // check for comment navigation ?>

                <ul class="comment-list">
                    <?php
                        /* Loop through and list the comments. Tell wp_list_comments()
                         * to use shopkeeper_comment() to format the comments.
                         * If you want to override this in a child theme, then you can
                         * define shopkeeper_comment() and that will be used instead.
                         * See shopkeeper_comment() in inc/template-tags.php for more.
                         */
                        wp_list_comments( array( 'callback' => 'shopkeeper_comment' ) );
                    ?>
                </ul>

                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
                    <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                        <h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'shopkeeper' ); ?></h1>
                        <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'shopkeeper' ) ); ?></div>
                        <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'shopkeeper' ) ); ?></div>
                    </nav><!-- #comment-nav-below -->
                <?php endif; ?>

            <?php endif; ?>

            <?php
                // If comments are closed and there are comments, let's leave a little note, shall we?
                if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
            ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'shopkeeper' ); ?></p>
            <?php endif; ?>


            <?php

            $commenter 	= wp_get_current_commenter();
            $req 		= get_option( 'require_name_email' );
            $aria_req 	= ( $req ? " aria-required='true'" : '' );

            $getbowtied_comment_args = array(

                'title_reply' => esc_html__( 'Leave a Reply', 'shopkeeper' ),

                'fields' => apply_filters( 'comment_form_default_fields', array(

                    'author' 	=> 	'<div class="row"><div class="large-6 columns"><p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'shopkeeper' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p></div>',
                    'email'  	=> 	'<div class="large-6 columns"><p class="comment-form-email"><label for="email">' . esc_html__( 'Email Address', 'shopkeeper' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                                    '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p></div></div>',
                    'url'   	=> 	'<div class="row"><div class="large-12 columns"><p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'shopkeeper' ) . '</label> ' .
                                    '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div></div>'

                )),

                'comment_field' =>	'<div class="row"><div class="large-12 columns"><p>' .
                                    '<label for="comment">' . esc_html__( 'Message', 'shopkeeper' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>' .
                                    '<textarea id="comment" name="comment" cols="45" rows="8" ' . $aria_req . '></textarea>' .
                                    '</p></div></div>',

                'comment_notes_after'  => '',

            );

            echo '<div class="row"><div class="large-12 columns">';

            ob_start();
            comment_form($getbowtied_comment_args);
            $form = ob_get_clean();
            echo str_replace('id="submit"','id="submit" class="button"', $form);

            echo '</div></div>';

            ?>

        </div><!-- #comments -->

    </div><!-- .columns -->
</div><!-- .row -->

</div><!-- .comments_section -->
