<?php
	require_once('model/connex.class');
	connex::connexion();
    session_start();
	if(ISSET($_POST['pseudo'])) {
		$mdp = $_POST['mdp'];
		$pseudo = $_POST['pseudo'];
		$req = connex::$bdd->query('SELECT * FROM membre where (pseudo =\''.$pseudo.'\')');
		if ($res = $req->fetch()) {
			if($res['mdp']==$mdp) {	
				$_SESSION['pseudo'] = $pseudo;
				$_SESSION['id'] = $res['id'];
                $_SESSION['status'] = $res['status'];
                $_SESSION['role'] = $res['role'];
                $path = 'location:../';
				header($path);

			} else {
				$_SESSION['id'] = '-1';
                $path = 'location:../';
                header($path);
			}
		} else {
            $_SESSION['id'] = '-1';
            $path = 'location:../';
            header($path);

		}
	}

	
?>