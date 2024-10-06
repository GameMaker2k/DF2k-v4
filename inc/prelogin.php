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
$safesql = new SafeSQL_MySQL();
$querylog2 = $safesql->query("select * from ".$Settings['sqltable']."Members where Name = '%s' and Password='%s'", array($_COOKIE['MemberName'],$_COOKIE['SessPass']));
$resultlog2 = mysqli_query($querylog2);
$numlog2 = mysqli_num_rows($resultlog2);
if ($numlog2 >= 1) {
    $il = 0;
    $YourIDAM = mysqli_result($resultlog2, $il, "id");
    $YourGroupAM = mysqli_result($resultlog2, $il, "Group");
    $YourTimeZoneAM = mysqli_result($resultlog2, $il, "TimeZone");
    $_SESSION['MemberName'] = $_COOKIE['MemberName'];
    $_SESSION['UserID'] = $YourIDAM;
    setcookie("UserID", $YourIDAM, time() + (7 * 86400));
} if ($numlog2 <= 0) {
    header("Location: Members.php?act=logout");
}
