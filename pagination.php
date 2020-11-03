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
      'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
      'format' => '?paged=%#%',
      'current' => max( 1, get_query_var('paged') ),
      'total' => $loop->max_num_pages,
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;'
      )
    );
  ?>
</div>

<?php wp_reset_query(); ?>
