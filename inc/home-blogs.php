<?php
// The Query.
$args = array(
    'post_type' => 'post',
    'posts_per_page'=> 2
);
$the_query = new WP_Query( $args );

// The Loop.
if ( $the_query->have_posts() ) {

    echo '<div class="card mb-3 bg-light border-0 py-2 px-3 shadow-sm color-theme fs-6 fw-bold text-center">Blog</div>';

    echo '<div class="bg-white p-3 shadow-sm">';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
        ?>
        <article <?php post_class('border rounded p-2 p-md-3 mb-2'); ?> id="post-<?php the_ID(); ?>">
            
            <?php if (has_post_thumbnail( $post->ID ) ): ?>
                <div class="row">

                    <div class="col-3 col-md-2">
                        <a class="d-block" href="<?php echo get_the_permalink(); ?>">
                            <div class="ratio ratio-1x1 bg-light overflow-hidden">
                                <?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'class' => 'w-100' ) ); ?>
                            </div>
                        </a>
                    </div>
                
                    <div class="col-8 col-md-10">
            <?php endif; ?>

                <?php
                    the_title(
                        sprintf('<div class="fw-bold mb-md-2"><a class="color-theme" href="%s" rel="bookmark">', esc_url(get_permalink())),
                        '</a></div>'
                    );
                ?>

                <div class="small">
                    <?php echo vd_limit_text(strip_tags(get_the_excerpt()), 20); ?>
                </div>

            <?php if (has_post_thumbnail( $post->ID ) ): ?>
                </div>
                </div>
            <?php endif; ?>

        </article>
        <?php
	}
	echo '</div>';

} 

// Restore original Post Data.
wp_reset_postdata();
