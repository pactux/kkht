<?php

  $mensagens = array(
    'Usuário ou senha inválidos' => 'warning',
    'Sessão encerrada com sucesso' => 'success',
    'Enviamos a nova senha para seu E-mail' => 'sent',
    'E-mail informado não existe' => 'danger',
    'Falha no envio da nova senha' => 'error'
  );

?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="NOINDEX, NOFOLLOW">
    <meta name="author" content="pactux">

    <title>Login</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>" />
    <script type="text/javascript" src="<?= base_url('assets/js/login.js'); ?>"></script>
  </head>

  <body>
    <noscript>
      <style type="text/css"> .container { display: none; } </style>
      <p>Habilite o JavaScript do browser</p>
    </noscript>

    <div class="container">
      <form action="login/signIn" method="post" class="form-signin">

        <?php if ($msg = array_search($dadosIncorretos, $mensagens)): ?>
          <div class="alert alert-<?= $mensagens[$msg]; ?> fade in"><?= $msg; ?></div>
        <?php elseif ($msg = array_search($logout, $mensagens)): ?>
          <div class="alert alert-<?= $mensagens[$msg]; ?> fade in"><?= $msg; ?></div>
        <?php endif ?>

        <h2 class="form-signin-heading">Login</h2>
        <input type="email" name="email" class="form-control" placeholder="E-mail" required autofocus />
        <input type="password" name="senha" class="form-control" placeholder="Senha" required />
        <button type="submit" class="btn btn-success btn-block">Entrar</button>
        <div id="senha"></div>
      </form>
    </div>
  </body>
</html>
