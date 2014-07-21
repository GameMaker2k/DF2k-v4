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
require('Preindex.php');
//This is Where You Put The Name of This File and Your Board Name
$filename="TagBoard";
$boardname=$Settings['board_name'];
?>

<title> <?php echo $Settings['board_name']." (Powered by ".$TB2k.")"; ?> </title>
</head>
<body>
<?php
require('inc/navbar.php');
?>
<ins><br /></ins>
<?php
if($_GET['act']==null)
{ $_GET['act']="View"; }
if($_GET['act']=="View")
{ require('inc/tagboard.php'); }
mysql_close();
echo $Endpage;
?>
</body>
</html>
<?php
fix_amp(null);
?>