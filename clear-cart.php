<?php
    session_start();
    $_SESSION['cart'] = [];
    header("Location:menu.php");
?>
