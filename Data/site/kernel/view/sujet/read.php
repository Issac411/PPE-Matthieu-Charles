<div id="forum-content-list">
    <?php session_start(); if(isset($_SESSION[pseudo])) {
    echo '<input type="button" value="Creer un sujet" name="create_sujet" id="create_sujet"/>
<div id="create_box">
    <form method="POST" action="../create">
        <input type="text" id="nom" name="nom" placeholder="Nom du sujet"/>
        <input type="hidden" name="id_auteur" value="'.$_SESSION['id'].'"/>
        <input type="hidden" name="id" value="';?><?php $param = explode ('/',$_GET['p']);$id = $param[2];echo $id;?><?php echo '"/>
        <input type="submit" value="Creer un sujet" name="create_sujet1" id="create_sujet1"/>
    </form>
</div>'; }
    ?>
<?php

if(isset($sujet)) {
    foreach ($sujet as $res) {
        echo '<div class="forum_case"><div class="forum_case_titleset"><div class="forum_case_name"><a href=/forum/message/read/' . $res['id'] . '>' . $res['nom'] . '</a></div>';
        echo "Dernier message de :" . $res['dernier_message'];
        if (isset($res['image'])) {
            echo '<img src="' . $res['image'] . '"/>';
        }
        echo '</div><div class="forum_case_message_block">';
        if ($_SESSION['role'] == 1 || $res['id_auteur']==$_SESSION['id']) {
            echo '
            <form id="spoiler' . $res['id'] . '" method="POST" action="' . WEBROOT . 'sujet/update/' . $res['id'] . '">
                <input type="hidden" name="id" value="' . $res['id'] . '"/>
                <input type="hidden" name="id_categorie" value="' . $res['id_categorie'] . '"/>
                <input type="hidden" name="date_creation" value="' . $res['date_creation'] . '"/>
                <input type="hidden" name="id_auteur" value="' . $res['id_auteur'] . '"/>
                <input type="hidden" name="etat" value="' . $res['etat'] . '"/>
                <input type="text" name="nom" placeholder="Nom"/>
                <input class="button_modif" type="submit" value="modifier" />
            </form>


            <form method="POST" action="' . WEBROOT . 'sujet/delete/' . $res['id'] . '">
                <input type="hidden" name="id_categorie" value="' . $res['id_categorie'] . '"/>
                <input class="button_suppr" type="submit" value="Supprimer normalement" />
            </form>
            ';
        }
        echo '</div></div>';
    }
} else {
    echo "<span style='color:red;'>Il n'y a aucun sujet dans cette catégorie.</div>";
}
    ?>