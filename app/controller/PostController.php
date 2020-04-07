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

    public function comentar($id)
    {
        $resultado = Postagem::select($id[0]);
        $dados['postagem']=$resultado['postagem'];
        $_SESSION['title']= $dados['postagem']->titulo;
        //tratar o post e chamar a model para inserir o comentario
        $dados['id']= $id[0];
        $dados['nome']= addslashes($_POST['nome']);
        $dados['comentario']= addslashes($_POST['comentario']);


        $resultado = Comentario::insert($dados);
        if($resultado){
            $resultado = Postagem::select($id[0]);
            //faço 2 coleções uma com conteudo da postagem e outra os comentario
            $dados['comentarios'] = $resultado['comentario'];
            $dados['postagem'] = $resultado['postagem'];
            $dados['alerta']='Comentado com seucesso';
            $dados['tipoAlerta']='success';
    
            //header('location: http://localhost/projeto_crud/post/index/'.$id[0]);
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            //carrega a view home
            $template = $twig->load('post.html');
            //renderiza a pagina passando os atributos para serem substituidos
            //sempre de ser passar um ARRAY no render
            echo $template->render($dados);
        }
    }

    public function deletarComentario($id){
        // trazer id / chamar model deletar / renderira tudo
        $resultado = Comentario::deletar($id[0]);

        if ($resultado) {
            $resultado = Postagem::select($id[1]);
            //faço 2 coleções uma com conteudo da postagem e outra os comentario
            $post['comentarios'] = $resultado['comentario'];
            $post['postagem'] = $resultado['postagem'];

            $post['alerta']='Comentário Deletado';
            $post['tipoAlerta']='danger';
    
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
}