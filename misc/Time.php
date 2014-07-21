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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en-US">
<head>
<title> Time Changer (unix time stamp and time zone) </title>
<meta http-equiv="content-language" content="en-US">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-15">
<meta name="Generator" content="EditPlus">
<meta name="Author" content="Null">
<meta name="Keywords" content="Null">
<meta name="Description" content="Null">
<style type="text/css">
body {
background-color: #000000; 
color: #87CEEB;
font-family: verdana, helvetica, sans-serif;
}
table {
height: 100%; 
width: 100%; 
text-align: center; 
vertical-align: center;
}
a {
font-size: 100px; 
font-weight: bold; 
text-decoration: none;
color: #87CEEB;
}
</style>
</head>

<body onload="window.status='403 Forbidden';" style="background-color: #000000; color: #87CEEB; font-family: verdana, helvetica, sans-serif;">
<?php require('Kernel.php'); ?>
<table style="height: 100%; width: 100%; text-align: center; vertical-align: center;">

<tr>
	<td>
<?php
if($_POST['time']==null) { $_POST['time'] = "Jan 24 2006 02:12 PM"; }
if($_POST['timeformat']==null) { $_POST['timeformat'] = "F j, Y, g:i a"; }
if($_POST['timezone']==null) { $_POST['timezone'] = "-6"; }
?>
<form method="POST" action="?act=convert">
Insert Time:<br /><input type="text" name="time" value="<?php echo $_POST['time']; ?>"><br />
Insert New Time Format:<br /><input type="text" name="timeformat" value="<?php echo $_POST['timeformat']; ?>"><br />
Insert New TimeZone:<br /><input type="text" name="timezone" value="<?php echo $_POST['timezone']; ?>"><br />
<input type="hidden" name="act" value="convert">
<input type="submit">
</form><br />
<?php
if($_GET['act']=="convert"&&$_POST['act']=="convert") {
echo "Time Change with GMDate(Changed to GMT then Time zone)<br />\n";
echo "New Time: ".GMTimeChange($_POST['timeformat'],GMTime_UnixStamp($_POST['time']),$_POST['timezone'])."<br />\n";
echo "Time Change with Date(Changed to Time zone)<br />\n";
echo "New Time: ".TimeChange($_POST['timeformat'],GMTime_UnixStamp($_POST['time']),$_POST['timezone'])."<br />\n";
echo "Unix Time Stamp w/o TimeZone: ".GMTime_UnixStamp($_POST['time'])."<br />\n"; }
?>
	</td>
</tr>
</table>
</body>
</html>
