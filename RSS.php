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
if ($_GET['act'] == null) {
    $_GET['act'] = "BoardFeed";
}
if ($_GET['act'] == "BoardFeed") {
    require('inc/rss/RSS1.php');
    $Feed['Feed'] = "Done";
}
if ($_GET['act'] == "CategoryFeed") {
    require('inc/rss/RSS4.php');
    $Feed['Feed'] = "Done";
}
if ($_GET['act'] == "TopicFeed") {
    require('inc/rss/RSS2.php');
    $Feed['Feed'] = "Done";
}
if ($_GET['act'] == "HelpFeed") {
    require('inc/rss/RSS3.php');
    $Feed['Feed'] = "Done";
}
if ($_GET['act'] == "EventFeed") {
    require('inc/rss/RSS5.php');
    $Feed['Feed'] = "Done";
}
if ($Feed['Feed'] != "Done") {
    require('inc/rss/RSS1.php');
    $Feed['Feed'] = "Done";
}
