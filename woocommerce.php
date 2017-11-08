<?php
// =============================================================================
// INDEX.PHP
// =============================================================================

global $query;
$woo_cnt = "";
$sidebar = "";
$sw = array("left"=>"col-md-3","right"=>"col-md-3","content"=>"col-md-9");
if (defined("HC_PLUGIN_PATH")) {
    include(HC_PLUGIN_PATH . "/global-content.php");
    $woo_cnt = hc_get_container_template();

    if (is_shop() || is_product_category() || is_product_tag()) $sidebar = hc_get_setting('woocommerce-sidebar-shop');
    else $sidebar = hc_get_setting('woocommerce-sidebar-single');
    $sw = hc_get_sidebars_width($sidebar);
}
get_header();
hc_default_title();
?>
<div <?php post_class("content-parallax woocommerce-cnt " . $woo_cnt . (($sidebar != "") ? " sidebar-content":"")); ?>>
    <div class="section-empty">
        <div class="container content">
            <?php if ($sidebar == "left") { ?>
            <div class="row">
                <div class="<?php echo esc_attr($sw["left"]) ?> widget">
                    <?php
                      if (is_shop() || is_product_category() || is_product_tag()) {
                          if (is_active_sidebar("woocommerce_shop_left_side_bar")) dynamic_sidebar("woocommerce_shop_left_side_bar");
                      } else {
                          if (is_active_sidebar("woocommerce_single_left_side_bar")) dynamic_sidebar("woocommerce_single_left_side_bar");
                      }
                    ?>
                </div>
                <div class="<?php echo esc_attr($sw["content"]) ?>">
                    <?php woocommerce_content() ?>
                </div>
            </div>
            <?php
                  }
                  if ($sidebar == "right") {
            ?>
            <div class="row">
                <div class="<?php echo esc_attr($sw["content"]) ?>">
                    <?php woocommerce_content() ?>
                </div>
                <div class="<?php echo esc_attr($sw["right"]) ?> widget">
                    <?php
                      if (is_shop() || is_product_category() || is_product_tag()) {
                          if (is_active_sidebar("woocommerce_shop_right_side_bar")) dynamic_sidebar("woocommerce_shop_right_side_bar");
                      } else {
                          if (is_active_sidebar("woocommerce_single_right_side_bar")) dynamic_sidebar("woocommerce_single_right_side_bar");
                      }
                    ?>
                </div>
            </div>
            <?php
                  }
                  if ($sidebar == "right-left") {
            ?>
            <div class="row">
                <div class="<?php echo esc_attr($sw["left"]) ?> widget">
                    <?php
                      if (is_shop() || is_product_category() || is_product_tag()) {
                          if (is_active_sidebar("woocommerce_shop_left_side_bar")) dynamic_sidebar("woocommerce_shop_left_side_bar");
                      } else {
                          if (is_active_sidebar("woocommerce_single_left_side_bar")) dynamic_sidebar("woocommerce_single_left_side_bar");
                      }
                    ?>
                </div>
                <div class="<?php echo esc_attr($sw["content"]) ?>">
                    <?php  woocommerce_content() ?>
                </div>
                <div class="<?php echo esc_attr($sw["right"]) ?> widget">
                    <?php
                      if (is_shop() || is_product_category() || is_product_tag()) {
                          if (is_active_sidebar("woocommerce_shop_right_side_bar")) dynamic_sidebar("woocommerce_shop_right_side_bar");
                      } else {
                          if (is_active_sidebar("woocommerce_single_right_side_bar")) dynamic_sidebar("woocommerce_single_right_side_bar");
                      }
                    ?>
                </div>
            </div>
            <?php
                  }
                  if ($sidebar == "") {
                      woocommerce_content();
                  }
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>
