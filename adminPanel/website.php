<?php
include('query.php');
?>

<h1> Hello User </h1>
<?php
if(isset($_SESSION['userEmail'])){
    ?>
<a href="weblogout.php">Logout</a>
<?php
}
else{
    ?>
    <a href="signin.php">Login</a>
    <?php
}
?>

