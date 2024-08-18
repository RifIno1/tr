<?php
include("config.php"); 
?><h3 class="pop popgreen bold">حرب التتار<?PHP echo $name ?>.</h3>
<h3>آلرجآء إختيآر السيرفر.</h3>
<br />
	<?php
		if ($s1==1)
		include("template/s1register.php");
		echo "<br />";
		if ($s2==1)
		include("template/s2register.php");
		echo "<br />";
		if ($s3==1)
		include("template/s3register.php");
		echo "<br />";
		if ($s1==0 && $s2==0 && $s3==0 )
		echo "للأسف جميع السيرفرات ممتلئه";
	?>