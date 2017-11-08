<?php
// =============================================================================
// TEMPLATE NAME: 404
// -----------------------------------------------------------------------------
// 404 Page Not Found template. This template is hidden.
// =============================================================================
$logo = landkit_URL . "/inc/logo.png";
get_header();
if (defined("HC_PLUGIN_PATH")) {
    $tmp = hc_get_setting("logo");
    if ($tmp != "") $logo = $tmp;
}
?>
<div class="section-empty bg-color" style="background-image: url('https://source.unsplash.com/collection/1042962/1920x1280?'); background-position: center; background-size: cover;">
    <div class="container content box-middle-container full-screen-size">
        <div class="row">
            <div class="col-md-12 box-middle white">
                <div>
                    <h5>
                        <?php esc_attr_e(" Error 404","landkit") ?>
                    </h5>
                    <h1 style="line-height: 60px">
                        <?php esc_attr_e("oops, something","landkit") ?>
                    </h1>
                    <h1 style="line-height: 60px">
                        <?php esc_attr_e("went wrong","landkit") ?>
                    </h1>
                    <hr class="space m" />
                    <a class="btn-default btn " href="<?php echo esc_url(get_site_url()) ?>">
                        <?php esc_attr_e("Go back to home","landkit") ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
