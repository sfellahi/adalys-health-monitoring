
    <?php
    session_start();
    session_unset();
    session_destroy();
    header('Location: membre.php');
    exit();
    ?>
    <?php
include("html/mainheader.html");
include("html/menu.html");
?>
<div id="page-wrapper">
<div class="main-page">