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
$File3Name = str_replace($File1Name, null, $File2Name);
if ($File3Name == "boards.php" || $File3Name == "/boards.php") {
    require('index.html');
    exit();
}
$prequery = $safesql->query("select * from ".$Settings['sqltable']."Categorys where ShowCategory='Yes' and InSubForum=0", array());
$preresult = mysqli_query($prequery);
$prenum = mysqli_num_rows($preresult);
$prei = 0;
while ($prei < $prenum) {
    $CategoryID = mysqli_result($preresult, $prei, "ID");
    $CategoryName = mysqli_result($preresult, $prei, "Name");
    $CategoryShow = mysqli_result($preresult, $prei, "ShowCategory");
    $CategoryDescription = mysqli_result($preresult, $prei, "Description");
    /*	Toggle Code	*/
    $query2 = $safesql->query("select * from ".$Settings['sqltable']."Forums where ShowForum='Yes' and CategoryID='%s' and InSubForum=0", array($CategoryID));
    $result2 = mysqli_query($query2);
    $num2 = mysqli_num_rows($result2);
    $i2 = 0;
    $toggle = "";
    while ($i2 < $num2) {
        $ForumID = mysqli_result($result2, $i2, "ID");
        $i3 = $i2 + 1;
        if ($i3 != $num2) {
            $toggle = $toggle."toggletag('Forum".$ForumID."'),";
        }
        if ($i3 == $num2) {
            $toggle = $toggle."toggletag('Forum".$ForumID."'),";
        }
        if ($i3 == $num2) {
            $toggle = $toggle."toggletag('Cat".$CategoryID."'),toggletag('CatEnd".$CategoryID."');";
        }
        ++$i2;
    } ?>
<table class="Table1" width="100%">
<tr class="TableRow1">
<td class="TableRow1" colspan="5"><span class="textright"><a href="#Toggle" onclick="<?php echo $toggle; ?>"><?php echo $SkinSet['Toggle']; ?></a><?php echo $SkinSet['ToggleExt']; ?></span>
<?php echo $SkinSet['TitleIcon'] ?><a href="Category.php?id=<?php echo $CategoryID; ?>"><?php echo $CategoryName; ?></a></td>
</tr>
<?php
    $query = $safesql->query("select * from ".$Settings['sqltable']."Forums where ShowForum='Yes' and CategoryID='%s' and InSubForum=0 ORDER BY ID", array($CategoryID));
    $result = mysqli_query($query);
    $num = mysqli_num_rows($result);
    $i = 0;
    if ($num >= 1) {
        ?>
<tr id="Cat<?php echo $CategoryID; ?>" class="TableRow2">
<th class="TableRow2" style="width: 5%;">&nbsp;</th>
<th class="TableRow2" style="width: 59%;">Forum</th>
<th class="TableRow2" style="width: 8%;">Topics</th>
<th class="TableRow2" style="width: 8%;">Posts</th>
<th class="TableRow2" style="width: 20%;">Last Topic</th>
</tr>
<?php }
    while ($i < $num) {
        $ForumID = mysqli_result($result, $i, "ID");
        $ForumName = mysqli_result($result, $i, "Name");
        $ForumShow = mysqli_result($result, $i, "ShowForum");
        $ForumType = mysqli_result($result, $i, "ForumType");
        $ForumDescription = mysqli_result($result, $i, "Description");
        unset($LastTopic);
        $gltquery = $safesql->query("select * from ".$Settings['sqltable']."Topics where CategoryID=%s and ForumID=%s", array($CategoryID,$ForumID));
        $gltresult = mysqli_query($gltquery);
        $gltnum = mysqli_num_rows($gltresult);
        if ($gltnum > 0) {
            $TopicID = mysqli_result($gltresult, $gltnum - 1, "ID");
            $TopicName = mysqli_result($gltresult, $gltnum - 1, "TopicName");
            $TopicName1 = substr($TopicName, 0, 15);
            if (strlen($TopicName) > 12) {
                $TopicName1 = $TopicName1."...";
            }
            $UsersID = mysqli_result($gltresult, $gltnum - 1, "UserID");
            $GuestName = mysqli_result($gltresult, $gltnum - 1, "GuestName");
            $UsersName = GetUserName($UsersID, $Settings['sqltable']);
            $UsersName1 = substr($UsersName, 0, 18);
            if ($UsersName == "Guest") {
                $UsersName = $GuestName;
                if ($UsersName == null) {
                    $UsersName = "Guest";
                }
            }
            if (strlen($UsersName) > 15) {
                $UsersName1 = $UsersName1."...";
                $oldtopicname = $TopicName;
                $oldusername = $UsersName;
                $TopicName = $TopicName1;
                $UsersName = $UsersName1;
            }
            $LastTopic = "Made By: <a href=\"#".$UsersID."\" title=\"".$oldusername."\">".$UsersName."</a><br />\nTopic Name: <a href=\"Topic.php?id=".$TopicID."&amp;ForumID=".$ForumID."&amp;CatID=".$CategoryID."&amp;act=View\" title=\"".$oldtopicname."\">".$TopicName."</a>";
        }
        if ($LastTopic == null) {
            $LastTopic = "&nbsp;<br />&nbsp;";
        }
        ?>
<tr class="TableRow3" id="Forum<?php echo $ForumID; ?>">
<td class="TableRow3"><?php echo $SkinSet['ForumIcon']; ?></td>
<td class="TableRow3"><div class="forumname"><a href="<?php echo $ForumType; ?>.php?act=View&amp;id=<?php echo $ForumID; ?>&amp;CatID=<?php echo $CategoryID; ?>"><?php echo $ForumName; ?></a></div>
<div class="forumescription"><?php echo $ForumDescription; ?></div></td>
<td class="TableRow3" style="text-align: center;"><?php echo CountTopics($CategoryID, $ForumID, $Settings['sqltable']); ?></td>
<td class="TableRow3" style="text-align: center;"><?php echo CountPosts($CategoryID, $ForumID, $Settings['sqltable']); ?></td>
<td class="TableRow3"><?php echo $LastTopic; ?></td>
</tr>
<?php
        ++$i;
    }
    if ($num >= 1) {
        ?>
<tr id="CatEnd<?php echo $CategoryID; ?>" class="TableRow4">
<td class="TableRow4" colspan="5">&nbsp;</td>
</tr>
<?php } ?>
</table>
<ins><br /></ins>
<?php
        ++$prei;
}
?>