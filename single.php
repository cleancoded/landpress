<?php
// =============================================================================
// SINGLE.PHP
// -----------------------------------------------------------------------------
// Template file for single blog posts.
// =============================================================================

if (defined("HC_PLUGIN_PATH")) {
    include(HC_PLUGIN_PATH . "/global-content.php");
}
get_header();
landkit_the_content();
get_footer();
?>
