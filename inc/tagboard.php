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
if ($File3Name=="tagboard.php"||$File3Name=="/tagboard.php") {
	require('index.html');
	exit(); }
/*	Toggle Code	*/
$query2 = $safesql->query("select * from ".$Settings['sqltable'].$filename, array());
$result2=mysql_query($query2);
$num2=mysql_num_rows($result2);
$i2=0;
$toggle="";
while ($i2 < $num2) {
$IDT=mysql_result($result2,$i2,"ID");
$i3=$i2+1;
if ($i3!=$num2) {
$toggle=$toggle."toggletag('".$filename.$IDT."'),"; }
if ($i3==$num2) {
$toggle=$toggle."toggletag('".$filename.$IDT."'),"; }
if ($i3==$num2) {
$toggle=$toggle."toggletag('".$filename."'),toggletag('".$filename."end')"; }
++$i2; } ?>
<table class="Table1" width="100%">
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span class="textright"><a href="#Toggle" onclick="<?php echo $toggle; ?>"><?php echo $SkinSet['Toggle']; ?></a><?php echo $SkinSet['ToggleExt']; ?></span>
<?php echo $SkinSet['TitleIcon'] ?><a href="TagBoard.php?act=View">TagBoard</a></td>
</tr>
<tr id="<?php echo $filename; ?>" class="TableRow2">
<th class="TableRow2" style="width: 20%;">Author</th>
<th class="TableRow2" style="width: 80%;">Posts</th>
</tr>
<?php
$query = $safesql->query("select * from ".$Settings['sqltable'].$filename, array());
$result=mysql_query($query);
$num=mysql_num_rows($result);
$i=0;
while ($i < $num) {
$IDT=mysql_result($result,$i,"ID");
$UsersID=mysql_result($result,$i,"UserID");
$GuestName=mysql_result($result,$i,"GuestName");
$Post=mysql_result($result,$i,"Post");
$UsersName = GetUserName($UsersID,$Settings['sqltable']);
if($UsersName=="Guest") { $UsersName=$GuestName;
if($UsersName==null) { $UsersName="Guest"; } } ?>
<tr id="<?php echo $filename.$IDT; ?>" class="TableRow3">
<td class="TableRow3"><div class="textcenter"><?php echo $UsersName; ?></div></td>
<td class="TableRow3"><?php echo $Post; ?></td>
</tr>
<?php
++$i;
}?>
<tr id="<?php echo $filename; ?>end" class="TableRow4">
<td class="TableRow4" colspan="2">&nbsp;</td>
</tr>
</table>
<ins><br /></ins>