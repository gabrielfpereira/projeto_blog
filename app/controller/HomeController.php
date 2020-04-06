<?php
class HomeController{
    public function index(){
        $pos = Postagem::selectAll();
        var_dump($pos);
        //require 'app/view/home.html';
    }
}