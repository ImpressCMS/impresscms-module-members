<?php
/**
* $Id$
* Module: members
* Author: Rene Sato <www.impresscms.de>
* Licence: GNU
*/

$modversion['name'] = _MI_MEMBERS_NAME;
$modversion['version'] = 2.03;
$modversion['description'] = _MI_MEMBERS_DESC;
$modversion['credits'] = "ImpressCMS.de";
$modversion['author'] = "Version developers: Rene Sato (Lead Developer) | www.ImpressCMS.de";
$modversion['help'] = "members.html";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = "yes";
$modversion['image'] = "members_slogo.png";
$modversion['iconsmall'] = "images/members_iconsmall.png";
$modversion['iconbig'] = "images/members_iconbig.png";
$modversion['dirname'] = "members";

// Admin
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";

// Menu
$modversion['hasMain'] = 1;

// Search
$modversion['hasSearch'] = 0;

// Templates
$modversion['templates'][1]['file'] = 'members_searchform.html';
$modversion['templates'][1]['description'] = 'searchform';
$modversion['templates'][2]['file'] = 'members_searchresults.html';
$modversion['templates'][2]['description'] = 'searchresults';
?>