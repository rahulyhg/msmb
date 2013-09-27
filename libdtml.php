<?

# RHYACS Database Table Management Library version 20060131.01
# Copyright 2004, 2005 Rhydio Ltd, all rights reserved

# This is a site independant library of routines that manages database tables
# in a common, reuseable format. This library is currently in development
# under job 0038 (RHYACS). More complete documentation for this library will
# be produced in due course.

# where am I?
$dtmlpath = "/admin2/core/libdtml.php";

# STYLESHEET CLASSES	Please include the following classes in your CSS file:

#	dtml-fieldlabel		- Used to label fields in forms (left column)
#	dtml-fieldcenter	- Thin dividing column between dtml-fieldlabel and dtml-fieldvalue
#	dtml-fieldvalue		- Used to contain field values and form elements (right column)
#	dtml-tablegrid		- Class applied to the table containing forms and reports
#	dtml-gridcell		- Table body cell
#	dtml-grey		- Grey background
#	dtml-red		- Red text
#	dtml-checkbox		- Class applied to checkboxes and radio buttons
#	dtml-button		- Class applied to form buttons
#	dtml-smallbutton	- Class applied to small form buttons
#	dtml-corporate		- A corporate colour, used in table and cell backgrounds
#	dtml-small-grey		- Small text with grey background
#	dtml-highlight		- Class applied to table rows when the mouse is over them
#	dtml-calendar		- Pop-up calendar object

#	TABLE TFOOT TH and TABLE THEAD TH also need to be defined

# IMAGES		Please have the following images available

#	excel.gif		- 16x16 icon used to download/export data

# DEPENDENCIES

# Requires the following Rhydio PHP libraries:
#	libdb.php	- Database library
#	libcmtl.php	- Content Management Tools library
#	librcfl.php	- Common functions library
#	libtabs.php	- DHTML tab system library
#	libjs.php	- Common JavaScript functions library

# DATABASE REQUIREMENTS

# These tables must exist in EACH database in which DTML is to operate:

# CREATE TABLE dtml_actions (
#    id int(11) NOT NULL auto_increment,
#   transid int(11) NOT NULL default '0',
#   action_label text NOT NULL,
#   action_script text NOT NULL,
#   UNIQUE KEY id (id)
# ) TYPE=MyISAM COMMENT='DTML action parameters';

# CREATE TABLE dtml_parameters (
#   id int(11) NOT NULL auto_increment,
#   transid int(11) NOT NULL default '0',
#   param_key text NOT NULL,
#   param_value text NOT NULL,
#   UNIQUE KEY id (id)
# ) TYPE=MyISAM COMMENT='DTML transaction parameters';

# CREATE TABLE dtml_transactions (
#   id int(11) NOT NULL auto_increment,
#   timestamp bigint(20) NOT NULL default '0',
#   hostscript text NOT NULL,
#   UNIQUE KEY id (id)
# ) TYPE=MyISAM COMMENT='DTML transaction information';

# WIDGET TYPES

# RHYACS specific (will not work in projects other than RHYACS)

#	custcode			- customer code box and lookup button
#	suppcode			- supplier code box and lookup button
#	sds_link			- shared diary appointment box and lookup button

# General (will work in any project assuming all dependencies are satisfied)

#	statictext			- prints static text, no form elements of any kind
#	multimenu			- multiple-selection version of "labelmenu"
#	multimenucsv			- as "multimenu", but able to pre-select multiple values from a CSV list
#	dropdowntextbox			- textbox plus a menu containing all the distinct values of the field to which it relates
#					- closest equivalent of an "editable menu" used in Windows. Allows selection of an existing
#					- value or input of a new value. Menu updates automatically to keyboard input where possible.
#	labelmenu			- menu is rendered as with the key as the value and the label as the option (normal use)
#	keymenu				- menu is rendered with the key as the value *and* the option		(to be scrubbed)
#	valuemenu			- menu is rendered with the *label* as the value *and* the option	(to be scrubbed)
#	fullmenu			- menu is rendered with the key as the value and the key *and* the label as the option
#	radiomenu			- menu is rendered as a list of radio buttons
#	autofixed			- field is fixed or automatically generated, do not render
#	autocreate			- textbox that is only rendered when DTMLForm() is in "edit" mode
#	autofixed-timestamp		- generate hidden field amd show current date and time as static text
#	hash				-
#	textbox-createonly		- textbox that is only rendered when DTMLForm() is in "new" mode
#	boolean				- deprecated, now an alias for "boolean-oo"
#	boolean-oo			- radio buttins labelled "On" and "Off"
#	boolean-yn			- radio buttons labelled "Yes" and "No"
#	textbox				- normal textbox
#	password			- password box, text is replaced by asterisks or spots depending on browser
#	textbox-suffix			- short textbox with trailing text
#	textbox-suffix-createonly	- short textbox with trailing text that is only rendered when DTMLForm() is in "new" mode
#	textbox-prefix			- short textbox with prefixed text
#	pricebox			- very short textbox prefixed with currency symbol
#	textbox-prefix-createonly	- short textbox with prefixed text that is only rendered when DTMLForm() is in "new" mode
#	prefix-textbox-suffix		- short textbox with prefixed *and* trailing text (specified separately)short textbox with trailing text that is only rendered when DTMLForm() is in "new" mode
#	textarea			- textarea
#	editorbox			- large textarea
#	htmleditorbox			- large textarea with content management control buttons
#	date				- date menus
#	time				- time menus
#	datetime			- date menus *and* time menus
#	date-dob			- date menus with extended year range (deprecated, now aliased to "date")
#	date-optional			- date menus plus checkbox which disables them if unchecked
#	countrymenu			- menu of countries, requires $config["country_list"] to be set
#	donotdisplay			- do not display field
#	fileupload			- file upload element. Remember to use enctype="multipart/form-data" when using this.

# INTERACTIVE MODE

# This code is executed when the library is called directly, for example when
# a results table needs to be re-ordered, paginated or exported. This replaces
# the old "dtmlshell.php" methods and uses HTTP objects instead.

if (ereg("libdtml.php",$_SERVER["SCRIPT_NAME"])) {

	# require database library and connection
	include "libdb.php";
	$dbh = ConnectDB();

	# require configuration (require field information - change this to suit the project as required)
	include "librcfl.php";
	include "libfunc.php";
	include "config.php";

	# set parameters
	$cgikeys = array_keys($_GET);
	foreach ($cgikeys as $key) { $params[$key] = $_GET[$key]; }

	if ($_GET["type"] == "csv") {

		# CSV mode
		
		# find source script
		$source = GetSingleField("hostscript","dtml_transactions",$params["db"],"id",$params["transid"]);

		# get last part of source path to use as a filename
		$sp = explode("/",$source);
		$source = ereg_replace(".php","",$sp[count($sp)-1]);

		# headers
		Header("Content-type: text/csv");
		Header("Content-Disposition: attachment; filename=".$source."-".$_GET["transid"].".csv");

		# render summary
		DTMLRecordSummary($params);

	} else {

		# normal mode

		# determine childmode
		$cmsth = SQLExecute("SELECT param_value FROM dtml_parameters WHERE transid='".$_GET["transid"]."' AND param_key='childmode';",$_GET["db"],$dbh);
		$cmrow = mysql_fetch_array($cmsth);

		# render summary
		DTMLRecordSummary($params);

	}

}

# FUNCTIONS

function DTMLSearchResults($table,$db,$subdata,$summaryparams) {

	# takes $subdata generated by DTMLSearchForm() ("multi" mode) and
	# formats the criteria portion of a SQL statement, which is then
	# passed on to the function DTMLRecordSummary() with $summaryparams,
	# which will perform the search itself and display the results in
	# the normal way.

	# $summaryparams has the following elements changed before the
	# function is called:
	#	- type		(if not already present)
	#	- table
	# 	- db
	#	- criteria

	# trap call from logic searches that aren't using the right function
	if ($subdata["criteriacount"]) {
		print "<p>You need to process this form using DTMLLogicSearchResults()</p>";
		return false;
	}

	# retrieve field lists for comparison (field data will only be entered
	# into the table if the field keys are present in the table)
	$postfields = array_keys($subdata);
	$tablefields = split(",",GetFieldList($table,$db));

	# build criteria statement
	foreach ($postfields as $field) {
		if (in_array($field,$tablefields)) {
			$criteria .= "(";
			if (is_array($subdata[$field])) {
				foreach ($subdata[$field] as $opt) {
					$criteria .= "$field='$opt' OR ";
				}
			} else {
				$criteria .= "$field LIKE '%".$subdata[$field]."%' OR ";
			}
			$criteria = StrTruncate($criteria,4).") AND ";
		}
	}
	$criteria = StrTruncate($criteria,5);

	# modify summary table parameters
	$summaryparams["criteria"] = $criteria;
	$summaryparams["table"]	= $table;
	$summaryparams["db"]	= $db;
	if (!$summaryparams["type"]) { $summaryparams["type"] = "table"; }

	# pass to record summary function
	DTMLRecordSummary($summaryparams);

}


function DTMLSingleFieldSearchResults($table,$db,$subdata,$summaryparams) {

	# takes $subdata generated by DTMLSearchForm() ("singlefield" mode) and
	# formats the criteria portion of a SQL statement, which is then
	# passed on to the function DTMLRecordSummary() with $summaryparams,
	# which will perform the search itself and display the results in
	# the normal way.

	# $summaryparams has the following elements changed before the
	# function is called:
	#	- type
	#	- table
	# 	- db
	#	- criteria
	#	- order

	# trap calls from logic searches that aren't using the right function
	if ($subdata["criteriacount"]) {
		print "<p>You need to process this form using DTMLLogicSearchResults()</p>";
		return false;
	}

	# build simple criteria statement
	$criteria = $subdata["keyfield"]." LIKE '%".$subdata["keyword"]."%'";

	# modify summary table parameters
	$summaryparams["criteria"] = $criteria;
	$summaryparams["table"]	= $table;
	$summaryparams["db"]	= $db;
	$summaryparams["type"]	= "table";
	if ($subdata["orderby"] && $subdata["orderdir"]) {
		$summaryparams["orderspecial"] = $subdata["orderby"]." ".strtoupper($subdata["orderdir"]);
	}

	# pass to record summary function
	DTMLRecordSummary($summaryparams);

}


function DTMLLogicSearchResults($table,$db,$subdata,$summaryparams) {

	# takes $subdata generated by DTMLSearchForm() ("logic" mode) and
	# formats the criteria portion of a SQL statement, which is then
	# passed on to the function DTMLRecordSummary() with $summaryparams,
	# which will perform the search itself and display the results in
	# the normal way.

	# $summaryparams has the following elements changed before the
	# function is called:
	#	- type		(if not already present)
	#	- table
	# 	- db
	#	- criteria
	#	- order

	# trap call from multi searches that aren't using the right function
	if (!$subdata["criteriacount"]) {
		print "<p>You need to process this form using DTMLSearchResults()</p>";
		return false;
	}

	# look for hidden fields and if present begin the criteria with them
	foreach (array_keys($subdata) as $field) { if (ereg("hidden_",$field)) {
		$field = ereg_replace("hidden_","",$field);
		$criteria .= "$field='".$subdata["hidden_".$field]."' AND ";
	} }

	# look for static criteria and add it to the statement
	if ($subdata["staticcriteria"]) {
		$criteria .= $subdata["staticcriteria"]." AND ";
	}

	# force processing of first criteria
	$subdata["crit0"] = "on";

	$c4 = 0; while ($c4 < $subdata["criteriacount"]) { if ($subdata["crit".$c4] == "on") {

		# prepare field name
		$fdstr = $subdata["field".$c4];

		switch ($subdata["operator".$c4]) {

			case "wild":
				$opstr = "LIKE '%QSTR%'";
				$delimlogic = "OR";
				break;
			case "unwild":
				$opstr = "NOT LIKE '%QSTR%'";
				$delimlogic = "AND";
				break;
			case "present":
				$opstr = "!= ''";
				$delimlogic = "OR";
				break;
			case "notpresent":
				$opstr = "= ''";
				$delimlogic = "OR";
				break;
			case "starts":
				$opstr = "LIKE 'QSTR%'";
				$delimlogic = "OR";
				break;
			case "ends":
				$opstr = "LIKE '%QSTR'";
				$delimlogic = "OR";
				break;
			case "notstart":
				$opstr = "NOT LIKE 'QSTR%'";
				$delimlogic = "OR";
				break;
			case "notend":
				$opstr = "NOT LIKE '%QSTR'";
				$delimlogic = "OR";
				break;
			case "=":
				$opstr = "= 'QSTR'";
				$delimlogic = "OR";
				break;
			case "!=":
				$opstr = "!= 'QSTR'";
				$delimlogic = "OR";
				break;
			case ">":
				$opstr = "> 'QSTR'";
				$delimlogic = "OR";
				break;
			case "<":
				$opstr = "< 'QSTR'";
				$delimlogic = "OR";
				break;
			case ">=":
				$opstr = ">= 'QSTR'";
				$delimlogic = "OR";
				break;
			case "<=":
				$opstr = "<= 'QSTR'";
				$delimlogic = "OR";
				break;
		}

		# combine the field string and the operator string
		if (    $subdata["operator".$c4] == "<"  ||
			$subdata["operator".$c4] == "<=" ){
			$opstr = "$fdstr $opstr AND $fdstr > '0' ";
		} else { $opstr = "$fdstr $opstr"; }

		# prepare query string
		$qystr = rtrim($subdata["string".$c4]);

		# list of valid delimiters
		$delimiters = array(",","/",";",":");

		# find first used delimiter (if any, $delim is false if none)
		$delimiter = false;
		foreach ($delimiters as $delim) {
			if (ereg($delim,$qystr)) { $delimiter = $delim; }
		}

		if (    $delimiter			      &&
			$subdata["operator".$c4] != ">"  &&
			$subdata["operator".$c4] != "<"  &&
			$subdata["operator".$c4] != ">=" &&
			$subdata["operator".$c4] != "<=" ){

			# delimited queries

			# get parts of the query string
			$qyparts = explode($delimiter,$qystr);

			$linepart = "(";

			foreach ($qyparts as $part) {

				# remove trailing and prefixed spaces
				if (substr($part,0,1) == " ") { $part = substr($part,1,strlen($part)-1); }
				if (substr($part,strlen($part)-1,1) == " ") { $part = chop($part); }

				# substitute into operator string
				$linepart .= ereg_replace("QSTR",$part,$opstr);

				# add logic operator
				$linepart .= " $delimlogic ";

			}

			$linepart = substr($linepart,0,strlen($linepart)-4);
			$linepart .= ")";

			$comstr .= " $linepart";

		} else {

			# single query
			$comstr .= ereg_replace("QSTR",$qystr,$opstr);

		}

		# prepare for next line
		$comstr .= " AND ";

	} $c4++; }

	# assemble final SQL criteria
	$criteria .= substr($comstr,0,strlen($comstr)-4);

	# modify summary table parameters
	$summaryparams["criteria"] = $criteria;
	$summaryparams["table"]	= $table;
	$summaryparams["db"]	= $db;
	if (!$summaryparams["type"]) { $summaryparams["type"] = "table"; }
	if ($subdata["orderby"] && $subdata["orderdir"]) {
		$summaryparams["orderspecial"] = $subdata["orderby"]." ".strtoupper($subdata["orderdir"]);
	}

	# pass to record summary function
	DTMLRecordSummary($summaryparams);

}


function DTMLCreateRecord($table,$db,$subdata) {

	# builds a SQL statement to create a new record in $db/$table using
	# $subdata, which must be a $_POST or $HTTP_POST_VARS associative
	# array. Returns the SQL statement, which must be SQLExecute()-ed

	# retrieve field lists for comparison (field data will only be entered
	# into the table if the field keys are present in the table)
	$postfields = array_keys($subdata);
	$tablefields = split(",",GetFieldList($table,$db));

	# handle any file uploads
	foreach ($postfields as $field) {
		if (ereg("_fileupload",$field)) {
			$filefield = ereg_replace("_fileupload","",$field);
			if ($_FILES[$filefield]["tmp_name"]) {
				array_push($postfields,$filefield);
				$ufile = implode("",file($_FILES[$filefield]["tmp_name"]));
				$subdata[$filefield] = base64_encode($ufile);
			}
		}
	}

	# build SQL statement
	$sql = "INSERT INTO $table (";
	foreach ($postfields as $field) {
		if (in_array($field,$tablefields)) { $sql .= "$field,"; }
	}
	$sql = StrTruncate($sql,1).") VALUES (";
	foreach ($postfields as $field) {
		if (in_array($field,$tablefields)) { $sql .= "'".$subdata[$field]."',"; }
	}
	$sql = StrTruncate($sql,1).");";

	return $sql;

}


function DTMLUpdateRecord($rid,$table,$db,$subdata) {
	
	if($subdata["usrMarketing"]==0)	
	{
		$res=mysql_query("select * from userphotos where userid='".$subdata["id"]."' and market=1");
		if(mysql_num_rows($res)>0)
		{
			while($rs=mysql_fetch_object($res))
			{
				mysql_query("delete from userphotos where id='".$rs->id."'");
			}	
		}	
	}	
	# builds a SQL statement to update record $rid in $db/$table using
	# $subdata, which must be a $_POST or $HTTP_POST_VARS associative
	# array. Returns the SQL statement, which must be SQLExecute()-ed
	//print_r($subdata);
	//die();
	global $config;

	# retrieve field lists for comparison (field data will only be entered
	# into the table if the field keys are present in the table)
	$postfields = array_keys($subdata);
	$tablefields = split(",",GetFieldList($table,$db));	
		
	# build SQL statement, excluding hashed fields that require no changes
	$sql = "UPDATE $table SET ";

	foreach ($postfields as $field) {

		if (in_array($field,$tablefields) || ereg("_keepfile",$field)) {

			if (ereg("_keepfile",$field)) {

				# field is a marker for a file upload

				$filefield = ereg_replace("_keepfile","",$field);

				if ($config["dtml_fieldinfo"][$db][$table][$filefield][1] == "fileupload") {

					# field confirmed to be a file upload

					if ($subdata[$field] == 0 && $_FILES[$filefield]["tmp_name"]) {

						# user has supplied a valid file
						$ufile = implode("",file($_FILES[$filefield]["tmp_name"]));
						$sql .= "$filefield='".base64_encode($ufile)."',";

					}

				}

			} else {

				# add normal field to SQL statement

				# detect and handle null values in boolean fields
				$fieldtype = $config["dtml_fieldinfo"][$db][$table][$field][1];
				if ($fieldtype == "boolean-yn" || $fieldtype == "boolean-oo") {
					if ($subdata[$field] != 1) { $subdata[$field] = 0; }
				}

				if (($subdata[$field] || $subdata[$field] == 0) && $subdata[$field] != "80a346d732d8f7ef263178038c39b87e") {
					$sql .= "$field='". $subdata[$field]."',";
				}

			}

		}

	}

	$sql = StrTruncate($sql,1)." WHERE id='$rid';";

	return $sql;

}


function DTMLSearchForm($params) {

	# displays a standard search engine form for users to find records in
	# a specified database table.

	# When submitted from "multi" mode, this form may then be
	# processed by DTMLSearchResults(). Similarly, the function
	# DTMLLogicSearchResults() will do the same when used in "logic" mode
	# DTMLSingleFieldSearchResults() will do the same when used in "singlefield" mode

	# When submitted from "logic" mode, this form may then be
	# processed by DTMLProcessLogicSQL() to generate SQL criteria
	# which can then be used with DTMLRecordSummary() directly.

	# $params is an associative array comprising the following:

	# type		[opt]	- search form type
	#	- "multi"
	#		[def]	- select any combination of values in any
	#			- number of fields. Note that this mode is deprecated
	#			- and is retained for backwards compatibility only.
	#	- "logic"	- use and/or logic with fields and values
	#	- "singlefield"	- use single field (drop down list of fields, plus
	#			- single keyword textbox

	# <parameters common to all types>
	# table		[req]	- table on which search is to be performed
	# db		[req]	- database in which table resides
	# fields	[opt]	- CSV list of fields to allow in search criteria
	#			- leave absent or pass "all" to include all fields
	# buttonlabel	[req]	- button label text

	# <parameters specific to "multi" mode">
	# listsperrow	[opt]	- [def 3] maximum number of lists per row
	# listheight	[opt]	- [def 10] height of lists
	# textfields	[opt]	- CSV list of fields for which a textbox should
	#			- be displayed for more specific searching

	# <parameters specific to "logic" mode">
	# criteriacount	[opt]	- [def 3] maximum number of criteria allowed
	# staticfields	[opt]	- comma separated list of static fields to include
	#			- as hidden fields in the form. For example:
	#			- "static=30,name=john" would be translated as
	#			- <input type="hidden" name="static" value="30">
	#			- <input type="hidden" name="name" value="john">
	#			- these fields will be included in the search criteria
	# staticcriteria[opt]	- static SQL criteria to include in the statement
	#			- eg: "(surname='smith' OR surname='jones') AND gender='m'"
	#			- This can also be added manually before form handler is called
	#			- DON'T USE INVERTED COMMAS (") IN THE CRITERIA
	# disableorderby[opt]	- set to true to disable the "order by" elements

	# <parameters specific to "singlefield" mode>
	# selectedfield	[opt]	- field in drop down menu to preselect

	# required resources
	global $config;
	$mdbh = ConnectDB();

	# set defaults
	if (!$params["listsperrow"]) { $params["listsperrow"] = 3; }
	if (!$params["listheight"]) { $params["listheight"] = 10; }
	if (!$params["fields"]) { $params["fields"] = "all"; }
	if (!$params["type"]) { $params["type"] = "multi"; }
	if (!$params["criteriacount"]) { $params["criteriacount"] = 3; }

	# retrieve fields (if necessary)
	if ($params["fields"] == "all") { $params["fields"] = GetFieldList($params["table"],$params["db"]); }

	if ($params["type"] == "logic") { ?>
		<p align="left">Use this facility to perform advanced searches with
		refined criteria. You may enter multiple search keywords on
		each line, separated by commas or forward slashes (/).
		The search engine will treat each comma or slash as the
		equivalent of the word "or". Criteria from each line are
		applied in succession to build the final query. <b>To return
		all records, simply submit a blank query</b>.</p>
	<? }

	# process static fields in logic mode if necessary
	if ($params["type"] == "logic" && $params["staticfields"]) {
		$staticparts = explode(",",$params["staticfields"]);
		foreach ($staticparts as $part) {
			$pair = explode("=",$part);
			print "<input type=\"hidden\" name=\"hidden_$pair[0]\" value=\"$pair[1]\">\n";
		}
	}

	# include static criteria in logic mode if necessary
	if ($params["type"] == "logic" && $params["staticcriteria"]) {
		print "<input type=\"hidden\" name=\"staticcriteria\" value=\"".$params["staticcriteria"]."\">\n";
	}

	# start common table
	print "<table class=\"dtml-tablegrid\" width=\"100%\" cellspacing=\"0\" cellpadding=\"3\">\n";

	if ($params["type"] == "multi") {

		# multiple field selection mode

		print "<tr>\n";

		foreach (split(",",$params["fields"]) as $field) {

			$rc++; if ($rc > $params["listsperrow"]) { $rc = 1; print "</tr>\n<tr>\n"; }

			$label = $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][0];
			if (strlen($label) <= 0) { $label = "&nbsp;"; }

			print "<td align=\"center\" valign=\"top\" width=\"".(100/$params["listsperrow"])."%\" nowrap>\n";

			print "<div class=\"dtml-grey\">$label</div>\n";
			print "<select name=\"".$field."[]\" multiple size=\"".$params["listheight"]."\" style=\"width: 100%;\">\n";

			$sth = SQLExecute("SELECT DISTINCT($field) FROM ".$params["table"]." ORDER BY $field;",$params["db"],$mdbh);
			while ($row = mysql_fetch_array($sth)) {
				if (strlen($row[0]) == 0) {
					print "<option value=\"$row[0]\">[blank field]</option>\n";
				} else {
					print "<option value=\"$row[0]\">$row[0]</option>\n";
				}
			}

			print "</select></td>\n";

		}

		if ($params["textfields"]) {

			# render text entry field(s)

			?>

			<tr>
				<td colspan="<?= $params["listsperrow"]; ?>" align="center" nowrap>
				<table border="0" width="100%" cellspacing="0" cellpadding="3">

				<? foreach (split(",",$params["textfields"]) as $textfield) { ?>

					<tr>
						<td class="dtml-fieldlabel" nowrap><?= $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$textfield][0]; ?></td>
						<td class="dtml-fieldcenter"></td>
						<td class="dtml-fieldvalue" width="100%"><input type="text" name="<?= $textfield; ?>" id="element_<?= $textfield; ?>" size="20" style="width: 100%;"></td>
					</tr>

				<? } ?>

				</table>
				</td>
			</tr>

			<?

		}

		?>

		<tr>
			<td colspan="<?= $params["listsperrow"]; ?>" align="center" nowrap class="dtml-corporate">
				<input type="submit" class="dtml-button" value="<?= $params["buttonlabel"]; ?>" style="width: 79%;">&nbsp;&nbsp<input type="reset" class="dtml-button" value="Reset" style="width: 19%;">
			</td>
		</tr>

		<?

	}

	if ($params["type"] == "logic") {

		# field logic selection mode

		# convert field list into array
		$params["fields"] = explode(",",$params["fields"]);

		# supported operator information
		$operdata = array (
			"wild"		=> "contains",
			"unwild"	=> "does not contain",
			"present"	=> "is present",
			"notpresent"	=> "is not present",
			"starts"	=> "starts with",
			"ends"		=> "ends with",
			"notstart"	=> "does not start with",
			"notend"	=> "does not end with",
			"="		=> "exactly matches",
			"!="		=> "does not match",
			">"		=> "is greater than",
			"<"		=> "is less than",
			">="		=> "is greater than or equal to",
			"<="		=> "is less than or equal to",
		);

		?>

		<script language="JavaScript">

		function updateOperator(opId) {
			if (	document.getElementById('operator'+opId).value == "present" ||
				document.getElementById('operator'+opId).value == "notpresent") {
				document.getElementById('string'+opId).style.display = 'none';
			} else {
				document.getElementById('string'+opId).style.display = '';
			}
		}

		</script>

		<input type="hidden" name="criteriacount" value="<?= $params["criteriacount"]; ?>">

		<tr>
			<td align="center" rowspan="2" class="dtml-corporate"></td>
			<td class="dtml-corporate" align="center">Field</td>
			<td class="dtml-corporate" align="center">Operator</td>
			<td class="dtml-corporate" align="center">Keywords</td>
		</tr>

		<? $c2 = 0; while ($c2 < $params["criteriacount"]) { ?>

			<tr>

			<? # "AND" column ?>

			<? if ($c2 != 0) { ?>
				<td class="dtml-grey" align="center" nowrap>&nbsp;AND&nbsp;<input class="dtml-checkbox" type="checkbox" id="crit<?= $c2; ?>" name="crit<?= $c2; ?>" value="on"></td>
			<? } ?>

			<? # Field menu column ?>

			<td align="center" width="30%">
				<select name="field<? echo $c2; ?>" id="field<? echo $c2; ?>" style="width: 100%;">

				<? $c3 = 0; while ($c3 < count($params["fields"])) {

					$mlabel = $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$params["fields"][$c3]][0];
					echo "<option value=\"".$params["fields"][$c3]."\">$mlabel</option>\n";

				$c3++; } ?>

			</select>
			</td>

			<? # Operator column ?>

			<td align="center" width="30%">
				<select name="operator<? echo $c2; ?>" style="width: 100%;" id="operator<? echo $c2; ?>" onchange="updateOperator('<?= $c2; ?>');">
					<? foreach ($operdata as $value => $label) { ?>
						<option value="<?= $value; ?>"><?= $label; ?></option>
					<? } ?>
				</select>
			</td>

			<? # Keyword column ?>

			<td align="center" width="30%">
			<input	type="text" name="string<? echo $c2; ?>" id="string<? echo $c2; ?>" size="21"
				<? if ($c2 > 0) { ?>onkeyup="if(string<? echo $c2; ?>.value==''){crit<? echo $c2; ?>.checked=false;}else{crit<?= $c2; ?>.checked=true;}"<? } ?>
				style="width: 100%;">
			</td>

			</tr>

		<? $c2++; } ?>

			<tr>
				<td class="dtml-corporate" align="center" nowrap>Order by</td>
				<td class="dtml-corporate">
					<select name="orderby" id="orderby" style="width: 100%;" <? if ($params["disableorderby"]) { print "disabled"; } ?>>
					<? $c3 = 0; while ($c3 < count($params["fields"])) {

						$mlabel = $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$params["fields"][$c3]][0];
						echo "<option value=\"".$params["fields"][$c3]."\">$mlabel</option>\n";

					$c3++; } ?></select>
				</td>
				<td class="dtml-corporate" nowrap>
					<input type="radio" name="orderdir" value="asc" id="odasc" checked <? if ($params["disableorderby"]) { print "disabled"; } ?>> <label for="odasc">ascending</label>
					<input type="radio" name="orderdir" value="desc" id="oddesc" <? if ($params["disableorderby"]) { print "disabled"; } ?>> <label for="oddesc">descending</label>
				</td>
				<td class="dtml-corporate" align="center"><input type="submit" class="dtml-button" value="<?= $params["buttonlabel"]; ?>" style="width: 100%;"></td>
			</tr>

		<?

	}

	if ($params["type"] == "singlefield") {

		# single field search mode

		print "<tr><td class=\"dtml-grey\" align=\"center\" valign=\"middle\" nowrap>\n";

		print "<b>Search for</b> &nbsp;";
		print "<select name=\"keyfield\">\n";

		foreach (explode(",",$params["fields"]) as $field) {

			print "<option value=\"$field\"";
			if ($field == $params["selectedfield"]) { print " selected"; }
			print ">".$config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][0]."</option>\n";

		}

		print "</select>&nbsp;\n";

		print "<b>containing</b> &nbsp;";
		print "<input type=\"text\" name=\"keyword\" size=\"30\">&nbsp;\n";

		print "<input type=\"submit\" value=\"Search\" style=\"width: 100px;\">\n";

		print "</td></tr>\n";

	}

	# complete common table
	print "</table>\n";

	if ($params["type"] == "logic") { ?>

		<p class="dtml-small-grey" style="text-align: left;"><b>NOTE:</b>
		It is not possible to specify
		multiple keywords when using the "less than [or equal to]" or
		"greater than [or equal to]" search types, as these operators can
		only accept one numeric value. Please do not insert other types of
		data when using these search types.</p>

	<? }

	return true;

}


function DTMLForm($params) {

	//$sth = SQLExecute("SELECT * FROM eventguests WHERE eventIndex=$id ORDER BY paymentDate;",$config["db"]["name"],$dbh);
	//print_r($params);
	$female1=0;
	$male1=0;
	$id1=$params['recordid'];
	$sql="SELECT a.*,b.* FROM eventguests a,users b WHERE a.eventIndex='$id1' and a.userIndex=b.id";
	//echo $sql;
	//die();
	$res=mysql_query($sql);
	if(mysql_num_rows($res)>0)
	{
		while($rs=mysql_fetch_object($res))
		{
			if($rs->usrGender=='F')
			{
				$female1++;
			}
			if($rs->usrGender=='M')
			{
				$male1++;
			}
		}	
	}	
	if($id1!="")
	{
		$res1=mysql_query("select * from events where id=$id1");
		if(mysql_num_rows($res1)>0)
		{
			mysql_query("update events set eveGuestsM='".$male1."',eveGuestsF='".$female1."' where id='".$id1."'");
		}
	}	
	//$sth = SQLExecute("SELECT * FROM eventguests WHERE eventIndex=$id ORDER BY paymentDate;",$config["db"]["name"],$dbh);
//	die();
	
	# displays a form for adding a new record to a database table; or
	# editing an existing database record, the contents of which can,
	# optionally, be handled by DTMLCreateRecord() or DTMLUpdateRecord()

	# $params is an associative array comprising the following:

	# opmode	[req]	- mode of operation:
	#	- "new"		- "new" form, blank fields, for record creation
	#	- "edit"	- form populated with existing database record
	# fieldmode
	#	- "table"
	#		[def]	- read field names from specified table (default)
	#	- "list"	- read field names from supplied list
	# fieldlist	[opt]	- array of fields to use ("list" fieldmode only)
	# recordid	[opt]	- ID of record to display in "edit" opmode
	# table		[req]	- name of table in which fields are found
	# db		[req]	- database in which table resides
	# fieldwidth	[opt]	- width of field area in pixels
	# columns	[opt]	- number of columns in which the fields are arranged
	#			- default is 1, omit to use default. Recommend 1-3.
	# buttontype
	#	- "submit"
	#		[def]- include a "submit" button at the foot (default)
	#	- "button"	- include a "button" button at the foot
	# buttononclick	[opt]	- (optional) script commands to be entered
	#			- into button's onclick attribute
	# buttonlabel	[opt]	- button label text
	#			- omit buttonlabel parameter to suppress rendering
	#			- of all buttons (including Reset and Cancel button)

	# required resources
	global $config;
	$mdbh = ConnectDB();

	# apply defaults
	if (!$params["fieldmode"]) { $params["fieldmode"] = "table"; }
	if (!$params["buttontype"]) { $params["buttontype"] = "submit"; }
	if (!$params["columns"]) { $params["columns"] = 1; }

	# retrieve field list if necessary
	if ($params["fieldmode"] == "table") {
		$params["fieldlist"] = split(",",GetFieldList($params["table"],$params["db"]));
	}

	# retrieve database record if necessary
	if ($params["opmode"] == "edit") {
		$sth = SQLExecute("SELECT * FROM ".$params["table"]." WHERE id='".$params["recordid"]."';",$params["db"],$mdbh);
		$record = mysql_fetch_array($sth);
	}

	# create form ID hash
	$formid = StandardHash(implode("",$params).microtime());

	# row marker
	$crow = 1;

	//print_r($params["fieldlist"]);
	//die();
	# start table
	print "<table class=\"dtml-tablegrid\" width=\"99%\" cellspacing=\"0\" cellpadding=\"3\" id=\"dtml_table_$formid\">\n";
	foreach ($params["fieldlist"] as $field) {

		if ($crow == 1) { print "<tr>\n"; }

		print "<td class=\"dtml-fieldlabel\" nowrap>";
		print $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][0];
		print "&nbsp;</td>\n";
		print "<td class=\"dtml-fieldcenter\"></td>\n";
		print "<td class=\"dtml-fieldvalue\"";
		if ($params["fieldwidth"]) { print " width=\"".$params["fieldwidth"]."\""; }
		print ">";

		# get widget information
		$widget = $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][1];
		$widgetoptions = $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][2];
//		echo $widgetoptions;
		$furtheroptions = $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][3];
		

		switch ($widget) {
			
			case "statictext":
				print $widgetoptions;
				break;

			case "custcode":
				print "<input type=\"text\" size=\"6\" maxlength=\"6\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\" style=\"font-weight: bold;\">";
				print "&nbsp;";
				print "<input type=\"button\" class=\"dtml-button\" value=\"Lookup\" onclick=\"openDBLookup('customer',$field.value,'$field');\">";
				break;

			case "suppcode":
				print "<input type=\"text\" size=\"6\" maxlength=\"6\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\" style=\"font-weight: bold;\">";
				print "&nbsp;";
				print "<input type=\"button\" class=\"dtml-button\" value=\"Lookup\" onclick=\"openDBLookup('supplier',$field.value,'$field');\">";
				break;

			case "sds_link":
				print "<input type=\"text\" readonly size=\"6\" maxlength=\"8\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\" style=\"font-weight: bold;\">";
				print "&nbsp;";
				print "<input type=\"button\" class=\"dtml-button\" value=\"Select appointment\" onclick=\"openSDSLookup($field.value,'$field');\">";
				break;

			case "multimenu":
				print "<select name=\"".$field."[]\" style=\"width: 100%;\" multiple size=\"".count($widgetoptions)."\">\n";
				foreach ($widgetoptions as $mval => $mlabel) {
					print "<option value=\"$mval\"";
					if ($record[$field] == $mval) { print " selected"; }
					print ">$mlabel</option>\n";
				}
				print "</select>\n";
				break;

			case "multimenucsv":
				print "<select name=\"".$field."[]\" style=\"width: 100%;\" multiple size=\"".count($widgetoptions)."\"";
				if ($furtheroptions == "createonly" && $record[$field]) { print " disabled"; }
				print ">\n";
				foreach ($widgetoptions as $mval => $mlabel) {
					print "<option value=\"$mval\"";
					foreach (split(",",$record[$field]) as $possval) {
						if ($possval == $mval) { print " selected"; }
					}
					print ">$mlabel</option>\n";
				}
				print "</select>\n";
				break;

			case "dropdowntextbox":
				$sth = SQLExecute("SELECT DISTINCT($field) AS $field FROM ".$params["table"]." ORDER BY $field;",$params["db"],$mdbh);
				print "<div><select id=\"".$field."_dtmllist\"  name=\"".$field."_dtmllist\" style=\"width: 100%;\" onchange=\"updateDropDownTextBox('$field','list2box');\" class=\"small\">\n";
				print "<option value=\"\"></option>\n";
				while ($row = mysql_fetch_array($sth)) {
					print "<option value=\"".$row[$field]."\">".$row[$field]."</option>\n";
				}
				print "</select></div>\n";
				print "<div><input type=\"text\" size=\"20\" style=\"width: 100%;\" name=\"$field\" id=\"$field\" value=\"".$record[$field]."\" onkeyup=\"updateDropDownTextBox('$field','box2list');\"></div>";
				if ($record[$field]) { print "<script language=\"JavaScript\">updateDropDownTextBox('$field','box2list');</script>\n"; }
				break;

			case "labelmenu":
				print "<select name=\"$field\" style=\"width: 100%;\">\n";
				foreach ($widgetoptions as $mval => $mlabel) {
					print "<option value=\"$mval\"";
					if ($record[$field] == $mval) { print " selected"; }
					print ">$mlabel</option>\n";
				}
				print "</select>\n";
				break;

			case "keymenu":
				print "<select name=\"$field\" style=\"width: 100%;\">\n";
				foreach ($widgetoptions as $mval => $mlabel) {
					print "<option value=\"$mval\"";
					if ($record[$field] == $mval) { print " selected"; }
					print ">$mval</option>\n";
				}
				print "</select>\n";
				break;

			case "valuemenu":
				print "<select name=\"$field\" style=\"width: 100%;\">\n";
				foreach ($widgetoptions as $mval => $mlabel) {
					print "<option value=\"$mlabel\"";
					if ($record[$field] == $mlabel) { print " selected"; }
					print ">$mlabel</option>\n";
				}
				print "</select>\n";
				break;

			case "fullmenu":
				print "<select name=\"$field\" style=\"width: 100%;\">\n";
				foreach ($widgetoptions as $mval => $mlabel) {
					print "<option value=\"$mval\"";
					if ($record[$field] == $mval) { print " selected"; }
					print ">$mval - $mlabel</option>\n";
				}
				print "</select>\n";
				break;

			case "radiomenu":
				$c1 = 1; foreach ($widgetoptions as $mval => $mlabel) {
					print "<input type=\"radio\" class=\"radio\" name=\"$field\" id=\"radio_".$field."_$c1\" value=\"$mval\"";
					if ($record[$field] == $mval) { print " checked"; }
					print "> <label for=\"radio_".$field."_$c1\">$mlabel</label><br>";
				$c1++; }
				break;

			case "autofixed":
				if ($record) {
					print "<input type=\"hidden\" name=\"$field\" value=\"".$record[$field]."\">";
					print "<b>".$record[$field]."</b><br>";
				} else {
					print "fixed or automatically generated field";
				}
				break;

			case "autocreate":
				if ($record) {
					print "<input type=\"text\" size=\"20\" style=\"width: 100%;\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\">";
				} else {
					print "automatically generated field";
				}
				break;

			case "autofixed-timestamp":
				if ($record) {
					print "<input type=\"hidden\" name=\"$field\" value=\"".$record[$field]."\">";
					print "<b>".strftime("%A %B %d %Y, %H:%M:%S",$record[$field])."</b><br>";
				} else {
					print "fixed or automatically generated field";
				}
				break;

			case "hash":
				if ($record) {
					print "<input type=\"text\" size=\"20\" style=\"width: 100%;\" name=\"$field\" id=\"element_$field\" value=\"[restricted field]\"><br>";
					print "leave this field intact if it requires no changes";
				} else {
					print "<input type=\"text\" size=\"20\" style=\"width: 100%;\" name=\"$field\" id=\"element_$field\" value=\"this field will be hashed before it is stored\">";
				}
				break;

			case "textbox-createonly":
				if ($record) {
					print "<input type=\"hidden\" name=\"$field\" value=\"".$record[$field]."\">";
					print "<b>".$record[$field]."</b><br>";
				} else {
					print "<input type=\"text\" name=\"$field\" id=\"element_$field\" style=\"width: 100%;\">";
				}
				break;

			case "boolean":
				print "<input type=\"radio\" class=\"radio\" name=\"$field\" value=\"1\" id=\"$field-on\"";
				if ($record && $record[$field] == "1") { print " checked"; }
				if (!$record && $widgetoptions == "1") { print " checked"; }
				print "> <label for=\"$field-on\">Yes/On</label> &nbsp; ";
				print "<input type=\"radio\" class=\"radio\" name=\"$field\" value=\"0\" id=\"$field-off\"";
				if ($record && $record[$field] == "0") { print " checked"; }
				if (!$record && $widgetoptions == "0") { print " checked"; }
				print "> <label for=\"$field-off\">No/Off</label>";
				break;

			case "boolean-oo":
				print "<input type=\"radio\" class=\"radio\" name=\"$field\" value=\"1\" id=\"$field-on\"";
				if ($record && $record[$field] == "1") { print " checked"; }
				if (!$record && $widgetoptions == "1") { print " checked"; }
				print "> <label for=\"$field-on\">On</label> &nbsp; ";
				print "<input type=\"radio\" class=\"radio\" name=\"$field\" value=\"0\" id=\"$field-off\"";
				if ($record && $record[$field] == "0") { print " checked"; }
				if (!$record && $widgetoptions == "0") { print " checked"; }
				print "> <label for=\"$field-off\">Off</label>";
				break;

			case "boolean-yn":
				//if($field=="super")
				//{
				//	$fiel=$field."1";
				//	print "<input type=\"radio\" class=\"radio\" name=\"$fiel\" value=\"1\" id=\"$field-on\"";				
				//}
				//else
				//{
					print "<input type=\"radio\" class=\"radio\" name=\"$field\" value=\"1\" id=\"$field-on\"";
				//}	
				if ($record && $record[$field] == "1") { print " checked"; }
				if (!$record && $widgetoptions == "1") { print " checked"; }
				print "> <label for=\"$field-on\">Yes</label> &nbsp; ";
				//if($field=="super")
				//{
				//	$fiel=$field."1";
				//	print "<input type=\"radio\" class=\"radio\" name=\"$fiel\" value=\"0\" id=\"$field-off\"";
				//}
				//else
				//{
					print "<input type=\"radio\" class=\"radio\" name=\"$field\" value=\"0\" id=\"$field-off\"";
				//}	
				if ($record && $record[$field] == "0") { print " checked"; }
				if (!$record && $widgetoptions == "0") { print " checked"; }
				print "> <label for=\"$field-off\">No</label>";
				break;

			case "textbox":
				print "<input type=\"text\" size=\"20\" style=\"width: 100%;\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\">";
				break;

			case "password":
				print "<input type=\"password\" size=\"20\" style=\"width: 100%;\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\">";
				break;

			case "textbox-suffix";
				print "<input type=\"text\" size=\"20\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\"> $widgetoptions";
				break;

			case "textbox-suffix-createonly":
				if ($record) {
					print "<input type=\"hidden\" name=\"$field\" value=\"".$record[$field]."\">";
					print "<b>".$record[$field]."</b> $widgetoptions<br>";
				} else {
					print "<input type=\"text\" size=\"20\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\"> $widgetoptions";
				}
				break;

			case "textbox-prefix":
				print "$widgetoptions <input type=\"text\" size=\"20\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\">";
				break;

			case "pricebox":
				print "£ <input type=\"text\" size=\"8\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\">";
				break;

			case "textbox-prefix-createonly":
				if ($record) {
					print "<input type=\"hidden\" name=\"$field\" value=\"".$record[$field]."\">";
					print "$widgetoptions <b>".$record[$field]."</b><br>";
				} else {
					print "$widgetoptions <input type=\"text\" size=\"20\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\">";
				}
				break;

			case "prefix-textbox-suffix":
				print "$widgetoptions <input type=\"text\" size=\"20\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\"> $furtheroptions";
				break;

			case "textarea":
				print "<textarea name=\"$field\" id=\"element_$field\" rows=\"5\" cols=\"20\" style=\"width: 100%;\">".$record[$field]."</textarea>";
				break;

			case "editorbox":
				//print "<textarea name=\"$field\" id=\"element_$field\" rows=\"20\" cols=\"50\" style=\"width: 100%;\">".$record[$field]."</textarea>";
				include("FCKeditor/fckeditor.php") ;
					$oFCKeditor = new FCKeditor($field) ;
					$oFCKeditor->BasePath = '/admin2/FCKeditor/';
					$oFCKeditor->Value = stripslashes($record[$field]);
					$oFCKeditor->Create() ;
					//print "<input type=\"hidden\" value=\"" . $iContentId . "\" name=\"iContentId\">";
					//print "<input type=\"text\" name=\"$field\" id=\"element_$field\" >";	
				break;

			case "htmleditorbox":
				HTMLToolBar("element_$field");
				print "<textarea name=\"$field\" id=\"element_$field\" rows=\"20\" cols=\"50\" style=\"width: 100%;\">".$record[$field]."</textarea>";
				break;

			case "date":
				if ($record) {
					$dparts = explode("-",$record[$field]);
					if ($dparts[0] == "0000") {
						DateSelector($field,"now",false,false);
					} else {
						DateSelector($field,array($dparts[2],$dparts[1],$dparts[0]),false,false);
					}
				} else {
					DateSelector($field,"now",false,false);
				}
				break;

			case "time":
				if ($record) {
					$dparts = explode(":",$record[$field]);
					DateSelector($field,false,array($dparts[0],$dparts[1],1),false);
				} else {
					DateSelector($field,false,array("now","now",$widgetoptions),false);
				}
				break;

			case "datetime":
			case "date-dob":
				if ($record) {
					$dparts = ereg_replace(" ","-",$record[$field]);
					$dparts = ereg_replace(":","-",$dparts);
					$dparts = explode("-",$dparts);					
					if ($dparts[0] == "0000") {
						DateSelector($field,"now",array("now","now",$widgetoptions),false);
					} else {
						DateSelector($field,array($dparts[2],$dparts[1],$dparts[0]),array($dparts[3],$dparts[4],$widgetoptions),false);
					}
				} else {
					DateSelector($field,"now",array("now","now",$widgetoptions),false);
				}
				break;

			case "date-optional":
				if ($record) {
					$dparts = explode("-",$record[$field]);
					if ($dparts[0] == "0000") {
						DateSelector($field,"now",false,true);
					} else {
						DateSelector($field,array($dparts[2],$dparts[1],$dparts[0]),false,true);
					}
				} else {
					DateSelector($field,"now",false,true);
				}
				break;

			case "countrymenu":
				print "<select name=\"$field\" style=\"width: 100%;\">\n";
				foreach ($config["country_list"] as $ccode => $clabel) {
					print "<option value=\"$ccode\"";
					if (!$record && $ccode == "GBR") { print " selected"; }
					if ($record && $ccode == $record[$field]) { print " selected"; }
					print ">$clabel</option>\n";
				}
				print "</select>\n";
				break;

			case "donotdisplay":
				print "This field cannot be displayed";
				break;

			case "fileupload":
				if ($record) {
					print "<nobr><input type=\"radio\" name=\"".$field."_keepfile\" id=\"".$field."_keepfile_on\" value=\"1\" checked onclick=\"$field.disabled=true;\"> <label for=\"".$field."_keepfile_on\">Keep existing file</label>&nbsp;\n";
					print "<input type=\"radio\" name=\"".$field."_keepfile\" id=\"".$field."_keepfile_off\" value=\"0\" onclick=\"$field.disabled=false;\"> <label for=\"".$field."_keepfile_off\">Replace file</label></nobr><br>\n";
				}
				print "<input type=\"file\" name=\"$field\" style=\"width: 100%;\"";
				if ($record) { print " disabled"; }
				print ">\n";
				if (!$record) { print "<input type=\"hidden\" name=\"".$field."_fileupload\" value=\"1\">"; }
				break;

			default:
				//print "<span class=\"dtml-red\">DTML doesn't know how to render field '$field'</span>";
				break;

		}

		print "</td>\n";

		if ($crow == $params["columns"]) { $crow = 1; print "</tr>"; } else { $crow++; }

	}
	
	# complete table

	if ($params["buttonlabel"]) { ?>

		<tr><td class="dtml-fieldlabel" height="10"></td></tr>
		<tr><td class="dtml-fieldlabel" colspan="<?= $params["columns"] * 3; ?>" nowrap align="right" style="padding: 4px;">
			<input type="button" class="dtml-button" value="Cancel" onclick="history.back(1);">
			<input type="reset" class="dtml-button" name="Reset">
			<input type="<?= $params["buttontype"]; ?>" class="dtml-button" value="<?= $params["buttonlabel"]; ?>" <? if ($params["buttononclick"]) { ?>onclick="<?= $params["buttononclick"]; ?>"<? } ?>>
		</td></tr>

	<? } ?>

	</table>

	<?

	return true;

}

function DTMLForm1($params) {

	//$sth = SQLExecute("SELECT * FROM eventguests WHERE eventIndex=$id ORDER BY paymentDate;",$config["db"]["name"],$dbh);
	//print_r($params);
	$female1=0;
	$male1=0;
	$id1=$params['recordid'];
	$sql="SELECT a.*,b.* FROM eventguests a,users b WHERE a.eventIndex='$id1' and a.userIndex=b.id";
	//echo $sql;
	//die();
	$res=mysql_query($sql);
	if(mysql_num_rows($res)>0)
	{
		while($rs=mysql_fetch_object($res))
		{
			if($rs->usrGender=='F')
			{
				$female1++;
			}
			if($rs->usrGender=='M')
			{
				$male1++;
			}
		}	
	}	
	if($id1!="")
	{
		$res1=mysql_query("select * from events where id=$id1");
		if(mysql_num_rows($res1)>0)
		{
			mysql_query("update events set eveGuestsM='".$male1."',eveGuestsF='".$female1."' where id='".$id1."'");
		}
	}	
	//$sth = SQLExecute("SELECT * FROM eventguests WHERE eventIndex=$id ORDER BY paymentDate;",$config["db"]["name"],$dbh);
//	die();
	
	# displays a form for adding a new record to a database table; or
	# editing an existing database record, the contents of which can,
	# optionally, be handled by DTMLCreateRecord() or DTMLUpdateRecord()

	# $params is an associative array comprising the following:

	# opmode	[req]	- mode of operation:
	#	- "new"		- "new" form, blank fields, for record creation
	#	- "edit"	- form populated with existing database record
	# fieldmode
	#	- "table"
	#		[def]	- read field names from specified table (default)
	#	- "list"	- read field names from supplied list
	# fieldlist	[opt]	- array of fields to use ("list" fieldmode only)
	# recordid	[opt]	- ID of record to display in "edit" opmode
	# table		[req]	- name of table in which fields are found
	# db		[req]	- database in which table resides
	# fieldwidth	[opt]	- width of field area in pixels
	# columns	[opt]	- number of columns in which the fields are arranged
	#			- default is 1, omit to use default. Recommend 1-3.
	# buttontype
	#	- "submit"
	#		[def]- include a "submit" button at the foot (default)
	#	- "button"	- include a "button" button at the foot
	# buttononclick	[opt]	- (optional) script commands to be entered
	#			- into button's onclick attribute
	# buttonlabel	[opt]	- button label text
	#			- omit buttonlabel parameter to suppress rendering
	#			- of all buttons (including Reset and Cancel button)

	# required resources
	global $config;
	$mdbh = ConnectDB();

	# apply defaults
	if (!$params["fieldmode"]) { $params["fieldmode"] = "table"; }
	if (!$params["buttontype"]) { $params["buttontype"] = "submit"; }
	if (!$params["columns"]) { $params["columns"] = 1; }

	# retrieve field list if necessary
	if ($params["fieldmode"] == "table") {
		$params["fieldlist"] = split(",",GetFieldList($params["table"],$params["db"]));
	}

	# retrieve database record if necessary
	if ($params["opmode"] == "edit") {
		$sth = SQLExecute("SELECT * FROM ".$params["table"]." WHERE id='".$params["recordid"]."';",$params["db"],$mdbh);
		$record = mysql_fetch_array($sth);
	}

	# create form ID hash
	$formid = StandardHash(implode("",$params).microtime());

	# row marker
	$crow = 1;

	//print_r($params["fieldlist"]);
	//die();
	# start table
	print "<table class=\"dtml-tablegrid\" width=\"99%\" cellspacing=\"0\" cellpadding=\"3\" id=\"dtml_table_$formid\">\n";
	foreach ($params["fieldlist"] as $field) {
		if(array_key_exists($field,$config["dtml_fieldinfo"][$params["db"]][$params["table"]])){
		if ($crow == 1) { print "<tr>\n"; }

		print "<td class=\"dtml-fieldlabel\" nowrap>";
		print $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][0];
		print "&nbsp;</td>\n";
		print "<td class=\"dtml-fieldcenter\"></td>\n";
		print "<td class=\"dtml-fieldvalue\"";
		if ($params["fieldwidth"]) { print " width=\"".$params["fieldwidth"]."\""; }
		print ">";

		# get widget information
		$widget = $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][1];
		$widgetoptions = $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][2];
//		echo $widgetoptions;
		$furtheroptions = $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][3];
		

		switch ($widget) {
			
			case "statictext":
				print $widgetoptions;
				break;

			case "custcode":
				print "<input type=\"text\" size=\"6\" maxlength=\"6\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\" style=\"font-weight: bold;\">";
				print "&nbsp;";
				print "<input type=\"button\" class=\"dtml-button\" value=\"Lookup\" onclick=\"openDBLookup('customer',$field.value,'$field');\">";
				break;

			case "suppcode":
				print "<input type=\"text\" size=\"6\" maxlength=\"6\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\" style=\"font-weight: bold;\">";
				print "&nbsp;";
				print "<input type=\"button\" class=\"dtml-button\" value=\"Lookup\" onclick=\"openDBLookup('supplier',$field.value,'$field');\">";
				break;

			case "sds_link":
				print "<input type=\"text\" readonly size=\"6\" maxlength=\"8\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\" style=\"font-weight: bold;\">";
				print "&nbsp;";
				print "<input type=\"button\" class=\"dtml-button\" value=\"Select appointment\" onclick=\"openSDSLookup($field.value,'$field');\">";
				break;

			case "multimenu":
				print "<select name=\"".$field."[]\" style=\"width: 100%;\" multiple size=\"".count($widgetoptions)."\">\n";
				foreach ($widgetoptions as $mval => $mlabel) {
					print "<option value=\"$mval\"";
					if ($record[$field] == $mval) { print " selected"; }
					print ">$mlabel</option>\n";
				}
				print "</select>\n";
				break;

			case "multimenucsv":
				print "<select name=\"".$field."[]\" style=\"width: 100%;\" multiple size=\"".count($widgetoptions)."\"";
				if ($furtheroptions == "createonly" && $record[$field]) { print " disabled"; }
				print ">\n";
				foreach ($widgetoptions as $mval => $mlabel) {
					print "<option value=\"$mval\"";
					foreach (split(",",$record[$field]) as $possval) {
						if ($possval == $mval) { print " selected"; }
					}
					print ">$mlabel</option>\n";
				}
				print "</select>\n";
				break;

			case "dropdowntextbox":
				$sth = SQLExecute("SELECT DISTINCT($field) AS $field FROM ".$params["table"]." ORDER BY $field;",$params["db"],$mdbh);
				print "<div><select id=\"".$field."_dtmllist\"  name=\"".$field."_dtmllist\" style=\"width: 100%;\" onchange=\"updateDropDownTextBox('$field','list2box');\" class=\"small\">\n";
				print "<option value=\"\"></option>\n";
				while ($row = mysql_fetch_array($sth)) {
					print "<option value=\"".$row[$field]."\">".$row[$field]."</option>\n";
				}
				print "</select></div>\n";
				print "<div><input type=\"text\" size=\"20\" style=\"width: 100%;\" name=\"$field\" id=\"$field\" value=\"".$record[$field]."\" onkeyup=\"updateDropDownTextBox('$field','box2list');\"></div>";
				if ($record[$field]) { print "<script language=\"JavaScript\">updateDropDownTextBox('$field','box2list');</script>\n"; }
				break;

			case "labelmenu":
				print "<select name=\"$field\" style=\"width: 100%;\">\n";
				foreach ($widgetoptions as $mval => $mlabel) {
					print "<option value=\"$mval\"";
					if ($record[$field] == $mval) { print " selected"; }
					print ">$mlabel</option>\n";
				}
				print "</select>\n";
				break;

			case "keymenu":
				print "<select name=\"$field\" style=\"width: 100%;\">\n";
				foreach ($widgetoptions as $mval => $mlabel) {
					print "<option value=\"$mval\"";
					if ($record[$field] == $mval) { print " selected"; }
					print ">$mval</option>\n";
				}
				print "</select>\n";
				break;

			case "valuemenu":
				print "<select name=\"$field\" style=\"width: 100%;\">\n";
				foreach ($widgetoptions as $mval => $mlabel) {
					print "<option value=\"$mlabel\"";
					if ($record[$field] == $mlabel) { print " selected"; }
					print ">$mlabel</option>\n";
				}
				print "</select>\n";
				break;

			case "fullmenu":
				print "<select name=\"$field\" style=\"width: 100%;\">\n";
				foreach ($widgetoptions as $mval => $mlabel) {
					print "<option value=\"$mval\"";
					if ($record[$field] == $mval) { print " selected"; }
					print ">$mval - $mlabel</option>\n";
				}
				print "</select>\n";
				break;

			case "radiomenu":
				$c1 = 1; foreach ($widgetoptions as $mval => $mlabel) {
					print "<input type=\"radio\" class=\"radio\" name=\"$field\" id=\"radio_".$field."_$c1\" value=\"$mval\"";
					if ($record[$field] == $mval) { print " checked"; }
					print "> <label for=\"radio_".$field."_$c1\">$mlabel</label><br>";
				$c1++; }
				break;

			case "autofixed":
				if ($record) {
					print "<input type=\"hidden\" name=\"$field\" value=\"".$record[$field]."\">";
					print "<b>".$record[$field]."</b><br>";
				} else {
					print "fixed or automatically generated field";
				}
				break;

			case "autocreate":
				if ($record) {
					print "<input type=\"text\" size=\"20\" style=\"width: 100%;\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\">";
				} else {
					print "automatically generated field";
				}
				break;

			case "autofixed-timestamp":
				if ($record) {
					print "<input type=\"hidden\" name=\"$field\" value=\"".$record[$field]."\">";
					print "<b>".strftime("%A %B %d %Y, %H:%M:%S",$record[$field])."</b><br>";
				} else {
					print "fixed or automatically generated field";
				}
				break;

			case "hash":
				if ($record) {
					print "<input type=\"text\" size=\"20\" style=\"width: 100%;\" name=\"$field\" id=\"element_$field\" value=\"[restricted field]\"><br>";
					print "leave this field intact if it requires no changes";
				} else {
					print "<input type=\"text\" size=\"20\" style=\"width: 100%;\" name=\"$field\" id=\"element_$field\" value=\"this field will be hashed before it is stored\">";
				}
				break;

			case "textbox-createonly":
				if ($record) {
					print "<input type=\"hidden\" name=\"$field\" value=\"".$record[$field]."\">";
					print "<b>".$record[$field]."</b><br>";
				} else {
					print "<input type=\"text\" name=\"$field\" id=\"element_$field\" style=\"width: 100%;\">";
				}
				break;

			case "boolean":
				print "<input type=\"radio\" class=\"radio\" name=\"$field\" value=\"1\" id=\"$field-on\"";
				if ($record && $record[$field] == "1") { print " checked"; }
				if (!$record && $widgetoptions == "1") { print " checked"; }
				print "> <label for=\"$field-on\">Yes/On</label> &nbsp; ";
				print "<input type=\"radio\" class=\"radio\" name=\"$field\" value=\"0\" id=\"$field-off\"";
				if ($record && $record[$field] == "0") { print " checked"; }
				if (!$record && $widgetoptions == "0") { print " checked"; }
				print "> <label for=\"$field-off\">No/Off</label>";
				break;

			case "boolean-oo":
				print "<input type=\"radio\" class=\"radio\" name=\"$field\" value=\"1\" id=\"$field-on\"";
				if ($record && $record[$field] == "1") { print " checked"; }
				if (!$record && $widgetoptions == "1") { print " checked"; }
				print "> <label for=\"$field-on\">On</label> &nbsp; ";
				print "<input type=\"radio\" class=\"radio\" name=\"$field\" value=\"0\" id=\"$field-off\"";
				if ($record && $record[$field] == "0") { print " checked"; }
				if (!$record && $widgetoptions == "0") { print " checked"; }
				print "> <label for=\"$field-off\">Off</label>";
				break;

			case "boolean-yn":
				//if($field=="super")
				//{
				//	$fiel=$field."1";
				//	print "<input type=\"radio\" class=\"radio\" name=\"$fiel\" value=\"1\" id=\"$field-on\"";				
				//}
				//else
				//{
					print "<input type=\"radio\" class=\"radio\" name=\"$field\" value=\"1\" id=\"$field-on\"";
				//}	
				if ($record && $record[$field] == "1") { print " checked"; }
				if (!$record && $widgetoptions == "1") { print " checked"; }
				print "> <label for=\"$field-on\">Yes</label> &nbsp; ";
				//if($field=="super")
				//{
				//	$fiel=$field."1";
				//	print "<input type=\"radio\" class=\"radio\" name=\"$fiel\" value=\"0\" id=\"$field-off\"";
				//}
				//else
				//{
					print "<input type=\"radio\" class=\"radio\" name=\"$field\" value=\"0\" id=\"$field-off\"";
				//}	
				if ($record && $record[$field] == "0") { print " checked"; }
				if (!$record && $widgetoptions == "0") { print " checked"; }
				print "> <label for=\"$field-off\">No</label>";
				break;

			case "textbox":
				print "<input type=\"text\" size=\"20\" style=\"width: 100%;\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\">";
				break;

			case "password":
				print "<input type=\"password\" size=\"20\" style=\"width: 100%;\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\">";
				break;

			case "textbox-suffix";
				print "<input type=\"text\" size=\"20\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\"> $widgetoptions";
				break;

			case "textbox-suffix-createonly":
				if ($record) {
					print "<input type=\"hidden\" name=\"$field\" value=\"".$record[$field]."\">";
					print "<b>".$record[$field]."</b> $widgetoptions<br>";
				} else {
					print "<input type=\"text\" size=\"20\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\"> $widgetoptions";
				}
				break;

			case "textbox-prefix":
				print "$widgetoptions <input type=\"text\" size=\"20\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\">";
				break;

			case "pricebox":
				print "£ <input type=\"text\" size=\"8\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\">";
				break;

			case "textbox-prefix-createonly":
				if ($record) {
					print "<input type=\"hidden\" name=\"$field\" value=\"".$record[$field]."\">";
					print "$widgetoptions <b>".$record[$field]."</b><br>";
				} else {
					print "$widgetoptions <input type=\"text\" size=\"20\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\">";
				}
				break;

			case "prefix-textbox-suffix":
				print "$widgetoptions <input type=\"text\" size=\"20\" name=\"$field\" id=\"element_$field\" value=\"".$record[$field]."\"> $furtheroptions";
				break;

			case "textarea":
				print "<textarea name=\"$field\" id=\"element_$field\" rows=\"5\" cols=\"20\" style=\"width: 100%;\">".$record[$field]."</textarea>";
				break;

			case "editorbox":
				//print "<textarea name=\"$field\" id=\"element_$field\" rows=\"20\" cols=\"50\" style=\"width: 100%;\">".$record[$field]."</textarea>";
				include("FCKeditor/fckeditor.php") ;
					$oFCKeditor = new FCKeditor($field) ;
					$oFCKeditor->BasePath = '/admin2/FCKeditor/';
					$oFCKeditor->Value = stripslashes($record[$field]);
					$oFCKeditor->Create() ;
					//print "<input type=\"hidden\" value=\"" . $iContentId . "\" name=\"iContentId\">";
					//print "<input type=\"text\" name=\"$field\" id=\"element_$field\" >";	
				break;

			case "htmleditorbox":
				HTMLToolBar("element_$field");
				print "<textarea name=\"$field\" id=\"element_$field\" rows=\"20\" cols=\"50\" style=\"width: 100%;\">".$record[$field]."</textarea>";
				break;

			case "date":
				if ($record) {
					$dparts = explode("-",$record[$field]);
					if ($dparts[0] == "0000") {
						DateSelector($field,"now",false,false);
					} else {
						DateSelector($field,array($dparts[2],$dparts[1],$dparts[0]),false,false);
					}
				} else {
					DateSelector($field,"now",false,false);
				}
				break;

			case "time":
				if ($record) {
					$dparts = explode(":",$record[$field]);
					DateSelector($field,false,array($dparts[0],$dparts[1],1),false);
				} else {
					DateSelector($field,false,array("now","now",$widgetoptions),false);
				}
				break;

			case "datetime":
			case "date-dob":
				if ($record) {
					$dparts = ereg_replace(" ","-",$record[$field]);
					$dparts = explode("-",$dparts);
					//echo $dparts[0].",".$dparts[1].",".$dparts[2].",widoptions=>".$widgetoptions;
					if ($dparts[0] == "0000") {
						DateSelector($field,"now",array("now","now",$widgetoptions),false);
					} else {
						DateSelector1($field,array($dparts[2],$dparts[1],$dparts[0]),array(),false);						
					}
				} else {
					DateSelector($field,"now",array("now","now",$widgetoptions),false);
				}
				break;

			case "date-optional":
				if ($record) {
					$dparts = explode("-",$record[$field]);
					if ($dparts[0] == "0000") {
						DateSelector($field,"now",false,true);
					} else {
						DateSelector($field,array($dparts[2],$dparts[1],$dparts[0]),false,true);
					}
				} else {
					DateSelector($field,"now",false,true);
				}
				break;

			case "countrymenu":
				print "<select name=\"$field\" style=\"width: 100%;\">\n";
				foreach ($config["country_list"] as $ccode => $clabel) {
					print "<option value=\"$ccode\"";
					if (!$record && $ccode == "GBR") { print " selected"; }
					if ($record && $ccode == $record[$field]) { print " selected"; }
					print ">$clabel</option>\n";
				}
				print "</select>\n";
				break;

			case "donotdisplay":
				print "This field cannot be displayed";
				break;

			case "fileupload":
				if ($record) {
					print "<nobr><input type=\"radio\" name=\"".$field."_keepfile\" id=\"".$field."_keepfile_on\" value=\"1\" checked onclick=\"$field.disabled=true;\"> <label for=\"".$field."_keepfile_on\">Keep existing file</label>&nbsp;\n";
					print "<input type=\"radio\" name=\"".$field."_keepfile\" id=\"".$field."_keepfile_off\" value=\"0\" onclick=\"$field.disabled=false;\"> <label for=\"".$field."_keepfile_off\">Replace file</label></nobr><br>\n";
				}
				print "<input type=\"file\" name=\"$field\" style=\"width: 100%;\"";
				if ($record) { print " disabled"; }
				print ">\n";
				if (!$record) { print "<input type=\"hidden\" name=\"".$field."_fileupload\" value=\"1\">"; }
				break;

			default:
				//print "<span class=\"dtml-red\">DTML doesn't know how to render field '$field'</span>";
				break;
			
		}

		print "</td>\n";

		if ($crow == $params["columns"]) { $crow = 1; print "</tr>"; } else { $crow++; }
		}
	}
	
	# complete table

	if ($params["buttonlabel"]) { ?>

		<tr><td class="dtml-fieldlabel" height="10"></td></tr>
		<tr><td class="dtml-fieldlabel" colspan="<?= $params["columns"] * 3; ?>" nowrap align="right" style="padding: 4px;">
			<input type="button" class="dtml-button" value="Cancel" onclick="history.back(1);">
			<input type="reset" class="dtml-button" name="Reset">
			<input type="<?= $params["buttontype"]; ?>" class="dtml-button" value="<?= $params["buttonlabel"]; ?>" <? if ($params["buttononclick"]) { ?>onclick="<?= $params["buttononclick"]; ?>"<? } ?>>
		</td></tr>

	<? } ?>

	</table>

	<?

	return true;

}

function DTMLRecordDisplay($params) {

	# renders a database table record in a format similar to that
	# produced by DTMLForm(), except the fields are not editable.
	# Different field types are treated in different ways, as with
	# DTMLForm(), on which this function is based

	# $params is an associative array comprising the following:

	# fieldmode
	#	- "table"
	#		[def]	- read field names from specified table (default)
	#	- "list"	- read field names from supplied list
	# fieldlist	[opt]	- array of fields to use ("list" fieldmode only)
	# recordid	[req]	- ID of record to display
	# table		[req]	- name of table in which fields are found
	# db		[req]	- database in which table resides
	# fieldwidth	[opt]	- width of field area in pixels
	# columns	[opt]	- number of columns in which the fields are arranged
	#			- default is 1, omit to use default. Recommend 1-3.

	# required resources
	global $config;
	$mdbh = ConnectDB();

	# apply defaults
	if (!$params["fieldmode"]) { $params["fieldmode"] = "table"; }
	if (!$params["columns"]) { $params["columns"] = 1; }

	# retrieve field list if necessary
	if ($params["fieldmode"] == "table") {
		$params["fieldlist"] = split(",",GetFieldList($params["table"],$params["db"]));
	}

	# retrieve database record
	$sth = SQLExecute("SELECT * FROM ".$params["table"]." WHERE id='".$params["recordid"]."';",$params["db"],$mdbh);
	$record = mysql_fetch_array($sth);

	# row marker
	$crow = 1;

	# start table
	print "<table class=\"dtml-tablegrid\" cellspacing=\"0\" cellpadding=\"3\">\n";

	foreach ($params["fieldlist"] as $field) {

		if ($crow == 1) { print "<tr>\n"; }

		print "<td class=\"dtml-fieldlabel\" nowrap>";
		print $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][0];
		print "&nbsp;</td>\n";
		print "<td class=\"dtml-fieldcenter\"></td>\n";
		print "<td class=\"dtml-fieldvalue\"";
		if ($params["fieldwidth"]) { print " width=\"".$params["fieldwidth"]."\""; }
		print ">";

		# get widget information
		$widget = $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][1];
		$widgetoptions = $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][2];

		switch ($widget) {

			case "custcode":
				if ($record[$field]) {
					print "<b>".$record[$field]."</b>";
					print "&nbsp;";
					print "<input type=\"button\" class=\"dtml-button\" value=\"Lookup\" onclick=\"openDBLookup('customer','$record[$field]','$field');\">";
				}
				break;

			case "suppcode":
				if ($record[$field]) {
					print $record[$field];
					print "&nbsp;";
					print "<input type=\"button\" class=\"dtml-button\" value=\"Lookup\" onclick=\"openDBLookup('supplier',$record[$field],'$field');\">";
				}
				break;

			case "multimenu":
			case "labelmenu":
			case "valuemenu":
			case "fullmenu":
			case "keymenu":
			case "radiomenu":
				print $widgetoptions[$record[$field]];
				break;

			case "multimenucsv":
				foreach (explode(",",$record[$field]) as $part) {
					print $widgetoptions[$part]."<br>";
				}
				break;

			case "autocreate":
			case "textbox":
			case "dropdowntextbox":
			case "textbox-createonly":
			case "sds_link":
				print $record[$field];
				break;

			case "autofixed-timestamp":
				print strftime("%A %B %d %Y, %H:%M:%S",$record[$field]);
				break;

			case "hash":
				print "<i>this field is encrypted and cannot be displayed</i>";
				break;

			case "boolean":
				if ($record[$field] == "1") { print "Yes/On"; }
				if ($record[$field] == "0") { print "No/Off"; }
				break;

			case "boolean-oo":
				if ($record[$field] == "1") { print "On"; }
				if ($record[$field] == "0") { print "Off"; }
				break;

			case "boolean-yn":
				if ($record[$field] == "1") { print "Yes"; }
				if ($record[$field] == "0") { print "No"; }
				break;

			case "password":
				print "<i>this is a password field and cannot be displayed</i>";
				break;

			case "textbox-suffix":
				print $record[$field]." ".$widgetoptions;
				break;

			case "pricebox":
				print "£ ".$record[$field];
				break;

			case "textbox-prefix":
				print $widgetoptions." ".$record[$field];
				break;

			case "prefix-textbox-suffix":
				print $widgetoptions." ".$record[$field]." ".$furtheroptions;
				break;

			case "textarea":
				print ereg_replace("\n","<br>",$record[$field]);
				break;

			case "editorbox":
				print $record[$field];
				break;

			case "htmleditorbox":
				print $record[$field];
				break;

			case "date":
			case "date-dob":
				print SlashDate($record[$field]);
				break;

			case "time":
				print $record[$field];
				break;

			case "date-optional":
				print SlashDate($record[$field]);
				break;

			case "countrymenu":
				print $config["country_list"][$record[$field]];
				break;

			case "donotdisplay":
			case "fileupload":
				print "This field cannot be displayed";
				break;

			case "autofixed":
				# sometimes we're able to transform autofixed fields
				if (ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})",$record[$field])) { print SlashDate($record[$field]); }	# ISO dates
				break;

			default:
				//print "<span class=\"dtml-red\">DTML doesn't know how to render field '$field'</span>";
				break;

		}

		print "</td>\n";

		if ($crow == $params["columns"]) { $crow = 1; print "</tr>"; } else { $crow++; }

	}

	# complete table
	print "</table>\n";
	
	return true;

}


function DTMLRecordSummary($params) {
	# creates a widget summarising records in a table by including
	# specified fields in records matching optional criteria

	# $params is an associative array comprising the following:

	# type		[req]
	#	- "table"
	#		[def]	- creates a summary table (default)
	#	- "menu"	- creates a summary menu
	#	- "csv"		- plaintext CSV output, used in interactive mode
	# table		[req]	- the name of the table from which to draw data
	# db		[req]	- the name of the database in which the table resides
	# fields	[opt]	- CSV list of fields to include
	#			- leave absent or pass "all" to include all fields
	# criteria	[opt]	- SQL compatible list of criteria to match records
	#			- leave absent or pass "all" to include all records
	# order		[opt]	- field(s) by which to order the records
	#			- leave absent to order by "id" field
	# orderdirection[opt]	- order direction, either "asc" for ascending [def]
	#			- or "desc" for descending
	# orderspecial	[opt]	- custom SQL compatible ORDER string. "order" and
	#			- "orderdirection" parameters are ignored if this is passed
	# stoperror	[opt]	- text for stop error if no records found, default is
	#			- "No records matched your query"
	# customerror	[opt]	- array of parameters for a custom error:
	#			-	[0] error type (stop|warn|info)
	#			-	[1] first line of text (large)
	#			-	[2] second line of text (small)
	#			- if omitted a normal stop error is rendered instead
	# maxperpage	[opt]	- [def 10] number of records to show per page. If the
	#			- number of matching records exceeds this, previous
	#			- and next links will be provided to browse the results
	#			- along with a list of numbered pagination links.
	#			- Set to "unlimited" to disable all this.
	# printmode	[opt]	- Set to true to disable rendering of re-ordering and
	#			- pagination links

	# actions	[opt]	- associative array for buttons, format as below.
	#			- the record id is always appended to the end
	#			- of each action. Only the first action is
	#			- used for "menu" summary types. The GET parameter
	# 			- "action=" with the value of the action key is
	#			- appended to the action handler, except if the
	#			- action handler itself contains "action=" (manual
	#			- override facility). For "table" summary types, the
	#			- FIRST action is used as a default action when the
	# 			- user clicks on the highlighted row rather than an
	#			- action button

	#		 	$actions = array (
	#				"action1" => "handlerscript1.php?",
	#				"action2" => "handlerscript2.php?"
	# 			);

	# database connection
	$mdbh = ConnectDB();
	//print_r($params);
	//die();
	# global configuration
	global $config, $dtmlpath;

	if (!$params["transid"]) {

		# store transaction information before defaults are set since it's not
		# necessary to store parameters if they're just defaults

		$sth = SQLExecute("INSERT INTO dtml_transactions (timestamp,hostscript) VALUES ('".time()."','".$_SERVER["SCRIPT_NAME"]."');",$params["db"],$mdbh);
		$transid = mysql_insert_id($mdbh);
		
		foreach ($params as $param_key => $param_value) { if ($param_key != "actions") {
			$param_value = addslashes($param_value);
			
			$sth = SQLExecute("INSERT INTO dtml_parameters (transid,param_key,param_value) VALUES ('$transid','$param_key','".$param_value."');",$params["db"],$mdbh);
		} }
		
		if ($params["actions"]) {
			foreach ($params["actions"] as $action_label => $action_script) {
				$sth = SQLExecute("INSERT INTO dtml_actions (transid,action_label,action_script) VALUES ('$transid','$action_label','$action_script');",$params["db"],$mdbh);
			}
		}

	} else {

		# keep submitted parameters as they may contain specific changes
		# (order, etc) beyond just providing the db name and transaction ID
		$subparams = $params;

		# retrieve parameters from transaction database
		$sth = SQLExecute("SELECT * FROM dtml_parameters WHERE transid='".$params["transid"]."' ORDER BY transid;",$params["db"],$mdbh);
		while ($row = mysql_fetch_array($sth)) { 
			$params[$row["param_key"]] = $row["param_value"];				
		}

		# retrieve actions from transaction database
		$sth = SQLExecute("SELECT * FROM dtml_actions WHERE transid='".$params["transid"]."' ORDER BY transid;",$params["db"],$mdbh);
		while ($row = mysql_fetch_array($sth)) { $params["actions"][$row["action_label"]] = $row["action_script"]; }

		# apply changes from submitted parameters
		foreach ($subparams as $subparam_key => $subparam_value) {
			if ($subparam_key != "db" && $subparam_key != "transid") {
				$params[$subparam_key] = $subparam_value;
			}
		}

		# if the childmode parameter is set, add it to the transaction
		# if it has been done already
		if ($params["childmode"] == "on") {
			$chksth = SQLExecute("SELECT param_value FROM dtml_parameters WHERE transid='".$params["transid"]."' AND param_key='childmode';",$params["db"],$mdbh);
			$chk = mysql_fetch_array($chksth);
			if ($chk["param_value"] != "on") {
				$cmi = SQLExecute("INSERT INTO dtml_parameters (transid,param_key,param_value) VALUES ('".$params["transid"]."','childmode','on');",$params["db"],$mdbh);
			}
		}

		# set the local variable
		$transid = $params["transid"];

	}
	
	# apply defaults to missing parameters
	if (!$params["type"]) { $params["type"] = "table"; }
	if (!$params["fields"]) { $params["fields"] = "all"; }
	if (!$params["criteria"]) { $params["criteria"] = "all"; }
	if (!$params["order"]) { $params["order"] = "id"; }
	if (!$params["orderdirection"]) { $params["orderdirection"] = "asc"; }
	if (!$params["stoperror"]) { $params["stoperror"] = "No records matched your query"; }
	if (!$params["maxperpage"]) { $params["maxperpage"] = 10; }
	if (!$params["startrecord"]) { $params["startrecord"] = 0; }

	# get field translation table
	$fieldinfo = $config["dtml_fieldinfo"][$params["db"]][$params["table"]];
	
	# get list of fields if necessary
	if ($params["fields"] == "all") { $params["fields"] = GetFieldList($params["table"],$params["db"]); }

	# process actions
	if ($params["actions"]) {
		$actionkeys = array_keys($params["actions"]);
		$actionhandlers = array();
		foreach ($actionkeys as $key) { array_push($actionhandlers,$params["actions"][$key]); }
	}

	# build and run SQL statement, forking off an unlimited version for
	# use by the paginator code

	# start
	# AT August 2006 - if statement required as the id field is duplicated between the two joined tables. Would really suggest that in future, the id field is called iUserId and iEndorsementId, so as to avoid mysql confusion when doing a select on "id" from two tables which both have the same named column, as primary keys
	$mod=0;
	if($params['fields']=="usrUsername,usrForename,usrSurname,usrDOB,usrTown,usrEmailAddress,usrGender,usrProfession,usrMobileNumber,usrSexualPrefs,usrPhotos")
	{
		$mod=1;
		//$params['fields']="usrUsername,usrForename,usrSurname,usrDOB,usrTown,usrEmailAddress,usrGender,usrProfession,usrMobileNumber,usrSexualPrefs";
	}		
	if(eregi("users inner join",$params["table"]))
	{
		if(($_REQUEST['usrEvents1']=="") && ($_REQUEST['usrEvents2']==""))
		{
			$sql = "SELECT users.id,".$params["fields"]." FROM ".$params["table"];						
		}
		else
		{
			$sql = "SELECT distinct users.id,".$params["fields"]." FROM ".$params["table"].",eventguests,waitinglist";
		}	
	}
	else
	{
		if($params['fields']=="usrUsername,usrForename,usrSurname,usrDOB,usrTown,usrEmailAddress,usrGender,usrProfession,usrMobileNumber,usrSexualPrefs,usrPhotos")
		{
			$params['fields']="usrUsername,usrForename,usrSurname,usrDOB,usrTown,usrEmailAddress,usrGender,usrProfession,usrMobileNumber,usrSexualPrefs,usrPhotos";						
			if(($_REQUEST['usrEvents1']=="") && ($_REQUEST['usrEvents2']==""))
			{
				$sql = "SELECT id,".$params["fields"]." FROM ".$params["table"];			
			}
			else
			{
				$sql = "SELECT distinct id,".$params["fields"]." FROM ".$params["table"];			
			}	
		}
		else
		{
			$sql = "SELECT id,".$params["fields"]." FROM ".$params["table"];
		}		
	}
	# criteria
	if ($params["criteria"] != "all") {
		if($params['fields']=="usrUsername,usrForename,usrSurname,usrDOB,usrTown,usrEmailAddress,usrGender,usrProfession,usrMobileNumber,usrSexualPrefs,usrPhotos")
		{
			if(($_REQUEST['usrEvents1']!="") && ($_REQUEST['usrEvents2']==""))
			{
		 		$sql .= " WHERE ".$params["criteria"]." and ((id not in (select userIndex from eventguests where eventIndex='".$_REQUEST['usrEvents1']."')) and (id not in (select userIndex from waitinglist where eventIndex='".$_REQUEST['usrEvents1']."')))";
			}
			elseif(($_REQUEST['usrEvents1']=="") && ($_REQUEST['usrEvents2']!=""))
			{
				$sql .= " WHERE ".$params["criteria"]." and ((id not in (select userIndex from eventguests where eventIndex='".$_REQUEST['usrEvents2']."')) and (id not in (select userIndex from waitinglist where eventIndex='".$_REQUEST['usrEvents2']."')))";
			}	
			elseif(($_REQUEST['usrEvents1']!="") && ($_REQUEST['usrEvents2']!=""))
			{
				$sql .= " WHERE ".$params["criteria"]." and (((id not in (select userIndex from eventguests where eventIndex='".$_REQUEST['usrEvents1']."')) and (id not in (select userIndex from waitinglist where eventIndex='".$_REQUEST['usrEvents1']."'))) and ((id not in (select userIndex from eventguests where eventguests.eventIndex='".$_REQUEST['usrEvents2']."')) and (id not in (select userIndex from waitinglist where eventIndex='".$_REQUEST['usrEvents2']."'))))";
			}
			else
			{
				$sql .= " WHERE ".$params["criteria"];				
			}
			if(($_REQUEST['usrCredits']!=1) && ($_REQUEST['usrCredits']==2))
			{
				$sql.=" and id in (SELECT user FROM credits)";
			}	
			if(($_REQUEST['usrCredits']!=1) && ($_REQUEST['usrCredits']==3))
			{
				$sql.=" and id not in (SELECT user FROM credits)";
			}
			if(($_REQUEST['usrPhotos']!=1) && ($_REQUEST['usrPhotos']==2))
			{
				$sql.=" and usrPhotos='Y'";
			}	
			if(($_REQUEST['usrPhotos']!=1) && ($_REQUEST['usrPhotos']==3))
			{
				$sql.=" and usrPhotos='N'";
			}
			$params['fields']="usrUsername,usrForename,usrSurname,usrDOB,usrTown,usrEmailAddress,usrGender,usrProfession,usrMobileNumber,usrSexualPrefs,usrPhotos";									
		}
		else
		{
			$sql .= " WHERE ".$params["criteria"];			
		}	
	}
	# ordering
	
	if ($params["orderspecial"]) {
		if($params['fields']=="usrUsername,usrForename,usrSurname,usrDOB,usrTown,usrEmailAddress,usrGender,usrProfession,usrMobileNumber,usrSexualPrefs,usrPhotos")		
		{	
			$sql .= " ORDER BY ".$params["orderspecial"];
		}else
		{
			$sql .= " ORDER BY ".$params["orderspecial"];
		}	
	} else {
		if($params['fields']=="usrUsername,usrForename,usrSurname,usrDOB,usrTown,usrEmailAddress,usrGender,usrProfession,usrMobileNumber,usrSexualPrefs,usrPhotos")		
		{	
			$sql .= " ORDER BY ".$params["order"]." ".strtoupper($params["orderdirection"]);
		}
		else
		{
			$sql .= " ORDER BY ".$params["order"]." ".strtoupper($params["orderdirection"]);
		}	
	}

	$unlimsql = $sql.";";
	
	if ($params["maxperpage"] != "unlimited") {
		$sql .= " LIMIT ".$params["startrecord"].",".$params["maxperpage"].";";
	}
	$sth = SQLExecute($sql,$params["db"],$mdbh);	
	$rc = mysql_num_rows($sth);

	$unlimsth = SQLExecute($unlimsql,$params["db"],$mdbh);
	$totalrc = mysql_num_rows($unlimsth);	
	# render widgets

	switch ($params["type"]) {
	
		
		case "table": 
				
			if ($params["table"] == 'admin_messages') {
				$params["fields"] = str_replace("id,","",$params["fields"]); 
			}	
		
		?>
			
			<? if ($rc <= 0) { ?>
				
				<? if ($params["customerror"]) { ?>
					<? StandardError($params["customerror"][1],$params["customerror"][2],$params["customerror"][0]); ?>
				<? } else { ?>
					<? InfoError($params["stoperror"],"!RETURN"); ?>
				<? } ?>

			<? } else { ?>
							
				<? $totalcolumns = 0; ?>
				<? $container = "dtml_".StandardHash($_SERVER["REMOTE_ADDR"].microtime()); ?>
				
				<div id="<?= $container; ?>">
				<table class="dtml-tablegrid" cellspacing="0" cellpadding="3" width="100%" <? if($params["table"]=='messages' or $params["table"]=='admin_messages'){ ?> border="1"<? } ?>>
				
				<thead><tr>
									
					<?
						if($params['fields']=="usrUsername,usrForename,usrSurname,usrDOB,usrTown,usrEmailAddress,usrGender,usrProfession,usrMobileNumber,usrSexualPrefs,usrPhotos")
						{
							?>
							<? foreach (explode(",",$params["fields"]) as $field) { 
								
								 if($field!="usrPhotos"){		
							?>							
							<th align="center" nowrap>
								<? if($fieldinfo[$field][0]=="Date of birth"){$fieldinfo[$field][0]="Age";}?>								
								<? if (!$params["printmode"]) { ?><a href="javascript:populateHTTPObject('<?= $container; ?>','GET','<?= $dtmlpath; ?>?db=<?= $params["db"]; ?>&transid=<?= $transid; ?>&order=users.<?= $field; ?>&orderdirection=asc&usrEvents1=<?=$_REQUEST['usrEvents1']?>&usrEvents2=<?=$_REQUEST['usrEvents2']?>&usrCredits=<?=$_REQUEST['usrCredits']?>&usrPhotos=<?=$_REQUEST['usrPhotos']?>&aj=1');"><? } ?><?= $fieldinfo[$field][0]; ?><? if (!$params["printmode"]) { ?></a><? } ?>
							</th>							
						<? 		} 
							}					
						
						?>
					<?	}else{
					?>
						<? foreach (explode(",",$params["fields"]) as $field) { ?>
						
							<th align="center" nowrap <? if($field=='mesMessageSubject'){ ?> width="150"<? } ?><? if($field=='mesMessageText'){?>width="350"<? } ?> <? if($field == 'mesDateSent' && $params["table"] == 'admin_messages'){ ?> width="80"<? } ?>>
								<? if($fieldinfo[$field][0]=="Date of birth"){$fieldinfo[$field][0]="Age";}?>								
								<? if (!$params["printmode"]) { ?><a href="javascript:populateHTTPObject('<?= $container; ?>','GET','<?= $dtmlpath; ?>?db=<?= $params["db"]; ?>&transid=<?= $transid; ?>&order=<?= $field; ?>&orderdirection=asc');"><? } ?><?= $fieldinfo[$field][0]; ?><? if (!$params["printmode"]) { ?></a><? } ?>								
							</th>
							
						<? } 
						   if ($params["table"] == 'admin_messages') { 						   		
						   ?>
						   	<th align="center" nowrap width="130">No of messages sent</th>
							<th align="center" nowrap width="150">No of messages unread</th>
						<? } ?>	
					<? } ?>	
					<? for ($i=0; $i<count($actionhandlers); $i++) { ?>
						<th align="center" nowrap><b><?= ereg_replace("_"," ",ucfirst($actionkeys[$i])); ?></b></td>
					<? } ?>						
				</tr></thead>
				
				<? while ($row = mysql_fetch_array($sth)) { ?>

					<? $rowid = "row_".StandardHash($row["id"].microtime()); ?>

					<tr	id="<?= $rowid; ?>"	onmouseover="changeClass('<?= $rowid; ?>','dtml-highlight');" onmouseout="changeClass('<?= $rowid; ?>','');">						

						<?
						 foreach (explode(",",$params["fields"]) as $field) {
						 	 if($field!="usrPhotos"){
						  ?>
						 	<?
								
								# increment total columns
								$totalcolumns++;
	
								# text processing
								$fieldtype = $config["dtml_fieldinfo"][$params["db"]][$params["table"]][$field][1];
								
								if ($fieldtype == "autofixed-timestamp") { $row[$field] = strftime("%d/%m/%y %H:%M",$row[$field]); }
								# AT Aug 2006 - Convert the dob to an age instead.							
								# Handle DOB and convert it to Age instead
								if ($fieldtype == "date-dob") { $row[$field] = DOB2Age($row[$field]); }
								if (strlen($row[$field]) == 0) { $row[$field] = "&nbsp;"; }
								
								if($field == "usrProfession")
								{
									$row[$field] = $config["menu_usrProfession"][$row[$field]];
								}
								
								$row[$field] = eregi_replace("\n","<br>",$row[$field]);
								$row[$field] = eregi_replace("\,",", ",$row[$field]);
								# $row[$field] = eregi_replace("\/","/ ",$row[$field]);
								
								if(($field=="mesSenderIndex") || ($field=="mesRecipientIndex"))
								{
									$usr_id=GetSingleField("usrUniqueID","users",$config["db"]["name"],"id",$row[$field]);
									$row[$field]=GetSingleField("usrUsername","users",$config["db"]["name"],"id",$row[$field]);
								}
								
								if(($field=="mesReplyPaid") || ($field=="mesEventFlag"))
								{
									if($row[$field]==1){$row[$field]='Y';}else{$row[$field]='N';}
								}
	
								# determine action location
								if ($params["childmode"] == "on") {
									$actloc = "parent.opener.document.location";
								} else {									
									$actloc = "location";
								}
	
								?>
	
								<? if (!ereg("action=",$actionhandlers[0])) { $actionstr = "action=".$actionkeys[0]."&"; } else unset($actionstr); ?>							
								<? if($mod==0){								
									if($params["table"]=="view_suspended_profile") 
									   	  {?>
									   		 <td class="dtml-gridcell"><?= $row[$field]; ?></td>
     								   <?  }else{
									   			if($params["table"]=="messages"){
													if(($field=="mesSenderIndex") || ($field=="mesRecipientIndex")){
													
													?>
														<td class="dtml-gridcell" onclick="javascript:window.open('http://www.singlesolution.com/common/login.html?id=<?= $usr_id; ?>')"><font style="text-decoration:underline;"><a href="#"><?= $row[$field]; ?></a></font></td>													
														
											<?		}else{?>
											
														<td class="dtml-gridcell"><?= $row[$field]; ?></td>		
														
												<?	}																						
												} else if ($params["table"] == 'admin_messages') { 	?>
									   			
													<td class="dtml-gridcell" <? if ($actionkeys[0]) { ?>nclick="<?= $actloc; ?>.href='<?= $actionhandlers[0]; ?><?= $actionstr; ?>id=<?= $row["id"]; ?>';"<? } ?>><?= htmlentities($row[$field]); ?></td>
												<?													
												} else { ?>
									   			
													<td class="dtml-gridcell" <? if ($actionkeys[0]) { ?>onclick="<?= $actloc; ?>.href='<?= $actionhandlers[0]; ?><?= $actionstr; ?>id=<?= $row["id"]; ?>';"<? } ?>><?= $row[$field]; ?></td>
										<? 		}
											} ?>	
									
								<? }else{ 
										?>
										  <td class="dtml-gridcell" <? if ($actionkeys[0]) { ?>nclick="javascript:window.open('<?= $actionhandlers[0]; ?><?= $actionstr; ?>id=<?= $row["id"]; ?>')"<? } ?>><?= $row[$field]; ?></td>									
										<?
									}
								}	
							
						    }
							$usr_id=GetSingleField("usrUniqueID","users",$config["db"]["name"],"id",$row["id"]);
							
							if ($params["table"] == 'admin_messages') {
								$resSent = mysql_query("select count(*) from messages where admin_message_id = '".$row[id]."'");									
								if (mysql_num_rows($resSent)) {
									$rsSent = mysql_fetch_array($resSent);
								} 
								$resUnread = mysql_query("select count(*) from messages where admin_message_id = '".$row[id]."' and mesMessageRead = 0");
								if (mysql_num_rows($resUnread)) {
									$rsUnread = mysql_fetch_array($resUnread);
								}
								?>
								<td class="dtml-gridcell"><?=$rsSent[0]?></th>
								<td class="dtml-gridcell"><?=$rsUnread[0]?></th>
							<? } ?>							 
																							
						<? for ($i=0; $i<count($actionkeys); $i++) { ?>

							<? $totalcolumns++; ?>

							<? if ($actionkeys[$i] == "delete" || $actionkeys[$i] == "cancel") { ?>
								<td align="center" class="dtml-grey"><input type="button" onclick="verifyDelete('<?= $actionhandlers[$i]; ?>action=<?= $actionkeys[$i]; ?>&id=<?= $row["id"]; ?>');" value="<?= ereg_replace("_"," ",ucfirst($actionkeys[$i])); ?>" class="dtml-smallbutton"></td>
							<? } else {	 ?>
								<? if ($actionkeys[$i] == "Login") { ?>
										<td align="center" class="dtml-grey"><input type="button" onclick="javascript:window.open('http://www.singlesolution.com/common/login.html?id=<?= $usr_id; ?>')" value="<?= ereg_replace("_"," ",ucfirst($actionkeys[$i])); ?>" class="dtml-smallbutton"></td>
								<? }else{?>
									<? if (!ereg("action=",$actionhandlers[$i])) { $actionstr = "action=".$actionkeys[$i]."&"; } else unset($actionstr); ?>
										<?	if($mod==1){
												if(ereg_replace("_"," ",ucfirst($actionkeys[$i]))=="View"){?>
													<td align="center" class="dtml-grey"><input type="button" onclick="window.open('<?= $actionhandlers[$i]; ?><?= $actionstr; ?>id=<?= $row["id"]; ?>')" value="<?= ereg_replace("_"," ",ucfirst($actionkeys[$i])); ?>" class="dtml-smallbutton"></td>
											<?  }else{ ?>
													<td align="center" class="dtml-grey"><input type="button" onclick="<?= $actloc; ?>.href='<?= $actionhandlers[$i]; ?><?= $actionstr; ?>id=<?= $row["id"]; ?>';" value="<?= ereg_replace("_"," ",ucfirst($actionkeys[$i])); ?>" class="dtml-smallbutton"></td>
											<?	}		
											}else{ ?>
												   <td align="center" class="dtml-grey"><input type="button" onclick="<?= $actloc; ?>.href='<?= $actionhandlers[$i]; ?><?= $actionstr; ?>id=<?= $row["id"]; ?>';" value="<?= ereg_replace("_"," ",ucfirst($actionkeys[$i])); ?>" class="dtml-smallbutton"></td>
											<? } ?>
									<? } ?>		
							<? } ?>

						<? } ?>		

					</tr>

				<? } 
				
				?>

				<? if (!$params["printmode"]) { ?>

					<tfoot><tr>
						<!-- <th colspan="<?=$totalcolumns?>" nowrap> -->
						<th colspan="14" nowrap>

						<?

						# pagination links

						# total records
						print "<b>$totalrc</b> record";
						if ($totalrc > 1) { print "s"; }

						if ($params["maxperpage"] != "unlimited") {

							print " | ";

							# prev
							if ($params["startrecord"] > 0) {
								if ($params["startrecord"] < $params["maxperpage"]) {
									$newstartrecord = 0;
								} else {
									$newstartrecord = $params["startrecord"] - $params["maxperpage"];
								}
								print "<a href=\"javascript:populateHTTPObject('$container','GET','$dtmlpath?db=".$params["db"]."&transid=$transid&order=".$params["order"]."&startrecord=$newstartrecord&maxperpage=".$params["maxperpage"]."&usrEvents1=".$_REQUEST['usrEvents1']."&usrEvents2=".$_REQUEST['usrEvents2']."&usrCredits=".$_REQUEST['usrCredits']."&usrPhotos=".$_REQUEST['usrPhotos']."&aj=1');\"><< Previous ".$params["maxperpage"]."</a>\n";
								$plr = true;
							}

							# page jumps
							$div = $totalrc / $params["maxperpage"];
							$chunks = intval($div);
							if ($div > $chunks) { $chunks++; }
							if ($plr) { print "|&nbsp"; }
							print "Page ";
							$c1 = 1; while ($c1 <= $chunks) {
								$newstartrecord = ($c1 - 1) * $params["maxperpage"];
								if ($newstartrecord == $params["startrecord"]) {
									print "<b>$c1</b>\n";
								} else {
									print "<a href=\"javascript:populateHTTPObject('$container','GET','$dtmlpath?db=".$params["db"]."&transid=$transid&order=".$params["order"]."&startrecord=$newstartrecord&maxperpage=".$params["maxperpage"]."&usrEvents1=".$_REQUEST['usrEvents1']."&usrEvents2=".$_REQUEST['usrEvents2']."&usrCredits=".$_REQUEST['usrCredits']."&usrPhotos=".$_REQUEST['usrPhotos']."&aj=1');\">$c1</a>\n";
								}
							$c1++; }

							# next
							if ($rc == $params["maxperpage"]) {
								$newstartrecord = $params["startrecord"] + $params["maxperpage"];
								print "|&nbsp;<a href=\"javascript:populateHTTPObject('$container','GET','$dtmlpath?db=".$params["db"]."&transid=$transid&order=".$params["order"]."&startrecord=$newstartrecord&maxperpage=".$params["maxperpage"]."&usrEvents1=".$_REQUEST['usrEvents1']."&usrEvents2=".$_REQUEST['usrEvents2']."&usrCredits=".$_REQUEST['usrCredits']."&usrPhotos=".$_REQUEST['usrPhotos']."&aj=1');\">Next ".$params["maxperpage"]." >></a>\n";
							}

						}

						# csv
						if($params['fields']=="usrUsername,usrForename,usrSurname,usrDOB,usrTown,usrEmailAddress,usrGender,usrProfession,usrMobileNumber,usrSexualPrefs,usrPhotos")
						{
							print "|&nbsp;<a href=\"$dtmlpath?db=".$params["db"]."&transid=$transid&order=".$params["order"]."&type=csv&maxperpage=unlimited&usrEvents1=".$_REQUEST['usrEvents1']."&usrEvents2=".$_REQUEST['usrEvents2']."&usrCredits=".$_REQUEST['usrCredits']."&usrPhotos=".$_REQUEST['usrPhotos']."&aj=1\"><img src=\"/images/excel.gif\" width=\"16\" height=\"16\" alt=\"Download results in Excel compatible CSV file\" border=\"0\" align=\"absmiddle\"></a>\n";
						}
						else
						{
							print "|&nbsp;<a href=\"$dtmlpath?db=".$params["db"]."&transid=$transid&order=".$params["order"]."&type=csv&maxperpage=unlimited\"><img src=\"/images/excel.gif\" width=\"16\" height=\"16\" alt=\"Download results in Excel compatible CSV file\" border=\"0\" align=\"absmiddle\"></a>\n";
						}	

						?>

						</th>
					</tfoot></tr>

				<? } ?>

				</table></div>

			<? } # $rc test ?>

			<? break;

		case "menu": ?>

			<select name="<?= $params["table"]; ?>select" onchange="location.href='<?= $actionhandlers[0]; ?>action=<?= $actionkeys[1]; ?>&id='+<?= $params["table"]; ?>select.value;">

			<? while ($row = mysql_fetch_array($sth)) {

				$olf = array();
				foreach (explode(",",$params["fields"]) as $field) {
					array_push($olf,$row[$field]);
				}
				$option = implode(", ",$olf);

				?>

				<option value="<?= $row["id"]; ?>"><?= $option; ?></option>

			<? } ?>

			</select>

			<? break;

		case "csv":

			# column headers
			foreach (explode(",",$params["fields"]) as $field) {
				if($fieldinfo[$field][0]=="Date of birth")	
				{
					$fieldinfo[$field][0]="Age";
				}
				if($field!="usrPhotos"){
					print $fieldinfo[$field][0].",";
				}else{
					print "Photos,";
				}	
			}
			if($params["table"]=="view_suspended_profile"){
				print "Photos,";		
			}
			print "\n";

			while ($row = mysql_fetch_array($sth)) {
				foreach (explode(",",$params["fields"]) as $field) {
    			if($field == "usrProfession")
    			{
    				$row[$field] = $config["menu_usrProfession"][$row[$field]];
    			}
				if(($field=="mesSenderIndex") || ($field=="mesRecipientIndex"))
				{					
					$row[$field]=GetSingleField("usrUsername","users",$config["db"]["name"],"id",$row[$field]);
				}
				if(($field=="mesReplyPaid") || ($field=="mesEventFlag"))
				{
					if($row[$field]==1){$row[$field]='Y';}else{$row[$field]='N';}
				}	
				if($field=="usrDOB")
				{
					$row[$field]=DOB2Age($row[$field]);
				}			
				print ereg_replace(",","",$row[$field]).",";
				}
				if($params["table"]=="view_suspended_profile"){
					$res_sus=mysql_query("select * from users where usrEmailAddress='".$row['email_address']."'");
					if(mysql_num_rows($res_sus)>0){
						$rs_sus=mysql_fetch_object($res_sus);
						print $rs_sus->usrPhotos.",";
					}	
							
				}
				print "\n";
			}

			break;

	}
	if(($mod==1) && ($_REQUEST['aj']!=1))
	{
		//sendBulkMessage($unlimsql);
		$param_res=mysql_query("select * from dtml_parameters where transid='".$transid."' and param_key='sql'");
		if(mysql_num_rows($param_res)>0)
		{
			$mes_sql=base64_encode($unlimsql);
			mysql_query("update dtml_parameters set param_value='$unlimsql' where param_key='sql' and transid='".$mes_sql."'");
		}
		else
		{
			$mes_sql=base64_encode($unlimsql);
			mysql_query("insert into dtml_parameters(transid,param_key,param_value) values('".$transid."','sql','".$mes_sql."')");
		}
		?>
		<script language="javascript">
			function openDialog1(id)
			{
				window.open("/admin2/sendmessage.php?id="+id,'','width=800,height=600,scrollbars=yes,status=no,toolbar=no,top=0,left=0');
				//window.open(Fname,'','width=500,height=300,scrollbars=no,status=no,toolbar=no,top=0,left=0');	
			}
		</script>
		<p class="greyframe">
			<a href="javascript:openDialog1('<?=$transid?>')">Send bulk message to <?=$totalrc?> members</a>
		</p>
	<?	
	}
	return true;

}


function DTMLImportForm($table,$db,$notes) {

	# prepares and renders an import configuration form for $table within
	# $db. Does not render <form> tags. The form should then be procesed by
	# DTMLImport(). $notes an associative array supplying field specific
	# notes, for example $notes["fieldname"] = "This field must be either A or B";

	# Don't forget to include enctype="multipart/form-data" in the <form> tag.

	global $config;

	?>

	<input type="hidden" name="table" value="<?= $table; ?>">
	<input type="hidden" name="db" value="<?= $db; ?>">

	<table border="0" cellpadding="5" cellspacing="0"><tr>
	<td align="left" valign="top" width="50%">

	<p class="heading2">Instructions</p>

	<ol>

		<li class="spaced">Use the form opposite to declare which fields you intend to
		include in the database import. As many or as few fields can
		be included as required, but the columns of the CSV file <b>must</b>
		be in the same order as shown opposite.</li>

		<li class="spaced">Uncheck a field if you do not intend to include it. When omitting fields,
		omit the corresponding column from the CSV file. Do NOT include a blank column
		for fields that you have marked to omit.</li>

		<li class="spaced">Read any field specific notes shown and ensure that the source
		data complies with them.</p>

		<li class="spaced">You may, where offered, opt to transform fields to uppercase or
		lowercase by using the appropriate transformation menu.</li>

		<li class="spaced">Specify the path to the source CSV file using the Browse button. The CSV file
		must be delimited by commas. Fields can optionally be encapsulated by quotation marks (").</li>

		<li class="spaced">When all settings are in place and the path has been specified, click Import to continue.</li>

	</ol>

	<table border="0" cellpadding="3" cellspacing="0" class="dtml-tablegrid" width="100%">

		<tr>
			<td class="dtml-fieldlabel" nowrap>Path to CSV file</td>
			<td class="dtml-fieldcenter"></td>
			<td class="dtml-fieldvalue" width="100%"><input type="file" name="csvfile"></td>
		</tr>

		<tr>
			<td class="dtml-fieldlabel" nowrap></td>
			<td class="dtml-fieldcenter"></td>
			<td class="dtml-fieldvalue" width="100%">
				<input type="checkbox" name="confirm" id="confirm">
				<label for="confirm">All settings are correct, proceed with data import</label>
			</td>
		</tr>

		<tr><td class="dtml-fieldlabel" height="10"></td></tr>
		<tr><td colspan="3" class="dtml-fieldlabel">
			<input type="reset" value="Reset">
			<input type="submit" value="Import data">
		</td></tr>

	</table>

	</td><td align="center" valign="top" width="50%">

	<table cellspacing="0" cellpadding="3" class="dtml-tablegrid">

		<thead><tr>
			<th>Use</th>
			<th>Field</th>
			<th>Type</th>
			<th>Transformation</th>
			<th>Notes</th>
		</tr></thead>

	<? $c1 = 0; foreach (array_keys($config["dtml_fieldinfo"][$db][$table]) as $field) { ?>

		<? $ftype = $config["dtml_fieldinfo"][$db][$table][$field][1]; ?>

		<tr <? if ($c1 == 1) { ?>style="background: <?= $config["style"]["color_lightgrey"]; ?>"<? } ?>>

			<td class="lgtpink" align="center" valign="top"><input type="checkbox" name="use_<?= $field; ?>" id="use_<?= $field; ?>" checked value="1"></td>

			<td class="dtml-gridcell" nowrap><label for="use_<?= $field; ?>"><?= $config["dtml_fieldinfo"][$db][$table][$field][0]; ?></label></td>

			<td class="dtml-gridcell" nowrap>

				<? switch ($ftype) {

					case "custcode":
						print "Cust. code";
						$stype = $ftype;
						break;

					case "suppcode":
						print "Supp. code";
						$stype = $ftype;
						break;

					case "boolean":
					case "boolean-oo":
					case "boolean-yn":
						print "Boolean";
						$stype = "boolean";
						break;

					case "pricebox";
						print "Float";
						$stype = "float";
						break;

					case "date":
					case "date-optional":
					case "date-dob":
						print "Date";
						$stype = "date";
						break;

					case "time":
						print "Time";
						$stype = $ftype;
						break;

					case "datetime";
						print "Date and time";
						$style = $ftype;
						break;

					default;
						print "Text";
						unset($stype);
						break;

				} ?>

			</td>

			<td class="dtml-gridcell">

				<? if ($stype == "custcode" || $stype == "suppcode" || !$stype) { ?>

					<select name="action_<?= $field; ?>">
						<option value="asis" selected>none</option>
						<option value="upper" <? if ($stype == "custcode" || $stype == "suppcode") { ?>selected<? } ?>>uppercase</option>
						<option value="lower">lowercase</option>
					</select>

				<? } else { ?>

					<select name="action_<?= $field; ?>" style="width: 100%;">
						<option value="asis">none</option>
					</select>

				<? } ?>

			</td>

			<td class="dtml-gridcell">

				<? if ($notes[$field]) { print $notes[$field];

				} else { switch ($stype) {

					case "custcode":
						print "must be a six character customer code (uppercase)";
						break;

					case "suppcode":
						print "must be a six character supplier code (uppercase)";
						break;

					case "boolean":
						print "must be either 1 (true) or 0 (false)";
						break;

					case "float":
						print "must be a number with up to two decimal places";
						break;

					case "date":
						print "must be an ISO date of the format 'YYYY-MM-DD'";
						break;

					case "time":
						print "must be an ISO time of the format 'HH:MM:SS'";
						break;

					case "datetime";
						print "must be an ISO date followed by an ISO time of the format 'YYYY-MM-DD HH:MM:SS'";
						break;

				} } ?>

			</td>

		</tr>

		<? if ($c1 == 1) { $c1 = 0; } else { $c1++; } ?>

		<? unset($ft); ?>

	<? } ?>

	</table>

	</td></tr></table>

	<?

}


function DTMLImport($subdata,$filedata) {

	# processes a form generated by DTMLImportForm() and imports data to
	# the specified table within the specified database. Pass $_POST to
	# $subdata and $_FILES to $filedata.

	# Returns a three part array if import was successful. First element
	# will be "success", followed by the number of records submitted, followed
	# by the number of records successfully imported. If the import was not
	# successful, an array of reasons as to why it was unsuccessful is returned.

	global $config, $dbh;

	# make basic checks
	$pass = true; $report = array();

	if (!$subdata["confirm"]) { unset($pass); array_push($report,"You did not not confirm that all settings were correct before clicking Import."); }
	if (!$filedata["csvfile"]["tmp_name"]) { unset($pass); array_push($report,"An invalid CSV file path was specified."); }

	if ($pass) {

		# open CSV file from temporary location
		$csv = fopen($filedata["csvfile"]["tmp_name"],"r");

		# build array of fields to include
		$incfields = array();
		foreach (array_keys($subdata) as $key) {
			if (substr($key,0,4) == "use_") {
				array_push($incfields,substr($key,4,strlen($key)-4));
			}
		}

		while (($data = fgetcsv($csv)) !== false) {

			# create record array
			$record = array();

			for ($i=0; $i<count($incfields); $i++) {
				$record[$incfields[$i]] = $data[$i];
			}

			# apply transformations
			foreach ($incfields as $field) {
				if ($subdata["action_$field"] == "upper") { $record[$field] = strtoupper($record[$field]); }
				if ($subdata["action_$field"] == "lower") { $record[$field] = strtolower($record[$field]); }
			}

			# convert record to INSERT statement
			$sql = DTMLCreateRecord($subdata["table"],$subdata["db"],$record);

			# run query and if it's successful update the import counter
			if (mysql_db_query($subdata["db"],$sql,$dbh)) { $ic++; }

			# increment general record counter
			$rc++;

		}

		return array("success",$ic,$rc);

	} else {

		return $report;

	}

}


function DTMLExportForm($table,$db) {

	# prepares and renders an export configuration form for $table within
	# $db. Does not render <form> tags. The form should then be procesed by
	# DTMLExport(), which will render CSV output.

	global $config;

	# get list of fields within table
	$fields = explode(",",GetFieldList($table,$db));

	# calculate suitable length for fieldlist
	if (count($fields) <= 20) { $flsize = count($fields); }
	else { $flsize = 20; }

	# parameters for search form
	$params["search"] = array(
		"type"			=> "logic",
		"db"			=> $db,
		"table"			=> $table,
		"criteriacount"		=> "10",
		"buttonlabel"		=> "Export data",
		"disableorderby"	=> true,
	);

	?>

	<input type="hidden" name="exporttable" value="<?= $table; ?>">
	<input type="hidden" name="exportdb" value="<?= $db; ?>">

	<table border="0" width="100%" cellpadding="5" cellspacing="0">
	<tr><td width="35%" align="left" valign="top">

	<? $tabs = TabSectionHeader("export",array("Fields","Sorting"),"h"); ?>

	<div id="<?= $tabs[0]; ?>">

		<p>Select any number of fields to include in the export. Use CTRL to make
		multiple selections, or drag the mouse whilst holding the principle mouse button.
		All are selected by default.</p>

		<p align="center"><select name="fieldlist[]" multiple size="<?= $flsize; ?>" style="width: 100%;">
			<? foreach ($fields as $field) { 
			      if(array_key_exists($field,$config["dtml_fieldinfo"][$db][$table])){
				?>				
				<option value="<?= $field; ?>" selected><?= $config["dtml_fieldinfo"][$db][$table][$field][0]; ?></option>
				<? } ?>
			<? } ?>	
		</select></p>

		<p class="small-grey"><b>NOTE:</b> If a large number of fields are selected, the record
		browser table generated is likely to be quite wide, and, depending on
		the nature of the data, may therefore cause fields to wrap, making the
		table also quite long, even if the number of records to be displayed
		per page is set low. Please be aware of this before submitting this form.</p>

	</div>

	<div id="<?= $tabs[1]; ?>" style="display: none;">

		<p>The exported data may be sorted by up to five fields, in order.
		Each stage of sorting can be set to sort ascending or descending.</p>

		<? $c1 = 1; while ($c1 <= 5) { ?>

			<table border="0" width="100%" class="tablegrid" cellpadding="3" cellspacing="0">

				<tr>
					<td class="lgtpink" nowrap><? if ($c1 == 1) { ?>Sort by<? } else { ?>then by<? } ?></td>
					<td class="small-grey" nowrap align="right">
						<input type="radio" name="sortdir<?= $c1; ?>" value="asc" checked id="sda<?= $c1; ?>">
						<label for="sda<?= $c1; ?>">ascending</label>
						<input type="radio" name="sortdir<?= $c1; ?>" value="desc" id="sdd<?= $c1; ?>">
						<label for="sdd<?= $c1; ?>">descending</label>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<select name="sortfield<?= $c1; ?>" style="width: 100%;">
							<? if ($c1 > 1) { ?><option value="do_not_sort">(none)</option><? } ?>
							<? foreach ($fields as $field) { ?><option value="<?= $field; ?>"><?= $config["dtml_fieldinfo"][$db][$table][$field][0]; ?></option><? } ?>
						</select>
					</td>
				</tr>

			</table>

		<? $c1++; } ?>

	</div>

	<? TabFooter(); ?>

	</td><td width="65%" align="left" valign="top">

	<p class="activetab">Search criteria</p>

	<? DTMLSearchForm($params["search"]); ?>

	</tr></td></table>

	<?

	return true;

}


function DTMLExport($subdata) {

	# processes a form generated by DTMLExportForm(). Pass $_POST to
	# $subdata. Results are rendered by DTMLRecordSummary in CSV mode.
	# Calling script must ensure correct headers are sent to browser.

	# create ordering string
	$orders = array(); $c1 = 1; while ($c1 <= 5) {
		if ($subdata["sortfield".$c1] != "do_not_sort") {
			$order = $subdata["sortfield".$c1]." ".strtoupper($subdata["sortdir".$c1]);
			array_push($orders,$order);
		}
	$c1++; }

	# parameters for record summary
	$params["summary"] = array(
		"type"		=> "csv",
		"fields"	=> implode(",",$subdata["fieldlist"]),
		"maxperpage"	=> "unlimited",
		"orderspecial"	=> implode(",",$orders),
	);

	# call logic search engine
	DTMLLogicSearchResults($subdata["exporttable"],$subdata["exportdb"],$subdata,$params["summary"]);

	return true;

}

?>
