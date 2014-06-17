<?php
/*
Template Name: Tabs
*/

get_header(); ?>

<div class="main" role="main">
  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  		<section class="content" id="post-<?php the_ID(); ?>">
    		<header>
      			<h2><?php the_title(); ?></h2>
      			<p><?php the_content(); ?></p>
    		</header>
    		<div class="tabs-wrapper">
    			<nav class="nav-tabs">
    				<a href="#" class="active">tab #1</a>
    				<a href="#">tab #2</a>
    				<a href="#">tab #3</a>
    			</nav>
    			<div class="tabs-content">
				</div><!-- /.tabs-content -->
			</div><!-- /.tabs-wrapper -->
		</section><!-- /.content -->
  	<?php endwhile; endif; ?>
</div><!-- /.main -->

<?php get_footer(); ?>
