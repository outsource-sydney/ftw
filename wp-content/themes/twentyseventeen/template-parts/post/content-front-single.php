<div class="block">

  <div class="block-header">

    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID( ), 'thumbnail' ); ?>" data-src="<?php echo get_the_post_thumbnail_url( get_the_ID( ), 'large' ); ?>" data-load="1" data-scroll="1">

  </div>

  <div class="block-content">

    <div class="block-content-body">

      <h4>

        <?php
        $catDetail=get_the_category( get_the_id() ); //$post->ID
        foreach($catDetail as $cd) :
        ?>

          <a href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo $cd->cat_name; ?></a>

        <?php endforeach; ?>

      </h4>

      <h2><?php the_title(); ?></h2>

      <?php the_excerpt(); ?>

    </div>

    <div class="block-content-footer">

      <?php echo time_ago(); ?>

      <a href="<?php echo the_permalink(); ?>" class="btn"><i class="icon icon-right"></i></a>

    </div>

  </div>

</div>
