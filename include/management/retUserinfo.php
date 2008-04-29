<?php

include_once('pages_common.php');
include_once('../common/calcs.php');



if (isset($_GET['retBandwidthInfo'])) {

	$divContainer = $_GET['divContainer'];				// get target div id
	$username = $_GET['username'];

	include('../../library/opendb.php');

	$sql = "SELECT SUM(AcctInputOctets) AS Upload, SUM(AcctOutputOctets) AS Download FROM ".
		$configValues['CONFIG_DB_TBL_RADACCT']." WHERE UserName='".
		$dbSocket->escapeSimple($username)."'";
	$res = $dbSocket->query($sql);
	$row = $res->fetchRow(DB_FETCHMODE_ASSOC);

	$upload = bytes2megabytes($row['Upload'])."Mb";
	$download = bytes2megabytes($row['Download'])."Mb";
	

	printqn("
		var divContainer = document.getElementById('{$divContainer}');
		divContainer.innerHTML = 'Upload: $upload <br/> Download: $download';
	");


}



?>