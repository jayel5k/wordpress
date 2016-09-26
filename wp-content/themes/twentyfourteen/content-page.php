<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



<?php 	/*
$mypages = get_pages( array( 'child_of' => $post->ID, 
	                         'sort_column' => 'post_date', 
	                         'sort_order' => 'desc' ) );  	
foreach( $mypages as $page ) {
		 $content = $page->post_content; 		
			if ( ! $content ) // Check for empty page 			continue;  		$content = apply_filters( 'the_content', $content ); 	
?> 		
<h2><a href="
<?php echo get_page_link( $page->ID ); ?>">
<?php echo $page->post_title; ?></a>
</h2>
	<?php 	}	 */?>



	<?php
		// Page thumbnail and title.
		twentyfourteen_post_thumbnail();
		the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' );
	?>

	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );

			edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
