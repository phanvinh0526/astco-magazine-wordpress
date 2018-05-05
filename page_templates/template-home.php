<?php
/*
Template Name: Home Template
*/
get_header(); 

?>
<div id="main-content" class="main-content woocommerce">
	<div class="container">
		<div class="row">
			<!-- Content Index -->
			<div class="wd-content-home">
				<div id="primary" class="content-area container">
					<main id="main" class="site-main row">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php the_content(); ?>	
						<?php endwhile; ?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>