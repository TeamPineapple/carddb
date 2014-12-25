<?php
get_header(); 

global $wp_query;
query_posts(
   array_merge(
      $wp_query->query,
      array('posts_per_page' => -1)
   )
);

?>
	<div class="sheet">
		
		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			$counter = 0;
			// Start the loop.
			while ( have_posts() ) : the_post();
				$copies = max(1, (int)(get_post_custom()['copies'][0]) );
				$copies = isset($_GET['print']) ? $copies : 1;
				while($copies--) {
					get_template_part( 'content', get_post_format() );
					$counter++;

					if($counter % 9 == 0) {
						
						echo '</div><br><br><br><br><div class="sheet">';
					} 
				}

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

	</div><!-- .content-area -->

<?php get_footer(); ?>
