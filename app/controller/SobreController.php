<?php
class SobreController{

    public function index(){
        $_SESSION['title'] = "Sobre";

        require_once 'app/view/sobre.html';
    }
}