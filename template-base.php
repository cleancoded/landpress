<?php
// =============================================================================
// TEMPLATE NAME: Base
// -----------------------------------------------------------------------------
// Base template.
// =============================================================================


get_header();
if (is_home()) { ?>
<div class="header-base">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="title-base text-left">
                    <h1>
                        <?php esc_attr_e("Blog","landkit") ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container content">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
    ?>
    <hr class="space l" />
    <div class="advs-box advs-box-side default-box <?php if (is_sticky()) echo "sticky-post"; ?>">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    <a href="<?php echo esc_url(get_the_permalink()) ?>">
                        <?php echo esc_attr(get_the_title()) ?>
                    </a>
                </h3>
                <div class="tag-row icon-row">
                	<span><i class="fa fa-calendar"></i><?php echo get_the_date(); ?></span>
                	<span><i class="fa fa-bookmark"></i><a href=""><?php echo the_category( ', ' ); ?></a></span>
                	<span><i class="fa fa-pencil"></i><?php echo get_the_author(); ?></span>                          
                </div>
                <hr class="space s" />
                <p>
                    <?php echo get_the_excerpt(); ?>
                </p>
                <hr class="space xs" />
                <a class="anima-button btn-text" href="<?php echo esc_url(get_the_permalink()) ?>">
                    <i class="fa fa-long-arrow-right"></i><?php esc_attr_e("Read more","landkit") ?>
                </a>
            </div>
        </div>
    </div>
    <hr class="space l" />
    <?php if (($wp_query->current_post +1) != ($wp_query->post_count)) {
  		echo('<hr class="default" />');
} 	?>
    <?php
        }
        wp_reset_postdata();
    }
    if ($wp_query->max_num_pages > 1) {  ?>
    <ul class="pagination-sm pagination-grid pagination default-pagination">
        <li class="prev">
            <?php echo get_previous_posts_link('◄'); ?>
        </li>
        <li class="next">
            <?php echo get_next_posts_link('►', $wp_query->max_num_pages ); ?>
        </li>
    </ul>
    <?php } ?>
</div>
<?php
} else {
   landkit_the_content();
}
get_footer();
?>
