<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$cmd=$_GET['cmd'];
if(strlen($cmd)==0) {echo "error";exit;}
include "consql.php";
$result = mysql_query($cmd); 

if(strstr($cmd,"SELECT"))
{	
	while($row = mysql_fetch_assoc($result)) 
	{
    $rows[] = $row;
	} 
	echo json_encode($rows);
}
elseif(strstr($cmd,"DELETE"))
{
	$mark  = mysql_affected_rows();//返回影响行数
	if($mark>0){
		echo "删除成功";
	}else{
		echo "删除失败";
	}
}
?>