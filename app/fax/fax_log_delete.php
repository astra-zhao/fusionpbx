<?php
/*
	FusionPBX
	Version: MPL 1.1

	The contents of this file are subject to the Mozilla Public License Version
	1.1 (the "License"); you may not use this file except in compliance with
	the License. You may obtain a copy of the License at
	http://www.mozilla.org/MPL/

	Software distributed under the License is distributed on an "AS IS" basis,
	WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
	for the specific language governing rights and limitations under the
	License.

	The Original Code is FusionPBX

	The Initial Developer of the Original Code is
	Mark J Crane <markjcrane@fusionpbx.com>
	Portions created by the Initial Developer are Copyright (C) 2008-2018
	the Initial Developer. All Rights Reserved.

	Contributor(s):
	Mark J Crane <markjcrane@fusionpbx.com>
*/

//includes
	require_once "root.php";
	require_once "resources/require.php";
	require_once "resources/check_auth.php";

//check permissions
	if (permission_exists('fax_log_delete')) {
		//access granted
	}
	else {
		echo "access denied";
		exit;
	}

//add multi-lingual support
	$language = new text;
	$text = $language->get();

//get the id
	$fax_log_uuid = $_GET["id"];
	$fax_uuid = $_GET["fax_uuid"];

//delete the fax log
	if (is_uuid($fax_log_uuid) && is_uuid($fax_uuid)) {
		//build array
			$array['fax_logs'][0]['domain_uuid'] = $domain_uuid;
			$array['fax_logs'][0]['fax_log_uuid'] = $fax_log_uuid;

		//execute
			$database = new database;
			$database->app_name = 'fax';
			$database->app_uuid = '24108154-4ac3-1db6-1551-4731703a4440';
			$database->delete($array);
			unset($array);

		//set message
			message::add($text['message-delete']);

		//redirect
			header('Location: fax_logs.php?id='.$fax_uuid);
			exit;
	}

//redirect the user
	header('Location: fax.php');
	exit;

?>
