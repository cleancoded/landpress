<?php
// =============================================================================
// INDEX.PHP
// =============================================================================

global $query;
if (is_search()) get_template_part('inc/search');
else get_template_part('template-base');

?>
