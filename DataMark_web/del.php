<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<?php
include '../../php/algo.php';
$value_id=from62($_REQUEST['id']);
include "consql.php";
$q = "DELETE FROM tp_follow WHERE ID=".$value_id;                   
mysql_query("SET NAMES 'GB2312'",$link);         
$rs = mysql_query($q);                  
if(!$rs){die("Valid result!");} 
else echo "删除成功"; 
echo "<script language=javascript> self.location=document.referrer;</script>";
?>
