<div id="forum-content-list">
    <?php
    if($_SESSION['role']==1) {
        echo '<input type="button" value="Creer un sujet" name="create_sujet" id="create_sujet"/>
 <div id="create_box">
        <form method="POST" action="categorie/create">
            <input type="text" id="nom_topic" name="nom" placeholder="Nom du topic"/>
            <input type="text" id="description" name="description" placeholder="description"/>
            <input type="text" id="image" name="image" placeholder="image"/>
            <input type="submit" value="Creer un topic" name="create_sujet1" id="create_sujet1"/>
        </form>
    </div>';}?>
<?php session_start();
if(isset($categorie)) {
    foreach ($categorie as $res) {
        echo '<div class="forum_case"><div class="forum_case_titleset"><div class="forum_case_name"><a href=/forum/sujet/read/' . $res['id'] . '>' . $res['libelle'] . '</a></div>';

       echo '</div><div class="forum_case_message_block">';
        if (isset($res['image'])) {
            echo '<a href=/forum/sujet/read/' . $res['id'] . '><img class="image_cat" src="' . $res['image'] . '" /></a>';
        }
        if($_SESSION['role']==1) {
            echo '<button value="clique" name="' . $res['id'] . '" onclick="loadspoiler(\'' . $res['id'] . '\')">yuuty</button>';
            echo '"spoiler'.$res['id'].'"';
            echo '<form id="spoiler'.$res['id'].'" method="POST" action="' . WEBROOT . 'categorie/update/' . $res['id'] . '/">
                <input type="hidden" name="id" value="' . $res['id'] . '"/>
                <input type="text" name="nom" placeholder="Nom"/>
                <input type="text" name="image" placeholder="Image"/>
                <input class="button_modif" type="submit" value="modifier" />
            </form>';
        }

        if($_SESSION['role']==1){
            echo '
            <form method="POST" action="' . WEBROOT . 'categorie/delete/' . $res['id'] . '">
                <input class="button_suppr" type="submit" value="Supprimer normalement" />
            </form>
            ';
        }

                echo'</div></div>';

    }
} else {
    echo "<span style='color:red;'>Cette catégorie n'existe pas !</div>";
}
?>                                                                  