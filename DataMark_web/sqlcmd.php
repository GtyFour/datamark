<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$cmd=$_GET['cmd'];
if(strlen($cmd)==0) {echo "";exit;}
include "consql.php";
$rs = mysql_query($cmd); 

///////////////////////////////////////////////////////////////
if(strstr($cmd,"SELECT"))
{	
	$Index=0;
	while($row = mysql_fetch_row($rs)) 
	{
	$Index=$Index+1;
	$count=count($row);
		echo $Index.',';
		$c=0;
		while($count)
		{
		echo $row[$c];
		echo ",";
		$c=$c+1;
		$count=$count-1;
		}
		echo "<br>";
	}
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
//http://www.trtos.com/web/datamark/sqlcom.php?cmd=SELECT%20*%20FROM%20tp_follow%20where%20id%3C10000000000 
?>