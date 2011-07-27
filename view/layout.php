<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=String("Site.HtmlPage.Title")?><?=empty($pageTitle)?'':(' :: '.$pageTitle)?></title>
		<link rel="stylesheet" href="/css/reset.css" />
		<link rel="stylesheet" href="/font/tuffy.css" />
		<link rel="stylesheet" href="/css/sitewide.css" />
		<link rel="stylesheet" href="/css/page.css" />
		<link rel="stylesheet" href="/css/header.css" />
		
		<noscript>
			<link rel="stylesheet" href="/css/sitewide-noscript.css" />
		</noscript>
		<!--
		<script src="/js/jquery.js"></script>
		<script defer src="/js/decor.js"></script>
		-->
	</head>
	<body class="<?=$pageClass?>">
		<?tag('chrome.site')?>
			<?=$content?>
		<?=tag()?>
		<pre><?=String::ExportMissing()?></pre><br />
	</body>
</html>