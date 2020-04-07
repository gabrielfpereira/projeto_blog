<?php
class Postagem{
//seleciona todas as postagem do banco de dados
    public static function selectAll(){
        $conn = Conexao::getConect();
        $sql = "SELECT * FROM postagem";
        $stmt =$conn->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    //seleciona no banco a postagem pelo id que é recebido
    public static function select($id){
        $conn = Conexao::getConect();
        $sql = "SELECT * FROM postagem WHERE id = :id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        //crio um array vario
        $resultado =array();

        if($stmt->rowCount()){
            // crio 2 objetos dentro do ARRAY
            $resultado['postagem'] = $stmt->fetch(PDO::FETCH_OBJ);
            $resultado['comentario'] = Comentario::selectComentario($id);
            return $resultado;
        }else{
            echo "Post não encontrado";
        }
    }

    public function alterar($dados){
        $conn = Conexao::getConect();
        $sql = "UPDATE postagem SET titulo = :t , conteudo = :c WHERE id = :id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id',$dados['id']);
        $stmt->bindValue(':t',$dados['titulo']);
        $stmt->bindValue(':c',$dados['conteudo']);
        $stmt->execute();

        if ($stmt->rowCount()) {
            return true;
        }
    }

    public function delete($id){
        $conn = Conexao::getConect();
        $sql = "DELETE FROM postagem WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount()) {
            return true;
        }

    }

    public function insert ($dados)
    {
        $conn = Conexao::getConect();
        $sql = "INSERT INTO postagem(titulo,conteudo) VALUE(:t,:c)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':t',$dados['titulo']);
        $stmt->bindValue(':c',$dados['conteudo']);
        $stmt->execute();

        if ($stmt->rowCount()) {
            return true;
        }
    }
}