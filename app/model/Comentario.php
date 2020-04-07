<?php
class Comentario{
    
    public static function selectComentario($id){
        $conn = Conexao::getConect();
        $sql = "SELECT * FROM comentario WHERE id_postagem = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        //crio um array vazio
        $resultado = array();
        //loop para pegar cada linha do objeto e colocar no ARRAY
        while($row = $stmt->fetchObject()){
            $resultado[]= $row;
        }
        // $resultado =$stmt->fetch(PDO::FETCH_OBJ);
        return $resultado;

    }
}