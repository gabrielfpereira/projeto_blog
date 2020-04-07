<?php
class PainelController{

    public function index(){
        $_SESSION['title'] = 'Dashboard';
        
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
        $_SESSION['title'] = 'Dashboard';
        
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

        $_SESSION['title'] = 'Dashboard';
        // pego do POST o titulo e conteudo da postagem
        $dados['titulo'] = addslashes($_POST['titulo']);
        $dados['conteudo'] = addslashes($_POST['conteudo']);
        //verifico se os campos estão vazios
        if (!empty($dados['titulo']) && !empty($dados['conteudo'])) {
            //verifico se retornou alguma alteração do banco de dados
            $resultado = Postagem::insert($dados);
            if ($resultado) {
                // redireciona para a area do painel novamente
                header('location: http://localhost/projeto_crud/painel/index');
            }
        }
    }

    public function delete($id){
        $_SESSION['title'] = 'Dashboard';
        $resultado = Postagem::delete($id[0]);
        if ($resultado) {
           header('location: http://localhost/projeto_crud/painel/index ');
        }
    }

    public function update($id){

        $_SESSION['title'] = 'Dashboard';
        $dados['id'] = $id[0];
        $dados['titulo'] = addslashes($_POST['titulo']);
        $dados['conteudo'] = addslashes($_POST['conteudo']);
        if (!empty($dados['id']) && !empty($dados['titulo']) && !empty($dados['conteudo'])) {
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