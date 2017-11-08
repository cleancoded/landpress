<?php
// =============================================================================
// HEADER.PHP
// -----------------------------------------------------------------------------
// Header of the theme.
// =============================================================================
?>
<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="wordpress">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php 
    if (defined("HC_PLUGIN_PATH")) {
        global $HC_THEME_SETTINGS;
        global $HC_PAGE_ARR;
        include_once(HC_PLUGIN_PATH . "/inc/front-functions.php");
        include_once(HC_PLUGIN_PATH ."/global-content.php");
        
        if (!function_exists('has_site_icon') || !has_site_icon()) {   ?>
        <link rel="shortcut icon" href="<?php echo esc_url(hc_get_setting("favicon")) ?>" />
        <?php }
        wp_head();
        ?>
    </head>
    <body <?php body_class(); if (in_array("inner_menu",hc_get_now($HC_PAGE_ARR, array("page_setting","settings"))) || hc_get_setting('menu-one-page') == "checked") echo ' data-spy="scroll" data-target="#hc-inner-menu" data-offset="200"';?> <?php hc_echo(hc_get_setting('site-background-color'),'style="background-color: ',';"') ?>>
        <?php
        hc_header_engine();
    } else { 
        //The code block below is only a default code block. It is applied only at first time theme activation and disabled when the theme's plugin is activated. 
        //The logo can be changed from the theme options panel once the plugin has been activated.
        wp_head();
        ?>
        </head>
        <body <?php body_class() ?>>
            <header>
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar navbar-main">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand" href="<?php echo esc_url(get_site_url()) ?>"><img src="<?php echo esc_url(get_template_directory_uri() . "/inc/logo.png") ?>" alt="logo" /></a>
                            </div>
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav over">
                                    <?php landkit_set_default_menu() ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
<?php }
?>
