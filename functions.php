<?php
// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Theme functions.
// =============================================================================
define("landkit_URL", get_template_directory_uri());
define("landkit_PATH", get_template_directory());
require_once(landkit_PATH . "/inc/class-tgm-plugin-activation.php");
function landkit_register_required_plugins() {
	$plugins = array(
        array(
			'name'               => esc_html__('Hybrid Composer',"landkit"),
			'slug'               => 'hybrid-composer',
			'source'             => landkit_PATH . '/inc/hybrid-composer.zip',
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		)
	);
	$config = array(
		'id'           => 'theme-tgmpa',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => ''
	);
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'landkit_register_required_plugins' );
if (!isset( $content_width )) $content_width = 1200;
add_theme_support( 'automatic-feed-links' );
add_theme_support('title-tag');
function landkit_enqueue_front_end_script() {
    if (!defined("HC_PLUGIN_PATH")) {
        wp_enqueue_style("bootstrap", landkit_URL . "/css/bootstrap/css/bootstrap.css", array(), "1.0", "all");
        wp_enqueue_script("bootstrap",  landkit_URL . '/css/bootstrap/js/bootstrap.min.js', array("jquery"), "1.0", true);
        wp_enqueue_script("landkit-script",  landkit_URL . '/inc/default.js', array(), "1.0",true);
        wp_enqueue_style("landkit-style", landkit_URL . "/style.css", array(), "1.0", "all");
    }
    if (is_singular() && comments_open() && (get_option('thread_comments') == 1)) wp_enqueue_script('comment-reply');
}
add_action('wp_enqueue_scripts', 'landkit_enqueue_front_end_script');
add_action('save_post', function () {
    if (isset($_POST['sidebars-menu'])) {
        $sidebar = $_POST['sidebars-menu'];
        if (update_post_meta($_POST['post_ID'], 'landkit-sidebar', $sidebar) != true) {
            add_post_meta($_POST['post_ID'], 'landkit-sidebar', $sidebar);
        }
    }
}, 10, 2);
function landkit_sidebar() {
    add_meta_box('landkit_sidebar', 'Sidebars', function () {
        $sidebar = get_post_meta(get_the_ID(), 'landkit-sidebar');
        if (count($sidebar) > 0) $sidebar = $sidebar[0];
        else $sidebar = "";
?>
<select data-hc-setting="sidebars" id="sidebars-menu" name="sidebars-menu">
    <option value="" <?php if ($sidebar == "") echo "selected" ?>><?php esc_attr_e("None","landkit") ?></option>
    <option value="right" <?php if ($sidebar == "right") echo "selected" ?>><?php esc_attr_e("Right","landkit") ?></option>
    <option value="left" <?php if ($sidebar == "left") echo "selected" ?>><?php esc_attr_e("Left","landkit") ?></option>
    <option value="right-left" <?php if ($sidebar == "right-left") echo "selected" ?>><?php esc_attr_e("Right and left","landkit") ?></option>
</select>
<?php
    }, array(array('Posts','post'), array('Pages','page'),array('Post Types','y-post-types'),array('Post Types Archivies','y-post-types-arc')), 'side', 'low' );
}
add_action('add_meta_boxes', 'landkit_sidebar');

//MENU
function landkit_init_menus() {
    register_nav_menus(
          array(
            'header-menu' => esc_html__('Header Menu',"landkit"),
            'footer-menu' => esc_html__('Footer Menu',"landkit"),
            'extra-menu' => esc_html__('Top mini Menu',"landkit")
          )
    );
}
add_action('after_setup_theme', 'landkit_init_menus');

//WIDGETS
function landkit_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__('Right Sidebar',"landkit"),
        'id'            => 'right_side_bar',
        'description'   => esc_html__('Global sidebar for pages, enable it on single page.',"landkit"),
        'before_widget' => '<div class="list-group list-blog">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="list-group-item active">',
        'after_title'   => '</p>',
    ) );
    register_sidebar(array(
        'name'          => esc_html__('Left Sidebar',"landkit"),
        'id'            => 'left_side_bar',
        'description'   => esc_html__('Global sidebar for pages, enable it on single page.',"landkit"),
        'before_widget' => '<div class="list-group list-blog">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="list-group-item active">',
        'after_title'   => '</p>',
    ));
    if (class_exists('WooCommerce')) {
        register_sidebar(array(
           'name'          => esc_html__('Woocommerce Shop Sidebar Left',"landkit"),
           'id'            => 'woocommerce_shop_left_side_bar',
           'description'   => esc_html__('Shop sidebar, enable it on Theme options > List Post Types',"landkit"),
           'before_widget' => '<div class="list-group list-blog">',
           'after_widget'  => '</div>',
           'before_title'  => '<p class="list-group-item active">',
           'after_title'   => '</p>',
       ));
        register_sidebar(array(
          'name'          => esc_html__('Woocommerce Shop Sidebar Right',"landkit"),
          'id'            => 'woocommerce_shop_right_side_bar',
          'description'   => esc_html__('Shop sidebar, enable it on Theme options > List Post Types',"landkit"),
          'before_widget' => '<div class="list-group list-blog">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="list-group-item active">',
          'after_title'   => '</p>',
      ));
        register_sidebar(array(
          'name'          => esc_html__('Woocommerce Item Sidebar Left',"landkit"),
          'id'            => 'woocommerce_single_left_side_bar',
          'description'   => esc_html__('Single product sidebar, enable it on Theme options > List Post Types',"landkit"),
          'before_widget' => '<div class="list-group list-blog">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="list-group-item active">',
          'after_title'   => '</p>',
      ));
        register_sidebar(array(
           'name'          => esc_html__('Woocommerce Item Sidebar Right',"landkit"),
           'id'            => 'woocommerce_single_right_side_bar',
           'description'   => esc_html__('Single product sidebar, enable it on Theme options > List Post Types',"landkit"),
           'before_widget' => '<div class="list-group list-blog">',
           'after_widget'  => '</div>',
           'before_title'  => '<p class="list-group-item active">',
           'after_title'   => '</p>',
       ));
    }
}
add_action( 'widgets_init', 'landkit_widgets_init' );
//MAIN CONTENT
function landkit_the_content() {
    function show_the_content() {
        while (have_posts()) {
            the_post();
            if (defined("HC_PLUGIN_PATH"))  {
                if (hc_get_setting("featured-image"))  {
                    the_post_thumbnail("large");
                } 
            } else {
                the_post_thumbnail("large");
            }
            the_content();
            wp_link_pages(array('before' => '<div class="pagination post-pagination">','after' => '</div>','link_before' => '<span>','link_after' => '</span>','pagelink' => '%'));
?>
<div class="comments-cnt">
    <div class="container">
        <?php comments_template() ?>
    </div>
</div>
<?php
        }
    }
    $default_content = false;
    if (!defined("HC_PLUGIN_PATH")) {
        $default_content = true;
    } else {
        global $HC_CLASSIC_CONTENT;
        if ($HC_CLASSIC_CONTENT == true) $default_content =true;
    }
    if ($default_content) {
?>
<div class="header-base">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="title-base text-left">
                    <h1>
                        <?php the_title(); ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    } else {
        hc_get_title();
    }
    $post_type_id = 0;
    $post_type = get_post_type();
    if ($post_type != "post" && $post_type != "page") {
        $current_post_type = get_post_type_object(get_post_type());
        $lists_ids = array();
        $args = array( 'post_type' => 'y-post-types', 'posts_per_page' => 999 );
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) {
            while ($the_query->have_posts()) {
                $the_query->the_post();
                if (strcasecmp($current_post_type->label,$the_query->post->post_name) == 0) {
                    $post_type_id = $the_query->post->ID;
                }
            }
        }
        wp_reset_query();
    } else {
        $post_type_id = get_the_ID();
    }
    $sidebar = get_post_meta($post_type_id, 'landkit-sidebar');
    $sw = array("left"=>"col-md-3","right"=>"col-md-3","content"=>"col-md-9");
    
    if (count($sidebar) > 0) {
        $sidebar = $sidebar[0];
        $woocommerce_prefix = "";
        if (defined("HC_PLUGIN_PATH") && hc_get_setting("shop-page") == $post_type_id) $woocommerce_prefix = "woocommerce_shop_";
        if (defined("HC_PLUGIN_PATH")) $sw = hc_get_sidebars_width($sidebar);
    }
    else $sidebar = "";
    if ($default_content || $sidebar != "") {
        if ($sidebar != "") echo "<div class='sidebar-cnt'>"; ?>
<div class="container content <?php if ($sidebar != "") echo "sidebar-content"; ?>">
    <?php }
    if ($sidebar == "left") {
    ?>
    <div class="row">
        <div class="<?php echo esc_attr($sw["left"]) ?> widget">
            <?php if (is_active_sidebar("left_side_bar")) dynamic_sidebar($woocommerce_prefix . "left_side_bar"); ?>
        </div>
        <div class="<?php echo esc_attr($sw["content"]) ?>">
            <?php show_the_content() ?>
        </div>
    </div>
    <?php
    }
    if ($sidebar == "right") {
    ?>
    <div class="row">
        <div class="<?php echo esc_attr($sw["content"]) ?>">
            <?php show_the_content() ?>
        </div>
        <div class="<?php echo esc_attr($sw["right"]) ?> widget">
            <?php if (is_active_sidebar("right_side_bar")) dynamic_sidebar($woocommerce_prefix . "right_side_bar"); ?>
        </div>
    </div>
    <?php
    }
    if ($sidebar == "right-left") {
    ?>
    <div class="row">
        <div class="<?php echo esc_attr($sw["left"]) ?> widget">
            <?php if (is_active_sidebar("left_side_bar")) dynamic_sidebar($woocommerce_prefix . "left_side_bar"); ?>
        </div>
        <div class="<?php echo esc_attr($sw["content"]) ?>">
            <?php show_the_content() ?>
        </div>
        <div class="<?php echo esc_attr($sw["right"]) ?> widget">
            <?php if (is_active_sidebar("right_side_bar")) dynamic_sidebar($woocommerce_prefix . "right_side_bar"); ?>
        </div>
    </div>
    <?php
    }
    if ($sidebar == "") {
        show_the_content();
    }
    if ($default_content || $sidebar != "") echo "</div></div>";
}
function landkit_search() {
    if (defined("HC_PLUGIN_PATH")) { hc_default_title(); }
    else {
    ?>
    <div class="header-base search-results-header">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="title-base text-left">
                        <h1><?php echo esc_html__("Search results for ","landkit") . get_search_query() ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="content-parallax">
        <div class="section-item section-empty">
               <hr class="space" />
               <div class="content container">
                <?php
    global $query_string;
    global $wp_query;
    $query_args = explode("&", $query_string);
    $search_query = array();
    if( strlen($query_string) > 0 ) {
        foreach($query_args as $key => $string) {
            $query_split = explode("=", $string);
            $search_query[$query_split[0]] = urldecode($query_split[1]);
        }
    }
    if ($wp_query->found_posts > 0) {
        while ($wp_query->have_posts()) {
            $wp_query->the_post();
            $link = get_the_permalink();
            $img = get_the_post_thumbnail_url($wp_query->post->ID, 'large');
            $css = "advs-box-side-icon";
            if ($img != "" && $img != false)  $css = "advs-box-side";
                ?>
                <div class="advs-box <?php echo esc_attr($css) ?> default-box">
                    <div class="row">
<?php
            if ($img != "" && $img != false) {
                echo '<div class="col-md-4"><a  href="' . esc_url($link) . '" class="img-box"><img src="' . esc_url($img) . '" alt="" /></a></div><div class="col-md-8">';
            } else {
                echo '<div class="col-md-12">';
            }
?>                         <h3>
                                <a href="<?php echo esc_url($link) ?>">
                                    <?php echo esc_attr(get_the_title()) ?>
                                </a>
                            </h3>
                            <hr class="anima" />
                            <p>
                                <?php
            if (defined("HC_PLUGIN_PATH")) {
                echo hc_get_the_excerpt($wp_query->post->post_excerpt);
            } else echo get_the_excerpt();
                                ?>
                            </p>
                            <hr class="space s" />
                            <a class=" anima-button btn-text" href="<?php echo esc_url($link) ?>">
                                <?php esc_attr_e("Read more","landkit") ?>
                            </a>
                        </div>
                    </div>
                </div>
                <hr class="space" />
                <?php
        }
    } else echo "<h3 class='no-search-results'>" . esc_html__("No results found ...","landkit") . "</h3><hr class='space row-500' />";
                ?>
            </div>
        </div>
    </div>
    <?php
}
function landkit_set_default_menu() {
    if (($locations = get_nav_menu_locations()) && isset($locations["header-menu"])) {
        $menu = wp_get_nav_menu_object($locations["header-menu"]);
        if (isset($menu->term_id)) {
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            $menu_count = count($menu_items);
            for ($i = 0; $i < $menu_count; $i++) {
                $menu_item = $menu_items[$i];
                if ($menu_item->ID != "-1") {
                    if ($i < $menu_count - 1 && $menu_items[$i + 1]->menu_item_parent == $menu_item->ID) {
    ?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><?php echo esc_attr($menu_item->title) ?> <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <?php
                        for ($j = $i; $j < $menu_count; $j++) {
                            $menu_sub_item_a = $menu_items[$j];
                            if ($menu_items[$j]->menu_item_parent == $menu_item->ID) {
                                if ($j < $menu_count - 1 && $menu_items[$j + 1]->menu_item_parent == $menu_sub_item_a->ID) {
            ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><?php echo esc_attr($menu_sub_item_a->title) ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php
                                    for ($y = $j; $y < $menu_count; $y++) {
                                        $menu_sub_item_b = $menu_items[$y];
                                        if ($menu_items[$y]->menu_item_parent == $menu_sub_item_a->ID) {
                                            $menu_items[$y]->ID = "-1";
                    ?>
                    <li><a href="<?php echo esc_url($menu_sub_item_b->url) ?>"><?php echo esc_attr($menu_sub_item_b->title) ?></a></li>
                    <?php
                                        }
                                    }
                    ?>
                </ul>
            </li>
            <?php
                                } else {
            ?>
            <li><a href="<?php echo esc_url($menu_sub_item_a->url) ?>"><?php echo esc_attr($menu_sub_item_a->title) ?></a></li>
            <?php
                                }
                                $menu_items[$j]->ID = "-1";
                            }
                        }
            ?>
        </ul>
    </li>
    <?php
                    } else {
    ?>
    <li><a href="<?php echo esc_url($menu_item->url) ?>"><?php echo esc_attr($menu_item->title) ?></a></li>
    <?php
                    }
                }
            }
        }
    }
}
    ?>
