<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<?php
include "consql.php";
include '../../php/algo.php';
$rs = mysql_query("SELECT FLOOR(RAND() * 20999999999999) AS random_number FROM tp_follow  WHERE 'random_number' NOT IN (SELECT id FROM tp_follow)  LIMIT 1 "); 
while($row = mysql_fetch_row($rs)) 
{
	$value=$row[0];
	break;
}
$id=from10($value);
Header("Location: index.php?id=$id");exit;
?>