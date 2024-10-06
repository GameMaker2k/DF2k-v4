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
if ($File3Name == "RSS4.php" || $File3Name == "/RSS4.php") {
    require('index.html');
    exit();
}
require('MySQL.php');
$BoardURL = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/";
$BoardURL = preg_replace("/misc/isxS", "", $BoardURL);
header("Content-type: application/xml");
if ($_GET['Validate'] == "RSS" || $_GET['validate'] == "RSS") {
    $NEW["REQUEST_URI"] = preg_replace("/\?Validate\=RSS/isxS", "?Renee=Awesome", $_SERVER["REQUEST_URI"]);
    $NEW["REQUEST_URI"] = preg_replace("/\&Validate\=RSS/isxS", "", $NEW["REQUEST_URI"]);
    header('Location: http://validator.w3.org/feed/check.cgi?url='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"]));
}
if ($act == "Download") {
    header('Content-Disposition: attachment; filename="'.$Settings['board_name'].'.xml"');
}
if ($_GET['id'] == null) {
    $_GET['id'] = 0;
}
if ($_GET['SubID'] == null) {
    $_GET['SubID'] = 0;
}
echo '<?xml version="1.0" encoding="iso-8859-15"?>'."\n\r";
$safesql = new SafeSQL_MySQL();
$query = $safesql->query("select * from ".$Settings['sqltable']."Categorys where ShowCategory='Yes' and InSubForum=%s ORDER BY ID", array($_GET['SubID']));
$preresult1 = mysqli_query($query);
$num = mysqli_num_rows($preresult1);
unset($safesql);
$prei1 = 0;
while ($prei1 < $num) {
    $CategoryID = mysqli_result($preresult1, $prei1, "ID");
    $CategoryName = mysqli_result($preresult1, $prei1, "Name");
    $CategoryShow = mysqli_result($preresult1, $prei1, "ShowCategory");
    $CategoryDescription = mysqli_result($preresult1, $prei1, "Description");
    $One = $One.'<rdf:li rdf:resource="'.$BoardURL.'Category.php?id='.$CategoryID.'&amp;SubID='.$_GET['SubID'].'"/>'."\n\r";
    $Two = $Two.'<item>'."\n\r".'<title>'.$CategoryName.'</title>'."\n\r".'<description>'.$CategoryDescription.'</description>'."\n\r".'<link>'.$BoardURL.'Category.php?id='.$CategoryID.'&amp;SubID='.$_GET['SubID'].'</link>'."\n\r".'</item>'."\n\r";
    ++$prei1;
} ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <channel>
   <title><?php echo $Settings['board_name']; ?></title>
   <description>RSS Feed of the Categorys on Board <?php echo $Settings['board_name']; ?></description>
   <link><?php echo $BoardURL; ?></link>
   <language>en-us</language>
   <generator>Edit Plus v2.12</generator>
   <copyright>Game Maker 2k� 2004</copyright>
   <ttl>120</ttl>
   <image>
	<url><?php echo $BoardURL; ?>Pics/xml.gif</url>
	<title><?php echo $Settings['board_name']; ?></title>
	<link><?php echo $BoardURL; ?></link>
   </image>
 <?php echo "\n\r".$Two."\n\r"; ?></channel>
</rss>
<?php mysqli_close(); ?>