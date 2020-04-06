<?php
class Postagem{

    public static function selectAll(){
        $conn = Conexao::getConect();
        $sql = "SELECT * FROM postagem";
        $stmt =$conn->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
}