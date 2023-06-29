<?php
$args = array( 'posts_per_page' => 5, 'order' => 'DESC', 'category_name' => 'books' );
$postslist = get_posts( $args );
$count = 0;

foreach ( $postslist as $post ) : setup_postdata( $post ); ?>

<div class="<?php echo (++$count%2 ? "section1" : "section2")?>">
  <div class="container">
  <?php if ($count % 2) : ?>
    <div class="col-md-6">
      <h3><?php the_title(); ?></h3>
      <?php the_content(); ?>
    </div>
    <div class="col-md-6 iemg">
      <?php the_post_thumbnail( 'full' );  ?>
    </div>
  <?php else : ?>
    <div class="col-md-6 iemg">
      <?php the_post_thumbnail( 'full' );  ?>
    </div>
    <div class="col-md-6">
      <h3><?php the_title(); ?></h3>
      <?php the_content(); ?>
    </div>
  <?php endif; ?>
  </div>
</div>
<?php endforeach; wp_reset_postdata(); ?>
