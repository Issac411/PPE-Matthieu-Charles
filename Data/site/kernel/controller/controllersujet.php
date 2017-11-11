<?php
$path = KERNEL.'/controller.php';
require_once("$path");

class controllersujet extends controller
{

    public function __construct() {
        $this->models=array('sujet','message');
        parent::__construct();
    }

    public function index() {
        $data = array('sujet'=>$this->sujet->readAll());
        $this->set($data);
        $this->render('index');
    }


    public function read($id)
    {
        $data = array('sujet'=>$this->sujet->read($id));
        $this->set($data);
        $data2 = array($this->recupNbMessage($id));
        $this->render('read');
    }

    public function readAll()
    {
        $data = array('sujet'=>$this->sujet->readAll());
        $this->set($data);
        $this->render('read');
    }

    function create()
    {
        $nom = $_POST['nom'];
        $id_categorie = $_POST['id'];
        $id_auteur = $_POST['id_auteur'];
        $name = htmlspecialchars($nom);
        $nom_sujet = htmlspecialchars($nom);
        $nom_sujet = pg_escape_string($nom);
        $date = date('c', time());
        $sujet1 = new sujet();
        $sujet1->set_nom($nom);
        $sujet1->set_id_auteur($id_auteur);
        $sujet1->set_date($date);
        $sujet1->set_etat(true);
        $sujet1->set_categorie($id_categorie);
        $req ="select pseudo from membre where (id = ".$id_auteur.")";
        $bdd = connex::connexion();
        $res = connex::$bdd->query($req);
        $data = $res->fetch();
        $req = "update categorie SET dernier_message ='".$data['pseudo']."' where (id = ".$id_categorie.")";
        $bdd = connex::connexion();
        $res = connex::$bdd->query($req);
        $sujet1->createTopic();
        $path = "location:".WEBROOT.'sujet/read/'.$id_categorie;
        header($path);
    }

    function update()
    {
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $id_categorie = $_POST['id_categorie'];
        $date = $_POST['date_creation'];
        $etat = $_POST['etat'];
        $id_auteur = $_POST['id_auteur'];
        $nom = htmlspecialchars($nom);
        $nom = pg_escape_string($nom);
        $sujet1 = new sujet();
        $sujet1->set_id($id);
        $sujet1->set_nom($nom);
        $sujet1->set_date($date);
        $sujet1->set_etat($etat);
        $sujet1->set_id_auteur($id_auteur);
        $sujet1->set_categorie($id_categorie);
        $sujet1->updateTopic();
        $path = "location:".WEBROOT.'sujet/read/'.$id_categorie;
        header($path);
    }

    function delete($id)
    {

        $sujet1 = new sujet($id);
        $id_categorie = $_POST['id_categorie'];
        $sujet1->set_id($id);
        $sujet1->del($id);
        $path = "location:".WEBROOT.'sujet/read/'.$id_categorie;
        header($path);
    }

    function recupNbMessage($id) {
        $req = "SELECT * FROM message where(id_sujet = ".$id.") ORDER BY id ASC;";
        $bdd = connex::connexion();
        $res = connex::$bdd->query($req);
        while($data = $res->fetch()) {
            $cats[] = $data;
        }
        $bdd = null;
        return $cats;
    }



}


















?>