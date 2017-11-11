<?php

class controller {
    protected $layout = 'defaut';
    protected $viewvars=array();
    protected $models=array();

    public function __construct() {
        foreach($this->models as $model) {
            $this->load_model($model);
        }
    }
    public function load_model($model) {
        require_once(MODEL.$model.".class");
        $this->$model = new $model();
    }

    public function render($view) {
        extract($this->viewvars);
        $controller = str_replace('controller','',get_class($this));
        ob_start();
        require_once(VIEW.$controller.'/'.$view.'.php');
        $content_layout = ob_get_clean();
        $skel = VIEW.'layout/'.$this->layout.'.php';
        require_once($skel);
    }

    public function set($variable) {
        $this->viewvars=array_merge($this->viewvars,$variable);// permet de mettre des valeurs dans le viewvar, $variable ne peut être qu'un tableau.
    }
}
