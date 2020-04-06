<?php
class PostController{

    // no index recebe array contendo o id da postagem
    public function index($id){
        // faz o select no bando com dados pegando o id na posição do array que vem como objeto
        $resultado = Postagem::select($id[0]);
        $post['comentarios'] = $resultado['comentario'];
        $post['postagem'] = $resultado['postagem'];

        //  var_dump($post);
        $_SESSION['title'] = $post['postagem']->titulo;

        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        //carrega a view home
        $template = $twig->load('post.html');
        //renderiza a pagina passando os atributos para serem substituidos
        echo $template->render($post);
    
    }
}