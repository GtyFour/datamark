<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<meta name="description" content="??????????????????,DataMark??????, Datamark ?????????????????????????........">
<meta name="keyword" content="DataMark,????,DataMark????"> 
<link rel="stylesheet" type="text/css" href="css/default.css">  
<link rel="shortcut icon" href="images/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
<title>Datamark</title>
<meta http-equiv="refresh" content="30">
<?php
$page_id=0;
$value_id=$_REQUEST['id'];
if(strlen($value_id)<3)
{
	echo "<h2><br><br><center>��Ч��ǩ�����ϵͳΪ������һ��?/center></h2>";
	echo "<meta http-equiv='refresh'content=2;URL='create.php'>";exit;
}
?>
</head>
<body onprint="document.all.pr.display='none'">
<FONT size=5>
<em><a href="create.php">�½�</a>
<a href=<?php echo 'index.php?id='.$value_id.'';?>>���</a>
<a href="javascript:void(0)" onclick=<?php echo "del('".$value_id."')";?>>ɾ��</a> 
<a href="javascript:void(0)" onclick="printdiv('div_print')">��ӡ</a> 
<a href="javascript:void(0)" onclick="refresh()">ˢ��</a> 
</em></font>
<script>
function del(delid){
    if(confirm("ɾ����û����Ŷ��")){
		self.location='del.php?id='+delid;
        return true;
    }else{
        return false;
    }
}
function refresh(){
    self.location=window.location.href;
}
</script>
<div id="div_print">
<center>
<h1><a href="http://blog.trtos.com/post/843.html">�����Ʊ�ǩV2.0</a></h1>
<br>
<a href=<?php echo "showcode.php?id=".$value_id;?>>
<img src=<?php echo "http://bshare.optimix.asia/barCode?site=weixin&url=http://dm.trtos.com/web/datamark/index.php?id=".$value_id;?>>
</a>
<center><h3>��ǩ��ѯ</h3>	
<?php include "display.php"; ?>
</font>
</div>
<script language="javascript"> 
function printdiv(printpage) 
{ 
var headstr = "<html><head><title></title></head><body>"; 
var footstr = "</body>"; 
var newstr = document.all.item(printpage).innerHTML; 
var oldstr = document.body.innerHTML; 
document.body.innerHTML = headstr+newstr+footstr; 
window.print(); 
document.body.innerHTML = oldstr; 
return false; 
} 
</script> 
</body>
<?php include "footer.html" ?>
</html>

