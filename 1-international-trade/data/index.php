<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" type="text/css" href="/resources/foundation/css/foundation.min.css">
</head>
<body>
	<div class="row">
		<div class="small-12 columns">
			<?php
			include("/Applications/MAMP/htdocs/test/resources/testHelper.php");

			$testHelper = new testHelper();
			$testHelper->breadcrumbs(basename(__DIR__));
			$testHelper->listFiles();
			?>
		</div>
	</div>

</body>
</html>