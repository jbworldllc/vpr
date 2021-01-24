<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$titles = ( isset( $titles ) AND is_array( $titles ) ) ? $titles : array();
$body   = isset( $body ) ? $body : '';

?>
<div class="nba-builder">
    <div class="nba-builder-header">
        <div class="nba-builder-title"<?php echo nba_pass_data_to_js( $titles ) ?>></div>
        <div class="nba-builder-closer">&times;</div>
    </div>
    <div class="nba-builder-body"><?php echo $body ?></div>
    <div class="nba-builder-footer">
        <div class="nba-builder-btn for_close button"><?php _e( 'Close', 'noo-before-after' ) ?></div>
        <div class="nba-builder-btn for_save button button-primary"><?php _e( 'Save changes',
				'noo-before-after-ba' ) ?></div>
    </div>
</div>
