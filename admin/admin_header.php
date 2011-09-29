<?php
/**
* $Id$
* Module: social-bookmarks
* Author: Rene Sato <www.impresscms.de>
* Licence: GNU
*/
include("../../../mainfile.php");
require_once ICMS_ROOT_PATH.'/kernel/module.php';
include(ICMS_ROOT_PATH."/include/cp_functions.php");
if ( $xoopsUser ) {
	$xoopsModule = XoopsModule::getByDirname("members");
	if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) { 
		redirect_header(ICMS_URL."/",3,_NOPERM);
		exit();
	}
} else {
	redirect_header(ICMS_URL."/",3,_NOPERM);
	exit();
}
if ( is_readable("../language/".$xoopsConfig['language']."/admin.php") ) {
	include("../language/".$xoopsConfig['language']."/admin.php");
} else {
	include("../language/english/admin.php");
}
?>