<?php
function from62($num){
  $from = 62;
  $num = strval($num);
  $dict = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $len = strlen($num);
  $dec = 0;
  for($i = 0; $i < $len; $i++) {
    $pos = strpos($dict, $num[$i]);
    $dec = bcadd(bcmul(bcpow($from, $len - $i - 1), $pos), $dec);
  }
  return $dec;
}
function unicodeDecode($name){
  $json = '{"str":"'.$name.'"}';
  $arr = json_decode($json,true);
  if(empty($arr)) return ''; 
  return $arr['str'];
}

$value_id=from62($_REQUEST['id']);
include "consql.php";
$start_id=$page_id*1000;
if($page_id>99999)
{
	//$q="select * from tp_follow where ID=$value_id order by 'index' desc limit 10";
	$q="select * from tp_follow where ID=$value_id order by tp_follow.index desc limit 10";
}else $q="SELECT * FROM tp_follow WHERE ID = $value_id LIMIT $start_id, 1000";
$q = "SELECT * FROM tp_follow WHERE ID=".$value_id." ORDER BY Idx DESC LIMIT 10000 OFFSET 0";                   //SQL查询语句  
mysql_query("SET NAMES 'GB2312'",$link);       
$rs = mysql_query($q);                     //获取数据集  
if(!$rs){die("Valid result!");} 
echo "<FONT size=6 face=微软雅黑 color=#00ff00>";
echo "<table border='1' borderColor=#cc6600 cellSpacing=3 cellPadding=3 style='width:100%;border:solid 1px;border-style:solid;border-color:#EEEEEE' align='center';ont-family:微软雅黑>";
echo "<tr>
	 <td>序号</td>
	 <td>项目</td>
	 <td>描述</td>
	 </tr>"; 
$Index=0;	 
while($row = mysql_fetch_row($rs)) 
{
$Index=1+$Index;
echo "<tr>
<td>$Index</td>
<td>$row[2]</td>
<td>$row[3]</td>
</tr>";    
} 
echo "</table>";  
mysql_free_result($rs);
?>
</font>