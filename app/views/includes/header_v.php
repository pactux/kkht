<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="NOINDEX, NOFOLLOW">
    <meta name="author" content="pactux">

    <title>Starter Template for Bootstrap</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/patch.css'); ?>" />

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
          
          <a class="navbar-brand" href="#">Project name</a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><?php echo anchor('chamada', 'Chamada'); ?></li>
            <li class="dropdown" onclick="subMenu(this);">
              <a href="#" class="dropdown-toggle">Alunos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><?php echo anchor("", "Novo aluno"); ?></li>
                <li><?php echo anchor("", "Listar todos"); ?></li>
              </ul>
            </li>

            <li class="dropdown" onclick="subMenu(this);">
              <a href="#" class="dropdown-toggle">Professores <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><?php echo anchor("", "Novo professor"); ?></li>
                <li><?php echo anchor("", "Listar todos"); ?></li>
              </ul>
            </li>

            <li class="dropdown" onclick="subMenu(this);">
              <a href="#" class="dropdown-toggle">Cursos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><?php echo anchor("cursos?acao=cadastrar", "Novo curso"); ?></li>
                <li><?php echo anchor("cursos?acao=listar", "Listar todos"); ?></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><?php echo anchor("login/signOut", 'Sair', array('title' => 'Sair')); ?></li>
          </ul>
        </div>

      </div>
    </nav>

    <div class="dist-topo"></div>
