<?php
$path = KERNEL.'/controller.php';
require_once("$path");

class controllermessage extends controller
{
    public function __construct() {
        $this->models=array('sujet','message');
        parent::__construct();
    }

    function read($id)
    {
        $data = array('message'=>$this->message->read($id));
        $this->set($data);
        $this->render('read');
    }

    function readAll() {
        $data = array('topic'=>$this->topic->readAll());
        $this->set($data);
        $this->render('read');
    }


    /*function read()
    {
        $id_suj = $_REQUEST['id_suj'];
        $message1 = new message();
        $message1->set_id_sujet($id_suj);
        $data = $message1->read();
        if (isset($data)) {
            foreach ($data as $res) {
                echo '<div class="forum_case"><div class="forum_case_titleset"><div class="forum_case_name"><a href="message.php?id_suj=' . $res['id'] . '">' . $res['nom'] . '</a></div>';
                echo "auteur : " . $res['id_auteur'] . " | " . $res['corps'] . '</br>' . '</br>' . '</div><div class="forum_case_message_block">qsfd<input class="button_test" type="submit" name="' . $res['id'] . '" value="supprimer EN AJAX" />
		<form method="POST" action="kernel/update_sujet.php">
			<input type="hidden" name="id" id="id" value="' . $res['id'] . '"/>
			<input type="hidden" name="id_sujet" value="' . $res['id_sujet'] . '"/>
			<input type="hidden" name="id_auteur" value="' . $res['id_auteur'] . '"/>
			<input type="text" name="nom" placeholder="Nom"/>
			<input class="button_modif" type="submit" value="modifier" />
		</form>
		</div></div>';
                echo $res['id'];
            }
        } else {
            echo "<div class='minor-red'>Ce sujet est vide !</div>";
        }
    }*/

    function create()
    {
        session_start();
        $id_suj = $_REQUEST['id_suj'];
        $corps = $_POST['corps'];
        $id_auteur = $_POST['id_auteur'];
        $corps = pg_escape_string($corps);
        $date = date('c', time());

        $message1 = new message();
        $message1->set_corps($corps);
        $message1->set_id_auteur($_SESSION['id']);
        $message1->set_date($date);
        $message1->set_id_sujet($id_suj);
       /* $req ="select * from membre where (pseudo = '".$id_auteur."')";
        echo $req;
        $bdd = connex::connexion();
        $res = connex::$bdd->query($req);
        $data = $res->fetch();*/
        $req = "update sujet SET dernier_message ='".$_SESSION['pseudo']."' where (id = ".$id_suj.")";
        $bdd = connex::connexion();
        $res = connex::$bdd->query($req);
        $req ="select nb_messages from membre where (id = ".$_SESSION['id'].")";
        $bdd = connex::connexion();
        $res = connex::$bdd->query($req);
        $data = $res->fetch();
        $nb_message = $data['nb_messages'] +1;
        $req = "update membre SET nb_messages =".$nb_message." where (id = ".$_SESSION['id'].")";
        $bdd = connex::connexion();
        $res = connex::$bdd->query($req);

        $req ="select id_categorie from sujet where (id = '".$id_suj."')";
        $bdd = connex::connexion();
        $res = connex::$bdd->query($req);
        $data = $res->fetch();
        $req = "update categorie SET dernier_message ='".$_SESSION['pseudo']."' where (id = ".$data['id_categorie'].")";
        $bdd = connex::connexion();
        $res = connex::$bdd->query($req);
        $message1->createTopic();
        $path = "location:".WEBROOT.'message/read/'.$id_suj;
        header($path);
        //$this->read($id_suj);


    }

    function update()
    {
        $id = $_POST['id'];
        $corps = $_POST['corps'];
        $date = $_POST['date_creation'];
        $id_auteur = $_POST['id_auteur'];
        $id_suj = $_POST['id_suj'];
        $corps = htmlspecialchars($corps);
        $corps = pg_escape_string($corps);
        $message1 = new message();
        $message1->set_id($id);
        $message1->set_date($date);
        $message1->set_id_auteur($id_auteur);
        $message1->set_corps(corps);
        $message1->updateTopic();
        $this->read($id_suj);
    }

    function delete($id)
    {
        $id_suj = $_POST['id_sujet'];
        $sujet1 = new message($id);
        $sujet1->set_id($id);
        $sujet1->del($id);
        $path = "location:".WEBROOT.'message/read/'.$id_suj;
        header($path);
    }


}







?>