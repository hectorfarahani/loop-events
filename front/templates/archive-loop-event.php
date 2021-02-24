<?php get_header(); ?>
	<?php
	while ( have_posts() ) :
		the_post();
		$post_classes   = get_post_class();
		$post_classes[] = 'entry-content';

		?>
		<div <?php post_class( 'entry-content' ); ?> >
			<header class="entry-header alignwide">
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
			</header>
		
			<main>
				<?php the_content(); ?>
				<p>
					<h4><?php esc_html_e( 'Event details', 'loop-events' ); ?></h4>
				</p>
				<p>
					<?php loop_events_show_text_field( __( 'Organizer Name', 'loop-events' ), 'organizer_name' ); ?>
				</p>
				<p>
					<?php loop_events_show_time(); ?>
				</p>
				<p>
					<?php loop_events_show_organizer_email(); ?>
				</p>
				<p>
					<?php loop_events_show_text_field( __( 'Address', 'loop-events' ), 'address' ); ?>
				</p>
				<p>
					<?php loop_events_show_map_link(); ?>
				</p>
				<footer>
					<p>
						<?php echo get_the_term_list( $post->ID, LOOP_EVENTS_CPT_SLUG . '-tags', __( 'Tags: ' ), ', ' ); ?>
					</p>
				</footer>
			</main>
		</div>
	<?php endwhile; ?>
	<p class="loop-event-older-posts">
		<?php next_posts_link( '&laquo; More Events' ); ?>
	</p>
<?php
get_footer();
