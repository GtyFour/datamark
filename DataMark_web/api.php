<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<?php

include "consql.php";
include '../../php/algo.php';
$dname=@$_POST['DataName'];
$dvalue=@$_POST['DataValue'];
if(strlen($dname)==0) {echo "参数为空";goto exitt;}
if(strlen($dvalue)==0) {echo "参数为空";goto exitt;}
if(strstr($dvalue,"http://")){
    $dvalue='<a href="'.$dvalue.'">'.$dvalue.'</a>';
}
if(strstr($dvalue,"https://")){
    $dvalue='<a href="'.$dvalue.'">'.$dvalue.'</a>';
}
include "consql.php";
$value_id=from62($_REQUEST['id']);
$q = "INSERT into tp_follow (id,NAME,VALUE) VALUES('$value_id','$dname','$dvalue')";
$rs = mysql_query($q); 
if($rs)
{
	echo"<script>history.go(-1);</script>";  
}
exitt:
header("Location: ".$_SERVER['HTTP_REFERER']);
echo"<script>history.go(-1);</script>";  
?>

