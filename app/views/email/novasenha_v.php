<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Nova senha</title>

	<style type="text/css">
		body {
			font-family: "Helvetica Neue";
		}

		h3 {
		  margin-top: 20px;
		  margin-bottom: 10px;
		  font-family: inherit;
		  font-size: 30px;
		  font-weight: 500;
		  text-align: left;
		  text-decoration: underline;
		  color: #ff0000;
		  line-height: 1.1;
		}

		div {
			height: 10px;
		}

		p {
		  margin: 15px 0 10px;
		  font-size: 14px;
		}

	</style>
</head>

<body>
	<h3>Atenção!</h3>
	<div></div>
	<p><b>Não responda esta mensagem.</b></p>
	<p>Caso possua dúvidas, entre em contato com o administrador do <b>APP</b>.</p>
	<div></div>
	<span><b>Senha:</b> <?php echo $message_body; ?></span>
</body>
</html>
