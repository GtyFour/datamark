<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<?php
$value_id=@$_REQUEST['id'];
if(strlen($value_id)<3)
{
	echo "��Ч��ǩ��ϵͳΪ������һ����";
	echo "<meta http-equiv='refresh'content=2;URL='http://dm.trtos.com/web/dm/create.php'>";exit;
}
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Datamark</title>
</head>
<link rel="stylesheet" type="text/css" href="css/default.css">  
<body>
<center>
<br>
<br>
<br>
<div>
<h1><a href="http://dm.trtos.com/web/wp/?p=658">�����Ʊ�ǩV2.0</a></h1><br>
������ʹ����
<br>
<a href=<?php echo "http://dm.trtos.com/web/datamark/show.php?id=".$value_id;?>>
<img src=<?php echo "http://bshare.optimix.asia/barCode?site=weixin&url=http://dm.trtos.com/web/datamark/index.php?id=".$value_id;?>>
</a>
<br>
<em>����Ҳ�ü�סŶ </em><a href=<?php echo "http://dm.trtos.com/web/datamark/?id=".$value_id;?>><?php echo "<font color='Green'>http://dm.trtos.com/web/datamark/?id=".$value_id."</font>";?></a>
</center>
</div>

<?php include "footer.html" ?>
</body>
</html>