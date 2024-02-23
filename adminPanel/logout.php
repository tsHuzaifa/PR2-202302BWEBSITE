<?php
session_start();
session_unset();
// unset($_SESSION['usEmail']);
echo "<script>
location.assign('signin.php')</script>";
?>