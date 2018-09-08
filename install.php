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
require('Preindex.php'); ?>

<title> <?php echo "Installing ".$DF2k." ".$VER2; ?> </title>
</head>
<body>
<?php 
require('inc/navbar.php');
?>

<ins><br /></ins>
<table class="Table1" width="100%">
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span class="textright">&nbsp;</span>
&nbsp;<a href="Install.php">Install <?php echo $DF2k." ".$VER2." on ".$OSType2; ?> </a></td>
</tr>
<tr class="TableRow2">
<th class="TableRow2" style="width: 100%; text-align: left;">&nbsp;Inert your install info: </th>
</tr>
<?php
if ($_GET['act']!="Install_Board"&&
$_POST['act']!="Install_Board") {
?>
<tr class="TableRow3">
<td class="TableRow3">
<form method="post" action="install.php?act=Install_Board">
<table style="text-align: left;">
<tr style="text-align: left;">
	<td style="width: 30%;"><label for="NewBoardName">Insert Board Name:</label></td>
	<td style="width: 70%;"><input type="text" name="NewBoardName" class="TextBox" id="NewBoardName" size="20" /></td>
</tr><tr>
	<td style="width: 30%;"><label for="DatabaseName">Insert Database Name:</label></td>
	<td style="width: 70%;"><input type="text" name="DatabaseName" class="TextBox" id="DatabaseName" size="20" /></td>
</tr><tr>
	<td style="width: 30%;"><label for="DatabaseUserName">Insert Database User Name:</label></td>
	<td style="width: 70%;"><input type="text" name="DatabaseUserName" class="TextBox" id="DatabaseUserName" size="20" /></td>
</tr><tr>
	<td style="width: 30%;"><label for="DatabasePassword">Insert Database Password:</label></td>
	<td style="width: 70%;"><input type="password" name="DatabasePassword" class="TextBox" id="DatabasePassword" size="20" /></td>
</tr><tr>
	<td style="width: 30%;"><label for="tableprefix">Insert Table Prefix:</label></td>
	<td style="width: 70%;"><input type="text" name="tableprefix" class="TextBox" id="tableprefix" value="DF2k_" size="20" /></td>
</tr><tr>
	<td style="width: 30%;"><label for="DatabaseHost">Insert Database Host:</label></td>
	<td style="width: 70%;"><input type="text" name="DatabaseHost" class="TextBox" id="DatabaseHost" size="20" value="localhost" /></td>
</tr><tr>
	<td style="width: 30%;"><label for="AdminUser">Insert Admin User Name:</label></td>
	<td style="width: 70%;"><input type="text" name="AdminUser" class="TextBox" id="AdminUser" size="20" /></td>
</tr><tr>
	<td style="width: 30%;"><label for="AdminPassword">Insert Admin Password:</label></td>
	<td style="width: 70%;"><input type="password" name="AdminPasswords" class="TextBox" id="AdminPassword" size="20" /></td>
</tr><tr>
	<td style="width: 30%;"><label for="UseGzip">Do you want to GZip Pages</label></td>
	<td style="width: 70%;"><select size="1" class="TextBox" name="GZip" id="UseGzip">
	<option value="false">Yes</option>
	<option value="true">No</option>
	</select></td>
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
<input type="hidden" name="act" value="Install_Board" style="display: none;" />
<input type="submit" class="Button" value="Install Board" name="Install_Board" />
<input type="reset" value="Reset Form" class="Button" name="Reset_Form" />
</td></tr></table>
</form>
</td>
</tr>
<?php }
if ($_GET['act']=="Install_Board"&&
$_POST['act']=="Install_Board") {
?>
<tr class="TableRow3" style="text-align: left;">
<td class="TableRow3" colspan="2">
<?php
$checkfile="Settings.php";
if (!is_writable($checkfile)) {
   exit('Settings is not writable.');
   chmod($checkfile, 0755);
} else {
   // Settings.php is writable install DF2k. ^_^ 
}
$YourDate = GMTimeSend(null);
/* Fix The User Info for DF2k */
$_POST['NewBoardName'] = htmlentities($_POST['NewBoardName'], ENT_QUOTES);
$_POST['NewBoardName'] = preg_replace("/\&amp;#(.*?);/is", "&#$1;", $_POST['NewBoardName']);
//$_POST['AdminPassword'] = stripcslashes(htmlentities($_POST['AdminPassword'], ENT_QUOTES));
//$_POST['AdminPassword'] = preg_replace("/\&amp;#(.*?);/is", "&#$1;", $_POST['AdminPassword']);
$_POST['AdminUser'] = stripcslashes(htmlentities($_POST['AdminUser'], ENT_QUOTES));
$_POST['AdminUser'] = preg_replace("/\&amp;#(.*?);/is", "&#$1;", $_POST['AdminUser']);
/* We are done now with fixing the info. ^_^ */
ConnectMysql($_POST['DatabaseHost'],$_POST['DatabaseUserName'],$_POST['DatabasePassword'],$_POST['DatabaseName']);
$query="CREATE TABLE `".$_POST['tableprefix']."Categorys` ( `ID` bigint(25) NOT NULL auto_increment, `Name` varchar(150) NOT NULL default '', `ShowCategory` varchar(5) NOT NULL default '', `InSubForum` bigint(25) NOT NULL default '0', `Description` text NOT NULL, PRIMARY KEY  (`ID`));";
$result=mysqli_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."Forums` ( `ID` bigint(25) NOT NULL auto_increment, `CategoryID` bigint(25) NOT NULL default '0', `Name` varchar(150) NOT NULL default '', `ShowForum` varchar(5) NOT NULL default '', `ForumType` varchar(15) NOT NULL default '', `InSubForum` bigint(25) NOT NULL default '0', `Description` text NOT NULL, PRIMARY KEY  (`ID`));";
$result=mysqli_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."Help` ( `ID` bigint(25) NOT NULL default '0', `HelpName` text NOT NULL, `HelpText` text NOT NULL);";
$result=mysqli_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."Events` ( `ID` bigint(25) NOT NULL auto_increment, `UserID` bigint(25) NOT NULL default '0', `EventName` varchar(150) NOT NULL default '', `EventText` text NOT NULL, `EventMouth` bigint(5) NOT NULL default '0', `EventMouthEnd` bigint(5) NOT NULL default '0', `EventDay` bigint(5) NOT NULL default '0', `EventDayEnd` bigint(5) NOT NULL default '0', `EventYear` bigint(5) NOT NULL default '0', `EventYearEnd` bigint(5) NOT NULL default '0', PRIMARY KEY  (`ID`));";
$result=mysqli_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."Members` ( `id` bigint(25) NOT NULL auto_increment, `Name` varchar(150) NOT NULL default '', `Password` varchar(150) NOT NULL default '', `Email` varchar(150) NOT NULL default '', `Group` varchar(150) NOT NULL default '', `WarnLevel` bigint(10) NOT NULL default '0', `Interests` varchar(150) NOT NULL default '', `Title` varchar(150) NOT NULL default '', `Joined` bigint(25) NOT NULL default '0', `LastActive` bigint(25) NOT NULL default '0', `Signature` text NOT NULL, `Avatar` varchar(150) NOT NULL default '', `AvatarSize` varchar(10) NOT NULL default '', `Website` varchar(150) NOT NULL default '', `PostCount` bigint(25) NOT NULL default '0', `TimeZone` varchar(5) NOT NULL default '0', `IP` varchar(20) NOT NULL default '', PRIMARY KEY  (`id`));";
$result=mysqli_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."Messenger` ( `id` bigint(25) NOT NULL auto_increment, `SenderID` bigint(25) NOT NULL default '0', `PMSentID` bigint(25) NOT NULL default '0', `MessageTitle` varchar(150) NOT NULL default '', `MessageText` text NOT NULL, `DateSend` bigint(25) NOT NULL default '0', `Read` bigint(5) NOT NULL default '0', PRIMARY KEY  (`id`));";
$result=mysqli_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."Posts` ( `ID` bigint(25) NOT NULL auto_increment, `TopicID` bigint(25) NOT NULL default '0', `ForumID` bigint(25) NOT NULL default '0', `CategoryID` bigint(25) NOT NULL default '0', `UserID` bigint(25) NOT NULL default '0', `GuestName` varchar(150) NOT NULL default '', `TimeStamp` bigint(25) NOT NULL default '0', `Post` text NOT NULL, `IP` varchar(20) NOT NULL default '', PRIMARY KEY  (`ID`));";
$result=mysqli_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."Smiles` ( `ID` bigint(25) NOT NULL auto_increment, `FileName` text NOT NULL, `SmileName` text NOT NULL, `SmileText` text NOT NULL, `Directory` text NOT NULL, `Show` varchar(15) NOT NULL default '', PRIMARY KEY  (`ID`));";
$result=mysqli_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."TagBoard` ( `ID` bigint(25) NOT NULL auto_increment, `UserID` bigint(25) NOT NULL default '0', `GuestName` varchar(150) NOT NULL default '', `Post` text NOT NULL, PRIMARY KEY  (`ID`));";
$result=mysqli_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."Topics` ( `ID` bigint(25) NOT NULL auto_increment, `ForumID` bigint(25) NOT NULL default '0', `CategoryID` bigint(25) NOT NULL default '0', `UserID` bigint(25) NOT NULL default '0', `GuestName` varchar(150) NOT NULL default '', `TimeStamp` bigint(25) NOT NULL default '0', `LastUpdate` bigint(25) NOT NULL default '0', `TopicName` varchar(150) NOT NULL default '', `Pinned` bigint(5) NOT NULL default '0', `Closed` bigint(5) NOT NULL default '0', PRIMARY KEY  (`ID`));";
$result=mysqli_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."Sessions` ( `SessionID` varchar(255) NOT NULL default '', `LastUpdated` datetime NOT NULL default '0000-00-00 00:00:00', `DataValue` text NOT NULL, PRIMARY KEY (`SessionID`));";
$result=mysqli_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."Groups` ( `id` bigint(25) NOT NULL auto_increment, `Name` varchar(150) NOT NULL default '', `Name_prefix` varchar(150) NOT NULL default '', `Name_suffix` varchar(150) NOT NULL default '', `View_board` varchar(5) NOT NULL default '', `Edit_profile` varchar(5) NOT NULL default '', `Can_make_topics` varchar(5) NOT NULL default '', `Can_make_replys` varchar(5) NOT NULL default '', `Can_edit_replys` varchar(5) NOT NULL default '', `Can_delete_replys` varchar(5) NOT NULL default '', `Can_add_events` varchar(5) NOT NULL default '', `Can_pm` varchar(5) NOT NULL default '', `Can_dohtml` varchar(5) NOT NULL default '', `Promote_to` varchar(150) NOT NULL default '', `Promote_posts` bigint(25) NOT NULL default '0', `Has_mod_cp` varchar(5) NOT NULL default '', `Has_admin_cp` varchar(5) NOT NULL default '', PRIMARY KEY  (`id`));";
$result=mysqli_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."Groups (`id`, `Name`, `Name_prefix`, `Name_suffix`, `View_board`, `Edit_profile`, `Can_make_topics`, `Can_make_replys`, `Can_edit_replys`, `Can_delete_replys`, `Can_add_events`, `Can_pm`, `Can_dohtml`, `Promote_to`, `Promote_posts`, `Has_mod_cp`, `Has_admin_cp`) VALUES (1, 'Admin', '', '', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'none', 0, 'yes', 'yes'), (2, 'Moderator', '', '', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'none', 0, 'yes', 'no'), (3, 'Member', '', '', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'none', 0, 'no', 'no'), (4, 'Guest', '', '', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'none', 0, 'no', 'no'), (5, 'Banned', '', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'none', 0, 'no', 'no');"; 
$result = mysqli_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."TagBoard VALUES (1,2,'Cool Dude 2k','Welcome to Your New Tag Board. ^_^')"; 
$result = mysqli_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."Help VALUES (1,'How to Make a Topic', 'To Make a New Topic Click on The Create New Topic Link.')"; 
$result = mysqli_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."Help VALUES (2,'How to Make a Post','To Make a Reply Click on Topic You Want to Rely to and Click on Reply to Topic Link.')";
$result = mysqli_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."Help VALUES (3,'How to Use BBCodes', 'Put [B]Then Your Text Here and[/B] to Close it<br />\r\nHere are other BBCodes You Can Use<br />\r\n[B]Text[/B]<br />\r\n[I]Text[/I]<br />\r\n[U]Text[/U]<br />\r\n[S]Text[/S]<br />\r\n[H1]Text[/H1]<br />\r\n[H6]Text[/H6]<br />\r\n[URL=URL Here]Website Name[/URL]<br />\r\n[EMAIL=Your Email]Yourr Email[/H6]<br />\r\n[CODE]Code Here[/CODE]<br />\r\n[PHP]PHP Code here[/PHP]<br />\r\n[HTML]HTML Code Here[/HTML]<br />\r\n[SQL]SQL Code here[/SQL]<br />\r\n[QUOTE]Your QUOTE here[/QUOTE]<br />\r\n[QUOTE=UserName to QUOTE]Your QUOTE here[/QUOTE]<br />')";
$result = mysqli_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."Categorys VALUES (1,'Main','Yes',0,'The Main Category.')";
$result = mysqli_query($query);
$MyDay = GMTimeGet("d",$YourOffSet);
$MyMonth = GMTimeGet("m",$YourOffSet);
$MyYear = GMTimeGet("Y",$YourOffSet);
$MyYear10 = $MyYear+10;
$query = "INSERT INTO ".$_POST['tableprefix']."Events VALUES (1, 1, 'Opening', 'This is the day the Board was made. ^_^', $MyMonth, $MyMonth, $MyDay, $MyDay, $MyYear, $MyYear10)";
$result = mysqli_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."Forums VALUES (-1,1,'-1 Forum','No','Forum',0,'This is The Forum With a ID of -1.')";
$result = mysqli_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."Forums VALUES (1,1,'Test/Spam','Yes','Forum',0,'A Test Board.')";
$result = mysqli_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."Topics VALUES (1,1,1,2,'Cool Dude 2k',$YourDate,$YourDate,'Welcome',1,1)";
$result = mysqli_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."Posts VALUES (1,1,1,1,2,'Cool Dude 2k',$YourDate,'Welcome to Your Message Board. :) ','127.0.0.1')"; 
$result = mysqli_query($query);
$NewPassword = sha1(md5($_POST['AdminPasswords']));
//$Name = stripcslashes(htmlentities($AdminUser, ENT_QUOTES));
$YourWebsite = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php?act=View";
$UserIP = $_SERVER['REMOTE_ADDR'];
$PostCount = 2;
$Email = "admin@".$_SERVER['HTTP_HOST'];
$AdminTime=SeverOffSet(null);
$query = "INSERT INTO ".$_POST['tableprefix']."Members VALUES (1,'".$_POST['AdminUser']."','".$NewPassword."','".$Email."','Admin',0,'".$Interests."','Admin',".$YourDate.",".$YourDate.",'".$NewSignature."','".$Avatar."','100x100','".$YourWebsite."',0,'".$AdminTime."','".$UserIP."')";
$result = mysqli_query($query);
$GEmail = "Guest@".$_SERVER['HTTP_HOST'];
$query = "INSERT INTO ".$_POST['tableprefix']."Members VALUES (2,'Guest','".sha1(md5('Guest'))."','".$GEmail."','Guest',0,'Guest Account','Guest',".$YourDate.",".$YourDate.",'[B]Test[/B]','http://','100x100','http://".$_SERVER['HTTP_HOST']."',".rand(-50,50).",'".$AdminTime."','127.0.0.1')";
$result = mysqli_query($query);
$MyInterests = "Playing Games, and Makeing Games, walching The Simpsons, Anime and Reading Anime and manga, php, html and Doing Other Cool Things, Making Discussion Forums 2k, and Tag Boards 2k, I love Renee Sabonis, and FireFox or Mozilla.";
$result = mysqli_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."Messenger VALUES (1,2,1,'Test','Thuis is a Test PM. :P ',".$YourDate.",0)";
$result = mysqli_query($query);
$CHMOD = $_SERVER['PHP_SELF'];
$url_this_dir = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php?act=View";
$YourIP = $_SERVER['REMOTE_ADDR'];
$BoardSettings="<?php\n\$Settings['sqlhost'] = '".$_POST['DatabaseHost']."';\n\$Settings['sqldb'] = '".$_POST['DatabaseName']."';\n\$Settings['sqltable'] = '".$_POST['tableprefix']."';\n\$Settings['sqluser'] = '".$_POST['DatabaseUserName']."';\n\$Settings['sqlpass'] = '".$_POST['DatabasePassword']."';\n\$Settings['board_name'] = '".$_POST['NewBoardName']."';\n\$Settings['use_iniset'] = 'false';\n\$Settings['use_gzip'] = ".$_POST['GZip'].";\n\$Settings['max_posts'] = '2';\n?>";
$fp = fopen("./Settings.php","w+");
fwrite($fp, $BoardSettings);
fclose($fp);
$_SESSION['MemberName']=$_POST['AdminUser'];
$_SESSION['UserID']=1;
$_SESSION['UserGroup']="Admin";
$_SESSION['UserTimeZone']=$AdminTime;
if($_POST['storecookie']==true) {
setcookie("MemberName", $_POST['AdminUser'], time() + (7 * 86400));
setcookie("UserID", 1, time() + (7 * 86400));
setcookie("SessPass", $NewPassword, time() + (7 * 86400)); }
mysqli_close();
unlink("install.php");
?>
Install Finish <a href="index.php?act=View">Click here</a> to goto board. ^_^
</td>
</tr>
<?php }
?>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">&nbsp;</td>
</tr>
</table>
<ins><br /></ins>
<?php
echo $Endpage;
?>
</body>
</html>
<?php
fix_amp(null);
?>