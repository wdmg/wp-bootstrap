<?php
/**
 * WP Bootstrap page content template
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 * @version 1.0
 */

?>
<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header entry-header">
		<?php the_title( '<h1 class="page-title entry-title">', '</h1>' ); ?>
	</header>
	<div class="entry-content">
	<?php
		the_content();
	?>
	</div>
	<?php
		edit_post_link(
			__('Edit', 'wp-bootstrap'),
			'<div class="text-right">',
			'</div>',
			get_the_ID(),
			'btn btn-secondary'
		);
	?>
</article>
