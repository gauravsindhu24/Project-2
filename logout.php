<?php
session_start();
unset($_SESSION["user_id"]);
unset($_SESSION["f_name"]);
unset($_SESSION["l_name"]);
header("Location:index.php");
?>