<?php

    if(isset($membre)) {
        foreach ($membre as $res) {
         print_r($res);
        echo "</br>".$res['pseudo']."<br>".$res['age']."<br>".$res['sexe']."<br>".$res['date_inscription']."<br>".$res['nb_messages']."<br><img class='mini_avat' src='".$res['avatar']."'/>";}
        echo '<form method="POST" id="spoiler' . $res['id'] . '" action="' . WEBROOT . 'membre/set_avatar/' . $res['id'] . '">';
        echo '<input type="hidden" name="id" value="' . $res['id'] . '"/>';
        echo '<input type="text" name="avatar" placeholder="Lien de l\'avatar"/>';
        echo '<input class="button_modif" type="submit" value="modifier" />';
        echo '</form>';
    }

?>