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

<title> <?php echo $Settings['board_name']." (Powered by ".$DF2k.")"; ?> </title>
</head>
<body>
<?php
require('inc/navbar.php');
?>

<ins><br /></ins>
<table class="Table1" width="100%">
<?php
if($_GET['act']=="login")
{ require('inc/login.php'); } 
if($_POST['act']=="loginmember")
{ require('inc/login.php'); } 
if($_GET['act']=="logout") 
{ require('inc/login.php'); } 
if($_GET['act']=="signup")
{ require('inc/register.php'); } 
if($_GET['act']=="makemember") {
if($_POST['act']=="makemembers") {
require('inc/register.php'); } }
?>
</table>
<ins><br /></ins>
<?php
mysql_close();
echo $Endpage;
?>
</body>
</html>
<?php
fix_amp(null);
?>