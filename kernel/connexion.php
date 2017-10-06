<?php
	require('connex.class');
	connex::connexion();
	session_start();
	if(ISSET($_POST['mail'])) {
		$mdp = $_POST['mdp'];
		$mail = $_POST['mail'];
		$mdp = md5($mdp);
		echo $mdp." | ";
		$req = 'SELECT * FROM utilisateurs where (adresse_mail="'.$mail.'")';
		echo $req;
		$req = connex::$bdd->query($req);
		if ($res = $req->fetch()) {
			echo $res['mdp']." | ";
			if($res['mdp']==$mdp) {	
				$_SESSION['mail'] = $mail;
				$_SESSION['id'] = $res['id'];
				$_SESSION['nom'] = $res['nom'];
				header('location: ../index.php');
			} else {
				$_SESSION['id'] = '-1';
				header('location: ../index.php');
			}
		} else {
				$_SESSION['id'] = '-1';
				header('location: ../index.php');
		}
	} else {
			$_SESSION['id'] = '-1';
			header('location: ../index.php');
	}

	
?>