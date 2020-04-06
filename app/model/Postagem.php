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
}