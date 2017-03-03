<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="robots" content="NOINDEX, NOFOLLOW" />

	<title>Erro</title>

	<style type="text/css">

		::selection { background-color: #E13300; color: white; }
		::-moz-selection { background-color: #E13300; color: white; }

		body {
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
			background-color: #eeeeee;
		}

		a {
			font-weight: normal;
			color: #003399;
			background-color: transparent;
		}

		h1 {
			margin-top: 1.8em;
			margin-bottom: 0.29em;
			font-size: 9em;
			text-align: center;
			color: #444444;
			background-color: transparent;
		}

		p {
			margin: 40px -16px 12px 15px;
			font-size: 15px;
			text-align: center;
		}

	</style>
</head>
<body>
	<div id="container">
		<h1><b><?php echo $heading; ?></b></h1>
		<?php echo $message; ?>
	</div>
</body>
</html>