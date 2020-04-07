<?php
class PainelController{

    public function index(){
        //tituo da pagina
        $_SESSION['title'] = 'Dashboard';
        //chama todas as postagens e coloca em um array
        $postagem = Postagem::selectAll();
        $dados['postagem']=$postagem;

        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        //carrega a view home
        $template = $twig->load('painel.html');
        //renderiza a pagina passando os atributos para serem substituidos
        echo $template->render($dados);
        
    }

    public function select($id){
        //titulo da pagina
        $_SESSION['title'] = 'Dashboard';
        // seleciona a postagem passando o id e passando para um array
        $resultado = Postagem::select($id[0]);
        $dados['postagem']=$resultado['postagem'];

        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        //carrega a view home
        $template = $twig->load('alterar.html');
        //renderiza a pagina passando os atributos para serem substituidos
        echo $template->render($dados);
        
    }

    public function inserir(){
        //titulo da pagina
        $_SESSION['title'] = 'Dashboard';
        // pego do POST o titulo e conteudo da postagem
        $dados['titulo'] = addslashes($_POST['titulo']);
        $dados['conteudo'] = addslashes($_POST['conteudo']);
        //verifico se os campos estão vazios
        if (!empty($dados['titulo']) && !empty($dados['conteudo'])) {
            //verifico se retornou alguma alteração do banco de dados
            // passa od dados a que vão ser inseridos
            $resultado = Postagem::insert($dados);
            if ($resultado) {
                // titilo da pagina
                $_SESSION['title'] = 'Dashboard';
                // antes de redirecionar puxo todo as postagens novamente
                $postagem = Postagem::selectAll();
                $dados['postagem'] = $postagem;
                //acrescento um alerta de succesa da inserção
                $dados['alerta'] = 'Sua postagem foi feita com sucesso !';
                $dados['tipoAlerta'] = 'success';


                $loader = new \Twig\Loader\FilesystemLoader('app/view');
                $twig = new \Twig\Environment($loader);
                //carrega a view home
                $template = $twig->load('painel.html');
                //renderiza a pagina passando os atributos para serem substituidos
                echo $template->render($dados);
            }
        }
    }

    public function delete($id){
        //titulo da pagina
        $_SESSION['title'] = 'Dashboard';
        // chama da delação passando o indice
        $resultado = Postagem::delete($id[0]);
        // verifico se a deleção foi feita
        if ($resultado) {
        // ante de redirecionar chama todo as postagens novamente
        $resultado = Postagem::selectAll();
        $dados['postagem']=$resultado;
        // acrescenta o alerta da deleção
        $dados['alerta'] = 'Sua postagem foi Deletada!';
        $dados['tipoAlerta'] = 'danger';

        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        //carrega a view home
        $template = $twig->load('painel.html');
        //renderiza a pagina passando os atributos para serem substituidos
        echo $template->render($dados);
        }
    }

    public function update($id){
        //titulo da pagina
        $_SESSION['title'] = 'Dashboard';
        // pega o id onde sera feita a update atribui ao array
        $dados['id'] = $id[0];
        // pega os dados que veio do POST e atribui ao array
        $dados['titulo'] = addslashes($_POST['titulo']);
        $dados['conteudo'] = addslashes($_POST['conteudo']);
        // verifia se não esvazio
        // talvez não precise porque o fermulario já esta verificando
        if (!empty($dados['id']) && !empty($dados['titulo']) && !empty($dados['conteudo'])) {
            // se houver retorno redireciona para o painel
            if (Postagem::alterar($dados)) {
                header('location: http://localhost/projeto_crud/painel/index ');
            }else{
                echo 'A alteração não pôde ser feita'; 
            }
        }else{
            echo 'Preencha todos os campos!';
        }

    }
        
}