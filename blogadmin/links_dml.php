<?php

// Data functions (insert, update, delete, form) for table links

// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

function links_insert(){
	global $Translation;

	// mm: can member insert record?
	$arrPerm=getTablePermissions('links');
	if(!$arrPerm[1]){
		return false;
	}

	$data['facebook'] = makeSafe($_REQUEST['facebook']);
		if($data['facebook'] == empty_lookup_value){ $data['facebook'] = ''; }
	$data['twitter'] = makeSafe($_REQUEST['twitter']);
		if($data['twitter'] == empty_lookup_value){ $data['twitter'] = ''; }
	$data['googleplus'] = makeSafe($_REQUEST['googleplus']);
		if($data['googleplus'] == empty_lookup_value){ $data['googleplus'] = ''; }
	$data['pinterest'] = makeSafe($_REQUEST['pinterest']);
		if($data['pinterest'] == empty_lookup_value){ $data['pinterest'] = ''; }
	$data['dribble'] = makeSafe($_REQUEST['dribble']);
		if($data['dribble'] == empty_lookup_value){ $data['dribble'] = ''; }
	$data['comments_script'] = br2nl(makeSafe($_REQUEST['comments_script']));
	$data['sharing_script'] = br2nl(makeSafe($_REQUEST['sharing_script']));
	$data['javascript'] = br2nl(makeSafe($_REQUEST['javascript']));

	// hook: links_before_insert
	if(function_exists('links_before_insert')){
		$args=array();
		if(!links_before_insert($data, getMemberInfo(), $args)){ return false; }
	}

	$o = array('silentErrors' => true);
	sql('insert into `links` set       `facebook`=' . (($data['facebook'] !== '' && $data['facebook'] !== NULL) ? "'{$data['facebook']}'" : 'NULL') . ', `twitter`=' . (($data['twitter'] !== '' && $data['twitter'] !== NULL) ? "'{$data['twitter']}'" : 'NULL') . ', `googleplus`=' . (($data['googleplus'] !== '' && $data['googleplus'] !== NULL) ? "'{$data['googleplus']}'" : 'NULL') . ', `pinterest`=' . (($data['pinterest'] !== '' && $data['pinterest'] !== NULL) ? "'{$data['pinterest']}'" : 'NULL') . ', `dribble`=' . (($data['dribble'] !== '' && $data['dribble'] !== NULL) ? "'{$data['dribble']}'" : 'NULL') . ', `comments_script`=' . (($data['comments_script'] !== '' && $data['comments_script'] !== NULL) ? "'{$data['comments_script']}'" : 'NULL') . ', `sharing_script`=' . (($data['sharing_script'] !== '' && $data['sharing_script'] !== NULL) ? "'{$data['sharing_script']}'" : 'NULL') . ', `javascript`=' . (($data['javascript'] !== '' && $data['javascript'] !== NULL) ? "'{$data['javascript']}'" : 'NULL'), $o);
	if($o['error']!=''){
		echo $o['error'];
		echo "<a href=\"links_view.php?addNew_x=1\">{$Translation['< back']}</a>";
		exit;
	}

	$recID = db_insert_id(db_link());

	// hook: links_after_insert
	if(function_exists('links_after_insert')){
		$res = sql("select * from `links` where `id`='" . makeSafe($recID, false) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=array();
		if(!links_after_insert($data, getMemberInfo(), $args)){ return $recID; }
	}

	// mm: save ownership data
	set_record_owner('links', $recID, getLoggedMemberID());

	return $recID;
}

function links_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false){
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('links');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='links' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='links' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: links_before_delete
	if(function_exists('links_before_delete')){
		$args=array();
		if(!links_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	sql("delete from `links` where `id`='$selected_id'", $eo);

	// hook: links_after_delete
	if(function_exists('links_after_delete')){
		$args=array();
		links_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='links' and pkValue='$selected_id'", $eo);
}

function links_update($selected_id){
	global $Translation;

	// mm: can member edit record?
	$arrPerm=getTablePermissions('links');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='links' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='links' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){ // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['facebook'] = makeSafe($_REQUEST['facebook']);
		if($data['facebook'] == empty_lookup_value){ $data['facebook'] = ''; }
	$data['twitter'] = makeSafe($_REQUEST['twitter']);
		if($data['twitter'] == empty_lookup_value){ $data['twitter'] = ''; }
	$data['googleplus'] = makeSafe($_REQUEST['googleplus']);
		if($data['googleplus'] == empty_lookup_value){ $data['googleplus'] = ''; }
	$data['pinterest'] = makeSafe($_REQUEST['pinterest']);
		if($data['pinterest'] == empty_lookup_value){ $data['pinterest'] = ''; }
	$data['dribble'] = makeSafe($_REQUEST['dribble']);
		if($data['dribble'] == empty_lookup_value){ $data['dribble'] = ''; }
	$data['comments_script'] = br2nl(makeSafe($_REQUEST['comments_script']));
	$data['sharing_script'] = br2nl(makeSafe($_REQUEST['sharing_script']));
	$data['javascript'] = br2nl(makeSafe($_REQUEST['javascript']));
	$data['selectedID']=makeSafe($selected_id);

	// hook: links_before_update
	if(function_exists('links_before_update')){
		$args=array();
		if(!links_before_update($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('update `links` set       `facebook`=' . (($data['facebook'] !== '' && $data['facebook'] !== NULL) ? "'{$data['facebook']}'" : 'NULL') . ', `twitter`=' . (($data['twitter'] !== '' && $data['twitter'] !== NULL) ? "'{$data['twitter']}'" : 'NULL') . ', `googleplus`=' . (($data['googleplus'] !== '' && $data['googleplus'] !== NULL) ? "'{$data['googleplus']}'" : 'NULL') . ', `pinterest`=' . (($data['pinterest'] !== '' && $data['pinterest'] !== NULL) ? "'{$data['pinterest']}'" : 'NULL') . ', `dribble`=' . (($data['dribble'] !== '' && $data['dribble'] !== NULL) ? "'{$data['dribble']}'" : 'NULL') . ', `comments_script`=' . (($data['comments_script'] !== '' && $data['comments_script'] !== NULL) ? "'{$data['comments_script']}'" : 'NULL') . ', `sharing_script`=' . (($data['sharing_script'] !== '' && $data['sharing_script'] !== NULL) ? "'{$data['sharing_script']}'" : 'NULL') . ', `javascript`=' . (($data['javascript'] !== '' && $data['javascript'] !== NULL) ? "'{$data['javascript']}'" : 'NULL') . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!=''){
		echo $o['error'];
		echo '<a href="links_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: links_after_update
	if(function_exists('links_after_update')){
		$res = sql("SELECT * FROM `links` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!links_after_update($data, getMemberInfo(), $args)){ return; }
	}

	// mm: update ownership data
	sql("update membership_userrecords set dateUpdated='".time()."' where tableName='links' and pkValue='".makeSafe($selected_id)."'", $eo);

}

function links_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = ''){
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('links');
	if(!$arrPerm[1] && $selected_id==''){ return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != ''){
		$dvprint = true;
	}


	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');

	if($selected_id){
		// mm: check member permissions
		if(!$arrPerm[2]){
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='links' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='links' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID){
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID){
			return "";
		}

		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("select * from `links` where `id`='".makeSafe($selected_id)."'", $eo);
		if(!($row = db_fetch_array($res))){
			return error_message($Translation['No records found'], 'links_view.php', false);
		}
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
	}else{
	}

	// code for template based detail view forms

	// open the detail view template
	if($dvprint){
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/links_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	}else{
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/links_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Link details', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert){
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return links_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return links_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']){
		$backAction = 'AppGini.closeParentModal(); return false;';
	}else{
		$backAction = '$j(\'form\').eq(0).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id){
		if(!$_REQUEST['Embedded']) $templateCode = str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$$(\'form\')[0].writeAttribute(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate){
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return links_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');" title="' . html_attr($Translation['Delete']) . '"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)){
		$jsReadOnly .= "\tjQuery('#facebook').replaceWith('<div class=\"form-control-static\" id=\"facebook\">' + (jQuery('#facebook').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#twitter').replaceWith('<div class=\"form-control-static\" id=\"twitter\">' + (jQuery('#twitter').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#googleplus').replaceWith('<div class=\"form-control-static\" id=\"googleplus\">' + (jQuery('#googleplus').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#pinterest').replaceWith('<div class=\"form-control-static\" id=\"pinterest\">' + (jQuery('#pinterest').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#dribble').replaceWith('<div class=\"form-control-static\" id=\"dribble\">' + (jQuery('#dribble').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#comments_script').replaceWith('<div class=\"form-control-static\" id=\"comments_script\">' + (jQuery('#comments_script').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#sharing_script').replaceWith('<div class=\"form-control-static\" id=\"sharing_script\">' + (jQuery('#sharing_script').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#javascript').replaceWith('<div class=\"form-control-static\" id=\"javascript\">' + (jQuery('#javascript').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert){
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array();
	foreach($lookup_fields as $luf => $ptfc){
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']){
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] && !$_REQUEST['Embedded']){
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(facebook)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(twitter)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(googleplus)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(pinterest)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(dribble)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(comments_script)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(sharing_script)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(javascript)%%>', '', $templateCode);

	// process values
	if($selected_id){
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(facebook)%%>', safe_html($urow['facebook']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(facebook)%%>', html_attr($row['facebook']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(facebook)%%>', urlencode($urow['facebook']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(twitter)%%>', safe_html($urow['twitter']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(twitter)%%>', html_attr($row['twitter']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(twitter)%%>', urlencode($urow['twitter']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(googleplus)%%>', safe_html($urow['googleplus']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(googleplus)%%>', html_attr($row['googleplus']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(googleplus)%%>', urlencode($urow['googleplus']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(pinterest)%%>', safe_html($urow['pinterest']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(pinterest)%%>', html_attr($row['pinterest']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(pinterest)%%>', urlencode($urow['pinterest']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(dribble)%%>', safe_html($urow['dribble']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(dribble)%%>', html_attr($row['dribble']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(dribble)%%>', urlencode($urow['dribble']), $templateCode);
		if($dvprint || (!$AllowUpdate && !$AllowInsert)){
			$templateCode = str_replace('<%%VALUE(comments_script)%%>', safe_html($urow['comments_script']), $templateCode);
		}else{
			$templateCode = str_replace('<%%VALUE(comments_script)%%>', html_attr($row['comments_script']), $templateCode);
		}
		$templateCode = str_replace('<%%URLVALUE(comments_script)%%>', urlencode($urow['comments_script']), $templateCode);
		if($dvprint || (!$AllowUpdate && !$AllowInsert)){
			$templateCode = str_replace('<%%VALUE(sharing_script)%%>', safe_html($urow['sharing_script']), $templateCode);
		}else{
			$templateCode = str_replace('<%%VALUE(sharing_script)%%>', html_attr($row['sharing_script']), $templateCode);
		}
		$templateCode = str_replace('<%%URLVALUE(sharing_script)%%>', urlencode($urow['sharing_script']), $templateCode);
		if($dvprint || (!$AllowUpdate && !$AllowInsert)){
			$templateCode = str_replace('<%%VALUE(javascript)%%>', safe_html($urow['javascript']), $templateCode);
		}else{
			$templateCode = str_replace('<%%VALUE(javascript)%%>', html_attr($row['javascript']), $templateCode);
		}
		$templateCode = str_replace('<%%URLVALUE(javascript)%%>', urlencode($urow['javascript']), $templateCode);
	}else{
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(facebook)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(facebook)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(twitter)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(twitter)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(googleplus)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(googleplus)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(pinterest)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(pinterest)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(dribble)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(dribble)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(comments_script)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(comments_script)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(sharing_script)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(sharing_script)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(javascript)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(javascript)%%>', urlencode(''), $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans){
		$templateCode = str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == ''){
		$templateCode .= "\n\n<script>\$j(function(){\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption){
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id){
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('links');
	if($selected_id){
		$jdata = get_joined_record('links', $selected_id);
		if($jdata === false) $jdata = get_defaults('links');
		$rdata = $row;
	}
	$cache_data = array(
		'rdata' => array_map('nl2br', array_map('addslashes', $rdata)),
		'jdata' => array_map('nl2br', array_map('addslashes', $jdata))
	);
	$templateCode .= loadView('links-ajax-cache', $cache_data);

	// hook: links_dv
	if(function_exists('links_dv')){
		$args=array();
		links_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>