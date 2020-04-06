<?php
require_once 'app/core/Core.php';
require_once 'app/controller/HomeController.php';
require_once 'app/controller/ErroController.php';
require_once 'app/model/Postagem.php';
require_once 'app/model/Conexao.php';

$core = new Core;
$core->start($_GET);