<?php
function custom_gallery( $attr ){
  $post = get_post();

      static $instance = 0;
      $instance++;

      if(!empty($attr['ids'])){
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if(empty($attr['orderby'])){ $attr['orderby'] = 'post__in'; }
        $attr['include'] = $attr['ids'];
      }

      $output = '';

      // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
      if(isset($attr['orderby'])){
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if(!$attr['orderby']) unset($attr['orderby']);
      }

      extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post ? $post->ID : 0,
        'icontag'    => 'figure',
        'captiontag' => 'p',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'it_slideshow'    => '',
        'exclude'    => '',
        'link'       => '',
        'class'      => ''//now you can add custom class to container UL 
      ), $attr, 'gallery'));

      $id = intval($id);

      if('RAND' == $order) $orderby = 'none';

      if(!empty($include)){
        $_attachments = get_posts(array(
          'include' => $include,
          'post_status' => 'inherit',
          'post_type' => 'attachment',
          'post_mime_type' => 'image',
          'order' => $order,
          'orderby' => $orderby
        ));

        $attachments = array();
        foreach($_attachments as $key => $val){
          $attachments[$val->ID] = $_attachments[$key];
        }
      } elseif (!empty($exclude)){
        $attachments = get_children(array(
          'post_parent' => $id,
          'exclude' => $exclude,
          'post_status' => 'inherit',
          'post_type' => 'attachment',
          'post_mime_type' => 'image',
          'order' => $order,
          'orderby' => $orderby
        ));
      } else {
        $attachments = get_children(array(
          'post_parent' => $id,
          'post_status' => 'inherit',
          'post_type' => 'attachment',
          'post_mime_type' => 'image',
          'order' => $order,
          'orderby' => $orderby
        ));
      }

      if(empty($attachments)) return '';

      //if ( is_feed() ) //removed, see original in media.php


      $itemtag = tag_escape('li');//new tag for item 
      $captiontag = tag_escape($captiontag);
      $icontag = tag_escape($icontag);

      //valid tags check removed, see original in media.php

      $columns = intval($columns);
      $selector = "gallery-{$instance}";

      $size_class = sanitize_html_class( $size );

      //new tag for container 
      if($it_slideshow == 'yes'){
        $output = "<div class='post-icon main-bg' data-title='".__('Gallery','itrays')."' data-tooltip='true' data-position='top'><i class='fa fa-camera'></i></div><div id='$selector' class='gallery portfolio-img-slick galleryid-{$id} {$class}'>";  
      }else{
        $output = "<ul id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} {$class}'>";
      }
      
      $i = 0;
      $c = count($attachments);
      $o = (int)floor($c/$columns)*$columns;

      foreach ( $attachments as $id => $attachment ) {
        if(!empty($link) && 'file' === $link) $image_output = wp_get_attachment_link($id,$size,false,false);
        elseif(!empty($link) && 'none' === $link) $image_output = wp_get_attachment_image($id,$size,false);
        else $image_output = wp_get_attachment_link( $id, $size, true, false );
        $image_meta = wp_get_attachment_metadata($id);
        $orientation = '';
        if(isset($image_meta['height'], $image_meta['width'])) $orientation = ($image_meta['height'] > $image_meta['width']) ? 'portrait' : 'landscape';

        //setup custom aux classes to help style
        $m = ++$i % $columns;
        $item_pos_class = ($m == 1) ? 'first-in-row' : (($m == 0) ? 'last-in-row' : '');
        $row_class = ($i <= $columns) ? 'first-row' : (($i > $o) ? 'last-row' : '');

        //added: custom aux classes
        if($it_slideshow == 'yes'){
            $output .= "<div class=''>";  
          }else{
            $output .= "<{$itemtag} class='gallery-item {$item_pos_class} {$row_class}'>";
          }
        $output .= "<{$icontag} class='gallery-icon {$orientation}'>$image_output</{$icontag}>";
        if($captiontag && trim($attachment->post_excerpt)){
          $output .= "<{$captiontag} class='wp-caption-text gallery-caption'>" . wptexturize($attachment->post_excerpt) . "</{$captiontag}>";
        }
        if($it_slideshow == 'yes'){
            $output .= "</div>";  
          }else{
            $output .= "</{$itemtag}>";
          }
        
      }

      //changed BR>clear:both with a more conventional clearfix div
      if($it_slideshow == 'yes'){
        $output .= "</div>\n<div class='clearfix'></div>";  
      }else{
        $output .= "</ul>\n<div class='clearfix'></div>";
      }

  return $output;
}
add_shortcode( 'gallery', 'custom_gallery' );