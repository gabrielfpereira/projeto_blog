<?php
abstract class  Conexao{
    private static $pdo;

    public static function getConect(){

        if(!isset(self::$pdo)){
            self::$pdo = new PDO('mysql: host=localhost ; dbname=projeto_blog','root','');
        }
        return self::$pdo;
    }
}