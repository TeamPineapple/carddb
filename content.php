<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

					<?php
$posttags = get_the_tags();
$tagClasses = '';
if ($posttags) {
  foreach($posttags as $tag) {
    $tagClasses .= 'tag-'. strtolower($tag->name) .' '; 
  }
}
?>
<article class="card <?php echo $tagClasses; ?>"  id="post-<?php the_ID(); ?>" >
	
		<?php
				the_title( sprintf( '<h2 class="name">', esc_url( get_permalink() ) ), '</h2>' );
		?>
	
	<div class="attributes">
		<ul>
					<?php
$posttags = get_the_tags();
if ($posttags) {
  foreach($posttags as $tag) {
  	echo sprintf('<li><a href="%s">%s</a></li> ', get_tag_link($tag->term_id), $tag->name );
  }
}
?>
		</ul>
	</div>

	<ul class="combatant">
		<?php  $combat = get_post_custom(); ?>

		<?php if (isset($combat['HP'])): ?>
			<?php echo sprintf('<li><strong>HP</strong>: %s</li>', $combat['HP'][0]); ?>
		<?php endif; ?>

		<?php if (isset($combat['ATK'])): ?>
			<?php echo sprintf('<li><strong>ATK</strong>: %s</li>', $combat['ATK'][0]); ?>
		<?php endif; ?>

		<?php if (isset($combat['AP'])): ?>
			<?php echo sprintf('<li><strong>AP</strong>: %s</li>', $combat['AP'][0]); ?>
		<?php endif; ?>

		<?php if (isset($combat['Lv'])): ?>
			<?php echo sprintf('<li><strong>Lv</strong>: %s</li>', $combat['Lv'][0]); ?>
		<?php endif; ?>
	</ul>


	<div class="description">
		<?php
			/* translators: %s: Name of current post */
			$content = get_the_content( sprintf(
				__( 'Continue reading %s', 'twentyfifteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			echo nl2br(str_replace('~', get_the_title(), $content));

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>
</article><!-- #post-## -->
