<?php
// =============================================================================
// TEMPLATE NAME: Two sides
// -----------------------------------------------------------------------------
// Two sides template.
// Documentation: framework-y.com/templates/fullpage/template-fullpage-twosides-documentation.html
// =============================================================================

if (defined("HC_PLUGIN_PATH")) {
    global $HC_PAGE_ARR;
    include(HC_PLUGIN_PATH ."/global-content.php");
}
get_header();
if (defined("HC_PLUGIN_PATH")) include(HC_PLUGIN_PATH . "/twosides.php");
get_footer();

?>
