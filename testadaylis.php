<?php
include("html/mainheader.html");
include("html/menu.html");
// Connexion au serveur MySQL
// mysql_connect(DB_SERVER, SERVER_USER, SERVER_PASSWORD);

$link = mysqli_connect("localhost", "root", "", "maladie2");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<div id="page-wrapper">
    <div class="main-page">
<?php
$recup_question = "SELECT id_question,type_question,id_type,colonne_assoc FROM ordre_question ORDER BY id_question ASC";

$resultat_recup_question = mysqli_query($link, $recup_question) or die(mysqli_error($link));
?> 
        <form method="POST" action="enregistrer_patient.php">
        <?php
        while ($temp_recup_question = mysqli_fetch_assoc($resultat_recup_question)) {


            $select_question = "SELECT *  FROM " . $temp_recup_question['type_question'] . " WHERE id_" . $temp_recup_question['type_question'] . "=" . $temp_recup_question['id_type'] . " ";
            $resultat_slect_question = mysqli_query($link, $select_question) or die(mysqli_error($link));

            while ($temp_select_question = mysqli_fetch_assoc($resultat_slect_question)) {
                if ($temp_recup_question['type_question'] == 'checkbox') {

                    $aa = "reponse_" . $temp_recup_question['type_question'] . "";
                    $solution_checkbox = explode(";", $temp_select_question[$aa]);
                    $i = 0;
                    $k = count($solution_checkbox);
                    echo $temp_select_question['question'];
                    ?><br/><?php
                        while ($i < $k) {
                            ?>
                            <input type="checkbox" class="cbp-spmenu-push" name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc'] . $i; ?>" value="<?php echo $solution_checkbox[$i]; ?>"/><label for="<?php echo $temp_recup_question['colonne_assoc'] . $i; ?>"><?php echo $solution_checkbox[$i]; ?></label>
                            <?php
                            $i++;
                        }
                        echo "<br/>";
                    } elseif ($temp_recup_question['type_question'] == 'radio') {
                        $aa = "reponse_" . $temp_recup_question['type_question'] . "";

                        $solution_radio = explode(";", $temp_select_question[$aa]);
                        $i2 = 0;
                        $k2 = count($solution_radio);
                        echo $temp_select_question['question'];
                        ?><br/><?php
                        while ($i2 < $k2) {
                            ?>
                            <input type="radio" name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc'] . $i2; ?>" value="<?php echo $solution_radio[$i2]; ?>"/><label for="<?php echo $temp_recup_question['colonne_assoc'] . $i2; ?>"><?php echo $solution_radio[$i2]; ?></label>
                            <?php
                            $i2++;
                        } echo "<br/>";
                    } elseif ($temp_recup_question['type_question'] == 'text') {
                        echo $temp_select_question['question'];
                        ?><br/><?php
                        $aa = "reponse_" . $temp_recup_question['type_question'] . "";
                        if ($temp_select_question[$aa] == 'date') {
                            ?><input type="<?php echo $temp_select_question[$aa]; ?>" name="<?php echo $temp_recup_question['colonne_assoc']; ?>" placeholder="YYYY-MM-JJ" id="<?php echo $temp_recup_question['colonne_assoc']; ?>"/><?php
                        } else {
                            ?><input type="<?php echo $temp_select_question[$aa]; ?>" class="boxes" name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc']; ?>"/><?php
                        }
                        echo "<br/>";
                    } elseif ($temp_recup_question['type_question'] == 'textarea') {

                        $aa = "reponse_" . $temp_recup_question['type_question'] . "";
                        echo $temp_select_question[$aa];
                        ?> 
                        <br/>
                        <textarea name="<?php echo $temp_recup_question['colonne_assoc']; ?>" rows="7" cols="60" id="<?php echo $temp_recup_question['colonne_assoc']; ?>"></textarea>
                        <?php
                        echo "<br/>";
                    } elseif ($temp_recup_question['type_question'] == 'selection') {
                        $aa = "reponse_" . $temp_recup_question['type_question'] . "";
                        $solution_select = explode(";", $temp_select_question[$aa]);
                        $i3 = 0;
                        $k3 = count($solution_select);
                        echo $temp_select_question['question'];
                        ?><br/>
                        <select name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc']; ?>">
                        <?php
                        while ($i3 < $k3) {
                            ?>
                                <option value="<?php echo $solution_select[$i3]; ?>"><?php echo $solution_select[$i3]; ?></option>
                                <?php
                                $i3++;
                            } echo "</select><br/>";
                        }
                    }
                }
                ?>
                <input type="submit" value="enregistrer">
                </form>

                </div>
                </div>
<?php
include("html/mainfooter.html");
?>