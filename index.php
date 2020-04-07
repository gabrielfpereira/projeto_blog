<?php
require_once 'vendor/autoload.php';

require_once 'app/core/Core.php';
require_once 'app/model/Conexao.php';
require_once 'app/model/Comentario.php';

//paginas
require_once 'app/controller/HomeController.php';
require_once 'app/controller/ErroController.php';
require_once 'app/model/Postagem.php';
require_once 'app/controller/SobreController.php';
require_once 'app/controller/PostController.php';
require_once 'app/controller/PainelController.php';

//carrega o arquivo com a base html do site e salva na variavel
$template = file_get_contents('app/view/base.html');

// o ob_ pega o que esta entre o inicio e fim e armazena na saida $pagina atraves do get_contents
ob_start();
$core = new Core;
$core->start($_GET); // resultado do controlller
$pagina = ob_get_contents();
ob_end_clean();

// pega o titulo da pagina da sessao para inserir no replace
$title = $_SESSION['title'];

// Substituui o conteudo #Conteudo# da pagina base pelo da saida do ob_ e impreime na tela
echo str_replace(array('#Conteudo#','#title#'),array($pagina,$title),$template);