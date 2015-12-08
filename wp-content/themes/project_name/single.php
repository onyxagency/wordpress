<?php while (have_posts()) : the_post(); ?>

  <?php get_template_part('templates/content', 'header'); ?>

  <?php $term_list = wp_get_post_terms($post->ID, 'category'); ?>
    
  <div class="back-button">
    <div class="inner">
      <p><a href="/<?php echo $term_list[0]->slug; ?>/"><span class="sprite"><svg class="icon-arrow-left"><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons.svg#icon-arrow-left"></use></svg></span>Back</a></p>
    </div>
  </div>

  <article class="post">
    <div class="inner">

      <div class="article-header">
        <div class="snippet-meta">
          <?php if (get_field('author_image')): ?>
            <div class="meta-avatar" style="background-image:url('<?php echo get_field('author_image')['url']; ?>')"></div>
          <?php endif; ?>
          <div class="meta-info">
            <?php if (get_field('author_name')): ?>
              By <span class="meta-name"><?php echo the_field('author_name'); ?></span> on
            <?php endif; ?>
            <span class="meta-date"><?php the_time('F j, Y'); ?></span>
          </div>
          <div class="meta-social">
            <a href="https://twitter.com/share" class="twitter-share-button sprite" data-count="none" target="_blank"><svg class="icon-twitter"><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons.svg#icon-twitter"></use></svg></a>
            <a class="facebook-share-button sprite" href="<?php echo the_permalink(); ?>">
              <svg class="icon-facebook"><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons.svg#icon-facebook"></use></svg>
            </a>
          </div>
        </div>

        <h1><?php the_title(); ?></h1>

        <div class="featured-image">
          <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>">
          <span><?php the_field('image_caption'); ?></span>
        </div>
      </div><!-- .article-header -->

      <div class="post-content">
        <?php the_content(); ?>
      </div>

    </div>
  </article>

  <?php  
    $related_blog_query = new WP_Query(array(
    'post_type' => 'post',
    'tax_query' => array(
      array(
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms' => $term_list[0]->slug,
      ),
    ),
    'posts_per_page' => 1,
    'post__not_in' => array($post->ID),
    'date_query' => array(
      'before' => $post->post_date
    ),
  )); ?>

  <?php if ($related_blog_query->have_posts()): ?>
  <div class="next-article">
    <div class="inner">

      <h4>Up Next</h4>
      
      <?php while ($related_blog_query->have_posts()): $related_blog_query->the_post(); ?>
        <article class="snippet">
          <div class="snippet-meta">
            <?php if (get_field('author_image')): ?>
              <div class="meta-avatar" style="background-image:url('<?php echo get_field('author_image')['url']; ?>')"></div>
            <?php endif; ?>
            <div class="meta-info">
              <?php if (get_field('author_name')): ?>
                By <span class="meta-name"><?php echo the_field('author_name'); ?></span> on
              <?php endif; ?>
              <span class="meta-date"><?php the_time('F j, Y'); ?></span>
            </div>
          </div>
          <h2 class="snippet-title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>   
          <p class="snippet-excerpt"><?php the_field('excerpt'); ?></p>
        </article>
      <?php endwhile; ?>

    </div>
  </div>
  <?php endif; wp_reset_postdata(); ?>

  <?php get_template_part('templates/content', 'footer'); ?>

<?php endwhile; ?>


