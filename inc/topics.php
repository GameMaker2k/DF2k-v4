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
if ($File3Name=="topics.php"||$File3Name=="/topics.php") {
	require('index.html');
	exit(); }
?>
<table width="100%" class="Table2">
<tr>
 <td style="width: 20%; text-align: left;" nowrap="nowrap">&nbsp;</td>
 <td style="width: 80%; text-align: right;"><a href="#Act/Topic"><?php echo $SkinSet['NewTopic']; ?></a></td>
</tr>
</table>
<ins><br /></ins>
<table class="Table1" width="100%">
<?php
$prequery = $safesql->query("select * from ".$Settings['sqltable']."Forums where CategoryID=%s and ID=%s", array($_GET['CatID'],$_GET['id']));
$preresult=mysql_query($prequery);
$prenum=mysql_num_rows($preresult);
$prei=0;
while ($prei < $prenum) {
$ForumID=mysql_result($preresult,$prei,"ID");
$ForumName=mysql_result($preresult,$prei,"Name");
/*	Toggle Code	*/
$query2 = $safesql->query("select * from ".$Settings['sqltable']."Topics where ForumID=%s and CategoryID=%s ORDER BY ID", array($_GET['id'],$_GET['CatID']));
$result2=mysql_query($query2);
$num2=mysql_num_rows($result2);
$i2=0;
$toggle="";
while ($i2 < $num2) {
$TopicID=mysql_result($result2,$i2,"ID");
$i3=$i2+1;
if ($i3!=$num2) {
$toggle=$toggle."toggletag('Topic".$TopicID."'),"; }
if ($i3==$num2) {
$toggle=$toggle."toggletag('Topic".$TopicID."'),"; }
if ($i3==$num2) {
$toggle=$toggle."toggletag('Forum".$_GET['id']."'),toggletag('ForumEnd');"; }
++$i2; }
?>
<tr class="TableRow1">
<td class="TableRow1" colspan="6"><span class="textright"><a href="#Toggle" onclick="<?php echo $toggle; ?>"><?php echo $SkinSet['Toggle']; ?></a><?php echo $SkinSet['ToggleExt']; ?></span>
<?php echo $SkinSet['TitleIcon'] ?><a href="Forum.php?act=View&amp;id=<?php echo $ForumID; ?>&amp;CatID=<?php echo $_GET['CatID']; ?>#<?php echo $ForumID; ?>"><?php echo $ForumName; ?></a></td>
</tr>
<?php ++$prei; } ?>
<tr id="Forum<?php echo $ForumID; ?>" class="TableRow2">
<th class="TableRow2" style="width: 5%;">State</th>
<th class="TableRow2" style="width: 33%;">Topic Name</th>
<th class="TableRow2" style="width: 15%;">Author</th>
<th class="TableRow2" style="width: 19%;">Time</th>
<th class="TableRow2" style="width: 5%;">Replys</th>
<th class="TableRow2" style="width: 23%;">Last Reply</th>
</tr>
<?php
$query = $safesql->query("select * from ".$Settings['sqltable']."Topics where ForumID=%s and CategoryID=%s ORDER BY Pinned DESC, LastUpdate DESC", array($_GET['id'],$_GET['CatID']));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$i=0;
while ($i < $num) {
$TopicID=mysql_result($result,$i,"ID");
$UsersID=mysql_result($result,$i,"UserID");
$GuestName=mysql_result($result,$i,"GuestName");
$TheTime=mysql_result($result,$i,"TimeStamp");
$TheTime=GMTimeChange("F j, Y, g:i a",$TheTime,$YourOffSet);
$TopicName=mysql_result($result,$i,"TopicName");
$PinnedTopic=mysql_result($result,$i,"Pinned");
$TopicStat=mysql_result($result,$i,"Closed");
$UsersName = GetUserName($UsersID,$Settings['sqltable']);
if($UsersName=="Guest") { $UsersName=$GuestName;
if($UsersName==null) { $UsersName="Guest"; } }
$glrquery = $safesql->query("select * from ".$Settings['sqltable']."Posts where CategoryID=%s and ForumID=%s and TopicID=%s ORDER BY TimeStamp", array($_GET['CatID'],$_GET['id'],$TopicID));
$glrresult=mysql_query($glrquery);
$glrnum=mysql_num_rows($glrresult);
if($glrnum>0){
$ReplyID1=mysql_result($glrresult,$glrnum-1,"ID");
$UsersID1=mysql_result($glrresult,$glrnum-1,"UserID");
$GuestName1=mysql_result($glrresult,$glrnum-1,"GuestName");
$TimeStamp1=mysql_result($glrresult,$glrnum-1,"TimeStamp");
$TimeStamp1=GMTimeChange("M j, Y, g:i a",$TimeStamp1,$YourOffSet);
$UsersName1 = GetUserName($UsersID1,$Settings['sqltable']); }
if($UsersName1=="Guest") { $UsersName1=$GuestName1;
if($UsersName1==null) { $UsersName1="Guest"; } }
if($TimeStamp1!=null) {
$LastReply = "By: <a href=\"#".$UsersID1."\">".$UsersName1."</a><br />\nTime: ".$TimeStamp1; }
if($TimeStamp1==null) { $LastReply = "&nbsp;<br />&nbsp;"; }
if ($PinnedTopic==1) {
	$PreTopic=$SkinSet['PinTopic']; }
if ($TopicStat==1) {
	$PreTopic=$SkinSet['ClosedTopic']; }
if ($PinnedTopic==0) {
	if ($TopicStat==0) {
		$PreTopic=$SkinSet['TopicIcon']; } }
if ($PinnedTopic==1) {
	if ($TopicStat==1) {
		$PreTopic=$SkinSet['PinClosedTopic']; } }
?>
<tr class="TableRow3" id="Topic<?php echo $TopicID; ?>">
<td class="TableRow3"><?php echo $PreTopic; ?></td>
<td class="TableRow3"><div class="topicname">
<a href="Topic.php?id=<?php echo $TopicID ?>&amp;ForumID=<?php echo $_GET['id']; ?>&amp;CatID=<?php echo $_GET['CatID']; ?>&amp;act=View"><?php echo $TopicName; ?></a>
</div></td>
<td class="TableRow3" style="text-align: center;"><a href="#<?php echo $UsersID; ?>"><?php echo $UsersName; ?></a></td>
<td class="TableRow3" style="text-align: center;"><?php echo $TheTime; ?></td>
<td class="TableRow3" style="text-align: center;"><?php echo CountReplys($_GET['CatID'],$_GET['id'],$TopicID,$Settings['sqltable'])-1; ?></td>
<td class="TableRow3"><?php echo $LastReply; ?></td>
</tr>
<?php ++$i; } ?>
<tr id="ForumEnd" class="TableRow4">
<td class="TableRow4" colspan="6">&nbsp;</td>
</tr>
</table>
<ins><br /></ins>
<table class="Table2" width="100%">
<tr>
 <td style="width: 20%; text-align: left;" nowrap="nowrap">&nbsp;</td>
 <td style="width: 80%; text-align: right;"><a href="#Act/Topic"><?php echo $SkinSet['NewTopic']; ?></a></td>
</tr>
</table>
<ins><br /></ins>