<?php
/* banner-php */

if ( post_password_required() )
    return;
?>
<?php if ( have_comments() ) : ?>
<div id="comments" class="post-comments-wrap single-post-comm">
    <h6 id="comments-title"><?php
		printf( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments_num_title', 'balkon' ),
			number_format_i18n( get_comments_number() ), get_the_title() );
	?></h6>
    
	<?php 
	$args = array(
		'walker'            => null,
		'max_depth'         => '',
		'style'             => 'li',
		'callback'          => 'balkon_comments',
		'end-callback'      => null,
		'type'              => 'all',
		'reply_text'        => esc_html__('Reply','balkon'),
		'page'              => '',
		'per_page'          => '',
		'avatar_size'       => 50,
		'reverse_top_level' => null,
		'reverse_children'  => '',
		'format'            => 'html5', //or xhtml if no HTML5 theme support
		'short_ping'        => false, // @since 3.6,
	    'echo'     			=> true, // boolean, default is true
	);
	?>

    <ul class="commentlist clearfix">
        <?php wp_list_comments($args);?>
    </ul>
    <?php
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<div class="comments-nav">
		<ul class="pager clearfix">
			<li class="previous"><?php previous_comments_link( wp_kses(__( '<i class="fa fa-angle-double-left"></i> Previous Comments', 'balkon' ), array('i'=>array('class'=>array())) ) ); ?></li>
			<li class="next"><?php next_comments_link( wp_kses(__( 'Next Comments <i class="fa fa-angle-double-right"></i>', 'balkon' ), array('i'=>array('class'=>array())) ) ); ?></li>
		</ul>
	</div>
	<?php endif; // Check for comment navigation ?>

  	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'balkon' ); ?></p>
	<?php endif; ?>
</div>
<div class="clearfix"></div>
<?php endif; ?>


<?php if(comments_open( )) : ?>
        <div class="comment-reply-form clearfix">

        	<?php
        		$commenter = wp_get_current_commenter();
        		$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true'" : '' );
				$char_req = ( $req ? '<span class="required">*</span>' : '' );

				$comment_args = array(
				'title_reply'=> esc_html__('Leave A Comment','balkon'),
				'fields' => apply_filters( 'comment_form_default_fields', 
				array(
						'author' => '<p class="comment-form-author"><label class="control-label" for="author">'.esc_html__('Name ','balkon'). $char_req .'</label><input type="text" id="author" name="author"  value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' size="40"></p>',
						'email' =>'<p class="comment-form-email"><label class="control-label" for="email">'.esc_html__('Email ','balkon'). $char_req .'</label><input id="email" name="email" type="email"  value="' . esc_attr(  $commenter['comment_author_email'] ) .'" ' . $aria_req . ' size="40"></p>',
						'url' =>'<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'balkon' ) . '</label>' .'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="30" /></p>',
						) 
					),
				'comment_field' => '<p class="comment-form-comment"><textarea   id="comment" cols="50" rows="8" name="comment"  '.$aria_req.'></textarea></p>',
				'id_form'=>'commentform',
				'id_submit' => 'submit',
				'class_submit'=>'submit',
				'label_submit' => esc_html__('Post Comment','balkon'),
				'must_log_in'=> '<p class="not-empty">' .  sprintf( wp_kses(__( 'You must be <a href="%s">logged in</a> to post a comment.' ,'balkon'),array('a'=>array('href'=>array(),'title'=>array(),'target'=>array())) ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				'logged_in_as' => '<p class="not-empty">' . sprintf( wp_kses(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','balkon' ),array('a'=>array('href'=>array(),'title'=>array(),'target'=>array())) ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				'comment_notes_before' => '<p class="text-center">'.esc_html__('Your email is safe with us.','balkon').'</p>',
				'comment_notes_after' => '',
				);
			?>
			<?php comment_form($comment_args); ?>
        </div>


<?php endif;?>