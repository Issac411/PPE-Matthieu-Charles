<?php
session_start();
	if(isset($_SESSION['nom'])) {	
	}
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css" media="all">@import "css/style.css";</style>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>

    <title>RPGDBS</title>

</head>
<body>
				<form method="post" action="kernel/connexion.php">
						Adresse mail : <input type="text" name="mail" id="mail" size="30" style="margin-left:0px">
					</br>
						Mot de passe : <input type="password" name="mdp" id="mdp" size="30" >
					</br>
						<a href="password_recup.php">Mot de passe oublié</a> <a href="inscription.php">S'inscrire</a>
					<input type="submit" value="Envoyer" name="b_connexion" id="b_connexion"/>
				</form>

				<div class="blue_box">
					Informations : </br>
					<?php 
						if(isset($_SESSION['nom'])) {
							echo $_SESSION['nom']." ";
						}
					?>
					</div>
				

</body>