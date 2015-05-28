<!doctype html>
<html class="no-js">
<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>系统发生错误</title>
</head>
<body>
<h1><?php echo strip_tags($e['message']);?></h1>
<?php if(isset($e['file'])) {?>
	<p>FILE: <?php echo $e['file'] ;?> LINE: <?php echo $e['line'];?></p>
<?php }?>
<?php if(isset($e['trace'])) {?>
	<p><?php echo nl2br($e['trace']);?></p>
<?php }?>
</body>
</html>
