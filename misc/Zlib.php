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
if ($File3Name == "Zlib.php" || $File3Name == "/Zlib.php") {
    require('index.html');
    exit();
}

function gunzip($infile, $outfile)
{
    $zp = gzopen($infile, "r");
    while (!gzeof($zp)) {
        $string .= gzread($zp, 4096);
    }
    gzclose($zp);
    $fp = fopen($outfile, "w");
    fwrite($fp, $string, strlen($string));
    fclose($fp);
}

function gunzip2($infile, $outfile)
{
    $string = implode("", gzfile($infile));
    $fp = fopen($outfile, "w");
    fwrite($fp, $string, strlen($string));
    fclose($fp);
}

function gzip($infile, $outfile, $param = 5)
{
    $fp = fopen($infile, "r");
    $data = fread($fp, filesize($infile));
    fclose($fp);
    $zp = gzopen($outfile, "w".$param);
    gzwrite($zp, $data);
    gzclose($zp);
}
