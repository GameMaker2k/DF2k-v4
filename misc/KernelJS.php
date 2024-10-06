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
require('Kernel.php');
header('Content-type: application/x-javascript');
?>
<!--
function getid(id) {
itm = document.getElementById(id);
return itm; }

function toggleview(id) {
if (itm.style.display == "none") {
itm.style.display = ""; }
else {
itm.style.display = "none"; } }

function toggletag(id) {
getid(id);
toggleview(id); }

function bgchange(id,color) {
getid(id);
itm.style.backgroundColor = ''+color+''; }

function innerchange(tag,text1,text2) {
usrname = document.getElementsByTagName(tag);
for (var i = 0; i < usrname.length; i++) {
if(usrname[i].innerHTML==text1) {
usrname[i].innerHTML = text2; } } }
//-->