<?php
// =============================================================================
// TEMPLATE NAME: Fullpage
// -----------------------------------------------------------------------------
// Fullpage template.
// Documentation: framework-y.com/templates/fullpage/template-fullpage-documentation.html
// =============================================================================

if (defined("HC_PLUGIN_PATH")) {
    global $HC_PAGE_ARR;
    include(HC_PLUGIN_PATH . "/global-content.php");
}

get_header();
if (defined("HC_PLUGIN_PATH")) include(HC_PLUGIN_PATH . "/fullpage.php");
get_footer();

?>
