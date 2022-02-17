<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */

get_header(); ?>

		<section id="primary">
			<main id="content" role="main"<?php sempress_main_class(); ?>>

				<?php
					if ( get_query_var('paged') ) {
						$paged = get_query_var('paged');
					} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
						$paged = get_query_var('page');
					} else {
						$paged = 1;
					}
			  		$args = array(
						'post_type' => 'post',
						'posts_per_page'=> get_option('posts_per_page'),
						'paged'=> $paged,
						'post_status' => 'publish',
						'cat' => -1,
					);
					$custom_query = new WP_Query($args);
					$orig_query = $wp_query; // fix for pagination to work
					$wp_query = $custom_query;
				?>

			<?php if ( have_posts() ) : ?>

				<?php sempress_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php sempress_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title p-entry-title"><?php _e( 'Nothing Found', 'sempress' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content e-entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'sempress' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			<?php
				$wp_query = $orig_query; // fix for pagination to work
			?>

			</main><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
