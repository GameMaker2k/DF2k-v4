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
if ($File3Name=="register.php"||$File3Name=="/register.php") {
	require('index.html');
	exit(); }
if($_GET['act']=="signup")
{ ?>
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span class="textright"><a href="#Toggle" onclick="<?php echo $toggle; ?>"><?php echo $SkinSet['Toggle']; ?></a><?php echo $SkinSet['ToggleExt']; ?></span>
<?php echo $SkinSet['TitleIcon'] ?><a href="Members.php?act=signup">Register</a></td>
</tr>
<tr class="TableRow2">
<th class="TableRow2" style="width: 100%; text-align: left;">&nbsp;Inert your user info: </th>
</tr>
<tr class="TableRow3">
<td class="TableRow3">
<form method="post" action="?act=makemember">
<table style="text-align: left;">
<tr style="text-align: left;">
	<td style="width: 30%;"><label for="Name">Insert a UserName:</label></td>
	<td style="width: 70%;"><input type="text" class="TextBox" name="Name" size="20" id="Name" /></td>
</tr><tr>
	<td><label for="Password">Insert a Password:</label></td>
	<td><input type="password" class="TextBox" name="Password" size="20" id="Password" /></td>
</tr><tr>
	<td><label for="Email">Insert Your Email:</label></td>
	<td><input type="text" class="TextBox" name="Email" size="20" id="Email" /></td>
</tr><tr>
	<td><label for="YourOffSet">Your TimeZone:</label></td>
	<td><select id="YourOffSet" name="YourOffSet" class="TextBox">
<option value="-12">GMT - 12:00 hours</option>
<option value="-11">GMT - 11:00 hours</option>
<option value="-10">GMT - 10:00 hours</option>
<option value="-9">GMT - 9:00 hours</option>
<option value="-8">GMT - 8:00 hours</option>
<option value="-7">GMT - 7:00 hours</option>
<option value="-6">GMT - 6:00 hours</option>
<option value="-5">GMT - 5:00 hours</option>
<option value="-4">GMT - 4:00 hours</option>
<option value="-3">GMT - 3:00 hours</option>
<option value="-2">GMT - 2:00 hours</option>
<option value="-1">GMT - 1:00 hours</option>
<option selected="selected" value="0">GMT +/- 0:00 hours</option>
<option value="1">GMT + 1:00 hours</option>
<option value="2">GMT + 2:00 hours</option>
<option value="3">GMT + 3:00 hours</option>
<option value="4">GMT + 4:00 hours</option>
<option value="5">GMT + 5:00 hours</option>
<option value="6">GMT + 6:00 hours</option>
<option value="7">GMT + 7:00 hours</option>
<option value="8">GMT + 8:00 hours</option>
<option value="9">GMT + 9:00 hours</option>
<option value="10">GMT + 10:00 hours</option>
<option value="11">GMT + 11:00 hours</option>
<option value="12">GMT + 12:00 hours</option>
</select></td>
</tr><tr>
	<td><label for="Website">Insert your Website:</label></td>
	<td><input type="text" class="TextBox" name="Website" size="20" value="http://" id="Website" /></td>
</tr><tr>
	<td><label for="Avatar">Insert a URL for Avatar:</label></td>
	<td><input type="text" class="TextBox" name="Avatar" size="20" value="http://" id="Avatar" /></td>
</tr><tr>
	<td style="width: 30%;"><label title="Store userinfo as a cookie so you dont need to login again." for="storecookie">Store as cookie?</label></td>
	<td style="width: 70%;"><select id="storecookie" name="storecookie" class="TextBox">
<option value="true">Yes</option>
<option value="false">No</option>
</select></td>
</tr>
</table>
<table style="text-align: left;">
<tr style="text-align: left;">
<td style="width: 100%;"><input type="hidden" class="HiddenTextBox" style="display: none;" name="id" value="26" />
<input type="hidden" class="HiddenTextBox" style="display: none;" name="Group" value="Member" />
<input type="hidden" class="HiddenTextBox" style="display: none;" name="Interests" value="" />
<input type="hidden" class="HiddenTextBox" style="display: none;" name="Title" value="" />
<input type="hidden" class="HiddenTextBox" style="display: none;" name="Joined" value="<?php echo GMTimeSend(null); ?>" />
<input type="hidden" class="HiddenTextBox" style="display: none;" name="LastActive" value="<?php echo GMTimeSend(null); ?>" />
<input type="hidden" class="HiddenTextBox" style="display: none;" name="PostCount" value="0" />
<input type="hidden" class="HiddenTextBox" style="display: none;" name="Signature" value="" />
<input type="hidden" class="HiddenTextBox" style="display: none;" name="UserIP" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
<label for="TOSBox">TOS - Please read fully and check 'I agree' box ONLY if you agree to terms</label><br />
<textarea rows="8" id="TOSBox" name="TOSBox" class="TextBox" cols="50" readonly="readonly" accesskey="T">Please remember that we are not responsible for any messages posted. We do not vouch for or warrant the accuracy, completeness or usefulness of any message, and are not responsible for the contents of any message. The messages express the views of the author of the message, not necessarily the views of this BB. Any user who feels that a posted message is objectionable is encouraged to contact us immediately by email. We have the ability to remove objectionable messages and we will make every effort to do so, within a reasonable time frame, if we determine that removal is necessary. You agree, through your use of this service, that you will not use this BB to post any material which is knowingly false and/or defamatory, inaccurate, abusive, vulgar, hateful, harassing, obscene, profane, sexually oriented, threatening, invasive of a person's privacy, or otherwise violative of any law. You agree not to post any copyrighted material unless the copyright is owned by you or by this BB.</textarea>
<input type="checkbox" class="TextBox" name="TOS" value="Agree" id="TOS" /><label for="TOS">I Agree</label><br/>
<input type="hidden" class="HiddenTextBox" style="display: none;" name="act" value="makemembers" />
<input type="submit" class="Button" value="Sign UP" />
</td></tr></table>
</form>
</td>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">&nbsp;</td>
</tr>
<?php } if($_GET['act']=="makemember") {
	if($_POST['act']=="makemembers") {
?>
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span class="textright"><a href="#Toggle" onclick="<?php echo $toggle; ?>"><?php echo $SkinSet['Toggle']; ?></a>&nbsp;</span>
&nbsp;<a href="Members.php?act=signup">Register</a></td>
</tr>
<tr class="TableRow2">
<th class="TableRow2" style="width: 100%; text-align: left;">&nbsp;Signup Message: </th>
</tr>
<tr class="TableRow3">
<td class="TableRow3">
<table style="width: 100%; height: 25%; text-align: center;">
<?php
$Name = stripcslashes(htmlentities($_POST['Name'], ENT_QUOTES));
$Name = preg_replace("/\&amp;#(.*?);/is", "&#$1;", $Name);
$sql_email_check = mysqli_query("SELECT Email FROM ".$Settings['sqltable']."Members WHERE Email='".$Email."'"); 
$sql_username_check = mysqli_query("SELECT Name FROM ".$Settings['sqltable']."Members WHERE Name='".$Name."'");
$email_check = mysqli_num_rows($sql_email_check); 
$username_check = mysqli_num_rows($sql_username_check);
if ($_POST['TOS']!="Agree") { $Error="Yes";  ?>
<tr>
	<td><br />You need to  agree to the tos.<br /></td>
</tr>
<?php } if ($_POST['Name']==null) { $Error="Yes"; ?>
<tr>
	<td><br />You need to enter a name.<br /></td>
</tr>
<?php } if ($_POST['Name']=="ShowMe") { $Error="Yes"; ?>
<tr>
	<td><br />You need to enter a name.<br /></td>
</tr>
<?php } if ($_POST['Password']==null) { $Error="Yes"; ?>
<tr>
	<td><br />You need to enter a password.<br /></td>
</tr>
<?php } if ($_POST['Email']==null) { $Error="Yes"; ?>
<tr>
	<td><br />You need to enter a email.<br /></td>
</tr>
<?php } if($email_check > 0) { $Error="Yes"; ?>
<tr>
	<td><br />Email address is already used.<br /></td>
</tr>
<?php } if($username_check > 0) { $Error="Yes"; ?>
<tr>
	<td><br />UserName is already used.<br /></td>
</tr>
<?php } if ($Error!="Yes") {
$NewPasswordMD5 = md5($_POST['Password']);
$NewPassword = sha1($NewPasswordMD5);
$_GET['YourPost'] = $_POST['Signature'];
//require( './misc/HTMLTags.php');
$Signature = preg_replace("/\&amp;#(.*?);/is", "&#$1;", $Signature);
$NewSignature = $_GET['YourPost'];
$Password = stripcslashes(htmlentities($Password, ENT_QUOTES));
$Password = preg_replace("/\&amp;#(.*?);/is", "&#$1;", $Password);
$Avatar = stripcslashes(htmlentities($_POST['Avatar'], ENT_QUOTES));
$Website = stripcslashes(htmlentities($_POST['Website'], ENT_QUOTES));
$query = $safesql->query("insert into ".$Settings['sqltable']."Members values (null,'%s','%s','%s','%s','0','%s','%s','%s','%s','%s','%s','100x100','%s','%s','%s','%s')", array($Name,$NewPassword,$Email,$_POST['Group'],$_POST['Interests'],$_POST['Title'],$_POST['Joined'],$_POST['LastActive'],$NewSignature,$Avatar,$Website,$_POST['PostCount'],$_POST['YourOffSet'],$_POST['UserIP']));
mysqli_query($query);
$querylogr = $safesql->query("select * from ".$Settings['sqltable']."Members where Name='%s' AND Password='%s'", array($Name,$NewPassword));
$resultlogr=mysqli_query($querylogr);
$numlogr=mysqli_num_rows($resultlogr);
if($numlogr>=1) {
$ir=0;
$YourIDMr=mysqli_result($resultlogr,$ir,"id");
$YourNameMr=mysqli_result($resultlogr,$ir,"Name");
$YourGroupMr=mysqli_result($resultlogr,$ir,"Group");
$YourTimeZoneMr=mysqli_result($resultlogr,$ir,"TimeZone"); }
session_destroy();
setcookie(session_name(), '', mktime() - 3600);
//session_regenerate_id();
$_SESSION['MemberName']=$YourNameMr;
$_SESSION['UserID']=$YourIDMr;
$_SESSION['UserTimeZone']=$YourTimeZoneMr;
$_SESSION['UserGroup']=$YourGroupMr;
if($_POST['storecookie']==true) {
setcookie("MemberName", $YourNameM, time() + (7 * 86400));
setcookie("UserID", $YourIDM, time() + (7 * 86400));
setcookie("SessPass", $YourPassM, time() + (7 * 86400)); }
$SendPMtoID=$row[0];
$YourPMID = 1;
$PMTitle = "Welcome ".$Name.".";
$YourMessage = "Hello ".$Name.". Welcome to ".$Settings['board_name'].". I hope you have fun here. ^_^ ";
$_POST['YourDate'] = $_POST['Joined'];
$query = $safesql->query("insert into ".$Settings['sqltable']."Messenger values (null,%s,%s,'%s','%s',%s,0)", array($YourPMID,$SendPMtoID,$PMTitle,$YourMessage,$_POST['YourDate']));
mysqli_query($query);
?>
<tr>
	<td><br />Welcome to the Board <?php echo $_SESSION['MemberName']; ?>. ^_^<br />
	Click <a href="index.php?act=View">here</a> to continue to board.<br />&nbsp;</td>
</tr>
<?php } ?>
</table>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">&nbsp;</td>
</tr>
<?php } } ?>