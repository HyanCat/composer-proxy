<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
</head>
<link href="//cdn.bootcss.com/semantic-ui/2.1.3/semantic.min.css" rel="stylesheet">
<style type="text/css">
	body{
		font-family: 'consolas';
	}
	.masthead.segment {
		min-height: 200px;
		padding: 1em 0em;
		background-color: #F4645F !important;
	}
	.masthead h1.ui.header {
		margin-top: 2em;
		margin-bottom: 0em;
		font-size: 4em;
		font-weight: normal;
	}
	.masthead h2 {
		font-size: 1.7em;
		font-weight: normal;
	}
	.ui.vertical.stripe {
		padding: 8em 0em;
	}
	.ui.vertical.stripe h3 {
		font-size: 2em;
	}
	.ui.vertical.stripe p + h3 {
		margin-top: 3em;
	}
	.ui.vertical.stripe p {
		font-size: 1.33em;
	}
	.footer.segment {
		padding: 5em 0em;
	}
</style>
<body>

<div class="ui vertical masthead center aligned segment">
	<div class="ui text container">
		<h1 class="ui inverted header">{{ $title }}</h1>
		<h2 class="ui inverted header">{{ $description }}</h2>
	</div>
</div>

<div class="ui vertical stripe segment">
	<div class="ui middle aligned stackable grid container">
		<div class="row">
			<div class="sixteen wide column">
				<h3 class="ui header">1. Setup</h3>

				<p>Edit Your $COMPOSER_HOME/config.json (You can edit by composer config -g -e):</p>
				<div class="ui segment">
				<pre><code>{
	"repositories": [
		{ "packagist": false },
		{
			"type": "composer",
			"url": "{{ $mirror }}"
		}
	]
}</code></pre>
				</div>

				<p>Or:</p>
				<div class="ui segment">
					<code>composer config -g repositories.packagist composer {{ $mirror }}</code>
				</div>

				<h3 class="ui header">2. Enjoy</h3>
			</div>
		</div>
	</div>
</div>

<div class="ui inverted vertical footer segment">
	<div class="ui container">
		<div class="ui inverted">
			<h4 class="ui inverted header">About</h4>

			<div class="ui inverted link list">
				<a href="https://github.com/HyanCat/Composer-Proxy" class="item" target="_blank">Github</a>
			</div>
		</div>
	</div>
</div>

</body>

</html>
