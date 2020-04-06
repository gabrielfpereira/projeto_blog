<?php
class HomeController{
    public function index(){
        //salvo na sessão o titulo da página
        $_SESSION['title'] = "Home";
        // pega do banco de dados todas as postagens
        $postagem = Postagem::selectAll();
        
        //atribui a coleção das postagens a um array 
        $dados['postagens']= $postagem;
        //diz ao twig onde se encontra as views
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        //carrega a view home
        $template = $twig->load('home.html');
        //renderiza a pagina passando os atributos para serem substituidos
        echo $template->render($dados);

        

        // percorre o objeto das postagens pega cada um e passa para o post
        //foreach ($postagem as $post) {
            // Substitui das tags encontradas na home html pelo conteudo do objeto.
          // echo str_replace(array('#titulo#','#conteudo#','#id#'),array($post->titulo, $post->conteudo,$post->id), $tplHome);
        //}
    }
}