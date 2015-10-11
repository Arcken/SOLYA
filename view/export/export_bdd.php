<?php

if (isset($_REQUEST['test']) && $_REQUEST['test'] == "accésValide") {


    $path = $_SERVER['DOCUMENT_ROOT'] . "SOLYA";
    require_once $path . '/view/export/export.php';
    
    // Init
error_reporting(E_ALL);
header('Content-type: text/plain');
 
// Config
$dbname = 'sloya';
mysql_connect('localhost', 'solya', 'Stage2015!');
mysql_select_db($dbname);
 
// Open dump file
$dumpfile = $dbname.'_'.date('Y-m-d_H-i').'.sql';
$fp = fopen($dumpfile, 'w');
if (!is_resource($fp)) {
    exit('Backup failed: unable to open dump file');
}
 
// Header
$out = '-- SQL Dump
--
-- Generation: '.date('r').'
-- MySQL version: '.mysql_get_server_info().'
-- PHP version: '.phpversion().'
 
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
 
--
-- Database: `'.$dbname.'`
--';
 
// Write
fwrite($fp, $out);
$out = '';
 
// Fetch tables
$tables = mysql_query("SHOW TABLE STATUS");
$c = 0;
while ($table = mysql_fetch_assoc($tables)) {
 
    $tableName = $table['Name'];
 
    $tmp = mysql_query("SHOW CREATE TABLE `$tableName`");
 
    // Create table
    $create = mysql_fetch_assoc($tmp);
    $out .= "\n\n--\n-- Table structure: `$tableName`\n--\n\n".$create['Create Table'].' ;';
 
    // Clean
    mysql_free_result($tmp);
    unset($tmp);
 
    // Write
    fwrite($fp, $out);
    $out = '';
 
    // Rows
    $tmp = mysql_query("SHOW COLUMNS FROM `$tableName`");
    $rows = array();
    while ($row = mysql_fetch_assoc($tmp)) {
        $rows[] = $row['Field'];
    }
 
    // Clean
    mysql_free_result($tmp);
    unset($tmp, $row);
 
    // Get data
    $tmp = mysql_query("SELECT * FROM `$tableName`");
    $count = mysql_num_rows($tmp);
 
    if ($count > 0) {
 
        $out .= "\n\n--\n-- Table data: `$tableName`\n--";
        $out .= "\nINSERT INTO `$tableName` (`".implode('`, `', $rows)."`) VALUES ";
 
        $i = 1;
        // Fetch data
        while ($entry = mysql_fetch_assoc($tmp)) {
 
            // Create values
            $out .= "\n(";
            $tmp2 = array();
 
            foreach ($rows as $row) {
                $tmp2[] = "'" . mysql_real_escape_string($entry[$row]) . "'";
            }
 
            $out .= implode(', ', $tmp2);
            $out .= $i++ === $count ? ');' : '),';
 
            // Save
            fwrite($fp, $out);
            $out = '';
        }
 
        // Clean
        mysql_free_result($tmp);
        unset($tmp, $tmp2, $i, $count, $entry);
 
    }
 
    // Operations counter
    $c++;
}
 
// Close dump file
fclose($fp);
 
echo "Finished! Backup $c tables to `$dumpfile` (".filesize($dumpfile)." o).";
}
?>