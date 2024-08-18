<?php
include("config.php"); 
?><h3 class="pop popgreen bold">حرب التتار<?PHP echo $name ?>.</h3>
<h3>الرجآء إختيار السيرفر.</h3>
<br />
	<?php
		if ($s1==1)
		include("template/s1login.php");
		echo "<br />";
		if ($s2==1)
		include("template/s2login.php");
		echo "<br />";
		if ($s3==1)
		include("template/s3login.php");
		echo "<br />";
		if ($s1==0 && $s2==0 && $s3==0 )
		echo "نعتذر جميع السيرفرات ممتلئه";
	?>