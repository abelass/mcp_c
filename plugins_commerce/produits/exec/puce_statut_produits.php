<?php

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/presentation');

// http://doc.spip.org/@exec_puce_statut_dist
function exec_puce_statut_produits_dist()
{
	exec_puce_statut_produits_args(_request('id'),  _request('type'));
}

// http://doc.spip.org/@exec_puce_statut_args
function exec_puce_statut_produits_args($id, $type)
{
	if (in_array($type,array('produit'))) {
		$table = table_objet_sql($type);
		$prim = id_table_objet($type);
		$id = intval($id);
		$r = sql_fetsel("id_rubrique,statut", "$table", "$prim=$id");
		$statut = $r['statut'];
		$id_rubrique = $r['id_rubrique'];
	} else {
		$id_rubrique = intval($id);
		$statut = 'prop'; // arbitraire
	}
	$puce_statut = charger_fonction('puce_statut', 'inc');
	ajax_retour($puce_statut($id,$statut,$id_rubrique,$type, true));
}
?>
