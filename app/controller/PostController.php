<?php
class PostController{

    // no index recebe array contendo o id da postagem
    public function index($id){
        // faz o select no bando com dados pegando o id na posição do array que vem como objeto
        $resultado = Postagem::select($id[0]);
        $coments = $resultado['comentario'];
        $post = $resultado['postagem'];

        if(!$coments){
            $coments = array('nome'=>'Comente','mesagem'=>'Seja o primeiro a comentar');
        }

        var_dump($coments);
        $template = file_get_contents('app/view/post.html');
        $_SESSION['title'] = $post->titulo;


        echo str_replace(
            array('#titulo#','#postagem#','#nome#','#mensagem#'),
            array($post->titulo,$post->conteudo,$coments->nome,$coments->mensagem),
            $template) ;
    
    }
}