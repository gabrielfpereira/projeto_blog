<?php
class Core{

    private $controller;
    private $method;
    private $params;

    public function start($req){
        $url = $req['url'];
        $res = explode('/',$url);

        if ($url == '') {
            $this->controller = 'HomeController';
            $this->method = 'index';

            call_user_func(array($this->controller, $this->method), $this->params);
        }else{
            $this->controller = ucfirst($res[0]) . 'Controller';
            array_shift($res);

            $this->method = $res[0];
            array_shift($res);

            $this->params = $res;

            if (class_exists($this->controller)) {
                call_user_func(array($this->controller, $this->method), $this->params);
            } else {
                header('location: http://localhost/projeto_crud/erro/index');
            }
        }
    }
}