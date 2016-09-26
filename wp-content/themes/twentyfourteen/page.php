 <?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<?php
		
		if ( has_children() OR $post->post_parent > 0 ) { ?>


	<nav id="primary-navigation2" class="site-navigation primary-navigation" role="navigation">
					<span class="parent-link"><a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>"></a></span>

				<ul>
					<?php

					$args = array(
						'child_of' => get_top_ancestor_id(),
						'title_li' => ''
					);

					?>

					<?php wp_list_pages($args); ?>
				</ul>
	</nav>

		<?php } ?>

<div id="main-content" class="main-content">
<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
