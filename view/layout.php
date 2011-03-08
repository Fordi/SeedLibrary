<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=String("Site.HtmlPage.Title")?><?=empty($pageTitle)?'':(' :: '.$pageTitle)?></title>
		<link rel="stylesheet" href="/font/gill-sans.css" />
		<link rel="stylesheet" href="/css/sitewide.css" />
		<noscript>
			<link rel="stylesheet" href="css/sitewide-noscript.css" />
		</noscript>
		<!--
		<script src="/js/jquery.js"></script>
		<script defer src="/js/decor.js"></script>
		-->
	</head>
	<body class="<?=$pageClass?>">
		<div id="content">
			<?=$content?>
		</div>
		<pre><?=String::ExportMissing()?></pre><br />
	</body>
</html>