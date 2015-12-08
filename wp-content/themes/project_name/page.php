<?php get_template_part('templates/content', 'header'); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <section class="secondary">
    	<div class="inner">

        <div class="post-content">
		      <h1><?php the_title(); ?></h1>
		      <?php the_content(); ?>
        </div>
        
	    </div>
    </section>

<?php endwhile; ?>

<?php get_template_part('templates/content', 'footer'); ?>