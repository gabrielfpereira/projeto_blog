<?php
class HomeController{
    public function index(){
        // pega do banco de dados todas as postagens
        $postagem = Postagem::selectAll();
        //pega o template da home 
        $tplHome = file_get_contents('app/view/home.html');

        //salvo na sessão o titulo da página
        $_SESSION['title'] = "Home";

        // percorre o objeto das postagens pega cada um e passa para o post
        foreach ($postagem as $post) {
            // Substitui das tags encontradas na home html pelo conteudo do objeto.
           echo str_replace(array('#titulo#','#conteudo#'),array($post->titulo, $post->conteudo), $tplHome);
        }
    }
}