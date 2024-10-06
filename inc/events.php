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
if ($File3Name == "events.php" || $File3Name == "/events.php") {
    require('index.html');
    exit();
}
$safesql = new SafeSQL_MySQL();
if ($_GET['act'] == "View" || $_GET['act'] == null) {
    $query = $safesql->query("select * from ".$Settings['sqltable']."Events where ID=%s", array($_GET['id']));
    $result = mysqli_query($query);
    $num = mysqli_num_rows($result);
    $is = 0;
    if ($num == 0) {
        header("Location: index.php?act=View");
    }
    while ($is < $num) {
        $EventID = mysqli_result($result, $is, "ID");
        $EventUser = mysqli_result($result, $is, "UserID");
        $EventName = mysqli_result($result, $is, "EventName");
        $EventText = mysqli_result($result, $is, "EventText");
        $EventMouth = mysqli_result($result, $is, "EventMouth");
        $EventMouthEnd = mysqli_result($result, $is, "EventMouthEnd");
        $EventDay = mysqli_result($result, $is, "EventDay");
        $EventDayEnd = mysqli_result($result, $is, "EventDayEnd");
        $EventYear = mysqli_result($result, $is, "EventYear");
        $EventYearEnd = mysqli_result($result, $is, "EventYearEnd");
        $EventStartTS = Time_UnixStamp($EventMouth."/".$EventDay."/".$EventYear);
        $EventEndTS = Time_UnixStamp($EventMouthEnd."/".$EventDayEnd."/".$EventYearEnd);
        $EventStart = GMTimeChange("M. j Y", $EventStartTS, null);
        $EventEnd = GMTimeChange("M. j Y", $EventEndTS, null);
        $requery = $safesql->query("select * from ".$Settings['sqltable']."Members where ID=%s", array($EventUser));
        $reresult = mysqli_query($requery);
        $renum = mysqli_num_rows($reresult);
        $rei = 0;
        while ($rei < $renum) {
            $User1ID = $MyUserID;
            $User1Name = mysqli_result($reresult, $rei, "Name");
            $User1Email = mysqli_result($reresult, $rei, "Email");
            $User1Title = mysqli_result($reresult, $rei, "Title");
            $User1Joined = mysqli_result($reresult, $rei, "Joined");
            $User1Joined = GMTimeChange("M j, Y, g:i a", $User1Joined, $YourOffSet);
            $User1Group = mysqli_result($reresult, $rei, "Group");
            $User1Signature = mysqli_result($reresult, $rei, "Signature");
            $User1Avatar = mysqli_result($reresult, $rei, "Avatar");
            $User1AvatarSize = mysqli_result($reresult, $rei, "AvatarSize");
            if ($User1Avatar == "http://" || $User1Avatar == null) {
                $User1Avatar = $SkinSet['NoAvatar'];
                $User1AvatarSize = $SkinSet['NoAvatarSize'];
            }
            $AvatarSize1 = explode("x", $User1AvatarSize);
            $AvatarSize1W = $AvatarSize1[0];
            $AvatarSize1H = $AvatarSize1[1];
            $User1Website = mysqli_result($reresult, $rei, "Website");
            $User1PostCount = mysqli_result($reresult, $rei, "PostCount");
            $User1IP = mysqli_result($reresult, $rei, "IP");
            ++$rei;
        }
        ++$is;
    }
    ?>
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span style="font-weight: bold; float: left;"><?php echo $SkinSet['TitleIcon'] ?><a href="Event.php?act=<?php echo $_GET['act']; ?>&amp;id=<?php echo $_GET['id']; ?>"><?php echo $EventName; ?></a></span><?php if ($SkinSet['TopicLayout'] != "Type 2") { ?>
<span style="float: right;">&nbsp;</span><?php } ?></td>
</tr>
<tr class="TableRow2">
<td class="TableRow2" style="vertical-align: center; width: 20%;">
&nbsp;<a href="#User/<?php echo $User1ID; ?>"><?php echo $User1Name; ?></a></td>
<td class="TableRow2" style="vertical-align: center; width: 80%;">
<div style="text-align: left; float: left;">
<span style="font-weight: bold;">Event Start: </span><?php echo $EventStart; ?><?php echo $SkinSet['LineDividerTopic']; ?><span style="font-weight: bold;">Event End: </span><?php echo $EventEnd; ?>
</div>
<div style="text-align: right;">&nbsp;</div>
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
<?php echo $EventText; ?>
<br /><br />--------------------<br />
<?php echo $User1Signature; ?>
</td>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">
<span style="float: left;">&nbsp;<a href="#Act/Email"><?php echo $SkinSet['Email']; ?></a><?php echo $SkinSet['LineDividerTopic']; ?><a href="<?php echo $User1Website; ?>"><?php echo $SkinSet['WWW']; ?></a><?php echo $SkinSet['LineDividerTopic']; ?><a href="#Act/PM"><?php echo $SkinSet['PM']; ?></a></span>
<span style="float: right;">&nbsp;</span></td>
</tr>
<?php } ?>