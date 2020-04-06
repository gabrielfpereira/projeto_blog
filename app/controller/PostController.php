<?php
class PostController{

    // no index recebe array contendo o id da postagem
    public function index($id){
        // faz o select no banco de dados pegando o id na posição do array que vem como objeto
        $resultado = Postagem::select($id[0]);
        //faço 2 coleções uma com conteudo da postagem e outra os comentario
        $post['comentarios'] = $resultado['comentario'];
        $post['postagem'] = $resultado['postagem'];

        // lembrando que dentro da view é preciso fazer um loop para percorrer os comentários

        //  var_dump($post);
        $_SESSION['title'] = $post['postagem']->titulo;

        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        //carrega a view home
        $template = $twig->load('post.html');
        //renderiza a pagina passando os atributos para serem substituidos
        //sempre de ser passar um ARRAY no render
        echo $template->render($post);
    
    }
}