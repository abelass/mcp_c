<?php
/**
 * Plugin My Chacra - Pack basique
 * (c) 2012 My Chacra
 * Licence GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

// La feuille de style
function mcp_c_insert_head($flux){
    $flux .= '<link rel="stylesheet" href="'.find_in_path('css/mcp_c_styles.css').'" type="text/css" media="all" />';
    return $flux;
}



?>
