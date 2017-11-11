<?php
$path = KERNEL.'/controller.php';
require_once("$path");

class controlleraccueil extends controller
{
    public function __construct()
    {
        $this->models = array('membre', 'categorie');
        parent::__construct();
    }

    function Accueil()
    {
        $data = array('categorie'=>$this->categorie->readAll());
        $this->set($data);
        $this->render('accueil');
    }

    function index()
    {
        $data = array('categorie'=>$this->categorie->readAll());
        $this->set($data);
        $this->render('accueil');
    }
}

?>