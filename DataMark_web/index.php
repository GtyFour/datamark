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
<?php

$value_id=@$_REQUEST['id'];
$page_id=999999;
if(strlen($value_id)<3)
{
	echo "<h2><br><br><center>无效标签，2秒后系统为您创建一个。</center></h2>";
	echo "<meta http-equiv='refresh'content=2;URL='create.php'>";exit;
}

?>
</head>
<title>Datamark</title>
<FONT size=5><em>
<a href="create.php">新建</a>
<a href=<?php echo 'show.php?id='.$value_id.'';?>>查看</a>
</em></font>
</head>
<body>
<div align="center" >
<h1><a href="http://blog.trtos.com/post/843.html">数据云便签V2.0</a></h1>
<br>
<a href=<?php echo "showcode.php?id=".$value_id;?>>
<img src=<?php echo "http://bshare.optimix.asia/barCode?site=weixin&url=http://dm.trtos.com/web/datamark/index.php?id=".$value_id;?>>
</a>
<form action=<?php echo 'api.php?id='.$value_id;?> method="post" accept-charset="GB2312">
	<h3>便签信息添加</h3>
	<h4>项目：<input class="input" type="text" name="DataName"/></h4>
	<h4>描述：<input class="input" type="text" name="DataValue"/></h4>
	<h3><button class="button green">提交</button></h3>
</form>
<div>
<?php include "display.php"; ?>
</font>
</div>
</body>
<center>
<br>
<br>
<br>
<?php include "footer.html" ?>
</html>
