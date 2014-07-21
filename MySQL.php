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
if ($File3Name=="MySQL.php"||$File3Name=="/MySQL.php") {
	require('inc/403.html');
	exit(); }
//error_reporting(E_ERROR);
if($_GET['act']=="gpl"||$_GET['act']=="GPL") {
header('Content-type: text/plain');
require("gpl.txt"); die(); }
function change_title($new_title) {
$output = ob_get_contents();
ob_end_clean();
$output = preg_replace("/<title>(.*?)<\/title>/", "<title>$new_title</title>", $output);
/* Change Some PHP Settings Fix the &PHPSESSID to &amp;PHPSESSID */
$SessName = session_name();
$output = preg_replace("/&PHPSESSID/", "&amp;PHPSESSID", $output);
$output = str_replace("&".$SessName, "&amp;".$SessName, $output);
echo $output;
}
function fix_amp($null) {
$output = ob_get_contents();
ob_end_clean();
/* Change Some PHP Settings Fix the &PHPSESSID to &amp;PHPSESSID */
$SessName = session_name();
$output = preg_replace("/&PHPSESSID/", "&amp;PHPSESSID", $output);
$output = str_replace("&".$SessName, "&amp;".$SessName, $output);
echo $output;
}
if($Settings['use_gzip']!=true) { ob_start(); }
if($Settings['use_gzip']==true) { ob_start("ob_gzhandler"); }
session_name("DFID");
session_start();
header("Cache-control: private"); // IE 6 Fix
require('inc/safesql/SafeSQL.class.php');
require('Settings.php');
/* if($Settings['use_iniset']==true) {
Change Some PHP Settings Fix the & to &amp;
ini_set("arg_separator.output","&amp;"); } */
header('Content-type: text/html');
require('misc/Kernel.php');
require('misc/Act.php');
if(CheckFiles("install.php")!=true) {
	if($Settings['sqldb']==null) {
		header("Location: install.php"); }
ConnectMysql($Settings['sqlhost'],$Settings['sqluser'],$Settings['sqlpass'],$Settings['sqldb']); }
if($_SESSION['CheckCookie']!="done") {
if($_COOKIE['SessPass']!=null&&
$_COOKIE['MemberName']!=null) {
require('inc/prelogin.php');
} }
$safesql =& new SafeSQL_MySQL;
//Time Zone Set
if($_SESSION['UserTimeZone']!=null) {
$YourOffSet = $_SESSION['UserTimeZone']; }
if($_SESSION['UserTimeZone']==null) {
$YourOffSet = SeverOffSet(null); }
// Skin Stuff
if($_GET['Skin']!=null) {
$_GET['Skin']=preg_replace("/(.*?).\/(.*?)/", "DF2k", $_GET['Skin']);
if($_GET['Skin']=="../"||$_GET['Skin']=="./") {
$_GET['Skin']="DF2k"; $_SESSION['Skin']="DF2k"; }
if (file_exists("skin/".$_GET['Skin']."/Settings.php")) {
$_SESSION['Skin'] = $_GET['Skin'];
/* The file Skin Exists */ }
else { $_GET['Skin']="DF2k"; $_SESSION['Skin']="DF2k";
/* The file Skin Dose Not Exists */ } }
if($_GET['Skin']==null) { 
if($_SESSION['Skin']!=null) {
$_GET['Skin']=$_SESSION['Skin']; }
if($_SESSION['Skin']==null) {
$_SESSION['Skin']="DF2k";
$_GET['Skin']="DF2k"; } }
$PreSkin['skindir1'] = $_SESSION['Skin'];
$PreSkin['skindir2'] = "skin/".$_SESSION['Skin'];
require("skin/".$_GET['Skin']."/Settings.php");
//if(ini_set()) { ini_set("arg_separator", "&amp;"); }
?>