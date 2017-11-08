<?php
// =============================================================================
// TEMPLATE NAME: Archive
// -----------------------------------------------------------------------------
// Archive template for all custom Post Types - Lists and for blog posts. This template is hidden.
// This template not show any direct content, but fetch the content of the archive page built by the user for the specific Post Type.
// =============================================================================
if (defined("HC_PLUGIN_PATH")) {
    hc_archive_engine();
} else {
    get_header();
    $filter = "";
    $date = "";
    $title = "";

    if (is_day()) $date = get_the_date();
    if (is_month()) $date = get_the_date('F Y');
    if (is_year()) $date = get_the_date('Y');

    if (count($wp_query->tax_query->queries) > 0) {
        $args['category_name'] = $wp_query->tax_query->queries[0]['terms'][0];
        $title = esc_attr__("Archives with tag ","landkit") . $wp_query->queried_object->name;
    }
    if ($date != "") {
        $title = esc_attr__("Archives with date ","landkit") . $date;
    }

    $content = "";
    $paged = get_query_var( 'paged' ) ? absint(get_query_var('paged')) : 1;

    if ($date != "") {
        $args['monthnum'] = date("m",strtotime($date));
        $args['year'] = date("Y",strtotime($date));
    }
?>
<div class="header-base">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="title-base text-left">
                    <h1>
                        <?php echo esc_attr($title) ?>
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
    <hr class="space" />
    <div class="advs-box advs-box-side default-box <?php if (is_sticky()) echo "sticky-post"; ?>" data-anima="fade-left" data-trigger="hover">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    <a href="<?php echo esc_url(get_the_permalink()) ?>">
                        <?php echo esc_attr(get_the_title()) ?>
                    </a>
                </h3>
                <hr class="anima" />
                <p>
                    <?php echo get_the_excerpt(); ?>
                </p>
                <hr class="space s" />
                <a class="anima-button btn-text" href="<?php echo esc_url(get_the_permalink()) ?>">
                    <?php esc_attr_e("Read more","landkit") ?>
                </a>
            </div>
        </div>
    </div>
    <hr class="space" />
    <?php
            }
            wp_reset_postdata();
        }
    ?>
    <?php if ($wp_query->max_num_pages > 1) {  ?>
    <ul class="pagination-sm pagination-grid pagination default-pagination">
        <li class="prev">
            <?php echo get_previous_posts_link('< Previous'); ?>
        </li>
        <li class="next">
            <?php echo get_next_posts_link('Next >', $wp_query->max_num_pages ); ?>
        </li>
    </ul>
    <?php
          } ?>
</div>
<?php
}
get_footer();
?>


