<?php
class SobreController{

    public function index(){
        $_SESSION['title']='Sobre';
        require 'app/view/sobre.html';
    }
}