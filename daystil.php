<?php

if(isset($_GET['when'])) {
	$til = strtotime($_GET['when']);
	$seconds = $til - time();
	$derpseconds = $seconds;
	if($seconds > 0) {
		$itisdone = false;
		$minutes = floor($seconds / 60);
		$seconds = $seconds - ($minutes * 60);
		$hours = floor($minutes / 60);
		$minutes = $minutes - ($hours * 60);
		$days = floor($hours / 24);
		$hours = $hours - ($days * 24);
	} else {
		$itisdone = true;
	}
}
if(isset($_GET['what'])) {
	$what = strip_tags($_GET['what']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Days Til 
	<?php
		echo substr($what,0,200);
	?>
</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script type="text/javascript">
	var enddate = new Date(<?php echo ($til * 1000); ?>);
	
	function calc_time_diff(){
		var nowdate = new Date();
		var seconds = Math.floor((enddate.getTime() - nowdate.getTime()) / 1000);
		var derpseconds = seconds;
		if(seconds < 0) {
			$('#everything').html('It Is Done.');
			clearInterval(t);
			return;
		}
		var minutes = Math.floor(seconds / 60);
		var seconds = seconds - (minutes * 60);
		var hours = Math.floor(minutes / 60);
		var minutes = minutes - (hours * 60);
		var days = Math.floor(hours / 24);
		var hours = hours - (days * 24);
		$('#hours').html(hours);
		$('#days').html(days);
		$('#minutes').html(minutes);
		$('#seconds').html(seconds);
	}
	$(function(){
		//alert(days+' days, '+hours+' hours, '+minutes+' minutes, '+seconds+' seconds. Now is: '+(derpseconds) + ' vs '+'<?=$derpseconds?>');
		<?php if(isset($_GET['when'])) { ?>
		calc_time_diff();
		var t = setInterval(function(){calc_time_diff()}, 1000);
		<?php } ?>
	});
</script>
</head>

<body>
<div id="everything" style="width:800px;height:600px;margin:100px auto 0 auto;text-align:center;font-family:Impact, Arial, Helvetica, sans-serif;font-size:48px;">
<?php
	if($itisdone) {
		echo 'It Is Done.';//.$seconds.'.'.time();
	} elseif(isset($_GET['when'])) {
		echo "<span style='font-size:200px;'><span  id='days'>$days</span> days</span><br />
			<span id='hours'>$hours</span> hours 
			<span id='minutes'>$minutes</span> minutes 
			<span id='seconds'>$seconds</span> seconds.";
	} else {
		
	?>
		<form method="GET" action="">
		When: <input type="text" name="when" /> <br />
		What: <input type="text" name ="what" /> <br />
		<input type="submit" value="Count Down" />
		</form>
	<?php
	}
?>
</div>
</body>
</html>

