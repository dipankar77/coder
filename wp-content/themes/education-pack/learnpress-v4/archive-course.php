<?php
/**
 * Template for displaying content of archive courses page.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * @since 4.0.0
 *
 * @see LP_Template_General::template_header()
 */

/**
 * LP Hook
 */
do_action( 'learn-press/before-main-content' );

$page_title = learn_press_page_title( false );
?>

<div class="lp-content-area">

	<?php
	/**
	 * LP Hook
	 */
	do_action( 'learn-press/before-courses-loop' );

	LP()->template( 'course' )->begin_courses_loop();

	while ( have_posts() ) :
		the_post();

		learn_press_get_template_part( 'content', 'course' );

	endwhile;

	LP()->template( 'course' )->end_courses_loop();

	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/after-courses-loop' );


	/**
	 * LP Hook
	 */
	do_action( 'learn-press/after-main-content' );

	/**
	 * LP Hook
	 *
	 * @since 4.0.0
	 */
	do_action( 'learn-press/sidebar' );
	?>
</div>

<?php
/**
 * @since 4.0.0
 *
 * @see   LP_Template_General::template_footer()
 */
