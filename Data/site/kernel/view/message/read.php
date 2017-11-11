<div id="forum-content-list">
    <script src="<?php echo JS; ?>tinymce/tinymce.min.js"></script>

<?php
session_start();
unset($_POST);
if(isset($message)) {
    foreach ($message as $res) {
        $req= 'select * from membre where(id = '.$res['id_auteur'].')';
        $bdd = connex::connexion();
        $res2 = connex::$bdd->query($req);
        $donnee = $res2->fetch();
        echo '<div class="message_block"><div class="avatar_place"><div class="pseudo_up_avat">'.$donnee['pseudo'].'</div><img class="mini_avat" src="'.$donnee['avatar'].'"/></div><div class="forum_case_avat">';
        echo $res['corps'];
        if ($_SESSION['role'] == 1 || $res['id_auteur']==$_SESSION['id']) {
            echo '<form method="POST" id="spoiler' . $res['id'] . '" action="/forum/message/delete/' . $res['id'] . '">
            <input type="hidden" name="id_sujet" value="' . $res['id_sujet'] . '"/>
            <input type="submit" value="Supprimer" name="delete" id="delete"/>
            </form>';
            $id_suj = $res['id_sujet'];
        }
        echo '</div></div>';
    }
} else {
    echo "<span style='color:red;'>Il n'y a aucun message dans ce sujet.</span>";
}

?>
    <?php session_start(); if(isset($_SESSION['pseudo'])) {

    echo '<form METHOD = "POST" action = "/forum/message/create/'.$id_suj.'" >
            <textarea id = "corps_texte" class="textarea_large" name = "corps" placeholder = "" ></textarea >
            <input type = "hidden" id = "id_auteur" name = "id_auteur" value = "'.$_SESSION['pseudo'].'" />
            <input type = "hidden" id = "id_suj" name = "id_suj" value = "';$param = explode ('/',$_GET['p']);$id = $param[2];echo $id; echo '" />
            <input type = "submit" value = "Ajouter le message" name = "create_message" id = "create_message" />
        </form >';
    }?>
</div>


<script>
tinymce.init({ selector:'textarea',plugins: "image textcolor bbcode",toolbar: "image forecolor backcolor emoticons"});</script>

<script>
/*
    $('#create_message').click(function(){
        tinyMCE.triggerSave(true, true);
        window.history.pushState(document.title,'',"message/create");
        alert('ok');
        var corps_texte = document.getElementById("corps_texte").value;
        var id_auteur = document.getElementById("id_auteur").value;
        var id_suj = document.getElementById("id_suj").value;
        var xhr = getXMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                var id = xhr.responseText;
                alert(id);
            }

        };
        var fd = new FormData();

        fd.append('id_suj', id_suj);
        fd.append('corps', corps_texte);
        fd.append('id_auteur', id_auteur);

        xhr.open("POST", "", true);
        xhr.send(fd);
    });
*/
</script>

