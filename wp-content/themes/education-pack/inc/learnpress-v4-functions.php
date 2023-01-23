<?php
if ( ! function_exists( 'thim_related_courses' ) ) {

    function thim_related_courses() {
        $related_courses = thim_get_related_courses( 4 );
        if ( $related_courses ) {
            ?>
            <div class="thim-related-course">
                <h3 class="related-title"><?php esc_html_e( 'Related Courses', 'course-builder' ); ?></h3>

                <div class="course-grid row">
                    <?php foreach ( $related_courses as $course_item ) : ?>
                        <?php
                        $course      = LP_Course::get_course( $course_item->ID );
                        $is_required = $course->is_required_enroll();
                        $course_id   = $course_item->ID;
                        if ( class_exists( 'LP_Addon_Course_Review' ) ) {
                            $course_rate              = learn_press_get_course_rate( $course_id );
                            $course_number_vote       = learn_press_get_course_rate_total( $course_id );
                            $html_course_number_votes = $course_number_vote ? sprintf( _n( '(%1$s vote )', ' (%1$s votes)', $course_number_vote, 'course-builder' ), number_format_i18n( $course_number_vote ) ) : esc_html__( '(0 vote)', 'course-builder' );
                        }
                        ?>
                        <div class="inner-course col-sm-3">
                            <?php do_action( 'learn_press_before_course_header' ); ?>

                            <div class="wrapper-course-thumbnail">
                                <?php if ( has_post_thumbnail( $course_id ) ) : ?>
                                    <a href="<?php the_permalink( $course_id ); ?>"
                                       class="img_thumbnail"><?php thim_thumbnail( $course_id, '320x320', 'post', false ); ?></a>
                                <?php endif; ?>
                                <div class="price-ht">
                                    <?php if ( $price = $course->get_price_html() ) {

                                        $origin_price = $course->get_origin_price_html();
                                        $sale_price   = $course->get_sale_price();
                                        $sale_price   = isset( $sale_price ) ? $sale_price : '';
                                        ?>
                                        <?php if ( $course->is_free() || ! $is_required ) { ?>
                                            <div class="value free-course" itemprop="price"
                                                 content="<?php esc_attr_e( 'Free', 'course-builder' ); ?>">
                                                <?php esc_html_e( 'Free', 'course-builder' ); ?>
                                            </div>
                                        <?php } else {
                                            echo '<span class="price">' . esc_html( $price ) . '</span>';
                                        }
                                    } ?>
                                </div>
                            </div>
                            <div class="item-list-center">
                                <div class="course-title">
                                    <h5 class="title">
                                        <a href="<?php echo esc_url( get_the_permalink( $course_item->ID ) ); ?>"> <?php echo get_the_title( $course_item->ID ); ?></a>
                                    </h5>
                                </div>
                                <?php
                                $count = $course->get_users_enrolled( 'append' ) ? $course->get_users_enrolled( 'append' ) : 0;
                                ?>
                                <span class="date-comment"><?php echo get_the_date() . ' / '; ?>
                                    <?php $comment = get_comments_number();
                                    if ( $comment == 0 ) {
                                        echo esc_html__( "No Comments", 'course-builder' );
                                    } else {
                                        echo esc_html( $comment . ' Comment' );
                                    }
                                    ?>
								</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }
}

function thim_get_related_courses( $limit ) {
    if ( ! $limit ) {
        $limit = 4;
    }
    $course_id = get_the_ID();

    $tag_ids = array();
    $tags    = get_the_terms( $course_id, 'course_tag' );

    if ( $tags ) {
        foreach ( $tags as $individual_tag ) {
            $tag_ids[] = $individual_tag->slug;
        }
    }

    $args = array(
        'posts_per_page'      => 4,
        'paged'               => 1,
        'ignore_sticky_posts' => 1,
        'post__not_in'        => array( $course_id ),
        'post_type'           => 'lp_course'
    );

    if ( $tag_ids ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'course_tag',
                'field'    => 'slug',
                'terms'    => $tag_ids
            )
        );
    }
    $related = array();
    if ( $posts = new WP_Query( $args ) ) {
        global $post;
        while ( $posts->have_posts() ) {
            $posts->the_post();
            $related[] = $post;
        }
    }
    wp_reset_query();

    return $related;
}
/**
 * Update template hook, remove hook to reorder html structure
 */
add_filter( 'learn-press/override-templates', '__return_true' );

if ( ! function_exists( 'thim_update_template_hook' ) ) {

        function thim_update_template_hook() {
            
   

            LP()->template( 'course' )->remove( 'learn-press/single-button-toggle-sidebar', array('<input type="checkbox" id="sidebar-toggle" />','single-button-toggle-sidebar' ), 5 );


            LP()->template( 'course' )->remove( 'learn-press/after-courses-loop-item', array( '<!-- START .course-content-meta --> <div class="course-wrap-meta">',
            'course-wrap-meta-open' ), 20 );
            LP()->template( 'course' )->remove( 'learn-press/after-courses-loop-item', array( '</div> <!-- END .course-content-meta -->', 'course-wrap-meta-close' ), 20 );
            LP()->template( 'course' )->remove_callback( 'learn-press/after-courses-loop-item', 'single-course/meta/duration', 20 );
            LP()->template( 'course' )->remove_callback( 'learn-press/after-courses-loop-item', 'single-course/meta/level', 20 );
            LP()->template( 'course' )->remove_callback( 'learn-press/before-courses-loop-item', 'loop/course/badge-featured', 5 );
            LP()->template( 'course' )->remove_callback( 'learn-press/before-courses-loop-item', 'loop/course/categories', 1010 );
            LP()->template( 'course' )->remove_callback( 'learn-press/before-courses-loop-item', 'loop/course/thumbnail.php', 10 );
            LP()->template( 'course' )->remove_callback( 'learn-press/before-courses-loop-item', 'loop/course/instructor', 1010 );

            remove_action(
                'learn-press/after-courses-loop-item', LP()->template( 'course' )->func( 'count_object' ),20
            );

            remove_action(
                'learn-press/before-main-content',
                LP()->template( 'general' )->text( '<div class="lp-archive-courses">', 'lp-archive-courses-open' ),
                - 100
            );
            
            remove_action(
                'learn-press/before-main-content', LP()->template( 'general' )->func( 'breadcrumb' )
            );
            remove_action(
                'learn-press/after-main-content',
                LP()->template( 'general' )->text( '</div>', 'lp-archive-courses-close' ),
                100
            );
    
            remove_action(
                'learn-press/after-checkout-form', LP()->template( 'checkout' )->func( 'account_logged_in' ), 20
            );
            
            remove_action( 'learn-press/after-courses-loop-item', 'learn_press_course_review_loop_stars' );


            add_action(
                'learn-press/after-checkout-form', LP()->template( 'checkout' )->func( 'account_logged_in' ), 90
            );
        
            LP()->template( 'course' )->remove( 'learn-press/course-content-summary', array( '<div class="course-detail-info"> <div class="lp-content-area"> <div class="course-info-left">', 'course-info-left-open' ), 10 );
            LP()->template( 'course' )->remove( 'learn-press/course-content-summary', array( '</div> </div> </div>', 'course-info-left-close' ), 15 );
            LP()->template( 'course' )->remove_callback( 'learn-press/course-content-summary', 'single-course/meta-primary', 10 );
            LP()->template( 'course' )->remove_callback( 'learn-press/course-content-summary', 'single-course/title', 10 );
            LP()->template( 'course' )->remove_callback( 'learn-press/course-content-summary', 'single-course/meta-secondary', 10 );
            LP()->template( 'course' )->remove_callback( 'learn-press/course-content-summary', 'single-course/sidebar', 85 );

            add_action('learn-press/course-content-summary', 'learn_press_course_price',12);
            add_action('learn-press/course-content-summary', 'learn_press_course_thumbnail',10);

            add_action('learn-press/course-content-summary', function() {
                $course = learn_press_get_course();

                if ( ! $course ) {
                    return;
                }

                $students = $course->count_students();
                echo '<span class="course-students">'; 
                printf( _nx( '%1$s Student', '%1$s Students', $students ,'number student', 'education-pack'),number_format_i18n($students));
                echo '</span>';       
            } ,12);

            add_action('learn-press/course-content-summary', LP()->template( 'course' )->func('course_buttons') ,12);

            add_action('learn-press/course-content-summary','thim_related_courses', 75);

        }
    
}
add_action( 'init', 'thim_update_template_hook' );
