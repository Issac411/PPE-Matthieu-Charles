<?php
// Cette template est la base du forum, elle contiendra en son body les éléments essentiels procurés par les controllers.

    session_start();
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css" media="all">@import "<?php echo CSS."/style.css"?>";</style>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>

    <title>RPGDBS</title>

</head>


<body>
<div id="fils">
    <div id="top-bar">
        <div id="element-table">
            <div class="top-bar-elem"><a class="top_bar_links" href="<?php echo WEBROOT; ?>">Accueil</a></div>
            <div class="top-bar-elem">Recherche</div>
            <div class="top-bar-elem">Wiki</div>
            <div class="top-bar-elem">FAQ</div>
            <?php
            if(ISSET($_SESSION['pseudo'])) {
                echo '<div class="top-bar-elem"><a href="'.WEBROOT."membre/read/".$_SESSION['id'].'">Profil</a></div>';
                echo '<div class="top-bar-elem" id="deconnexion_button" ><a href="/forum/kernel/deconnexion.php">Se deconnecter</a></div>';
            } else {
                echo '<div class="top-bar-elem" id="connexion_button" >Se connecter</div>';
                echo '<div class="top-bar-elem">Inscription</div>';
            }
            ?>
        </div>
    </div>
    <div id="connexion_popup">
        <div id="connexion_popup_content">
            <form method="post" action="<?php echo WEBROOT;?>kernel/connexion.php">
                Pseudo : <input type="text" name="pseudo" id="pseudo" size="30" style="margin-left:42px">
                </br>
                Mot de passe : <input type="password" name="mdp" id="mdp" size="30" >
                </br>
                <a href="password_recup.php">Mot de passe oublié</a> <a href="inscription.php">S'inscrire</a>
                <input type="submit" value="Envoyer" name="b_connexion" id="b_connexion"/>
            </form>
            <?php
            if(isset($_SESSION['id'])) {
                if($_SESSION['id'] == '-1') {
                    echo "<div class='minor-red'>Vos informations de connexion sont erronées.</div>";
                }
            }
            ?>

        </div>


    </div>

    <?php
    echo $content_layout;
    ?>

</body>

<script>

    $('#connexion_button').click(function(){
        if(document.getElementById('connexion_popup').style.display=="block") {
            document.getElementById('connexion_popup').style.display="none";
        } else {
            document.getElementById('connexion_popup').style.display="block";
        }
    });

    $('#create_sujet').click(function(){
        if(document.getElementById('create_box').style.display=="block") {
            document.getElementById('create_box').style.display="none";
        } else {
            document.getElementById('create_box').style.display="block";
        }
    });

    $('#deconnexion_button').click(function(){

        var error = document.getElementById("inscription_errors");

        var xhr2 = getXMLHttpRequest();
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && (xhr2.status == 200 || xhr2.status == 0)) {
                var id = xhr2.responseText;
                alert(id);
                if(id="L'adresse email est d�j� prise, veuillez la changer si vous souhaitez cr�er un compte") {
                    var element = document.getElementById("adresse_mail");
                    element.style.border = "2px solid red";
                }


            }

        };
    });

    function getXMLHttpRequest() {
        var xhr = new XMLHttpRequest();
        return xhr;
    }


    $('.button_test').click(function(){

        var element = this.name;
        var xhr = getXMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                var id = xhr.responseText;
                alert(id);

            }

        };
        var fd = new FormData();

        fd.append('id', element);
        xhr.open("POST", "kernel/delete_topic.php", true);
        xhr.send(fd);
    });

    $('#create_topic2').click(function(){
        var element = this.name;
        var nom = document.getElementById("nom_forum").value;
        var image = document.getElementById("image_forum").value;
        var description = document.getElementById("description_forum").value;
        var xhr = getXMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                var id = xhr.responseText;
                alert(id);

            }

        };
        var fd = new FormData();

        fd.append('id', element);
        fd.append('nom', nom);
        fd.append('image', image);
        fd.append('description', description);

        xhr.open("POST", "kernel/create_forum.php", true);
        xhr.send(fd);
    });

    $('#create_topic').click(function(){
        if(document.getElementById('create_box').style.display=="block") {
            document.getElementById('create_box').style.display="none";
        } else {
            document.getElementById('create_box').style.display="block";
        }
    });

    $('#load_spoiler').click(function(){
        if(document.getElementById('spoiler').style.display=="spoiler") {
            document.getElementById('spoiler').style.display="none";
        } else {
            document.getElementById('spoiler').style.display="block";
        }
    });

    function loadspoiler(id) {
        if(document.getElementById('forum'+id).style.display=="block") {
            document.getElementById('forum'+id).style.display="none";
        } else {
            document.getElementById('forum'+id).style.display="block";
        }

    }





</script>