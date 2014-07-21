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
if ($File3Name=="login.php"||$File3Name=="/login.php") {
	require('index.html');
	exit(); }
if($_GET['act']=="logout") {
session_unregister(MemberName);
session_unregister(UserID);
session_unregister(UserTimeZone);
session_unregister(UserGroup);
session_destroy();
session_unset();
setcookie("MemberName", null, mktime() - 3600);
setcookie("UserID", null, mktime() - 3600);
setcookie("SessPass", null, mktime() - 3600);
$_SESSION['UserGroup']=null;
$_SESSION['MemberName']=null;
$_SESSION['UserID']=0;
$_SESSION['UserTimeZone']=0;
session_destroy();
setcookie(session_name(), '', mktime() - 3600);
//session_regenerate_id();
//$_GET['act']="login";
header("Location: Members.php?act=login");
}
if($_GET['act']=="login")
{
?>
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span class="textright"><a href="#Toggle" onclick="<?php echo $toggle; ?>"><?php echo $SkinSet['Toggle']; ?></a><?php echo $SkinSet['ToggleExt']; ?></span>
<?php echo $SkinSet['TitleIcon'] ?><a href="Members.php?act=login">Log in</a></td>
</tr>
<tr class="TableRow2">
<th class="TableRow2" style="width: 100%; text-align: left;">&nbsp;Inert your login info: </th>
</tr>
<tr class="TableRow3">
<td class="TableRow3">
<form method="post" action="?act=login_now">
<table style="text-align: left;">
<tr style="text-align: left;">
	<td style="width: 30%;"><label for="username">Enter UserName: </label></td>
	<td style="width: 70%;"><input class="TextBox" id="username" type="text" name="username" /></td>
</tr><tr>
	<td style="width: 30%;"><label for="userpass">Enter Password: </label></td>
	<td style="width: 70%;"><input class="TextBox" id="userpass" type="password" name="userpass" /></td>
</tr><tr>
	<td style="width: 30%;"><label title="Store userinfo as a cookie so you dont need to login again." for="storecookie">Store as cookie?</label></td>
	<td style="width: 70%;"><select id="storecookie" name="storecookie" class="TextBox">
<option value="true">Yes</option>
<option value="false">No</option>
</select></td>
</tr></table>
<table style="text-align: left;">
<tr style="text-align: left;">
<td style="width: 100%;">
<input type="hidden" name="act" value="loginmember" style="display: none;" />
<input class="Button" type="submit" value="Log in" />
</td></tr></table>
</form>
</td>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">&nbsp;</td>
</tr>
<?php } if($_POST['act']=="loginmember"){
$safesql =& new SafeSQL_MySQL;
$YourName = stripcslashes(htmlentities($_POST['username'], ENT_QUOTES));
$YourName = preg_replace("/\&amp;#(.*?);/is", "&#$1;", $YourName);
$YourPasswordMD5 = md5($_POST['userpass']);
$YourPassword = sha1($YourPasswordMD5);
$querylog = $safesql->query("select * from ".$Settings['sqltable']."Members where Name = '%s' and Password='%s'", array($YourName,$YourPassword));
$resultlog=mysql_query($querylog);
$numlog=mysql_num_rows($resultlog);
if($numlog>=1) {
$i=0;
$YourIDM=mysql_result($resultlog,$i,"id");
$YourNameM=mysql_result($resultlog,$i,"Name");
$YourPassM=mysql_result($resultlog,$i,"Password");
$YourGroupM=mysql_result($resultlog,$i,"Group");
$YourTimeZoneM=mysql_result($resultlog,$i,"TimeZone");
$NewDay=GMTimeSend(null);
$NewIP=$_SERVER['REMOTE_ADDR'];
$queryup = $safesql->query("update ".$Settings['sqltable']."Members set LastActive=%s,IP='%s' WHERE id=%s", array($NewDay,$NewIP,$YourIDM));
mysql_query($queryup);
session_destroy();
setcookie(session_name(), '', mktime() - 3600);
//session_regenerate_id();
$_SESSION['MemberName']=$YourNameM;
$_SESSION['UserID']=$YourIDM;
$_SESSION['UserTimeZone']=$YourTimeZoneM;
$_SESSION['UserGroup']=$YourGroupM;
if($_POST['storecookie']==true) {
setcookie("MemberName", $YourNameM, time() + (7 * 86400));
setcookie("UserID", $YourIDM, time() + (7 * 86400));
setcookie("SessPass", $YourPassM, time() + (7 * 86400)); }
} if($numlog<=0) {
//echo "Password was not right or user not found!! <_< ";
} ?>
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span class="textright"><a href="#Toggle" onclick="<?php echo $toggle; ?>"><?php echo $SkinSet['Toggle']; ?></a>&nbsp;</span>
&nbsp;<a href="Members.php?act=login">Log in</a></td>
</tr>
<tr class="TableRow2">
<th class="TableRow2" style="width: 100%; text-align: left;">&nbsp;Login Message: </th>
</tr>
<tr class="TableRow3">
<td class="TableRow3">
<table style="width: 100%; height: 25%; text-align: center;">
<?php if($numlog>=1) { ?>
<tr>
	<td><br />Welcome to the Board <?php echo $_SESSION['MemberName']; ?>. ^_^<br />
	Click <a href="index.php?act=View">here</a> to continue to board.<br />&nbsp;</td>
</tr>
<?php } if($numlog<=0) { ?>
<tr>
	<td><br />Password was not right or user not found!! &lt;_&lt;<br />
	Click <a href="Members.php?act=login">here</a> to try again.<br />&nbsp;</td>
</tr>
<?php } ?>
</table>
</tr>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">&nbsp;</td>
</tr>
<?php } ?>