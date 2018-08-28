<?php
/**
 * WP Bootstrap searchform template file
 *
 * @package WordPress
 * @subpackage WP_Bootstrap
 * @since 1.0
 * @version 1.0
 */

?>
<form action="/" method="get" class="form-inline mt-2 mt-md-0">
	<input id="search" type="search" name="s" class="form-control mr-sm-2" type="text" value="<?php the_search_query(); ?>" placeholder="Search" aria-label="Search">
	<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>
