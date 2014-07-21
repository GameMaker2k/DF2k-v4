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
if ($File3Name=="replys.php"||$File3Name=="/replys.php") {
	require('index.html');
	exit(); }
$safesql =& new SafeSQL_MySQL;
$prequery = $safesql->query("select * from ".$Settings['sqltable']."Topics where ID=%s", array($_GET['id']));
$preresult=mysql_query($prequery);
$prenum=mysql_num_rows($preresult);
$prei=0;
while ($prei < $prenum) {
$TopicName=mysql_result($preresult,$prei,"TopicName");
++$prei; }
?>
<table width="100%" class="Table2">
<tr>
 <td style="width: 20%; text-align: left;" nowrap="nowrap">&nbsp;</td>
 <td style="width: 80%; text-align: right;"><a href="#Act/Reply"><?php echo $SkinSet['AddReply']; ?></a><?php echo $SkinSet['LineDividerTopic']; ?><a href="#Act/Topic"><?php echo $SkinSet['NewTopic']; ?></a></td>
</tr>
</table>
<ins><br /></ins>
<table class="Table1" width="100%">
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span style="font-weight: bold; float: left;"><?php echo $SkinSet['TitleIcon'] ?><a href="Topic.php?id=<?php echo $_GET['id']; ?>&amp;ForumID=<?php echo $_GET['ForumID']; ?>&amp;CatID=<?php echo $_GET['CatID']; ?>&amp;act=View"><?php echo $TopicName; ?></a></span><?php if($SkinSet['TopicLayout']!="Type 2") { ?>
<span style="float: right;">&nbsp;</span><?php } ?></td>
</tr>
<?php
$query = $safesql->query("select * from ".$Settings['sqltable']."Posts where TopicID=%s AND ForumID=%s and CategoryID=%s ORDER BY TimeStamp", array($_GET['id'],$_GET['ForumID'],$_GET['CatID']));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$i=0;
if($num==0) { header("Location: index.php?act=View"); }
while ($i < $num) {
$MyPostID=mysql_result($result,$i,"ID");
$MyTopicID=mysql_result($result,$i,"TopicID");
$MyForumID=mysql_result($result,$i,"ForumID");
$MyCategoryID=mysql_result($result,$i,"CategoryID");
$MyUserID=mysql_result($result,$i,"UserID");
$MyGuestName=mysql_result($result,$i,"GuestName");
$MyTimeStamp=mysql_result($result,$i,"TimeStamp");
$MyTimeStamp=GMTimeChange("M j, Y, g:i a",$MyTimeStamp,$YourOffSet);
$MyPost=mysql_result($result,$i,"Post");
$requery = $safesql->query("select * from ".$Settings['sqltable']."Members where ID=%s", array($MyUserID));
$reresult=mysql_query($requery);
$renum=mysql_num_rows($reresult);
$rei=0;
while ($rei < $renum) {
$User1ID=$MyUserID;
$User1Name=mysql_result($reresult,$rei,"Name");
$User1Email=mysql_result($reresult,$rei,"Email");
$User1Title=mysql_result($reresult,$rei,"Title");
$User1Joined=mysql_result($reresult,$rei,"Joined");
$User1Joined=GMTimeChange("M j, Y, g:i a",$User1Joined,$YourOffSet);
$User1Group=mysql_result($reresult,$rei,"Group");
$User1Signature=mysql_result($reresult,$rei,"Signature");
$User1Avatar=mysql_result($reresult,$rei,"Avatar");
$User1AvatarSize=mysql_result($reresult,$rei,"AvatarSize");
if ($User1Avatar=="http://"||$User1Avatar==null) {
$User1Avatar=$SkinSet['NoAvatar'];
$User1AvatarSize=$SkinSet['NoAvatarSize']; }
$AvatarSize1=explode("x", $User1AvatarSize);
$AvatarSize1W=$AvatarSize1[0];
$AvatarSize1H=$AvatarSize1[1];
$User1Website=mysql_result($reresult,$rei,"Website");
$User1PostCount=mysql_result($reresult,$rei,"PostCount");
$User1IP=mysql_result($reresult,$rei,"IP");
++$rei; }
if($User1ID==2) { $User1Name=$MyGuestName;
if($User1Name==null) { $User1Name="Guest"; } }
?>
<tr class="TableRow2">
<td class="TableRow2" style="vertical-align: center; width: 20%;">
&nbsp;<a href="#User/<?php echo $User1ID; ?>"><?php echo $User1Name; ?></a></td>
<td class="TableRow2" style="vertical-align: center; width: 80%;">
<div style="text-align: left; float: left;">
<span style="font-weight: bold;">Time Posted: </span><?php echo $MyTimeStamp; ?>
</div>
<div style="text-align: right;"><a href="#Act/Quote"><?php echo $SkinSet['QuoteReply']; ?></a>&nbsp;</div>
</td>
</tr>
<tr>
<td class="TableRow3" style="vertical-align: top;">
<img src="<?php echo $User1Avatar; ?>" alt="<?php echo $User1Name; ?>'s Avatar" style="border: 0px; width: <?php echo $AvatarSize1W; ?>px; height: <?php echo $AvatarSize1H; ?>px;" /><br /><br />
<br />
Group: <?php echo $User1Group; ?><br />
Posts: <?php echo $User1PostCount; ?><br />
Joined: <?php echo $User1Joined; ?><br /><br />
</td>
<td class="TableRow3" style="vertical-align: center;">
<?php echo $MyPost; ?>
<br /><br />--------------------<br />
<?php echo $User1Signature; ?>
</td>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">
<span style="float: left;">&nbsp;<a href="#Act/Email"><?php echo $SkinSet['Email']; ?></a><?php echo $SkinSet['LineDividerTopic']; ?><a href="<?php echo $User1Website; ?>"><?php echo $SkinSet['WWW']; ?></a><?php echo $SkinSet['LineDividerTopic']; ?><a href="#Act/PM"><?php echo $SkinSet['PM']; ?></a></span>
<span style="float: right;">&nbsp;</span></td>
</tr>
<?php ++$i; } ?>
</table>
<ins><br /></ins>
<table class="Table2" width="100%">
<tr>
 <td style="width: 20%; text-align: left;" nowrap="nowrap">&nbsp;</td>
 <td style="width: 80%; text-align: right;"><a href="#Act/Reply"><?php echo $SkinSet['AddReply']; ?></a><?php echo $SkinSet['LineDividerTopic']; ?><a href="#Act/Reply"><?php echo $SkinSet['FastReply']; ?></a><?php echo $SkinSet['LineDividerTopic']; ?><a href="#Act/Topic"><?php echo $SkinSet['NewTopic']; ?></a></td>
</tr>
</table>
<ins><br /></ins>