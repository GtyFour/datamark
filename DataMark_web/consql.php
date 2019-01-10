<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<?php
$link=mysql_connect("bdm261699222.my3w.com","bdm261699222","T0ngjinlv");  
if(!$link) echo "数据库连接错误";   
mysql_select_db("bdm261699222_db");
mysql_query("SET NAMES 'GB2312'",$link); 
?>