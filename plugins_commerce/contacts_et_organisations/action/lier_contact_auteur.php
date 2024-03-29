<?php
/**
 * Plugin Contacts & Organisations 
 * Licence GPL (c) 2010-2011 Matthieu Marcillaud, Cyril Marion
**/

if (!defined("_ECRIRE_INC_VERSION")) return;

function action_lier_contact_auteur_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}
	$args = explode('/', $arg);

	// cas liaison id_organisation / id_auteur
	if (intval($args[0]) and is_numeric($args[1])) {
		// spip_log("appel à l'action_lier_contact_auteur_dist avec $arg[0] $arg[1] comme argument");
		action_lier_contact_auteur_post($args[0], $args[1]);
	}

	else {
		spip_log("action_lier_contact_auteur_dist $arg pas compris");
	}
}

function action_lier_contact_auteur_post($id_contact, $id_auteur) {

	$id_auteur = intval($id_auteur); // id_auteur peut valoir 0 pour une deliaison
	$id_contact = intval($id_contact);
	if ($id_contact) {
		sql_updateq('spip_contacts', array('id_auteur' => $id_auteur), 'id_contact=' . $id_contact);
		
		//compatibilite
			$champs = array(
				'id_contact' => $id_contact,
				'objet' => 'auteur',
				'id_objet' => $id_auteur
			);
			sql_updateq("spip_contacts_liens", $champs);
					
		include_spip('inc/invalideur');
		suivre_invalideur("id='id_contact/$id_contact'");
	}
}

?>
