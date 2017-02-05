<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">

    <title>Kyorugui Kwan - Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>" />
  </head>

  <body>
    <div class="container">
      <form action="login/signIn" method="post" class="form-signin">

        <?php if (isset($_GET['dadosIncorretos'])): ?>
          <div class="alert alert-warning fade in"><?php echo 'Usuário ou senha inválidos'; ?></div>
        <?php elseif (isset($_GET['logout'])): ?>
            <div class="alert alert-success fade in"><?php echo 'Sessão encerrada com sucesso'; ?></div>
        <?php endif ?>

        <h2 class="form-signin-heading">Login</h2>
        <input type="email" name="email" class="form-control" placeholder="E-mail" required autofocus />
        <input type="password" name="senha" class="form-control" placeholder="Senha" required />
        <button type="submit" class="btn btn-lg btn-success btn-block">Entrar</button>
      </form>
    </div>
  </body>
</html>
