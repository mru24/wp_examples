<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$loop = new WP_Query( array('post_type' => 'custom_post_type', 'orderby' => 'post_id',  'order' => 'DESC', 'posts_per_page' => 25, 'paged' => $paged));
?>

<?php while( $loop->have_posts() ) :  $loop->the_post(); ?>
<?php
  $title = get_the_title();
	$content = get_the_content();
	$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
?>

  <div class="box">
    <?php echo $title; ?>
  </div>

<?php endwhile; ?>

<div class="pagination">
  <?php
    $big = 999999999;
    echo paginate_links( array(
      'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
      'total'        => $query->max_num_pages,
      'current'      => max( 1, get_query_var( 'paged' ) ),
      'format'       => '?paged=%#%',
      'show_all'     => false,
      'type'         => 'plain',
      'end_size'     => 2,
      'mid_size'     => 1,
      'prev_next'    => true,
      'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
      'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
      'add_args'     => false,
      'add_fragment' => '',
      )
    );
  ?>
</div>

<?php wp_reset_query(); ?>
