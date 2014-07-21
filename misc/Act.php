<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="Act.php"||$File3Name=="/Act.php") {
	require('index.html');
	exit(); }
/* 
$_GET_Test is same as $_GET['Test'];
*/ 
import_request_variables("g", "_GET_");
/* 
$_POST_Test is same as $_POST['Test'];
*/ 
import_request_variables("p", "_POST_");
/* 
$_COOKIE_Test is same as $_COOKIE['Test'];
*/ 
import_request_variables("c", "_COOKIE_");
/* 
$_GET2_Test will get both $_POST['Test'] and $_GET['Test'] but will use $_GET['Test'] If they both have a Value.
*/
import_request_variables("pg", "_GET2_");
/* 
$_POST2_Test will get both $_POST['Test'] and $_GET['Test'] but will use $_POST['Test'] If they both have a Value.
*/
import_request_variables("gp", "_POST2_");
/*$_SESSION['DF2kVer']="v3.3.T<!-- Renee Sabonis -->";
$_SESSION['DF2kPreVer']="&nbsp;Beta 4";*/
if ($_GET['act']==null&&$_GET['action']!=null) { $_GET['act']=$_GET['action']; }
if ($_GET['act']==null&&$_GET['function']!=null) { $_GET['act']=$_GET['function']; }
if ($_GET['act']==null&&$_GET['mode']!=null) { $_GET['act']=$_GET['mode']; }
if ($_GET['act']==null&&$_GET['show']!=null) { $_GET['act']=$_GET['show']; }
if ($_GET['act']==null&&$_GET['do']!=null) { $_GET['act']=$_GET['do']; }
if ($_GET['act']=="idx") {
	$_GET['act']="View"; }
$CD2k = "Cool Dude 2k"; $GM2k = "Game Maker 2k";
$DF2k = "Discussion Forums 2k"; $TB2k = "Tag Boards 2k";
$DF2kURL1 = "<a href=\"http://df2k.berlios.de/DF2k/index.php?act=View\">"; $DF2kURL2 = $DF2kURL1.$DF2k."</a>";
$TB2kURL1 = "<a href=\"http://df2k.berlios.de/DF2k/TagBoard.php?act=View\">"; $TB2kURL2 = $TB2kURL1.$TB2k."</a>";
$PHPQA = "PHP-Quick-Arcade";
$VER1 = "4.0.0"; $VER2 = "Pre-Alpha 5"; $VER3 = "PA 5"; 
$DF2kV1 = $DF2kURL2." v. ".$VER1; $DF2kV2 = $DF2kURL2." v. ".$VER1." ".$VER2;
$DF2kV3 = $DF2kURL2." v. ".$VER1." ".$VER3;
$TB2kV1 = $TB2kURL2." v. ".$VER1; $TB2kV2 = $TB2kURL2." v. ".$VER1." ".$VER2;
$TB2kV3 = $TB2kURL2." v. ".$VER1." ".$VER3;
$PHPV1 = phpversion(); $PHPV2 = "PHP ".$PHPV1; $OSType = PHP_OS;
if($OSType=="WINNT") { $OSType="Windows"; } $OSType2 = $OSType." / ".$PHPV2;
$ZENDV1 = zend_version(); $ZENDV2 = "Zend engine ".$ZENDV1;
header("X-Powered-By-Ver: DF2k ".$VER1." ".$VER3);
if ($_GET['act']=="DeleteSession"||$_SERVER["QUERY_STRING"]=="DeleteSession") {
	session_destroy(); }
if ($_GET['act']=="ResetSession"||$_SERVER["QUERY_STRING"]=="ResetSession") {
	session_unset(); }
if ($_GET['act']=="NewSessionID"||$_SERVER["QUERY_STRING"]=="NewSessionID") {
	session_regenerate_id(); }
if ($_GET['act']=="PHPInfo"||$_SERVER["QUERY_STRING"]=="PHPInfo") {
	phpinfo();
	exit(); }
if ($_GET['act']=="phpinfo"||$_SERVER["QUERY_STRING"]=="phpinfo") {
	phpinfo();
	exit(); }
if ($_GET['act']=="PHPCredits"||$_SERVER["QUERY_STRING"]=="PHPCredits") {
	phpcredits();
	exit(); }
if ($_GET['act']=="phpcredits"||$_SERVER["QUERY_STRING"]=="phpcredits") {
	phpcredits();
	exit(); }
if ($_GET['act']=="GM2kSite"||$_SERVER["QUERY_STRING"]=="GM2kSite") {
	header('Location: http://developer.berlios.de/projects/df2k/'); }
if ($_GET['act']=="GM2kBoard"||$_SERVER["QUERY_STRING"]=="GM2kBoard") {
	header('Location: http://df2k.berlios.de/DF2k/index.php?act=View'); }
if ($_GET['act']=="GM2kTagBoard"||$_SERVER["QUERY_STRING"]=="GM2kTagBoard") {
	header('Location: http://df2k.berlios.de/DF2k/TagBoard.php?act=View'); }
if ($_GET['act']=="SQLServer"||$_SERVER["QUERY_STRING"]=="SQLServer") {
	$Settings['sqlhost'];
	$SQLURL=$Settings['sqlhost'][0].$Settings['sqlhost'][1].$Settings['sqlhost'][2].$Settings['sqlhost'][3];
	$SQLURL = preg_replace("/http/isxS", "http", $SQLURL);
	$SQLGoto = $Settings['sqlhost'];
	if ($SQLURL!="http") { $SQLGoto="http://".$Settings['sqlhost']; }
	header('Location: '.$SQLGoto); }
if ($_GET['Validate']=="HTML"||$_GET['validate']=="HTML") {
	$NEW["REQUEST_URI"] = preg_replace("/\?Validate\=HTML/isxS", "?DF2k=".$VER1." ".$VER3, $_SERVER["REQUEST_URI"]);
	$NEW["REQUEST_URI"] = preg_replace("/\&Validate\=HTML/isxS", "", $NEW["REQUEST_URI"]);
	header('Location: http://validator.w3.org/check?verbose=1&uri='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"])); }
if ($_GET['Validate']=="HTML2"||$_GET['validate']=="HTML2") {
	$NEW["REQUEST_URI"] = preg_replace("/\?Validate\=HTML2/isxS", "?DF2k=".$VER1." ".$VER3, $_SERVER["REQUEST_URI"]);
	$NEW["REQUEST_URI"] = preg_replace("/\&Validate\=HTML2/isxS", "", $NEW["REQUEST_URI"]);
	header('Location: http://www.htmlhelp.com/cgi-bin/validate.cgi?warnings=yes&url='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"])); }
if ($_GET['Validate']=="MutiHTML"||$_GET['validate']=="MutiHTML") {
	$NEW["REQUEST_URI"] = preg_replace("/\?Validate\=MutiHTML/isxS", "?DF2k=".$VER1." ".$VER3, $_SERVER["REQUEST_URI"]);
	$NEW["REQUEST_URI"] = preg_replace("/\&Validate\=MutiHTML/isxS", "", $NEW["REQUEST_URI"]);
	header('Location: http://www.htmlhelp.com/cgi-bin/validate.cgi?warnings=yes&spider=yes&url='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"])); }
if ($_GET['Validate']=="Links"||$_GET['validate']=="Links") {
	$NEW["REQUEST_URI"] = preg_replace("/\?Validate\=Links/isxS", "?DF2k=".$VER1." ".$VER3, $_SERVER["REQUEST_URI"]);
	$NEW["REQUEST_URI"] = preg_replace("/\&Validate\=Links/isxS", "", $NEW["REQUEST_URI"]);
	header('Location: http://validator.w3.org/checklink?check=Check&hide_type=all&summary=on&uri='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"])); }
if ($_GET['Validate']=="CSS"||$_GET['validate']=="CSS") {
	$NEW["REQUEST_URI"] = preg_replace("/\?Validate\=CSS/isxS", "?DF2k=".$VER1." ".$VER3, $_SERVER["REQUEST_URI"]);
	$NEW["REQUEST_URI"] = preg_replace("/\&Validate\=CSS/isxS", "", $NEW["REQUEST_URI"]);
	header('Location: http://jigsaw.w3.org/css-validator/validator?profile=css2&warning=2&uri='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"])); }
if ($_GET['Validate']=="WAI"||$_GET['validate']=="WAI") {
	$NEW["REQUEST_URI"] = preg_replace("/\?Validate\=WAI/isxS", "?DF2k=".$VER1." ".$VER3, $_SERVER["REQUEST_URI"]);
	$NEW["REQUEST_URI"] = preg_replace("/\&Validate\=WAI/isxS", "", $NEW["REQUEST_URI"]);
	header('Location: http://www.contentquality.com/mynewtester/cynthia.exe?rptmode=2&url1='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"])); }
if ($_GET['Validate']=="Section508"||$_GET['validate']=="Section508") {
	$NEW["REQUEST_URI"] = preg_replace("/\?Validate\=Section508/isxS", "?DF2k=".$VER1." ".$VER3, $_SERVER["REQUEST_URI"]);
	$NEW["REQUEST_URI"] = preg_replace("/\&Validate\=Section508/isxS", "", $NEW["REQUEST_URI"]);
	header('Location: http://www.contentquality.com/mynewtester/cynthia.exe?rptmode=-1&url1='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"])); }
if ($_GET['Validate']=="SpeedReport"||$_GET['validate']=="SpeedReport") {
	$NEW["REQUEST_URI"] = preg_replace("/\?Validate\=SpeedReport/isxS", "?DF2k=".$VER1." ".$VER3, $_SERVER["REQUEST_URI"]);
	$NEW["REQUEST_URI"] = preg_replace("/\&Validate\=SpeedReport/isxS", "", $NEW["REQUEST_URI"]);
	header('Location: http://www.websiteoptimization.com/cgi-bin/wso/wso.pl?url='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"])); }
if ($_GET['Validate']=="META"||$_GET['validate']=="META") {
	$NEW["REQUEST_URI"] = preg_replace("/\?Validate\=META/isxS", "?DF2k=".$VER1." ".$VER3, $_SERVER["REQUEST_URI"]);
	$NEW["REQUEST_URI"] = preg_replace("/\&Validate\=META/isxS", "", $NEW["REQUEST_URI"]);
	header('Location: http://www.scrubtheweb.com/cgi-bin/webtools/meta-check.cgi?URL='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"])); }
if ($_GET['Validate']=="LoadTime"||$_GET['validate']=="LoadTime") {
	$NEW["REQUEST_URI"] = preg_replace("/\?Validate\=LoadTime/isxS", "?DF2k=".$VER1." ".$VER3, $_SERVER["REQUEST_URI"]);
	$NEW["REQUEST_URI"] = preg_replace("/\&Validate\=LoadTime/isxS", "", $NEW["REQUEST_URI"]);
	header('Location: http://www.1-hit.com/all-in-one/php/tool.loading-time-checker.php?url='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"])); }
if ($_GET['act']=="Download") {
	$ThisFile1 = dirname($_SERVER['PHP_SELF'])."/";
	$ThisFile2 = $_SERVER['PHP_SELF'];
	$ThisFile3=str_replace($ThisFile1, null, $ThisFile2);
	$ThisFile3=preg_replace("/.php/isxS", "", $ThisFile3);
	header('Content-Disposition: attachment; filename="'.$ThisFile3.'.html"');
	$_GET['act']="View"; }
if ($_GET['Download']!=null) {
	$ThisFile1 = dirname($_SERVER['PHP_SELF'])."/";
	$ThisFile2 = $_SERVER['PHP_SELF'];
	$ThisFile3=str_replace($ThisFile1, null, $ThisFile2);
	$ThisFile3=preg_replace("/.php/isxS", "", $ThisFile3);
	header('Content-Disposition: attachment; filename="'.$ThisFile3.'.html"'); }
?>