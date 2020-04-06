<?php
class PostController{

    // no index recebe array contendo o id da postagem
    public function index($id){
        // faz o select no bando com dados pegando o id na posição do array que vem como objeto
        $post = Postagem::select($id[0]);
        $template = file_get_contents('app/view/post.html');
        $_SESSION['title'] = $post->titulo;


        echo str_replace(array('#titulo#','#postagem#'),array($post->titulo,$post->conteudo),$template) ;
    
    }
}