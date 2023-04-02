<?php
    session_start();
    unset($_SESSION['id_user']);
    unset($_SESSION['nik']);
    session_destroy();

    header("Location: doc_logout.php");
    exit;
?>