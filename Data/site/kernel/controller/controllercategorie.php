<?php
$path = KERNEL.'/controller.php';
require_once("$path");
// S OCCUPER DE L UPDATE/DELETE ET CREATE DE SUJET EN INSERANT LE FORUMALIRE DANS LE READ/READALL (créer les fichiers dans [sujet] dans view)
class controllercategorie extends controller
{

    public function __construct() {
        $this->models=array('categorie','sujet');
        parent::__construct();
    }

    public function index() {
        $data = array('categorie'=>$this->categorie->readAll());
        $this->set($data);
        $this->render('index');
    }

    function read($id)
    {
        $data = array('categorie'=>$this->categorie->read($id));
        $this->set($data);

        $this->render('read');
    }

    function readAll() {
        $data = array('categorie'=>$this->categorie->readAll());
        $this->set($data);
        $this->render('read');
    }

    function create()
    {
        $name = $_POST['nom'];
        $image = $_POST['image'];
        $name = htmlspecialchars($name);
        $name = pg_escape_string($name);
        $image = pg_escape_string($image);
        $image = htmlspecialchars($image);
        $categories1 = new categorie();
        $categories1->set_libelle($name);
        $categories1->set_image($image);
        $categories1->createTopic();
        $path = "location:".WEBROOT;
        header($path);
    }

    function update($id)
    {
        $nom = $_POST['nom'];
        $description = pg_escape_string($_POST['description']);
        $image = $_POST['image'];
        $nom = htmlspecialchars($nom);
        $nom = pg_escape_string($nom);
        $image = pg_escape_string($image);
        $image = htmlspecialchars($image);
        $categories1 = new categorie();
        $categories1->set_libelle($nom);
        $categories1->set_image($image);
        $categories1->set_id($id);
        $categories1->updateTopic();
        $path = "location:".WEBROOT;
        header($path);
    }

    function delete($id) {
        $categories1 = new categorie();
        $categories1->del($id);
    }





}








?>
