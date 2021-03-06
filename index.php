<?php
/**
* $Id$
* Module: members
* Author: Rene Sato <www.impresscms.de>
* Licence: GNU
*/

include "../../mainfile.php";

$op = "form";
if ( isset($_POST['op']) && $_POST['op'] == "submit" ) {
	$op = "submit";
}

if ( $op == "form" ) {
	$xoopsOption['template_main'] = 'members_searchform.html';
	include ICMS_ROOT_PATH."/header.php";
	$member_handler =& xoops_gethandler('member');
	$total = $member_handler->getUserCount(new Criteria('level', 0, '>'));
	include_once ICMS_ROOT_PATH."/class/xoopsformloader.php";
	$group_select = new XoopsFormSelectGroup(_AM_GROUPS, "selgroups", null, false, 5, true);
	$uname_text = new XoopsFormText("", "user_uname", 30, 60);
	$uname_match = new XoopsFormSelectMatchOption("", "user_uname_match");
	$uname_tray = new XoopsFormElementTray(_MM_UNAME, "&nbsp;");
	$uname_tray->addElement($uname_match);
	$uname_tray->addElement($uname_text);
	$name_text = new XoopsFormText("", "user_name", 30, 60);
	$name_match = new XoopsFormSelectMatchOption("", "user_name_match");
	$name_tray = new XoopsFormElementTray(_MM_REALNAME, "&nbsp;");
	$name_tray->addElement($name_match);
	$name_tray->addElement($name_text);
	$email_text = new XoopsFormText("", "user_email", 30, 60);
	$email_match = new XoopsFormSelectMatchOption("", "user_email_match");
	$email_tray = new XoopsFormElementTray(_MM_EMAIL, "&nbsp;");
	$email_tray->addElement($email_match);
	$email_tray->addElement($email_text);
	$url_text = new XoopsFormText(_MM_URLC, "user_url", 30, 100);
	//$theme_select = new XoopsFormSelectTheme(_MM_THEME, "user_theme");
	//$timezone_select = new XoopsFormSelectTimezone(_MM_TIMEZONE, "user_timezone_offset");
	$icq_text = new XoopsFormText("", "user_icq", 30, 100);
	$icq_match = new XoopsFormSelectMatchOption("", "user_icq_match");
	$icq_tray = new XoopsFormElementTray(_MM_ICQ, "&nbsp;");
	$icq_tray->addElement($icq_match);
	$icq_tray->addElement($icq_text);
	$aim_text = new XoopsFormText("", "user_aim", 30, 100);
	$aim_match = new XoopsFormSelectMatchOption("", "user_aim_match");
	$aim_tray = new XoopsFormElementTray(_MM_AIM, "&nbsp;");
	$aim_tray->addElement($aim_match);
	$aim_tray->addElement($aim_text);
	$yim_text = new XoopsFormText("", "user_yim", 30, 100);
	$yim_match = new XoopsFormSelectMatchOption("", "user_yim_match");
	$yim_tray = new XoopsFormElementTray(_MM_YIM, "&nbsp;");
	$yim_tray->addElement($yim_match);
	$yim_tray->addElement($yim_text);
	$msnm_text = new XoopsFormText("", "user_msnm", 30, 100);
	$msnm_match = new XoopsFormSelectMatchOption("", "user_msnm_match");
	$msnm_tray = new XoopsFormElementTray(_MM_MSNM, "&nbsp;");
	$msnm_tray->addElement($msnm_match);
	$msnm_tray->addElement($msnm_text);
	$location_text = new XoopsFormText(_MM_LOCATION, "user_from", 30, 100);
	$occupation_text = new XoopsFormText(_MM_OCCUPATION, "user_occ", 30, 100);
	$interest_text = new XoopsFormText(_MM_INTEREST, "user_intrest", 30, 100);
	$sort_select = new XoopsFormSelect(_MM_SORT, "user_sort");
	$sort_select->addOptionArray(array(
		"uname"=>_MM_UNAME,
		"user_from"=>_MM_LOCATION,
		"email"=>_MM_EMAIL,
		"last_login"=>_MM_LASTLOGIN,
		"user_regdate"=>_MM_REGDATE,
		"posts"=>_MM_POSTS
	));
	$order_select = new XoopsFormSelect(_MM_ORDER, "user_order");
	$order_select->addOptionArray(array("ASC"=>_MM_ASC,"DESC"=>_MM_DESC));
	$limit_text = new XoopsFormText(_MM_LIMIT, "limit", 6, 2);
	$op_hidden = new XoopsFormHidden("op", "submit");
	$submit_button = new XoopsFormButton("", "user_submit", _SUBMIT, "submit");

	$form = new XoopsThemeForm("", "searchform", "index.php");
	$form->addElement($uname_tray);
	$form->addElement($name_tray);
	$form->addElement($user_genre_tray);
	$form->addElement($email_tray);
	$form->addElement($group_select);
	//$form->addElement($theme_select);
	//$form->addElement($timezone_select);
	$form->addElement($icq_tray);
	$form->addElement($aim_tray);
	$form->addElement($yim_tray);
	$form->addElement($msnm_tray);
	$form->addElement($url_text);
	$form->addElement($location_text);
	$form->addElement($user_codepostal_text);
	$form->addElement($user_regionfr_text);
	$form->addElement($user_planete_text);
	$form->addElement($occupation_text);
	$form->addElement($interest_text);
	$form->addElement($lastlog_more);
	$form->addElement($lastlog_less);
	$form->addElement($reg_more);
	$form->addElement($reg_less);
	$form->addElement($posts_more);
	$form->addElement($posts_less);
	$form->addElement($sort_select);
	$form->addElement($order_select);
	$form->addElement($limit_text);
	$form->addElement($op_hidden);
	 // if this is to find users for a specific group
    if ( !empty($_GET['group']) && intval($_GET['group']) > 0 ) {
        $group_hidden = new XoopsFormHidden("group", intval($_GET['group']));
        $form->addElement($group_hidden);
    }
	$form->addElement($submit_button);
	$form->assign($xoopsTpl);
	$xoopsTpl->assign('lang_search', _MM_SEARCH);
	$xoopsTpl->assign('lang_totalusers', sprintf(_MM_TOTALUSERS, '<span style="color:#ff0000;">'.$total.'</span>'));
}

if ( $op == "submit" ) {
	$xoopsOption['template_main'] = 'members_searchresults.html';
	include ICMS_ROOT_PATH."/header.php";
	$iamadmin = $xoopsUserIsAdmin;
	$myts =& MyTextSanitizer::getInstance();
	$criteria = new CriteriaCompo();
	if ( !empty($_POST['user_uname']) ) {
		$match = (!empty($_POST['user_uname_match'])) ? intval($_POST['user_uname_match']) : XOOPS_MATCH_START;
		switch ( $match ) {
		case XOOPS_MATCH_START:
			$criteria->add(new Criteria('uname', $myts->addSlashes(trim($_POST['user_uname'])).'%', 'LIKE'));
			break;
		case XOOPS_MATCH_END:
			$criteria->add(new Criteria('uname', '%'.$myts->addSlashes(trim($_POST['user_uname'])), 'LIKE'));
			break;
		case XOOPS_MATCH_EQUAL:
			$criteria->add(new Criteria('uname', $myts->addSlashes(trim($_POST['user_uname']))));
			break;
		case XOOPS_MATCH_CONTAIN:
			$criteria->add(new Criteria('uname', '%'.$myts->addSlashes(trim($_POST['user_uname'])).'%', 'LIKE'));
			break;
		}
	}
	if ( !empty($_POST['user_name']) ) {
		$match = (!empty($_POST['user_name_match'])) ? intval($_POST['user_name_match']) : XOOPS_MATCH_START;
		switch ($match) {
		case XOOPS_MATCH_START:
			$criteria->add(new Criteria('name', $myts->addSlashes(trim($_POST['user_name'])).'%', 'LIKE'));
			break;
		case XOOPS_MATCH_END:
			$criteria->add(new Criteria('name', '%'.$myts->addSlashes(trim($_POST['user_name'])).'%', 'LIKE'));
			break;
		case XOOPS_MATCH_EQUAL:
			$criteria->add(new Criteria('name', $myts->addSlashes(trim($_POST['user_name']))));
			break;
		case XOOPS_MATCH_CONTAIN:
			$criteria->add(new Criteria('name', '%'.$myts->addSlashes(trim($_POST['user_name'])).'%', 'LIKE'));
			break;
		}
	}
	if ( !empty($_POST['user_email']) ) {
		$match = (!empty($_POST['user_email_match'])) ? intval($_POST['user_email_match']) : XOOPS_MATCH_START;
		switch ($match) {
		case XOOPS_MATCH_START:
			$criteria->add(new Criteria('email', $myts->addSlashes(trim($_POST['user_email'])).'%', 'LIKE'));
			break;
		case XOOPS_MATCH_END:
			$criteria->add(new Criteria('email', '%'.$myts->addSlashes(trim($_POST['user_email'])), 'LIKE'));
			break;
		case XOOPS_MATCH_EQUAL:
			$criteria->add(new Criteria('email', $myts->addSlashes(trim($_POST['user_email']))));
			break;
		case XOOPS_MATCH_CONTAIN:
			$criteria->add(new Criteria('email', '%'.$myts->addSlashes(trim($_POST['user_email'])).'%', 'LIKE'));
			break;
		}
		if ( !$iamadmin ) {
			$criteria->add(new Criteria('user_viewemail', 1));
		}
	}
	if ( !empty($_POST['user_url']) ) {
		$url = formatURL(trim($_POST['user_url']));
		$criteria->add(new Criteria('url', $myts->addSlashes($url).'%', 'LIKE'));
	}
	if ( !empty($_POST['user_icq']) ) {
		$match = (!empty($_POST['user_icq_match'])) ? intval($_POST['user_icq_match']) : XOOPS_MATCH_START;
		switch ($match) {
		case XOOPS_MATCH_START:
			$criteria->add(new Criteria('user_icq', $myts->addSlashes(trim($_POST['user_icq'])).'%', 'LIKE'));
			break;
		case XOOPS_MATCH_END:
			$criteria->add(new Criteria('user_icq', '%'.$myts->addSlashes(trim($_POST['user_icq'])), 'LIKE'));
			break;
		case XOOPS_MATCH_EQUAL:
			$criteria->add(new Criteria('user_icq', $myts->addSlashes(trim($_POST['user_icq']))));
			break;
		case XOOPS_MATCH_CONTAIN:
			$criteria->add(new Criteria('user_icq', '%'.$myts->addSlashes(trim($_POST['user_icq'])).'%', 'LIKE'));
			break;
		}
	}
	if ( !empty($_POST['user_aim']) ) {
		$match = (!empty($_POST['user_aim_match'])) ? intval($_POST['user_aim_match']) : XOOPS_MATCH_START;
		switch ($match) {
		case XOOPS_MATCH_START:
			$criteria->add(new Criteria('user_aim', $myts->addSlashes(trim($_POST['user_aim'])).'%', 'LIKE'));
			break;
		case XOOPS_MATCH_END:
			$criteria->add(new Criteria('user_aim', '%'.$myts->addSlashes(trim($_POST['user_aim'])), 'LIKE'));
			break;
		case XOOPS_MATCH_EQUAL:
			$criteria->add(new Criteria('user_aim', $myts->addSlashes(trim($_POST['user_aim']))));
			break;
		case XOOPS_MATCH_CONTAIN:
			$criteria->add(new Criteria('user_aim', '%'.$myts->addSlashes(trim($_POST['user_aim'])).'%', 'LIKE'));
			break;
		}
	}
	if ( !empty($_POST['user_yim']) ) {
		$match = (!empty($_POST['user_yim_match'])) ? intval($_POST['user_yim_match']) : XOOPS_MATCH_START;
		switch ($match) {
		case XOOPS_MATCH_START:
			$criteria->add(new Criteria('user_yim', $myts->addSlashes(trim($_POST['user_yim'])).'%', 'LIKE'));
			break;
		case XOOPS_MATCH_END:
			$criteria->add(new Criteria('user_yim', '%'.$myts->addSlashes(trim($_POST['user_yim'])), 'LIKE'));
			break;
		case XOOPS_MATCH_EQUAL:
			$criteria->add(new Criteria('user_yim', $myts->addSlashes(trim($_POST['user_yim']))));
			break;
		case XOOPS_MATCH_CONTAIN:
			$criteria->add(new Criteria('user_yim', '%'.$myts->addSlashes(trim($_POST['user_yim'])).'%', 'LIKE'));
			break;
		}
	}
	if ( !empty($_POST['user_msnm']) ) {
		$match = (!empty($_POST['user_msnm_match'])) ? intval($_POST['user_msnm_match']) : XOOPS_MATCH_START;
		switch ($match) {
		case XOOPS_MATCH_START:
			$criteria->add(new Criteria('user_msnm', $myts->addSlashes(trim($_POST['user_msnm'])).'%', 'LIKE'));
			break;
		case XOOPS_MATCH_END:
			$criteria->add(new Criteria('user_msnm', '%'.$myts->addSlashes(trim($_POST['user_msnm'])), 'LIKE'));
			break;
		case XOOPS_MATCH_EQUAL:
			$criteria->add(new Criteria('user_msnm', $myts->addSlashes(trim($_POST['user_msnm']))));
			break;
		case XOOPS_MATCH_CONTAIN:
			$criteria->add(new Criteria('user_msnm', '%'.$myts->addSlashes(trim($_POST['user_msnm'])).'%', 'LIKE'));
			break;
		}
	}
	if ( !empty($_POST['user_from']) ) {
		$criteria->add(new Criteria('user_from', '%'.$myts->addSlashes(trim($_POST['user_from'])).'%', 'LIKE'));
	}
	if ( !empty($_POST['user_intrest']) ) {
		$criteria->add(new Criteria('user_intrest', '%'.$myts->addSlashes(trim($_POST['user_intrest'])).'%', 'LIKE'));
	}
	if ( !empty($_POST['user_occ']) ) {
		$criteria->add(new Criteria('user_occ', '%'.$myts->addSlashes(trim($_POST['user_occ'])).'%', 'LIKE'));
	}
	$groups = empty($_POST['selgroups']) ? array() : array_map("intval", $_POST['selgroups']);
	$criteria->add(new Criteria('level', 0, '>'));
	$validsort = array(
		"uname", 
		"user_genre", 
		"user_tonage", 
		"user_orientation", 
		"user_from", 
		"user_codepostal", 
		"user_planete", 
		"email", 
		"last_login", 
		"user_regdate", 
		"posts"
	);
	$sort = (!in_array($_POST['user_sort'], $validsort)) ? "uname" : $_POST['user_sort'];
	$order = "ASC";
	if ( isset($_POST['user_order']) && $_POST['user_order'] == "DESC") {
		$order = "DESC";
	}
	$limit = (!empty($_POST['limit'])) ? intval($_POST['limit']) : 20;
	if ( $limit == 0 || $limit > 50 ) {
		$limit = 50;
	}
	$start = (!empty($_POST['start'])) ? intval($_POST['start']) : 0;
	$member_handler =& xoops_gethandler('member');
	$total = $member_handler->getUserCountByGroupLink($groups, $criteria);
	//$total = $member_handler->getUserCount($criteria);
	$xoopsTpl->assign('lang_search', _MM_SEARCH);
	$xoopsTpl->assign('lang_results', _MM_RESULTS);
	$xoopsTpl->assign('total_found', $total);
	if ( $total == 0 ) {
		$xoopsTpl->assign('lang_nonefound', _MM_NOFOUND);
	} elseif ( $start < $total ) {
		$xoopsTpl->assign('lang_username', _MM_UNAME);
		$xoopsTpl->assign('lang_realname', _MM_REALNAME);
		$xoopsTpl->assign('lang_from', _MM_LOCATION);
		$xoopsTpl->assign('lang_avatar', _MM_AVATAR);
		$xoopsTpl->assign('lang_email', _MM_EMAIL);
		$xoopsTpl->assign('lang_privmsg', _MM_PM);
		$xoopsTpl->assign('lang_regdate', _MM_REGDATE);
		$xoopsTpl->assign('lang_lastlogin', _MM_LASTLOGIN);
		$xoopsTpl->assign('lang_posts', _MM_POSTS);
		$xoopsTpl->assign('lang_url', _MM_URL);
		$xoopsTpl->assign('lang_admin', _MM_ADMIN);
		if ( $iamadmin ) {
			$xoopsTpl->assign('is_admin', true);
		}
		$criteria->setSort($sort);
		$criteria->setOrder($order);
		$criteria->setStart($start);
		$criteria->setLimit($limit);
		$foundusers =& $member_handler->getUsersByGroupLink($groups, $criteria, true);
		//$foundusers =& $member_handler->getUsers($criteria, true);
		foreach (array_keys($foundusers) as $j) {
			$userdata['avatar'] = $foundusers[$j]->getVar("user_avatar") ? "<img src='".XOOPS_UPLOAD_URL."/".$foundusers[$j]->getVar("user_avatar")."' alt='' />" : "&nbsp;";
			$userdata['realname'] = $foundusers[$j]->getVar("name") ? $foundusers[$j]->getVar("name") : "&nbsp;";
			$userdata['name'] = $foundusers[$j]->getVar("uname");
			$userdata['user_from'] = $foundusers[$j]->getVar("user_from");
			$userdata['id'] = $foundusers[$j]->getVar("uid");
			if ( $foundusers[$j]->getVar("user_viewemail") == 1 || $iamadmin ) {
				$userdata['email'] = "<a href='mailto:".$foundusers[$j]->getVar("email")."'><img src='".ICMS_URL."/images/icons/email.gif' border='0' alt='".sprintf(_SENDEMAILTO,$foundusers[$j]->getVar("uname", "E"))."' /></a>";
			} else {
				$userdata['email'] = "&nbsp;";
			}
			if ( $xoopsUser ) {
				$userdata['pmlink'] = "<a href='javascript:openWithSelfMain(\"".ICMS_URL."/pmlite.php?send2=1&amp;to_userid=".$foundusers[$j]->getVar("uid")."\",\"pmlite\",800,680);'><img src='".ICMS_URL."/images/icons/pm.gif' border='0' alt='".sprintf(_SENDPMTO,$foundusers[$j]->getVar("uname", "E"))."' /></a>";
			} else {
				$userdata['pmlink'] = "&nbsp;";
			}
			if ( $foundusers[$j]->getVar("url","E") != "" ) {
				$userdata['website'] =  "<a href='".$foundusers[$j]->getVar("url","E")."' target='_blank'><img src='".ICMS_URL."/images/icons/www.gif' border='0' alt='"._VISITWEBSITE."' /></a>";
			} else {
				$userdata['website'] =  "&nbsp;";
			}
			$userdata['registerdate'] = formatTimeStamp($foundusers[$j]->getVar("user_regdate"),"s");
			if ( $foundusers[$j]->getVar("last_login") != 0 ) {
				$userdata['lastlogin'] =  formatTimeStamp($foundusers[$j]->getVar("last_login"),"m");
			} else {
				$userdata['lastlogin'] =  "&nbsp;";
			}
			$userdata['posts'] = $foundusers[$j]->getVar("posts");
			if ( $iamadmin ) {
				$userdata['adminlink'] = "<a href='".ICMS_URL."/modules/system/admin.php?fct=users&amp;uid=".$foundusers[$j]->getVar("uid")."&amp;op=modifyUser'>"._EDIT."</a> | <a href='".ICMS_URL."/modules/system/admin.php?fct=users&amp;op=delUser&amp;uid=".$foundusers[$j]->getVar("uid")."'>"._DELETE."</a>";
			}
			$xoopsTpl->append('users', $userdata);
		}
		$group = !empty($_POST['group']) ? intval($_POST['group']) : 0;
        if ( $group > 0 ) {
            $member_handler =& xoops_gethandler('member');
            $add2group =& $member_handler->getGroup($group);
            echo "<option value='groups' selected='selected'>".sprintf(_AM_ADD2GROUP, $add2group->getVar('name'))."</option>";
        }
        echo "</select>&nbsp;";
        if ( $group > 0 ) {
            echo "<input type='hidden' name='groupid' value='".$group."' />";
        }
    //    echo "</td><td colspan='10'>".$GLOBALS['xoopsSecurity']->getTokenHTML()."<input type='submit' value='"._SUBMIT."' /></td></tr></table></form>\n";
        
		$totalpages = ceil($total / $limit);
		if ( $totalpages > 1 ) {
			$hiddenform = "<form name='findnext' action='index.php' method='post'>";
			$skip_vars = array('selgroups');
			foreach ( $_POST as $k => $v ) {
			if ($k == 'selgroups') {
		            foreach( $_POST['selgroups'] as $_group){
		 				$hiddenform .= "<input type='hidden' name='selgroups[]' value='".$_group."' />\n";
		            }
	            } elseif ($k == 'XOOPS_TOKEN_REQUEST') {
                    // regenerate token value
                    $hiddenform .= $GLOBALS['xoopsSecurity']->getTokenHTML()."\n";
                } else {
                    $hiddenform .= "<input type='hidden' name='".$myts->htmlSpecialChars($k)."' value='".$myts->htmlSpecialChars($myts->stripSlashesGPC($v))."' />\n";
                }
				// $hiddenform .= "<input type='hidden' name='".$myts->oopsHtmlSpecialChars($k)."' value='".$myts->makeTboxData4PreviewInForm($v)."' />\n";
			}
			if (!isset($_POST['limit'])) {
				$hiddenform .= "<input type='hidden' name='limit' value='".$limit."' />\n";
			}
			if (!isset($_POST['start'])) {
				$hiddenform .= "<input type='hidden' name='start' value='".$start."' />\n";
			}
			$prev = $start - $limit;
			if ( $start - $limit >= 0 ) {
				$hiddenform .= "<a href='#0' onclick='javascript:document.findnext.start.value=".$prev.";document.findnext.submit();'>"._MM_PREVIOUS."</a>&nbsp;\n";
        	}
			$counter = 1;
			$currentpage = ($start+$limit) / $limit;
			while ( $counter <= $totalpages ) {
				if ( $counter == $currentpage ) {
					$hiddenform .= "<b>".$counter."</b> ";
				} elseif ( ($counter > $currentpage-4 && $counter < $currentpage+4) || $counter == 1 || $counter == $totalpages ) {
					if ( $counter == $totalpages && $currentpage < $totalpages-4 ) {
						$hiddenform .= "... ";
					}
					$hiddenform .= "<a href='#".$counter."' onclick='javascript:document.findnext.start.value=".($counter-1)*$limit.";document.findnext.submit();'>".$counter."</a> ";
					if ( $counter == 1 && $currentpage > 5 ) {
						$hiddenform .= "... ";
					}
				}
				$counter++;
			}
			$next = $start+$limit;
			if ( $total > $next ) {
				$hiddenform .= "&nbsp;<a href='#".$total."' onclick='javascript:document.findnext.start.value=".$next.";document.findnext.submit();'>"._MM_NEXT."</a>\n";
			}
			$hiddenform .= "</form>";
			$xoopsTpl->assign('pagenav', $hiddenform);
			$xoopsTpl->assign('lang_numfound', sprintf(_MM_USERSFOUND, $total));
		}
	}
}

include_once ICMS_ROOT_PATH."/footer.php";
?>