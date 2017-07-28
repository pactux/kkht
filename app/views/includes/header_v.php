<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="NOINDEX, NOFOLLOW">
    <meta name="author" content="pactux">

    <title>Título</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/patch.css'); ?>" />

    <!-- JS -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/global.js'); ?>"></script>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" id="menu-mobile" class="navbar-toggle collapsed" onclick="menuMobile();">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <a class="navbar-brand" href="#"><?= $this->usuario['nome']; ?></a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><?= anchor('chamada', 'Chamada'); ?></li>

            <?php if ($this->usuario['permissao'] > 1): ?>

              <li class="dropdown" onclick="subMenu(this);">
                <a href="#" class="dropdown-toggle">Alunos <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><?= anchor("alunos/novo", "Novo aluno"); ?></li>
                  <li><?= anchor("alunos/listacursos", "Listar todos"); ?></li>
                </ul>
              </li>

              <li class="dropdown" onclick="subMenu(this);">
                <a href="#" class="dropdown-toggle">Professores <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><?= anchor("professores/novo", "Novo professor"); ?></li>
                  <li><?= anchor("professores/lista", "Listar todos"); ?></li>
                </ul>
              </li>

              <li class="dropdown" onclick="subMenu(this);">
                <a href="#" class="dropdown-toggle">Cursos <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><?= anchor("cursos?a=cadastrar", "Novo curso"); ?></li>
                  <li><?= anchor("cursos?a=listar", "Listar todos"); ?></li>
                </ul>
              </li>

              <li class="dropdown" onclick="subMenu(this);">
                <a href="#" class="dropdown-toggle">Resumo <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><?= anchor('resumo/busca?b=aluno', 'Por aluno'); ?></li>
                  <li><?= anchor('resumo/busca?b=periodo', 'Por período'); ?></li>
                </ul>
              </li>

              <li class="dropdown" onclick="subMenu(this);">
                <a href="#" class="dropdown-toggle">Pagamentos <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><?= anchor('pagamentos/gerarlista', 'Gerar lista'); ?></li>
                  <li><?= anchor('pagamentos/atual', 'Verificar pagamentos'); ?></li>
                  <li><?= anchor('pagamentos/historico', 'Pesquisar anteriores'); ?></li>
                </ul>
              </li>

            <?php endif ?>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><?= anchor("login/signOut", 'Sair', array('title' => 'Sair')); ?></li>
          </ul>
        </div>

      </div>
    </nav>

    <div class="dist-topo"></div>
