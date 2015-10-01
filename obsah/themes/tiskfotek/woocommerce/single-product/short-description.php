<?php
/**
 * Single product short description
 *
 * @author         WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_excerpt ) {
    return;
}

?>
<!--
<div itemprop="description">
    <div class="list-item last-list">
    <label class="control-label"><i class="fa fa-align-justify"></i><?php echo __('Quick Overview:','itrays') ?></label>
    <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
    </div>
</div>
-->