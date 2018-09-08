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
function CheckFile($FileName) {
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name==$FileName||$File3Name=="/".$FileName) {
	require('index.html');
	exit(); }
return null;
}
function CheckFiles($FileName) {
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name==$FileName||$File3Name=="/".$FileName) {
	return true; }
}
CheckFile("Kernel.php");
require('Zlib.php');
function ConnectMysql($sqlhost,$sqluser,$sqlpass,$sqldb) {
$StatSQL = mysqli_connect($sqlhost,$sqluser,$sqlpass,null,'MYSQL_CLIENT_COMPRESS');
$StatBase = @mysqli_select_db($sqldb);
}
function GMTimeChange($format,$timestamp,$offset)
{
$Time[Hour] = date("G",$timestamp);
$Time[Minute] = date("i",$timestamp);
$Time[Second] = date("s",$timestamp);
$Time[Month] = date("n",$timestamp);
$Time[Day] = date("j",$timestamp);
$Time[Year] = date("Y",$timestamp);
return gmdate($format,mktime($Time[Hour]+$offset,$Time[Minute],$Time[Second],$Time[Month],$Time[Day],$Time[Year]));
}
function TimeChange($format,$timestamp,$offset)
{
$Time[Hour] = date("G",$timestamp);
$Time[Minute] = date("i",$timestamp);
$Time[Second] = date("s",$timestamp);
$Time[Month] = date("n",$timestamp);
$Time[Day] = date("j",$timestamp);
$Time[Year] = date("Y",$timestamp);
return date($format,mktime($Time[Hour]+$offset,$Time[Minute],$Time[Second],$Time[Month],$Time[Day],$Time[Year]));
}
function GMTimeSend($none)
{
return gmdate(mktime(date('H'),date('i'),date('s'),date('n'),date('j'),date('Y')));
}
function GMTimeGet($format,$offset)
{
$TimeFix	 = $FixMinute;
return gmdate($format,mktime(date('H')+$offset,date('i')-1,date('s'),date('n'),date('j'),date('Y')));
}
function SeverOffSet($Cool)
{
$TestHour1 = date("H")+1;
$TestHour2 = gmdate("H")+1;
$TestHour3 = $TestHour1-$TestHour2;
$TestHour4 = $TestHour3;
return $TestHour4;
}
function Time_UnixStamp($time) {
/*	//strtotime('2005-08-25 12:04:53');
//strtotime('October 30, 2005, 2:17 am');	*/
return strtotime($time);
}
function GMTime_UnixStamp($time) {
/*	//strtotime('2005-08-25 12:04:53');
//strtotime('October 30, 2005, 2:17 am');	*/
return strtotime($time);
}
function parsedate($value)
{
// If it looks like a UK date dd/mm/yy, reformat to US date mm/dd/yy so strtotime can parse it.
$reformatted = preg_replace("/^\s*([0-9]{1,2})[\/\. -]+([0-9]{1,2})[\/\. -]+([0-9]{1,4})/", "\\2/\\1/\\3", $value);
return strtotime($reformatted);
}
function CountPosts($idc,$idf,$sqlt) {
$safesql = new SafeSQL_MySQL;
$cpquery = $safesql->query("select * from ".$sqlt."Posts where CategoryID=%s and ForumID=%s", array($idc,$idf));
unset($safesql);
$cpresult=mysqli_query($cpquery);
$cpnum=mysqli_num_rows($cpresult);
return $cpnum;
}
function CountReplys($idc,$idf,$idt,$sqlt) {
$safesql = new SafeSQL_MySQL;
$crquery = $safesql->query("select * from ".$sqlt."Posts where CategoryID=%s and ForumID=%s and TopicID=%s", array($idc,$idf,$idt));
unset($safesql);
$crresult=mysqli_query($crquery);
$crnum=mysqli_num_rows($crresult);
return $crnum;
}
function GetUserName($idu,$sqlt) {
$safesql = new SafeSQL_MySQL;
$gunquery = $safesql->query("select * from ".$sqlt."Members where id=%s", array($idu));
unset($safesql);
$gunresult=mysqli_query($gunquery);
$gunnum=mysqli_num_rows($gunresult);
if($gunnum>0){
$UsersName=mysqli_result($gunresult,$gunnum-1,"Name"); }
return $UsersName;
}
function CountTopics($idc,$idf,$sqlt) {
$safesql = new SafeSQL_MySQL;
$ctquery = $safesql->query("select * from ".$sqlt."Topics where CategoryID=%s and ForumID=%s", array($idc,$idf));
unset($safesql);
$ctresult=mysqli_query($ctquery);
$ctnum=mysqli_num_rows($ctresult);
return $ctnum;
}
function PassHash2x($Text)
{
$Text = md5($Text);
$Text = sha1($Text);
return $Text;
}
function GetQueryStr($Text)
{
$OldBoardQuery = preg_replace("/&/isxS", "&amp;", $_SERVER['QUERY_STRING']);
$BoardQuery = "?".$OldBoardQuery;
return $BoardQuery;
}
function dump_included_files($type)
{
	return var_dump(get_included_files());
}
function count_included_files($type)
{
	return count(get_included_files());
}
function dump_extensions($type)
{
	return var_dump(get_loaded_extensions());
}
function count_extensions($type)
{
	return count(get_loaded_extensions());
}
?>